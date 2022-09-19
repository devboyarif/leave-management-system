<?php

namespace Database\Seeders;

use App\Models\Cms;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cms = new Cms();

        // Home Page
        $cms->home_banner_title = 'Leave Management System (SAAS)';
        $cms->home_banner_description = 'Leaving - Leave Management System SPA (SAAS) is a web application that helps you to manage your company leaves.';
        $cms->home_banner_button_text = 'Get Started';
        $cms->home_banner_button2_text = ' Learn More';
        $cms->home_banner_button_url = route('register');
        $cms->home_banner_button2_url = route('website.about');
        $cms->home_feature_title = 'Features';
        $cms->home_feature_subtitle = 'Main Features of';
        $cms->home_feature_description = 'We have a lot of features that you can use to manage your company leaves. But the most important features are the following';

        // About Page
        $cms->about_title = 'About Us';
        $cms->about_subtitle = 'We are a team of developers';
        $cms->about_image = 'website/images/about/about-image.svg';
        $cms->about_description = 'Leaving - Leave Management System SPA (SAAS) is a web application that helps you to manage your company leaves. It is organized and lightweight speed in a way that it is easy to use and easy to manage for your employees.
        <br>
        <br>
        Manage your company leaves, holidays easily and efficiently. It allows you to country holidays, sick leave, maternity leave, paternity leave, etc. We also have multiple payment options that you can choose from. You can also choose to pay your leaves online.';

        // Pricing Page
        $cms->pricing_plan_title = 'Our Pricing';
        $cms->pricing_plan_description = 'Here are the plans that we offer for you. Choose the plan that best suits your needs. Pay for it monthly or yearly. You can also pay for it once and get it for life.';

        // Testimonial Page
        $cms->testimonial_title = 'Testimonials';
        $cms->testimonial_subtitle = 'What our Customers Says';
        $cms->testimonial_description = ' We are very happy to hear from our customers. Read what they have to say about us. If you have any questions, please feel free to contact us';

        // Faq Page
        $cms->faq_title = 'FAQ';
        $cms->faq_subtitle = 'Any Questions? Answered';
        $cms->faq_description = 'Any confused? We have answers. Read our frequently asked questions and answers. If you have any questions, please feel free to contact us';

        // Contact Page
        $cms->contact_title = 'CONTACT US';
        $cms->contact_subtitle = 'Lets discuss your needs and get in touch with us';

        // Privacy and Terms Page
        $cms->terms_description = 'These Website Standard Terms and Conditions written on this webpage shall manage your use of our website, Webiste Name accessible at Website.com.

        These Terms will be applied fully and affect to your use of this Website. By using this Website, you agreed to accept all terms and conditions written in here. You must not use this Website if you disagree with any of these Website Standard Terms and Conditions.

        Minors or people below 18 years old are not allowed to use this Website.';
        $cms->privacy_description = 'These Website Standard Terms and Conditions written on this webpage shall manage your use of our website, Webiste Name accessible at Website.com.

        These Terms will be applied fully and affect to your use of this Website. By using this Website, you agreed to accept all terms and conditions written in here. You must not use this Website if you disagree with any of these Website Standard Terms and Conditions.

        Minors or people below 18 years old are not allowed to use this Website.';

        $cms->save();
    }
}
