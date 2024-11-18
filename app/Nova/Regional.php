<?php

namespace App\Nova;

use App\Models\Enums\Active;
use App\Models\Enums\Box;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Regional extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Regional>
     */
    public static $model = \App\Models\Regional::class;

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
        'id','name'
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
                ->rules('required', 'max:255')
                ->sortable(),

            Select::make('Caixa', 'box')
                ->options([
                    Box::Sim->value => 'Sim',
                    Box::Nao->value => 'Nao',
                ])
                ->rules('required')
                ->filterable()
                ->sortable(),

            Select::make('Ativa', 'active')
                ->options([
                    Active::Sim->value => 'Sim',
                    Active::Nao->value => 'Nao',
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
        return 'Regionais';
    }

    /**
     * O nome que será exibido quando o recurso estiver em singular.
     */
    public static function singularLabel()
    {
        return 'Regional';
    }

    public  function title()
    {
        return $this->id . ' - ' . $this->name . ' - Caixa: ' . $this->box;
        // return $this->name;
    }
}
