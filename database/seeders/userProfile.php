<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\HASH;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class userProfile extends Seeder
{
    public function run()
    {

        DB::table('users')->insert(
            [
                'companyid'=>1,
                'roleid'=>1,
                'name'=>'Nowab Shorif',
                'address'=>'',
                'contact_no'=>'',
                'reference_by'=>'',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('12345'),
            ]
        );

        DB::table('company_datails')->insert(
            [
                'companyName'=>"-",
                'companyEmail'=>"example@gmail.com",
                'phone'=>"-",
                'address'=>"-",
                'logo'=>"-",
            ]
        );

        DB::table('roles')->insert(
        [
            'id'=>1,
            'role'=>'Admin'
        ],
        [
            'id'=>2,
            'role'=>'Manager'
        ]);


    }
}
