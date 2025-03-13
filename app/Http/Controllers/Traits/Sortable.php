<?php

namespace App\Http\Controllers\Traits;

trait Sortable
{
    protected function getOrderBy($default = 'id')
    {
        $orderBy = request()->get('orderBy');

        if (!in_array($orderBy, $this->sortable)) {
            $orderBy = $default;
        }
        return $orderBy;
    }

    protected function getOrderDir()
    {
        return request()->get('orderDir') == 'DESC' ? 'DESC' : 'ASC';
    }
}
