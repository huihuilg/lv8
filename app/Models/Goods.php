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

    protected $casts = [
        'content' => 'json'
    ];


    protected $mapping = [
        'properties' => [
            'id' => [
                'type' => 'long',
            ],
            'title' => [
                'type' => 'text',
            ],
            'content' => [
                'properties' => [
                    'address' => [
                        'type' => 'text',
                    ],
                    'key_param' => [
                        'type' => 'text'
                    ],
                    'plan_time' => [
                        'type' => 'date',
                        'format' => 'yyyy-MM-dd HH:mm:ss||yyyy-MM-dd||epoch_millis'
                    ],
                ]
            ],
            'created_at' => [
                'type' => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss||yyyy-MM-dd||epoch_millis'
            ],
            'updated_at' => [
                'type' => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss||yyyy-MM-dd||epoch_millis'
            ]
        ]
    ];


    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }


    public function getUpdatedAtAttribute($value)
    {
        return $value ? date("Y-m-d H:i:s", strtotime($value)) : '';
    }

    public function getCreatedAtAttribute($value)
    {
        return $value ? date("Y-m-d H:i:s", strtotime($value)) : '';
    }


}
