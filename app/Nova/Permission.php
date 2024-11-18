<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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

            BelongsTo::make('Usuário','User', resource: User::class)
                ->rules('required', Rule::exists('users', 'id'))
                ->showWhenPeeking() //Exibe as informações do usuário ao passar o mouse em cima
                ->searchable()
                ->filterable()
                ->sortable(),

            BooleanGroup::make('Permissões', 'permissions')
                ->options([
                    'index' => 'Tela',
                    'viewAny' => 'Ver todos os registros',
                    'view' => 'Ver detalhes do registro',
                    'create' => 'Cadastrar',
                    'update' => 'Atualizar',
                    'delete' => 'Deletar'
                ])
                ->noValueText('Nenhuma permissão selecionada')
                ->rules('required')
                // ->fillUsing(function ($request, $model, $attribute, $requestAttribute) {
                //     $model->$attribute = array_filter($request->get($requestAttribute, []));
                // })
                ->showOnIndex(),

            Select::make('Recurso', 'recurso')
                ->options($this->getAvailableResources())
                ->displayUsingLabels()
                // ->rules('required', 'exists:resources,id')
                ->rules('required', Rule::in(array_keys($this->getAvailableResources())))
                ->sortable()
                ->filterable(),
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

    /**
     * O nome que será exibido na listagem de recursos.
     */
    public static function label()
    {
        return 'Permissões';
    }

    /**
     * O nome que será exibido quando o recurso estiver em singular.
     */
    public static function singularLabel()
    {
        return 'Permissão';
    }

    public function rules(Request $request)
    {
        return [
            'user_id' => 'required|exists:users,id',
            'recurso' => [
                'required',
                Rule::unique('permissions')
                    ->where('user_id', $request->user_id)
                    ->where('recurso', $this->recurso)
                    ->ignore($this->id), // Ignorar o registro atual ao atualizar
            ],
        ];
    }

    // public static function messages(Request $request)
    // {
    //     return [
    //         'recurso.unique' => 'Já existe uma permissão com este recurso para o mesmo usuário.',
    //     ];
    // }
}
