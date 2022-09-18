<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testimonials = [
            [
                'name' => 'Ariful Islam Arif',
                'position' => 'Software Engineer',
                'avatar' => asset('website/images/testimonial/image.png'),
                'description' => 'Sincerely, I am very grateful to the technical support that helps the Leaving application to work properly when there are some situations that the buyer cannot solve',
            ],
            [
                'name' => 'Zakir Hossen',
                'position' => 'Businessman',
                'avatar' => asset('website/images/testimonial/image2.png'),
                'description' => 'They are Excellent in all their services. Very organized developers. And the application is very excellent with constant updates, improvements and great support.',
            ],
            [
                'name' => 'Mohammad Ali',
                'position' => 'Product Manager',
                'avatar' => asset('website/images/testimonial/image3.jpg'),
                'description' => 'Their support is very fast and they try to solve all your issues. Also the application is very good with simple user friendly admin panel. Wish you all the best, please keep the good work',
            ]
        ];


        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
