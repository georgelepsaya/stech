<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\CompanyPage;
use \App\Models\ProductPage;
use \App\Models\TopicPage;
use \App\Models\Article;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Dummy data
        User::factory()->create([
            'name' => 'test',
            'email' => 'test@inbox.lv',
            'password' => bcrypt('qwer1234')
        ]);
        User::factory()->create([
            'name' => 'Joe',
            'email' => 'joe@gmail.com',
            'password' => bcrypt('pass1234')
        ]);
        CompanyPage::create([
            'name' => 'Foo',
            'description' => 'Bar',
            'content' => '<h1><strong>Heard</strong></h1><h2><u>Understood</u></h2><p><em>And noticed</em></p><p><br></p>'
        ]);
        ProductPage::create([
            'company_id' => 1,
            'name' => 'Lotus',
            'description' => 'It does stuff',
            'content' => '<h1><u>Bring</u></h1><h2>Radical <em>change</em></h2><p>Expressive<strong> lotus</strong></p><p><br></p>',
            'release_date' => now()
        ]);
        ProductPage::create([
            'company_id' => 1,
            'name' => 'Mylti',
            'description' => 'Omg the name',
            'content' => '<h1><u>Should you need anything</u></h1><h2>Call <em>me</em></h2><p>Express<strong> your feelings</strong></p><p><br></p>',
            'release_date' => now()
        ]);
        TopicPage::create([
            'name' => 'Nun',
            'description' => 'A woman that looks like a penguin',
            'content' => '<h1><u>A dummy text</u></h1><h2>Road <em>tiles</em></h2><p>Express<strong> Inspiring text</strong></p><p><br></p>'
        ]);
        TopicPage::create([
            'name' => 'Bob',
            'description' => 'A woman that looks like Bob',
            'content' => '<h1><u>A dummy text</u></h1><h2>Road <em>tiles</em></h2><p>Express<strong> Inspiring text</strong></p><p><br></p>'
        ]);
        TopicPage::create([
            'name' => 'New texh',
            'description' => 'Information about tech',
            'content' => '<h1><u>A dummy text</u></h1><h2>Road <em>tiles</em></h2><p>Express<strong> Inspiring text</strong></p><p><br></p>'
        ]);
        Article::create([
            'title' => 'AI and stuff',
            'description' => 'AI is smart, but not really',
            'content' => '<h1>Self hacking server</h1><h2>I think it\'s the <u><em>future</em></u></h2><p>"I love and sometimes hate, but I\'m not AI" - Conscious robot</p><p><br></p>',
            'user_id' => 2
        ]);
    }
}
