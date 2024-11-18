<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Operator extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Operator>
     */
    public static $model = \App\Models\Operator::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name'; //Exibe o nome da operadora no filtro dos relacionamentos

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name',
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
            Text::make('Nome', 'name')->sortable(),

            // /* Declarando o relacionamento, apenas para uso em pesquisas e filtros de outras telas */
            // BelongsTo::make('Cartão Sim', 'sim_card', resource: SimCard::class)
            //     ->rules(Rule::exists('sim_cards', 'id'))
            //     ->hideFromIndex(),
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
        return 'Operadoras';
    }

    /**
     * O nome que será exibido quando o recurso estiver em singular.
     */
    public static function singularLabel()
    {
        return 'Operadora';
    }

    // /**
    //  * Método para definir o título que será exibido ao visualizar o recurso.
    //  */
    // public function title()
    // {
    //     return $this->id . ' - ' . $this->name; // Exibe o campo 'name' como título
    // }
}
