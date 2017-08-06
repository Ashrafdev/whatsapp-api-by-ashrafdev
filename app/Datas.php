<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datas extends Model
{
    public $table = 'datas';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone', 'text',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

    protected $casts = [
        'phone' => 'integer',
        'text' => 'string',
    ];
}
