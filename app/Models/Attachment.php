<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attachment extends Model
{
    use HasFactory;


    protected $fillable = [

        'file',

        'attachable_id',

        'attachable_type'

    ];


    public function attachable()
    {

        return $this->morphTo();

    }

}