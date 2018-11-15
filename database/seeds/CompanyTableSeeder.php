<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //实例化Faker对象
        $faker = \Faker\Factory::create('zh_CN');
        $data = [];
        //通过循环生成100条数据
        for($i = 1; $i <= 100; $i++){
        	$data[] = [
        		'com_name' => $faker->company,
        		'password' => bcrypt('123456'),
        		'mobile' => $faker->phoneNumber,
        		'email' => $faker->email,
        		'created_at' => date('Y-m-d H:i:s'),
        	];
        }
        //写入数据库
        DB::table('company')->insert($data);
    }
}
