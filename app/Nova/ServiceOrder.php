<?php

namespace App\Nova;

use App\Models\Enums\SituationOS;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

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
            new Panel('Dados da Ordem de Serviço', [
                ID::make()->sortable(),

                Number::make('N° OS', 'service')
                    ->rules('required', 'unique:service_orders,id,{{resourceId}}')
                    ->sortable()
                    ->readonly(), //Somente leitura

                Date::make('Data', 'date')
                    ->rules(['required', 'date'],[
                        'required' => 'O campo data é obrigatório',
                        'date' => 'O campo data deve ser uma data válida',
                    ]) //'after_or_equal:now'
                    ->filterable()
                    ->sortable(),

                Text::make('Associado(a)', 'associate')
                    ->rules(['required', 'max:255'],[
                        'required' => 'O campo associado é obrigatório',
                        'max' => 'O campo associado deve ter no máximo :max caracteres',
                    ])
                    ->sortable(),

                Text::make('Placa', 'plate')
                    ->rules(['required', 'max:8', 'regex:^[A-Z]{3}-?[0-9]{4}$|^[A-Z]{3}-?[0-9][A-Z][0-9]{2}$'],[
                        'required' => 'O campo placa é obrigatório',
                        'max' => 'O campo placa deve ter no máximo :max caracteres',
                        'regex' => 'O campo placa deve ser uma placa válida (AAA-9999 ou AAA-9A99)',
                    ])
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
                    ->rules('required', 'min:0')
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
            ]),

            new Panel('Rastreadores', [

                BelongsToMany::make('Trackers', 'trackers', Tracker::class)
                    ->rules(function ($request) {
                        return [
                            function ($attribute, $value, $fail) {
                                if (empty($value)) {
                                    $fail('Você deve vincular pelo menos um Rastreador à Ordem de Serviço.');
                                }
                            }
                        ];
                    })
                    ->showWhenPeeking()
                    ->showCreateRelationButton()
                    ->showOnCreating() // Exibe ao criar
                    ->showOnUpdating() // Exibe ao editar
                    ->filterable()
                    ->sortable(),
            ]),

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
