<?php

use Illuminate\Database\Seeder;
use App\ConfigWeb;
class ConfigWebTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
       'id_page' => '104651187547290',
       'page_name'=> 'Đọc Tin Hay',
       'domain' => '24h.xaluanvn.net',
       'web_name'=>'24h Xã Luận',
       'id_ads'=> '389373932077460_389373962077457',
       'id_analytics'=> '"UA-178506002-1"',

    ];
    ConfigWeb::create($data);
    }
}
