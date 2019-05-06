<?php

namespace Larangular\UnidadFomento\Models;

use Illuminate\Database\Eloquent\Model;
use Larangular\RoutingController\Model as RoutingModel;

class UnidadFomento extends Model {
    use RoutingModel;

    protected $fillable   = [
        'UF',
        'date',
    ];

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->table = config('installable.migrations.Larangular\UnidadFomento\UnidadFomentoServiceProvider.unidad-fomento.name');
        $this->connection = config('installable.migrations.Larangular\UnidadFomento\UnidadFomentoServiceProvider.unidad-fomento.connection');
        $this->timestamps = config('installable.migrations.Larangular\UnidadFomento\UnidadFomentoServiceProvider.unidad-fomento.timestamps');
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
