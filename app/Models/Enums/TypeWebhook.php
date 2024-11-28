<?php

namespace App\Models\Enums;

enum TypeWebhook: string
{
    case Cadastro = 'Cadastro';
    case Atualizacao = 'Atualizacao';
    case Remocao = 'Remocao';
}
