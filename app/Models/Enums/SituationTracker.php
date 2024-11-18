<?php

namespace App\Models\Enums;

enum SituationTracker: string
{
    case Disponivel = 'Disponivel';
    case ComDefeito = 'ComDefeito';
    case Instalado = 'Instalado';
}
