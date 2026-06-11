<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [

        'user_id',

        'title',

        'content',

        'status',

        'published_at'

    ];


    protected $casts = [

        'published_at'
        =>
        'datetime'

    ];


    // Article → Author
    public function author()
    {

        return $this->belongsTo(

            User::class,

            'user_id'

        );

    }

 public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Article → Comments
    public function comments()
    {

        return $this->morphMany(

            Comment::class,

            'commentable'

        );

    }


    // Article → Attachments
    public function attachments()
    {

        return $this->morphMany(

            Attachment::class,

            'attachable'

        );

    }


    // Article → Tags
    public function tags()
    {

        return $this->morphToMany(

            Tag::class,

            'taggable'

        );

    }

}