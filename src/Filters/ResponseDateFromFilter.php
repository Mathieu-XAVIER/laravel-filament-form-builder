<?php

namespace Novius\LaravelFormBuilder\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Nova\Filters\DateFilter;

class ResponseDateFromFilter extends DateFilter
{
    public function __construct()
    {
        $this->name = trans('laravel-form-builder::response.filter_from_date_title');
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Request $request, $query, $value)
    {
        return $query->where('created_at', '>=', Carbon::parse($value));
    }
}
