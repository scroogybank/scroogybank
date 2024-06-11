<?php

namespace App\Table;

class Column
{
    public string $component = 'columns.column';

    public function __construct(
        public string $key,
        public string $label
    ) {
    }

    public static function make(string $key, string $label)
    {
        return new static($key, $label);
    }

    public function component($component)
    {
        $this->component = $component;

        return $this;
    }
}
