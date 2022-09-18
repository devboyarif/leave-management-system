<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faqs = [
            [
                'question' => "What web browser should I use to complete an application?",
                'answer' => "A list of web browsers supported by our vendor. Please note that older browsers may appear to work correctly but you could experience some problems when you try to attach supporting materials or answer video questions (where applicable).  If you are experiencing issues and are using an unsupported web browser we recommend you update to a supported version before contacting our vendor for assistance"
            ],
            [
                'question' => "How can I create a team?",
                'answer' => "You can easily create your team, open the app, choose “create a team”, add your company name, email, and password and choose the country, then press “sign up”. Afterward, you can set the company working days, add leave types then start adding employees."
            ],
            [
                'question' => "How can I set the company settings?",
                'answer' => "After creating the company's account, you can choose the working days, types of leaves and balances as well as customizing the employees view.Then visit the setting tabs from sidebar."
            ],
            [
                'question' => "How can I edit leave types?",
                'answer' => "To edit leaves types, go to the leave types page from sidebar, you can edit the leave types, enable leave options like half day, compensations and auto approve, and also you can enable/disable a certain leave type."
            ],
            [
                'question' => "How can I add employees?",
                'answer' => "After creating the company’s account, you need to go employees page from sidebar then you can invite employees or create a employee instantly"
            ],
            [
                'question' => "How can I add an official holiday?",
                'answer' => "To add an official holiday, go to the holidays section from sidebar, choose “Add Holiday” on the top of the page, enter the holiday’s name, start and end dates then click “Add Another Holiday” and the holiday will be added to your official holidays list."
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
