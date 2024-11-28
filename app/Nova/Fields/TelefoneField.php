<?php

namespace App\Nova\Fields;

use Laravel\Nova\Fields\Text;

class TelefoneField extends Text
{
    public function __construct($name, $attribute = null, $mask = null)
    {
        parent::__construct($name, $attribute);
        $this->mask($mask);
    }

    public function mask($mask)
    {
        return $this->withMeta(['mask' => $mask]);
    }
}
