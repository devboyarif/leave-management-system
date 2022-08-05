<?php

namespace Database\Seeders;

use App\Models\Seo;
use Illuminate\Database\Seeder;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'page_name' => 'Home',
                'page_slug' => 'home',
                'title' => 'Welcome To Leaving - The Best Way To Leave',
                'description' => 'Leaving is leave management system that helps you to manage your leave and get the best leave management system for your business.',
                'keywords' => 'home, leave, management, laravel, vuejs'
            ],
            [
                'page_name' => 'About',
                'page_slug' => 'about',
                'title' => 'About Us',
                'description' => 'Leaving is leave management system that helps you to manage your leave and get the best leave management system for your business.',
                'keywords' => 'about, leave, management, laravel, vuejs'
            ],
            [
                'page_name' => 'Pricing',
                'page_slug' => 'pricing',
                'title' => 'Pricing',
                'description' => 'Leaving is leave management system that helps you to manage your leave and get the best leave management system for your business.',
                'keywords' => 'pricing, leave, management, laravel, vuejs'
            ],
            [
                'page_name' => 'Blog',
                'page_slug' => 'blog',
                'title' => 'Blog',
                'description' => 'Leaving is leave management system that helps you to manage your leave and get the best leave management system for your business.',
                'keywords' => 'blog, leave, management, laravel, vuejs'
            ],
            [
                'page_name' => 'Privacy Policy',
                'page_slug' => 'privacy-policy',
                'title' => 'Welcome To Leaving - The Best Way To Leave',
                'description' => 'Leaving is leave management system that helps you to manage your leave and get the best leave management system for your business.',
                'keywords' => 'privacy policy, leave, management, laravel, vuejs'
            ],
            [
                'page_name' => 'Terms & Conditions',
                'page_slug' => 'terms-conditions',
                'title' => 'Welcome To Leaving - The Best Way To Leave',
                'description' => 'Leaving is leave management system that helps you to manage your leave and get the best leave management system for your business.',
                'keywords' => 'terms & condition, leave, management, laravel, vuejs'
            ],
            [
                'page_name' => 'Contact',
                'page_slug' => 'contact',
                'title' => 'Welcome To Leaving - The Best Way To Leave',
                'description' => 'Leaving is leave management system that helps you to manage your leave and get the best leave management system for your business.',
                'keywords' => 'contact, leave, management, laravel, vuejs'
            ]
        ];

        foreach ($pages as $page) {
            Seo::create($page);
        }
    }
}
