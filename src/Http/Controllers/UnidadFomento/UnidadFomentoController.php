<?php

namespace Larangular\UnidadFomento\Http\Controllers\UnidadFomento;

use Larangular\UnidadFomento\Models\UnidadFomento;
use Larangular\UFScraper\UnidadFomento as UFScraper;

class UnidadFomentoController {

    private $scraper;

    public function __construct() {
        $this->scraper = new UFScraper();
    }

    public function current($date = null): ?UnidadFomento {
        if (!isset($date)) {
            $date = date('Y-m-d');
        }

        $response = UnidadFomento::byDate($date)
                                 ->first();

        if (!$response) {
            $scrapedUF = $this->scraper->getUnidadFomento($date);
            if (!$scrapedUF || $scrapedUF < 0) {
                $this->tryEmailNotification($date);
                if(!config('unidad-fomento.on_value_fail.get_last')) {
                    return null;
                }

                $lastRecord = UnidadFomento::lastFirst()->first();
                $scrapedUF = $lastRecord->UF;
            }

            $response = UnidadFomento::create([
                                                  'UF'   => $scrapedUF,
                                                  'date' => $date,
                                              ]);
        }

        return $response;
    }

    public function loadRange($startDate, $endDate): void {
        $period = $this->datePeriodDaily($startDate, $endDate);
        foreach($period as $value) {
            $this->current($value->format('Y-m-d'));
        }
    }

    public function loadFromLastRecord(): void {
        $lastRecord = UnidadFomento::lastFirst()->first();
        $today = date('Y-m-d');

        $this->loadRange($lastRecord->date, $today);
    }

    private function tryEmailNotification($date) {
        $email = config('unidad-fomento.on_value_fail.email_to_notify');
        $safeModeEnabled = config('unidad-fomento.on_value_fail.get_last');
        if(!is_null($email) && !empty($email)) {
            $message = [
                'HTTP_HOST' => @$_SERVER['HTTP_HOST'],
                'GET_LAST_ENABLED' => $safeModeEnabled,
                'REQUIRED_DATE' => $date
            ];

            mail($email, 'UFScraper fail', json_encode($message));
        }
    }

    private function datePeriodDaily($startDate, $endDate): \DatePeriod {
        return new \DatePeriod(
            new \DateTime($startDate),
            new \DateInterval('P1D'),
            (new \DateTime($endDate))->setTime(23, 59, 59)
        );
    }

}
