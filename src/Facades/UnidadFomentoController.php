<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2019-01-06
 */

namespace Larangular\UnidadFomento\Facades;

use Illuminate\Support\Facades\Facade;

class UnidadFomentoController extends Facade {
    protected static function getFacadeAccessor() {
        return 'UFController';
    }
}
