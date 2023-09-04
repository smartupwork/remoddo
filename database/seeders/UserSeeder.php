<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\Role;
use App\Models\User;
use App\Models\UserInfo;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $time_zone=get_local_time();
        $users = [
            [
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin@mail.com'),
                'roles'=>[UserType::ADMIN],
                'time_zone'=>$time_zone
            ],
            [
                'email' => 'lender@mail.com',
                'password' => Hash::make('lender@mail.com'),
                'roles'=>[UserType::LENDER,UserType::RENTER],
                'time_zone'=>$time_zone
            ],
            [
                'email' => 'renter@mail.com',
                'password' => Hash::make('renter@mail.com'),
                'roles'=>[UserType::LENDER,UserType::RENTER],
                'time_zone'=>$time_zone
            ]
        ];

        foreach ($users as $user) {
            $roles=$user['roles'];
            unset($user['roles']);

            $model = User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );

            foreach ($roles as $role){
                $model->roles()->attach(Role::getIdByName($role));
            }

            if (in_array($role,UserType::getValues())) {
                UserInfo::updateOrCreate([
                    'name' => "$faker->name",
                    'surname' => "$faker->name",
                    'user_id' => $model->id,
                ]);
            }
        }
    }
}
