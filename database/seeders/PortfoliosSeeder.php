<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortfoliosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('portfolios')->insert([
            [
                'name' => 'SMS Mobile App',
                'image' => 'portfolio_pic1.jpg',
                'filter' => 'APPLE IOS'
            ],
            [
                'name' => 'Finance App',
                'image' => 'portfolio_pic2.jpg',
                'filter' => 'DESIGN'
            ],
            [
                'name' => 'GPS Concept',
                'image' => 'portfolio_pic3.jpg',
                'filter' => 'DESIGN'
            ],
            [
                'name' => 'Shopping',
                'image' => 'portfolio_pic4.jpg',
                'filter' => 'PROTOTYPE,ANDROID,WEB APP'
            ],
            [
                'name' => 'Managment',
                'image' => 'portfolio_pic5.jpg',
                'filter' => 'DESIGN'
            ],
            [
                'name' => 'iPhone',
                'image' => 'portfolio_pic6.jpg',
                'filter' => 'APPLE IOS,WEB APP'
            ],
            [
                'name' => 'Nexus Phone',
                'image' => 'portfolio_pic7.jpg',
                'filter' => 'DESIGN,WEB APP'
            ],
            [
                'name' => 'Android',
                'image' => 'portfolio_pic8.jpg',
                'filter' => 'ANDROID'
            ]
        ]);
    }
}
