<?php

namespace App\Nova;

use App\Models\Enums\TypeWebhook;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MultiSelect;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;

class Webhook extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Webhook>
     */
    public static $model = \App\Models\Webhook::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Nome', 'name')
                ->rules('required', 'max:255'),

            URL::make('URL', 'url_webhook')
                ->displayUsing(fn ($value) => $value ? $value : 'Não inserido')
                ->rules('required', 'url', 'max:255'),

            Select::make('Tipo Webhook', 'type_webhook')
                ->options([
                    TypeWebhook::Cadastro->value => 'Cadastro',
                    TypeWebhook::Atualizacao->value => 'Atualizacao',
                    TypeWebhook::Remocao->value => 'Remocao',
                ])
                ->rules('required')
                ->filterable()
                ->sortable(),

            MultiSelect::make('Modelos do webhook', 'models_webhook')
                ->options($this->getResourceOptions())
                ->displayUsingLabels()
                ->rules('required')
                ->help('Selecione o módulo (resource) que este webhook deve observar.'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

    public function getResourceOptions()
    {
        return collect(Nova::$resources)
            ->filter(fn($resource) => method_exists(new $resource, 'model')) // Filtra apenas resources que têm um modelo
            ->mapWithKeys(fn ($resource) => [$resource => class_basename($resource)]) // Chave: nome do resource, Valor: nome base)
            ->toArray();
    }
}
