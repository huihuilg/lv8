<?php


namespace App\Models\Traits;


use App\Filters\QueryFilter;

trait Filterable
{
    /**
     * Notes: 模型过滤
     * User: hui
     * Date: 2021/4/8
     * Time: 4:27 下午
     * @param $query
     * @param QueryFilter $filters
     */
    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }
}
