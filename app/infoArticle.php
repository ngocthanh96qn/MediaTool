<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class infoArticle extends Model
{
     protected $fillable = [
    	'url','id_import', 'status',
    ];
}
