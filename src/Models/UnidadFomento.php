<?php

namespace Larangular\UnidadFomento\Models;

use Illuminate\Database\Eloquent\Model;
use Larangular\Installable\Facades\InstallableConfig;
use Larangular\RoutingController\Model as RoutingModel;

class UnidadFomento extends Model {
    use RoutingModel;

    protected $fillable = [
        'UF',
        'date',
    ];

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $installableConfig = InstallableConfig::config('Larangular\UnidadFomento\UnidadFomentoServiceProvider');
        $this->connection = $installableConfig->getConnection('unidad_fomento');
        $this->table = $installableConfig->getName('unidad_fomento');
        $this->timestamps = $installableConfig->getTimestamp('unidad_fomento');
    }

    public function scopeByDate($query, $date = null) {
        if (!isset($date)) {
            $date = date('Y-m-d');
        }
        return $query->where('date', $date);
    }

    public function scopeLastFirst($query) {
        return $query->orderBy('date', 'desc');
    }


}
