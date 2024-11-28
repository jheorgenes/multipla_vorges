<?php

namespace App\Nova;

use App\Models\Enums\SituationSIM;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class SimCard extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\SimCard>
     */
    public static $model = \App\Models\SimCard::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'number'; //Exibe o número da SIM nos filtros de relacionamento

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','number','operator.name'
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

            Text::make('Numero', 'number')->sortable(),

            BelongsTo::make('Operadora', 'operator', resource: Operator::class)
                ->rules('required', Rule::exists('operators', 'id'))
                ->showCreateRelationButton() //Botão para criar um novo cartão SIM
                ->sortable()
                ->showWhenPeeking(),

            Select::make('Situação SIM', 'situationSIM')
                ->options([
                    SituationSIM::Disponivel->value => 'Disponivel',
                    SituationSIM::Vinculado->value => 'Vinculado',
                ])
                ->rules('required')
                ->filterable()
                ->sortable(),

            BelongsToMany::make('Tracker', 'trackers', Tracker::class)
                ->filterable(),
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
        return 'Cartões SIM';
    }

    /**
     * O nome que será exibido quando o recurso estiver em singular.
     */
    public static function singularLabel()
    {
        return 'Cartão SIM';
    }
}
