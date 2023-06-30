<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CompanyPage;
use App\Models\ProductPage;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use \App\Models\User;
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
            'name' => 'Thomas',
            'username' => 'thomas.h',
            'email' => 'thomas@inbox.lv',
            'password' => bcrypt('qwer1234')
        ],
        );

        User::factory()->create([
            'name' => 'Georgy',
            'username' => 'georgy.l',
            'email' => 'georgy@test.com',
            'password' => bcrypt('georgy12345')
        ]);

        User::factory()->create([
            'name' => 'Jeff',
            'username' => 'jeff1',
            'email' => 'jeff@test.com',
            'password' => bcrypt('apple333'),
            'admin' => 1
        ]);

        $companyPages = [
            [
                'name' => 'Adobe',
                'description' => 'Software company best known for Adobe Creative Cloud, a suite of multimedia and creativity software',
                'logo_path' => '',
                'content' => '<h1>Adobe</h1>',
                'website' => 'https://www.adobe.com',
                'industry' => 'Software',
                'founding_date' => '1982-12-02',
                'approved' => 1
            ],
            [
                'name' => 'Figma',
                'description' => 'Web-based vector graphics editor and prototyping tool',
                'content' => '<h1>Figma</h1>',
                'website' => 'https://www.figma.com',
                'industry' => 'Software',
                'founding_date' => '2012-02-01',
                'approved' => 1
            ],
            [
                'name' => 'Ableton',
                'description' => 'Producer of music performance and production software',
                'content' => '<h1>Ableton</h1>',
                'website' => 'https://www.ableton.com',
                'industry' => 'Music Technology',
                'founding_date' => '1999-10-01',
                'approved' => 1
            ],
            [
                'name' => 'Autodesk',
                'description' => 'Leader in 3D design, engineering and entertainment software',
                'content' => '<h1>Autodesk</h1>',
                'website' => 'https://www.autodesk.com',
                'industry' => 'Software',
                'founding_date' => '1982-01-30',
                'approved' => 1
            ],
            [
                'name' => 'Notion Labs',
                'description' => 'Creator of Notion, an all-in-one workspace for note-taking, project management, and task management',
                'content' => '<h1>Notion Labs</h1>',
                'website' => 'https://www.notion.so',
                'industry' => 'Software',
                'founding_date' => '2013-06-01',
                'approved' => 1
            ],
            [
                'name' => 'Slack Technologies',
                'description' => 'Company behind Slack, the popular team collaboration and communication platform',
                'content' => '<h1>Slack Technologies</h1>',
                'website' => 'https://slack.com',
                'industry' => 'Software',
                'founding_date' => '2009-01-01',
                'approved' => 1
            ],
            [
                'name' => 'Spotify',
                'description' => 'Digital music service that provides access to millions of songs',
                'content' => '<h1>Spotify</h1>',
                'website' => 'https://www.spotify.com',
                'industry' => 'Music Streaming',
                'founding_date' => '2006-04-23',
                'approved' => 1
            ],
            [
                'name' => 'GitHub',
                'description' => 'Provides hosting for software development and version control using Git',
                'content' => '<h1>GitHub</h1>',
                'website' => 'https://github.com',
                'industry' => 'Software Development',
                'founding_date' => '2008-04-10',
                'approved' => 1
            ],
            [
                'name' => 'Unity Technologies',
                'description' => 'Creator of the Unity game engine, used in the development of video games and simulations',
                'content' => '<h1>Unity Technologies</h1>',
                'website' => 'https://unity.com',
                'industry' => 'Software',
                'founding_date' => '2004-01-01',
                'approved' => 1
            ],
            [
                'name' => 'Atlassian',
                'description' => 'Company behind project management software such as Jira, Confluence, and Trello',
                'content' => '<h1>Atlassian</h1>',
                'website' => 'https://www.atlassian.com',
                'industry' => 'Software',
                'founding_date' => '2002-03-01',
                'approved' => 1
            ]
        ]

        foreach ($companyPages as $company) {
            $companyPage = CompanyPage::updateOrCreate(
                ['name' => $company['name']],
                $company
            );

            // Insert product pages for the company
            $products = [];

            if ($company['name'] === 'Adobe') {
                $products[] = [
                    'name' => 'Adobe Photoshop',
                    'description' => 'Image editing and graphic design software',
                    'content' => '<h1>Adobe Photoshop</h1><p>Adobe Photoshop is a powerful software for image editing, graphic design, and photo manipulation. It provides a wide range of tools and features for professional photographers, designers, and artists.</p>',
                    'release_date' => Carbon::create(1990, 2, 19),
                    'company_id' => $companyPage->id,
                    'approved' => 2
                ];

                $products[] = [
                    'name' => 'Adobe Premiere Pro',
                    'description' => 'Video editing software',
                    'content' => '<h1>Adobe Premiere Pro</h1><p>Adobe Premiere Pro is a leading video editing software used by professionals in the film, TV, and media industry. It offers advanced editing features, effects, and workflows for creating high-quality videos.</p>',
                    'release_date' => Carbon::create(1991, 8, 17),
                    'company_id' => $companyPage->id,
                    'approved' => 2
                ];

                // Add more product pages for Adobe if needed
            }

            if ($company['name'] === 'Google') {
                $products[] = [
                    'name' => 'Google Chrome',
                    'description' => 'Web browser',
                    'content' => '<h1>Google Chrome</h1><p>Google Chrome is a fast, secure, and easy-to-use web browser. It provides a smooth browsing experience with features like tab management, extensions, and synchronization across devices.</p>',
                    'release_date' => Carbon::create(2008, 9, 2),
                    'company_id' => $companyPage->id,
                    'approved' => 2
                ];

                $products[] = [
                    'name' => 'Google Drive',
                    'description' => 'Cloud storage and file synchronization service',
                    'content' => '<h1>Google Drive</h1><p>Google Drive is a cloud storage and file synchronization service provided by Google. It allows users to store, share, and collaborate on files and documents from anywhere.</p>',
                    'release_date' => Carbon::create(2012, 4, 24),
                    'company_id' => $companyPage->id,
                    'approved' => 2
                ];

                // Add more product pages for Google if needed
            }

            if ($company['name'] === 'Microsoft') {
                $products[] = [
                    'name' => 'Microsoft Office 365',
                    'description' => 'Productivity suite and cloud-based software',
                    'content' => '<h1>Microsoft Office 365</h1><p>Microsoft Office 365 is a suite of productivity tools and cloud-based software. It includes popular applications like Word, Excel, PowerPoint, and Outlook, along with collaboration and communication features.</p>',
                    'release_date' => Carbon::create(2011, 6, 28),
                    'company_id' => $companyPage->id,
                    'approved' => 2
                ];

                $products[] = [
                    'name' => 'Microsoft Azure',
                    'description' => 'Cloud computing platform and services',
                    'content' => '<h1>Microsoft Azure</h1><p>Microsoft Azure is a comprehensive cloud computing platform that provides a range of services, including virtual machines, storage, databases, and analytics. It enables organizations to build, deploy, and manage applications and services on a global scale.</p>',
                    'release_date' => Carbon::create(2010, 2, 1),
                    'company_id' => $companyPage->id,
                    'approved' => 2
                ];

                // Add more product pages for Microsoft if needed
            }

            if ($company['name'] === 'Apple') {
                $products[] = [
                    'name' => 'iPhone',
                    'description' => 'Smartphone',
                    'content' => '<h1>iPhone</h1><p>iPhone is a line of smartphones designed and marketed by Apple. It offers a range of features and capabilities, including a high-resolution display, advanced camera system, and integration with Apple`s ecosystem of apps and services.</p>',
                    'release_date' => Carbon::create(2007, 6, 29),
                    'company_id' => $companyPage->id,
                    'approved' => 2
                ];

                $products[] = [
                    'name' => 'MacBook Pro',
                    'description' => 'Laptop computer',
                    'content' => '<h1>MacBook Pro</h1><p>MacBook Pro is a high-performance laptop computer designed for professionals and power users. It combines powerful hardware, a sleek design, and the macOS operating system to deliver an exceptional computing experience.</p>',
                    'release_date' => Carbon::create(2006, 1, 10),
                    'company_id' => $companyPage->id,
                    'approved' => 2
                ];

                // Add more product pages for Apple if needed
            }

            if ($company['name'] === 'Amazon') {
                $products[] = [
                    'name' => 'Amazon Kindle',
                    'description' => 'E-reader device',
                    'content' => '<h1>Amazon Kindle</h1><p>Amazon Kindle is a series of e-reader devices designed for reading digital books and other content. It offers features like adjustable lighting, long battery life, and access to a vast library of books and publications.</p>',
                    'release_date' => Carbon::create(2007, 11, 19),
                    'company_id' => $companyPage->id,
                    'approved' => 2
                ];

                $products[] = [
                    'name' => 'Amazon Echo',
                    'description' => 'Smart speaker and virtual assistant',
                    'content' => '<h1>Amazon Echo</h1><p>Amazon Echo is a smart speaker powered by the virtual assistant Alexa. It can play music, answer questions, control smart home devices, and perform a wide range of tasks through voice commands.</p>',
                    'release_date' => Carbon::create(2014, 6, 23),
                    'company_id' => $companyPage->id,
                    'approved' => 2
                ];

                // Add more product pages for Amazon if needed
            }

            if ($company['name'] === 'Netflix') {
                $products[] = [
                    'name' => 'Netflix Streaming Service',
                    'description' => 'Online streaming platform for movies and TV series',
                    'content' => '<h1>Netflix Streaming Service</h1><p>Netflix is a leading online streaming platform that offers a wide range of movies, TV series, and original content. Subscribers can access a vast library of entertainment and enjoy high-quality streaming on various devices.</p>',
                    'release_date' => Carbon::create(2007, 1, 1),
                    'company_id' => $companyPage->id,
                    'approved' => 2
                ];

                // Add more product pages for Netflix if needed
            }

            if ($company['name'] === 'Tesla, Inc.') {
                $products[] = [
                    'name' => 'Tesla Model S',
                    'description' => 'Electric luxury sedan',
                    'content' => '<h1>Tesla Model S</h1><p>Tesla Model S is an all-electric luxury sedan known for its performance, range, and advanced features. It offers zero-emission driving, autopilot capabilities, and over-the-air software updates.</p>',
                    'release_date' => Carbon::create(2012, 6, 22),
                    'company_id' => $companyPage->id,
                    'approved' => 2
                ];

                $products[] = [
                    'name' => 'Tesla Powerwall',
                    'description' => 'Home battery storage system',
                    'content' => '<h1>Tesla Powerwall</h1><p>Tesla Powerwall is a home battery storage system that stores energy generated from renewable sources or off-peak grid electricity. It provides backup power during outages and helps optimize energy usage.</p>',
                    'release_date' => Carbon::create(2015, 6, 29),
                    'company_id' => $companyPage->id,
                    'approved' => 2
                ];

                // Add more product pages for Tesla if needed
            }

            if ($company['name'] === 'Airbnb, Inc.') {
                $products[] = [
                    'name' => 'Airbnb',
                    'description' => 'Online marketplace for lodging and tourism experiences',
                    'content' => '<h1>Airbnb</h1><p>Airbnb is an online marketplace that connects travelers with hosts offering unique accommodations and tourism experiences. It allows people to rent out their homes or properties and provides a platform for booking and managing stays.</p>',
                    'release_date' => Carbon::create(2008, 8, 1),
                    'company_id' => $companyPage->id,
                    'approved' => 2
                ];

                // Add more product pages for Airbnb if needed
            }

            if ($company['name'] === 'Salesforce') {
                $products[] = [
                    'name' => 'Salesforce CRM',
                    'description' => 'Customer relationship management (CRM) platform',
                    'content' => '<h1>Salesforce CRM</h1><p>Salesforce CRM is a cloud-based platform that helps businesses manage customer relationships, sales processes, and marketing campaigns. It provides tools for tracking leads, managing contacts, and analyzing sales data.</p>',
                    'release_date' => Carbon::create(1999, 3, 8),
                    'company_id' => $companyPage->id,
                    'approved' => 2
                ];

                // Add more product pages for Salesforce if needed
            }

            if ($company['name'] === 'Uber Technologies, Inc.') {
                $products[] = [
                    'name' => 'Uber',
                    'description' => 'Ride-hailing and food delivery platform',
                    'content' => '<h1>Uber</h1><p>Uber is a global platform that connects riders with drivers for on-demand transportation services. It offers ride-hailing, food delivery, and other mobility solutions to millions of users worldwide.</p>',
                    'release_date' => Carbon::create(2009, 3, 1),
                    'company_id' => $companyPage->id,
                    'approved' => 2
                ];

                // Add more product pages for Uber if needed
            }

            // Add more conditions for other companies and their associated product pages

            ProductPage::insert($products);
        }

        $tags = [
            [
                'title' => 'Collaboration & Communication'
            ],
            [
                'title' => 'Productivity & Project Management'
            ],
            [
                'title' => 'Note-taking & Documentation'
            ],
            [
                'title' => 'Data Analytics & Visualization'
            ],
            [
                'title' => 'E-commerce & Online Marketplace'
            ],
            [
                'title' => 'Social Networking & Community'
            ],
            [
                'title' => 'Mobile App Development'
            ],
            [
                'title' => 'Web Development & CMS'
            ],
            [
                'title' => 'Artificial Intelligence & Machine Learning'
            ],
            [
                'title' => 'Augmented Reality & Virtual Reality'
            ],
            [
                'title' => 'Internet of Things (IoT)'
            ],
            [
                'title' => 'Cybersecurity & Privacy'
            ],
            [
                'title' => 'Cloud Computing & SaaS'
            ],
            [
                'title' => 'DevOps & Automation'
            ],
            [
                'title' => 'UX/UI Design & Prototyping'
            ],
            [
                'title' => 'Digital Marketing & SEO'
            ],
            [
                'title' => 'Content Creation & Publishing'
            ],
            [
                'title' => 'Gaming & Entertainment'
            ],
            [
                'title' => 'Financial Technology (FinTech)'
            ],
            [
                'title' => 'HealthTech & MedTech'
            ],
            [
                'title' => 'EdTech & Online Learning'
            ],
            [
                'title' => 'Wearable Technology'
            ],
            [
                'title' => 'Open Source Projects'
            ],
            [
                'title' => 'Robotics & Automation'
            ],
            [
                'title' => 'Video Streaming & Broadcasting'
            ],
            [
                'title' => 'Blockchain & Cryptocurrency'
            ],
            [
                'title' => 'API Development & Integration'
            ],
            [
                'title' => 'Data Science & Predictive Analytics'
            ],
            [
                'title' => 'Clean Energy & Sustainability'
            ],
            [
                'title' => 'UI Frameworks & Libraries'
            ],
            [
                'title' => 'Accessibility & Inclusive Design'
            ],
            [
                'title' => 'Voice Assistants & Natural Language Processing'
            ],
        ];

//        TopicPage::create([
//            'name' => 'Nun',
//            'description' => 'A woman that looks like a penguin',
//            'content' => '<h1><u>A dummy text</u></h1><h2>Road <em>tiles</em></h2><p>Express<strong> Inspiring text</strong></p><p><br></p>',
//            'approved' => 3
//        ]);
//        TopicPage::create([
//            'name' => 'Bob',
//            'description' => 'A woman that looks like Bob',
//            'content' => '<h1><u>A dummy text</u></h1><h2>Road <em>tiles</em></h2><p>Express<strong> Inspiring text</strong></p><p><br></p>',
//            'approved' => 3
//        ]);
//        TopicPage::create([
//            'name' => 'New texh',
//            'description' => 'Information about tech',
//            'content' => '<h1><u>A dummy text</u></h1><h2>Road <em>tiles</em></h2><p>Express<strong> Inspiring text</strong></p><p><br></p>',
//            'approved' => 3
//        ]);

        Tag::insert($tags);
    }
}
