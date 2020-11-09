<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ConfigWeb;
use Faker\Generator as Faker;

$factory->define(ConfigWeb::class, function (Faker $faker) {
    return [
       'id_page' => '104651187547290',
       'page_name'=> 'Đọc Tin Hay',
       'domain' => '24h.xaluanvn.net',
       'web_name'=>'24h Xã Luận',
       'id_ads'=> '389373932077460_389373962077457',
       'id_analytics'=> '"UA-178506002-1"',

    ];
});
