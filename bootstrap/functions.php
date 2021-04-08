<?php



if (!function_exists('is_production')) {
    /**
     * 判断是否生产环境
     *
     * @return bool
     */
    function is_production()
    {
        return env('APP_ENV') === 'production';
    }
}

if (!function_exists('array_format_tree')) {
    /**
     * 数组格式化树状
     * @param array $data
     * @param int $parentID
     * @param string $field
     * @param string $parentField
     * @param string $sort 主键排序类型  asc/desc/空
     * @return array
     */
    function array_format_tree(array $data, int $parentID = 0, string $field = 'id', string $parentField = 'parent_id', string $sort = "")
    {
        $fields = array_column($data, $parentField);
        if ($sort == "asc") {
            array_multisort($fields, SORT_ASC, $data);
        } elseif ($sort == "desc") {
            array_multisort($fields, SORT_DESC, $data);
        }
        $list = [];
        foreach ($data as $id => $item) {
            if ($item[$parentField] == $parentID) {
                unset($data[$id]);
                $childrenList = array_format_tree($data, $item[$field]);
                $item['children'] = $childrenList ?? [];
                $list[] = $item;
            }
        }
        return $list;
    }
}


