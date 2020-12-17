<?php

namespace Larangular\UnidadFomento\Http\Controllers\UnidadFomento;

use Larangular\UnidadFomento\Models\UnidadFomento;
use Larangular\UnidadFomento\Http\Resources\UnidadFomentoResource;
use Larangular\RoutingController\{Controller,
    Contracts\HasPagination,
    Contracts\HasResource,
    Contracts\IGatewayModel,
    Contracts\RecursiveStoreable,
    RecursiveStore\RecursiveOption};


class Gateway extends Controller implements IGatewayModel {

    public function model() {
        return UnidadFomento::class;
    }

    public function allowedMethods() {
        return [
            'index',
            'show',
            'store',
        ];
    }

    public function current($date = null) {
        $UFController = resolve(UnidadFomentoController::class);
        return $UFController->current($date);
    }

}
