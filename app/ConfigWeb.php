<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigWeb extends Model
{
    protected $fillable = [
    	'id_page','page_name', 'domain', 'web_name'
    ];
}
