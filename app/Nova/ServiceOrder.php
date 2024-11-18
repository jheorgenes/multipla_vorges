<?php

namespace App\Nova;

use App\Models\Enums\SituationOS;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class ServiceOrder extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ServiceOrder>
     */
    public static $model = \App\Models\ServiceOrder::class;

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
        'id','service','associate','plate'
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

            Number::make('N° OS', 'service')->rules('required', 'unique:service_orders,id,{{resourceId}}')
                ->sortable()
                ->readonly(), //Somente leitura

            Date::make('Data', 'date')
                ->rules('required', 'date') //'after_or_equal:now'
                ->filterable()
                ->sortable(),

            Text::make('Associado(a)', 'associate')
                ->rules('required', 'max:255')
                ->sortable(),

            Text::make('Placa', 'plate')
                ->rules('required', 'max:8')
                ->filterable()
                ->sortable(),

            BelongsTo::make('Regional', 'regional', resource: Regional::class)
                ->rules('required', Rule::exists('regionals', 'id'))
                ->showCreateRelationButton()
                ->filterable()
                ->sortable()
                ->showWhenPeeking(),

            BelongsTo::make('Tabela de Serviço', 'table_service', resource: TableService::class)
                ->rules('required', Rule::exists('table_services', 'id'))
                ->showCreateRelationButton()
                ->filterable()
                ->sortable()
                ->showWhenPeeking(),

            Currency::make('Valor Total', 'total_value')
                ->currency('BRL')
                ->rules('required')
                ->sortable(),

            Date::make('Data de Pagamento', 'payment_date')
                ->rules('required', 'date') //'after_or_equal:now'
                ->filterable()
                ->sortable(),

            Select::make('Situação SIM', 'situationOS')
                ->options([
                    SituationOS::Finalizada->value => 'Finalizada',
                    SituationOS::Pendente->value => 'Pendente',
                    SituationOS::Executada->value => 'Executada',
                ])
                ->rules('required')
                ->filterable()
                ->sortable(),
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

        /**
     * O nome que será exibido na listagem de recursos.
     */
    public static function label()
    {
        return 'Ordens de Serviço';
    }

    /**
     * O nome que será exibido quando o recurso estiver em singular.
     */
    public static function singularLabel()
    {
        return 'Ordem de Serviço';
    }
}
