<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	//实例化工厂factory对象，然后进行数据填充
        $users = factory(User::class)->times(50)->make();
        User::insert($users->makeVisible(['password', 'remember_token'])->toArray());

        $user = User::find(1);
        $user->name = 'Jackey';
        $user->email = 'Jackey@163.com';
        $user->password = bcrypt('password');
        $user->is_admin = true;
        $user->save();
    }
}
