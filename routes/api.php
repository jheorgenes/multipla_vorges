<?php

use Illuminate\Support\Facades\Route;
use Laravel\Nova\Nova;

Route::get('/resource-options', function () {
    return collect(Nova::$resources)
        ->filter(fn($resource) => method_exists(new $resource, 'model'))
        ->mapWithKeys(function ($resource) {
            $model = (new $resource)->model();
            return [$model => class_basename($model)];
        })->toArray();
});
