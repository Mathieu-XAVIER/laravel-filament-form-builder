<?php

namespace Novius\LaravelFormBuilder\Contracts;

interface FormField
{
    /**
     * Position of field
     */
    public function position(): int;

    /**
     * Parameters of field
     */
    public function params(): array;
}
