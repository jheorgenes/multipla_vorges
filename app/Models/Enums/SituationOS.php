<?php

namespace App\Models\Enums;

enum SituationOS: string
{
    case Finalizada = 'Finalizada';
    case Executada = 'Executada';
    case Pendente = 'Pendente';
}
