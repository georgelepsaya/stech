<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CompanyPage;
use App\Models\ProductPage;
use App\Models\Tag;
use Carbon\Carbon;
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
        ],
        );

        User::factory()->create([
            'name' => 'Georgy',
            'email' => 'georgy@test.com',
            'password' => bcrypt('georgy12345')
        ]);

        $companyPages = [
            [
                'name' => 'Adobe',
                'description' => 'Multinational computer software company',
                'content' => '<h1>Adobe</h1>',
                'website' => 'https://www.adobe.com',
                'industry' => 'Technology',
                'founding_date' => '1982-12-01',
            ],
            [
                'name' => 'Google',
                'description' => 'Technology company specializing in internet-related services',
                'content' => '<h1>Google</h1>',
                'website' => 'https://www.google.com',
                'industry' => 'Technology',
                'founding_date' => '1998-09-04',
            ],
            [
                'name' => 'Microsoft',
                'description' => 'Multinational technology company',
                'content' => '<h1>Microsoft</h1>',
                'website' => 'https://www.microsoft.com',
                'industry' => 'Technology',
                'founding_date' => '1975-04-04',
            ],
            [
                'name' => 'Apple',
                'description' => 'Multinational technology company',
                'content' => '<h1>Apple</h1>',
                'website' => 'https://www.apple.com',
                'industry' => 'Technology',
                'founding_date' => '1976-04-01',
            ],
            [
                'name' => 'Amazon',
                'description' => 'Multinational technology company focusing on e-commerce, cloud computing, digital streaming, and artificial intelligence',
                'content' => '<h1>Amazon</h1>',
                'website' => 'https://www.amazon.com',
                'industry' => 'Technology',
                'founding_date' => '1994-07-05',
            ],
            [
                'name' => 'Netflix',
                'description' => 'Streaming service for movies and TV series',
                'content' => '<h1>Netflix</h1>',
                'website' => 'https://www.netflix.com',
                'industry' => 'Entertainment',
                'founding_date' => '1997-08-29',
            ],
            [
                'name' => 'Tesla, Inc.',
                'description' => 'Electric vehicle and clean energy company',
                'content' => '<h1>Tesla</h1>',
                'website' => 'https://www.tesla.com',
                'industry' => 'Automotive',
                'founding_date' => '2003-07-01',
            ],
            [
                'name' => 'Salesforce',
                'description' => 'Cloud-based customer relationship management (CRM) platform',
                'content' => '<h1>Salesforce</h1>',
                'website' => 'https://www.salesforce.com',
                'industry' => 'Technology',
                'founding_date' => '1999-03-08',
            ],
            [
                'name' => 'Uber Technologies, Inc.',
                'description' => 'Ride-hailing and food delivery platform',
                'content' => '<h1>Uber</h1>',
                'website' => 'https://www.uber.com',
                'industry' => 'Transportation',
                'founding_date' => '2009-03-01',
            ],
            [
                'name' => 'Slack Technologies, Inc.',
                'description' => 'Business communication platform for teams.',
                'content' => '<h1>Slack Technologies, Inc.</h1><p>Slack is a messaging and collaboration platform designed for teams and workplaces. It offers features like channels, direct messaging, file sharing, and integrations with other productivity tools.</p>',
                'website' => 'https://slack.com',
                'industry' => 'Technology',
                'founding_date' => '2013-08-01',
            ],
            [
                'name' => 'Stripe, Inc.',
                'description' => 'Online payment processing platform.',
                'content' => '<h1>Stripe, Inc.</h1><p>Stripe is a technology company that provides infrastructure for online payment processing. It allows businesses to accept payments securely and offers tools for managing subscriptions, marketplaces, and more.</p>',
                'website' => 'https://stripe.com',
                'industry' => 'Finance',
                'founding_date' => '2010-09-29',
            ],
            [
                'name' => 'Airbnb, Inc.',
                'description' => 'Online marketplace for lodging and tourism experiences.',
                'content' => '<h1>Airbnb, Inc.</h1><p>Airbnb is an online platform that allows people to rent out their homes or properties to travelers. It offers a wide range of accommodations and unique experiences for users around the world.</p>',
                'website' => 'https://www.airbnb.com',
                'industry' => 'Hospitality',
                'founding_date' => '2008-08-01',
            ],
            [
                'name' => 'GitHub, Inc.',
                'description' => 'Web-based hosting service for version control and collaboration.',
                'content' => '<h1>GitHub, Inc.</h1><p>GitHub is a platform that provides hosting for software development and version control using Git. It offers collaboration features like code review, issue tracking, and project management tools.</p>',
                'website' => 'https://github.com',
                'industry' => 'Technology',
                'founding_date' => '2008-04-10',
            ],
            [
                'name' => 'Zoom Video Communications, Inc.',
                'description' => 'Video conferencing and online meeting platform.',
                'content' => '<h1>Zoom Video Communications, Inc.</h1><p>Zoom is a video conferencing platform that enables individuals and teams to conduct online meetings, webinars, and virtual events. It provides features like screen sharing, chat, and recording.</p>',
                'website' => 'https://zoom.us',
                'industry' => 'Technology',
                'founding_date' => '2011-04-21',
            ],
            [
                'name' => 'Atlassian Corporation Plc',
                'description' => 'Software company that develops products for software development, project management, and content management.',
                'content' => '<h1>Atlassian Corporation Plc</h1><p>Atlassian is a leading software company that provides tools and solutions for software developers, project managers, and content creators. It offers popular products like Jira, Confluence, Bitbucket, and Trello.</p>',
                'website' => 'https://www.atlassian.com',
                'industry' => 'Technology',
                'founding_date' => '2002-11-01',
            ],
            [
                'name' => 'Twilio Inc.',
                'description' => 'Cloud communications platform as a service (CPaaS) company.',
                'content' => '<h1>Twilio Inc.</h1><p>Twilio is a cloud communications platform that enables developers to build and scale applications using various communication channels like voice, video, SMS, and chat. It provides APIs and services for integrating communication capabilities into software applications.</p>',
                'website' => 'https://www.twilio.com',
                'industry' => 'Technology',
                'founding_date' => '2008-03-01',
            ],
            [
                'name' => 'MongoDB, Inc.',
                'description' => 'Cross-platform document-oriented database company.',
                'content' => '<h1>MongoDB, Inc.</h1><p>MongoDB is a popular document-oriented NoSQL database company. Its database software allows flexible and scalable storage of data in JSON-like documents. It is widely used in modern web applications and supports features like horizontal scaling and automatic sharding.</p>',
                'website' => 'https://www.mongodb.com',
                'industry' => 'Technology',
                'founding_date' => '2007-08-01',
            ],
            [
                'name' => 'Docker, Inc.',
                'description' => 'Software company that provides an open platform for building, shipping, and running distributed applications.',
                'content' => '<h1>Docker, Inc.</h1><p>Docker is a platform that allows developers to automate the deployment and management of applications within software containers. It provides a consistent environment for running applications across different operating systems and infrastructures.</p>',
                'website' => 'https://www.docker.com',
                'industry' => 'Technology',
                'founding_date' => '2010-03-01',
            ],
            [
                'name' => 'Dropbox, Inc.',
                'description' => 'File hosting service and cloud storage company.',
                'content' => '<h1>Dropbox, Inc.</h1><p>Dropbox is a file hosting service that offers cloud storage, file synchronization, and collaboration features. Users can store and share files across devices and collaborate on projects with teams.</p>',
                'website' => 'https://www.dropbox.com',
                'industry' => 'Technology',
                'founding_date' => '2007-06-01',
            ],
            [
                'name' => 'Shopify Inc.',
                'description' => 'E-commerce company providing a platform for online stores.',
                'content' => '<h1>Shopify Inc.</h1><p>Shopify is an e-commerce platform that allows businesses to set up and manage online stores. It provides features for creating product listings, managing inventory, processing payments, and customizing the storefront.</p>',
                'website' => 'https://www.shopify.com',
                'industry' => 'E-commerce',
                'founding_date' => '2006-09-01',
            ],
        ];

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
                ];

                $products[] = [
                    'name' => 'Adobe Premiere Pro',
                    'description' => 'Video editing software',
                    'content' => '<h1>Adobe Premiere Pro</h1><p>Adobe Premiere Pro is a leading video editing software used by professionals in the film, TV, and media industry. It offers advanced editing features, effects, and workflows for creating high-quality videos.</p>',
                    'release_date' => Carbon::create(1991, 8, 17),
                    'company_id' => $companyPage->id,
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
                ];

                $products[] = [
                    'name' => 'Google Drive',
                    'description' => 'Cloud storage and file synchronization service',
                    'content' => '<h1>Google Drive</h1><p>Google Drive is a cloud storage and file synchronization service provided by Google. It allows users to store, share, and collaborate on files and documents from anywhere.</p>',
                    'release_date' => Carbon::create(2012, 4, 24),
                    'company_id' => $companyPage->id,
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
                ];

                $products[] = [
                    'name' => 'Microsoft Azure',
                    'description' => 'Cloud computing platform and services',
                    'content' => '<h1>Microsoft Azure</h1><p>Microsoft Azure is a comprehensive cloud computing platform that provides a range of services, including virtual machines, storage, databases, and analytics. It enables organizations to build, deploy, and manage applications and services on a global scale.</p>',
                    'release_date' => Carbon::create(2010, 2, 1),
                    'company_id' => $companyPage->id,
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
                ];

                $products[] = [
                    'name' => 'MacBook Pro',
                    'description' => 'Laptop computer',
                    'content' => '<h1>MacBook Pro</h1><p>MacBook Pro is a high-performance laptop computer designed for professionals and power users. It combines powerful hardware, a sleek design, and the macOS operating system to deliver an exceptional computing experience.</p>',
                    'release_date' => Carbon::create(2006, 1, 10),
                    'company_id' => $companyPage->id,
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
                ];

                $products[] = [
                    'name' => 'Amazon Echo',
                    'description' => 'Smart speaker and virtual assistant',
                    'content' => '<h1>Amazon Echo</h1><p>Amazon Echo is a smart speaker powered by the virtual assistant Alexa. It can play music, answer questions, control smart home devices, and perform a wide range of tasks through voice commands.</p>',
                    'release_date' => Carbon::create(2014, 6, 23),
                    'company_id' => $companyPage->id,
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
                ];

                $products[] = [
                    'name' => 'Tesla Powerwall',
                    'description' => 'Home battery storage system',
                    'content' => '<h1>Tesla Powerwall</h1><p>Tesla Powerwall is a home battery storage system that stores energy generated from renewable sources or off-peak grid electricity. It provides backup power during outages and helps optimize energy usage.</p>',
                    'release_date' => Carbon::create(2015, 6, 29),
                    'company_id' => $companyPage->id,
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

        Tag::insert($tags);
    }
}
