<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;

class Permission extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Permission>
     */
    public static $model = \App\Models\Permission::class;

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
        'id', 'user_id', 'recurso',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User')->searchable(),

            BooleanGroup::make('Permissions')->options([
                'index' => 'Tela',
                'viewAny' => 'Ver todos os registros',
                'view' => 'Ver registro',
                'create' => 'Cadastrar',
                'update' => 'Atualizar',
                'delete' => 'Deletar'
            ])->noValueText('Nenhuma permissão selecionada')->rules('required'),

            Select::make('Recurso')
                ->options($this->getAvailableResources())
                ->displayUsingLabels()
                ->rules('required'),
        ];
    }

    public static function authorizedToCreate(Request $request): bool
    {
        // return in_array($request->user()->role, ['admin', 'gestor']);
        return true;
    }

    public function authorizedToUpdate(Request $request): bool
    {
        return in_array($request->user()->role, ['admin', 'gestor']);
    }

    public function authorizedToDelete(Request $request): bool
    {
        return in_array($request->user()->role, ['admin', 'gestor']);
    }

    protected function getAvailableResources(): array
    {
        $resources = [];
        // NOVA::$resources -> Obtem todos os recursos (classes) que foram criados no Nova Laravel
        foreach (Nova::$resources as $resourceClass) {
            // Obter apenas o nome da classe, sem o namespace
            $resourceName = class_basename($resourceClass);

            // Adicione à lista, usando o nome da classe como chave e rótulo
            $resources[strtolower($resourceName)] = $resourceName;
        }
        return $resources;
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
}
