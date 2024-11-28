<?php

namespace App\Nova;

use App\Nova\Fields\TelefoneField;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Client extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Client>
     */
    public static $model = \App\Models\Client::class;

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
        'id', 'name', 'email'
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
                ->rules([
                    'required',
                    'max:255',
                    'min:3',
                    'string',
                ], [
                    'required' => 'O campo nome é obrigatório',
                    'max:255' => 'O campo nome deve ter no máximo :max caracteres',
                    'min:3' => 'O campo nome deve ter no mínimo :min caracteres',
                    'string' => 'O campo nome deve ser uma string',
                ])
                ->sortable(),

            Text::make('Email')
                ->rules([
                    'required',
                    'email',
                    'max:254'
                ], [
                    'required' => 'O campo email é obrigatório',
                    'email' => 'O campo email deve ser um email',
                    'max:254' => 'O campo email deve ter no máximo :max caracteres',
                ])
                ->sortable(),

            TelefoneField::make('Contato', 'contact')
                ->rules([
                    'required',
                    'max:15',
                    'min:3',
                    'string',
                    'regex:/^\(\d{2}\) (9\d{4}|\d{4})-\d{4}$/'
                ], [
                    'required' => 'O campo contato é obrigatório',
                    'max:15' => 'O campo contato deve ter no máximo :max caracteres',
                    'min:3' => 'O campo contato deve ter no mínimo :min caracteres',
                    'string' => 'O campo contato deve ser uma string',
                    'regex' => 'O formato do Telefone deve ser (XX) XXXX-XXXX ou (XX) 9XXXX-XXXX.'
                ])
                ->mask('(##) ####-#### ou (##) 9####-####')
                ->sortable(),

            Textarea::make('Endereço', 'address')
                ->withMeta(['extraAttributes' => [
                    'placeholder' => 'Rua, Número, Bairro, Cidade, UF, CEP (Endereço completo em 1000 caracteres)']
                ])
                ->rules([
                    'required',
                    'max:1000',
                    'min:3',
                    'string'
                ], [
                    'required' => 'O campo endereço é obrigatório',
                    'max' => 'O campo endereço deve ter no máximo :max caracteres',
                    'min' => 'O campo endereço deve ter no mínimo :min caracteres',
                    'string' => 'O campo endereço deve ser uma string',
                ])
                ->alwaysShow()
                ->rows(3)
                ->sortable(),

            Boolean::make('Status')
                ->rules(['required'], ['required' => 'O campo status é obrigatório'])
                ->filterable()
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
        return 'Clientes';
    }

    /**
     * O nome que será exibido quando o recurso estiver em singular.
     */
    public static function singularLabel()
    {
        return 'Cliente';
    }
}
