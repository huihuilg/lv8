<?php


namespace App\Models;


use App\Es\GoodsIndexConfigurator;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use ScoutElastic\Searchable;

class Goods extends Model
{
    use Searchable;
    use Filterable;

    protected $table = 'l_goods';
    public $timestamps = true;

    //使用es配置
    protected $indexConfigurator = GoodsIndexConfigurator::class;



    protected $fillable = [
        'title',
        'content'
    ];

    protected $mapping = [
        'properties' => [
            'title' => [
                'type' => 'text',
            ],
            'content' => [
                'type' => 'text',
            ],
            'id' => [
                'type' => '',
            ]
        ]
    ];


    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'content' => strip_tags($this->content),
        ];
    }



}
