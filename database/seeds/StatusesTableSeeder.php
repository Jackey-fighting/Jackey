<?php

use Illuminate\Database\Seeder;
use App\Models\Status;
use App\Models\User;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = ['1', '2', '3'];
        $faker = app(Faker\Generator::class);//通过app()来获取一个Faker容器实例
        //注意factory()中的一个类模型
        $statuses = factory(Status::class)->times(100)->make()->each(function($status) use ($faker, $user_ids){
        	$status->user_id = $faker->randomElement($user_ids);//随机获取用户的id
        });

        Status::insert($statuses->toArray());
    }
}
