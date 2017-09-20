<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('links')->insert([
            [
                'link_name' => '搜索',
                'link_title' => '百度',
                'link_url' => 'http://www.baidu.com',
                'link_order'=>1
            ],
            [
                'link_name' => '新闻',
                'link_title' => '搜狐',
                'link_url' => 'http://www.souhu.com',
                'link_order'=>2
            ]
        ]);
    }
}
