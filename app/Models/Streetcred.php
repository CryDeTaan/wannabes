<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Streetcred extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'snippet_id',
        'streetcred',
    ];

}
