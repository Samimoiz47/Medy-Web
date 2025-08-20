<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\App;

class AppsTableSeeder extends Seeder
{
    public function run()
    {
        $apps = [
            [
                'name' => 'Super Mario Run',
                'description' => 'A fun running game featuring Mario and friends',
                'category' => 'Games',
                'version' => '1.0.0',
                'size' => '45MB',
                'download_url' => '#',
                'icon_url' => '#',
                'rating' => 4.5,
                'download_count' => 1000000,
                'is_free' => true
            ],
            [
                'name' => 'WhatsApp Messenger',
                'description' => 'Free messaging and calling app',
                'category' => 'Communication',
                'version' => '2.21.0',
                'size' => '35MB',
                'download_url' => '#',
                'icon_url' => '#',
                'rating' => 4.8,
                'download_count' => 5000000,
                'is_free' => true
            ],
            [
                'name' => 'TikTok',
                'description' => 'Create and share short videos',
                'category' => 'Social',
                'version' => '21.1.0',
                'size' => '85MB',
                'download_url' => '#',
                'icon_url' => '#',
                'rating' => 4.3,
                'download_count' => 2000000,
                'is_free' => true
            ]
        ];

        foreach ($apps as $app) {
            App::create($app);
        }
    }
}
