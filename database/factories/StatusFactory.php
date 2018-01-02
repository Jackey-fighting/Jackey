<?php

use Faker\Generator as Faker;
//factory()方法中的闭包函数是不用理会的，会默认传入一个$faker容器的实例
$factory->define(App\Models\Status::class, function (Faker $faker) {
	$date_time = $faker->date. ' '. $faker->time;
    return [
        'content'=> $faker->text(),
        'created_at'=> $date_time,
        'updated_at'=> $date_time,
    ];
});
