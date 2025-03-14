<?php

namespace App\Http\Controllers\Traits;

trait Sortable
{
    protected function getOrderBy($default = 'id')
    {
        if (!isset($this->sortable)) {
            return $default;
        }

        $orderBy = request()->get('orderBy');

        if (!in_array($orderBy, $this->sortable)) {
            $orderBy = $default;
        }
        return $orderBy;
    }

    protected function getItems($class, $field)
    {
        $items = $class::orderBy($this->getOrderBy($field), $this->getOrderDir());

        if ($filter = request('filter.' . $field)) {
            $items->where($field, 'like', '%' . $filter . '%');
        }
        return $items->paginate(10);
    }

    protected function getOrderDir()
    {
        return request()->get('orderDir') == 'DESC' ? 'DESC' : 'ASC';
    }
}
