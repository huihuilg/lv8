<?php


namespace App\Models;


use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use ScoutElastic\Searchable;

class Test extends Model
{
    use Searchable;
    use Filterable;

    protected $table = 'test';

    protected $fillable = [
        'name',
        'age',
        'json',
        'created_at',
    ];

    protected $casts = [
        'content' => 'json'
    ];

}