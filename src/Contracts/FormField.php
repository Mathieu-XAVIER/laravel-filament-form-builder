<?php

namespace Novius\LaravelFormBuilder\Contracts;

interface FormField
{
    /**
     * Position of field
     *
     * @return int
     */
    public function position(): int;

    /**
     * Parameters of field
     *
     * @return array
     */
    public function params(): array;
}
