<?php

namespace App\Es;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class GoodsIndexConfigurator extends IndexConfigurator
{
    use Migratable;


    protected $name = 'l_goods';

    /**
     * @var array
     */
    protected $settings = [
        'analysis' => [
            'analyzer' => [
                'ik' => [
                    "tokenizer" => "ik_max_word"
                ]
            ]
        ]
    ];
}
