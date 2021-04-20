<?php


namespace App\Filters;


use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

abstract class QueryFilter
{

    /**
     * @var Request
     */
    public $request;

    /**
     * @var Builder
     */
    public $builder;

    /**
     * @var array
     */
    public $extra = [];


    /**
     * QueryFilter constructor.
     * @param Request|null $request
     */
    public function __construct(Request $request = null)
    {
        $this->request = $request;
    }


    /**
     * 设置额外查询参数
     *
     * @param array $condition
     */
    public function setExtraConditions($condition = [])
    {
        $this->extra = $condition;
    }

    /**
     * 获取额外查询参数
     * @return array
     */
    public function getExtraConditions()
    {
        if ($this->request && $this->request instanceof Request) {
            return array_merge($this->request->all(), $this->extra);
        }
        return $this->extra;
    }


    /**
     * Notes: 过滤
     * User: hui
     * Date: 2021/4/8
     * Time: 3:54 下午
     * @param Builder $builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        foreach($this->filters() as $name => $value) {
            //0 状态查询不过滤
            if($value !== 0){
                //其他过滤空查询
                if (empty($value)) {
                    continue;
                }
            }
            // filter方法统一驼峰命名
            $method = Str::camel($name);
            if (method_exists($this, $method)) {
                call_user_func_array([$this, $method], [$value]);
            }
        }
        return true;
    }


    /**
     * Notes: 数据
     * User: hui
     * Date: 2021/4/8
     * Time: 3:37 下午
     * @return array
     */
    public function filters()
    {
        if (empty($this->extra)) {
            return $this->request ? $this->request->all() : [];
        } else {
            return $this->getExtraConditions();
        }
    }

    // value = 0 时需转格式
    public function trimValue($value)
    {
        return (int) trim($value, '-');
    }



}
