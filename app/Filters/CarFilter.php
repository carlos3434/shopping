<?php

namespace App\Filters;

use Ambengers\QueryFilter\AbstractQueryFilter;

class CarFilter extends AbstractQueryFilter
{
    /**
     * Relationship loader class.
     *
     * @var string
     */
    protected $loader = '';

    /**
     * Columns that are searchable.
     *
     * @var array
     */
    protected $searchableColumns = [
        //
    ];

    /**
     * List of object filters.
     *
     * @var array
     */
    protected $filters = [
        //
    ];
    /**
     * Filter the post to get the published ones
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function title($title)
    {
        return $this->builder->where('title', 'like', '%'.$title.'%');
    }
    public function status($status)
    {
        return $this->builder->where('status', '=', $status);
    }
}
