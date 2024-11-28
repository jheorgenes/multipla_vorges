<?php

namespace App\Nova;

use App\Models\Enums\Gps;
use App\Models\Enums\SituationTracker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Tracker extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Tracker>
     */
    public static $model = \App\Models\Tracker::class;

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
        'id','imei','model','gps', 'situation','brand.name','operator.name'
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

            Text::make('IMEI', 'imei')
                ->rules('required', 'max:255')
                ->sortable(),

            BelongsTo::make('Marca', 'brand', resource: Brand::class)
                ->rules('required', Rule::exists( 'brands', 'id'))
                ->showCreateRelationButton()
                ->modalSize('3xl')
                ->showOnCreating()
                ->showWhenPeeking()
                ->filterable()
                ->sortable(),

            Text::make('Modelo', 'model')
                ->rules('required', 'max:255')
                ->sortable(),

            Select::make('GPS', 'gps')
                ->options([
                    Gps::Chip->value => 'Chip',
                    Gps::Satelite->value => 'Satelite',
                ])
                ->rules('required')
                ->filterable()
                ->sortable(),

            Text::make('Cartões SIM', 'simCards', function () {
                // Retorna uma string formatada com todos os SIM Cards relacionados
                return $this->simCards->pluck('number')->join(', ');
            })->onlyOnIndex(), // Exibe apenas na lista (tela de index)

            // Relacionamento com Sim Cards
            BelongsToMany::make('Cartões SIM', 'simCards', SimCard::class)
                ->rules('required', Rule::exists('sim_cards', 'id'))
                ->filterable()
                ->sortable()
                ->showOnCreating()
                ->showWhenPeeking()
                ->showCreateRelationButton(),

            // Relacionamento com Operators
            // BelongsToMany::make('Operadoras', 'operators', Operator::class),

            // BelongsTo::make('Operadora', 'operator', resource: Operator::class)
            //     ->rules('required', Rule::exists('operators', 'id'))
            //     // ->searchable()
            //     ->showCreateRelationButton()
            //     ->modalSize('3xl')
            //     ->showOnCreating()
            //     ->filterable()
            //     ->sortable()
            //     ->showWhenPeeking(),

            // /**
            //  *  Só vão aparecer a lista de Cartões SIM na edição e criação, os cartões SIM que estiver vinculado a operadora, quando a operadora for selecionada
            //  */
            // BelongsTo::make('Cartão SIM', 'sim_card', resource: SimCard::class)
            //     ->dependsOn(['operator'], function (BelongsTo $field, NovaRequest $request, FormData $data) {
            //         // Se não houver operadora, esconde o campo
            //         if(!$data->get('operator')) {
            //             $field->hide();
            //         }
            //         // Se houver operadora, mostra o campo filtrando os cartões SIM vinculados a operadora
            //         $field->relatableQueryUsing(function (Request $request, Builder $query) use ($data) {
            //             return $query->where('operator_id', $data->get('operator'));
            //         })->rules('required', Rule::exists('sim_cards','id'));
            //     })
            //     ->showCreateRelationButton() //Botão para criar um novo cartão SIM
            //     ->modalSize('3xl') //   Tamanho do modal para criar um novo cartão SIM
            //     ->showOnCreating()
            //     ->filterable()
            //     ->sortable()
            //     ->showWhenPeeking(),

            Select::make('Situação Rastreador', 'situationTracker')
                ->options([
                    SituationTracker::Disponivel->value => 'Disponivel',
                    SituationTracker::ComDefeito->value => 'ComDefeito',
                    SituationTracker::Instalado->value => 'Instalado',
                ])
                ->rules('required')
                ->filterable()
                ->sortable(),

            BelongsToMany::make('Ordens de Serviço', 'serviceOrders', ServiceOrder::class)
                ->readonly(),
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
        return 'Rastreadores';
    }

    /**
     * O nome que será exibido quando o recurso estiver em singular.
     */
    public static function singularLabel()
    {
        return 'Rastreador';
    }

    public  function title()
    {
        return $this->brand['name'] . ' -> ' . $this->model . ' - ' . $this->imei; /*. ' - Chip: [' . $this->simCard['number'] . ']' */;
    }
}
