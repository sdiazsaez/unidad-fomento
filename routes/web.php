<?php

Route::group([
    'prefix' => config('unidad-fomento.route_prefix'), //'api/uf',
    'middleware' => 'api',
    'namespace' => 'Larangular\UnidadFomento\Http\Controllers',
    'as' => 'larangular.api.unidad-fomento.'
], function () {
    Route::resource('/', 'UnidadFomento\Gateway');
    Route::get('date/{date?}', 'UnidadFomento\Gateway@current');
});
