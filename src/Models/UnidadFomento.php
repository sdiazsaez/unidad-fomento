<?php

namespace Larangular\UnidadFomento\Models;

use Illuminate\Database\Eloquent\Model;
use Larangular\RoutingController\Model as RoutingModel;

class UnidadFomento extends Model {
    use RoutingModel;

    protected $table      = 'UF';
    protected $fillable   = [
        'UF',
        'date',
    ];

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->connection = config('unidad-fomento.connection');
        $this->timestamps = config('unidad-fomento.timestamps');
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
