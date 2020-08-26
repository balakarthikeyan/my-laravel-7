<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    // public $sortable = ['title', 'created_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'category_id', 'title', 'body'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
      'created_at'
    ];

    protected $guarded = ['*'];

    //When a post is created then this Event will be fired
    protected $dispatchesEvents = [
        'created' => \App\Events\PostCreated::class 
    ];

    public function user(){
        return $this->belongsTo(\App\User::class, 'id');
    }

    public function category(){
        return $this->belongsTo(\App\Models\Category::class, 'id');
    }
}