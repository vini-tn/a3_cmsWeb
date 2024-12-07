<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    //Structure of posts to use in Post controller
    Use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'image',
     
    ];

    //This function assigns the created post to the user logged in
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

}
