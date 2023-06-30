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
                'name' => 'Adobe Inc.',
                'description' => 'Software company best known for Adobe Creative Cloud, a suite of multimedia and creativity software',
                'logo_path' => 'images/adobe-logo.png',
                'content' => '<h1>Adobe</h1>',
                'website' => 'https://www.adobe.com',
                'industry' => 'Software',
                'founding_date' => '1982-12-02',
                'approved' => 1
            ],
            [
                'name' => 'Figma, Inc.',
                'description' => 'Web-based vector graphics editor and prototyping tool',
                'logo_path' => 'images/figma-logo.png',
                'content' => '<h1>Figma</h1>',
                'website' => 'https://www.figma.com',
                'industry' => 'Software',
                'founding_date' => '2012-02-01',
                'approved' => 1
            ],
            [
                'name' => 'Ableton Inc.',
                'description' => 'Producer of music performance and production software',
                'logo_path' => 'images/ableton-logo.jpeg',
                'content' => '<h1>Ableton</h1>',
                'website' => 'https://www.ableton.com',
                'industry' => 'Music Technology',
                'founding_date' => '1999-10-01',
                'approved' => 1
            ],
            [
                'name' => 'Autodesk, Inc.',
                'description' => 'Leader in 3D design, engineering and entertainment software',
                'logo_path' => 'images/autodesk-logo.png',
                'content' => '<h1>Autodesk</h1>',
                'website' => 'https://www.autodesk.com',
                'industry' => 'Software',
                'founding_date' => '1982-01-30',
                'approved' => 1
            ],
            [
                'name' => 'Notion Labs',
                'description' => 'Creator of Notion, an all-in-one workspace for note-taking, project management, and task management',
                'logo_path' => 'images/notion-logo.png',
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
                'logo_path' => 'images/slack-logo.png',
                'website' => 'https://slack.com',
                'industry' => 'Software',
                'founding_date' => '2009-01-01',
                'approved' => 1
            ],
            [
                'name' => 'Spotify',
                'description' => 'Digital music service that provides access to millions of songs',
                'logo_path' => 'images/spotify-logo.png',
                'content' => '<h1>Spotify</h1>',
                'website' => 'https://www.spotify.com',
                'industry' => 'Music Streaming',
                'founding_date' => '2006-04-23',
                'approved' => 1
            ],
            [
                'name' => 'GitHub, Inc.',
                'description' => 'Provides hosting for software development and version control using Git',
                'logo_path' => 'images/github-logo.png',
                'content' => '<h1>GitHub</h1>',
                'website' => 'https://github.com',
                'industry' => 'Software Development',
                'founding_date' => '2008-04-10',
                'approved' => 1
            ],
            [
                'name' => 'Unity Technologies',
                'description' => 'Creator of the Unity game engine, used in the development of video games and simulations',
                'logo_path' => 'images/unity-logo.png',
                'content' => '<h1>Unity Technologies</h1>',
                'website' => 'https://unity.com',
                'industry' => 'Software',
                'founding_date' => '2004-01-01',
                'approved' => 1
            ],
            [
                'name' => 'OpenAI Inc.',
                'description' => 'An artificial intelligence research lab consisting of both for-profit and non-profit arms',
                'logo_path' => 'images/openai-logo.png',
                'content' => '<h1>OpenAI</h1>',
                'website' => 'https://www.openai.com',
                'industry' => 'Artificial Intelligence',
                'founding_date' => '2015-12-11',
                'approved' => 1
            ],
            [
                'name' => 'Savage Interactive',
                'description' => 'The company behind Procreate, an iPad app that lets creatives sketch, paint, and illustrate on a portable canvas',
                'logo_path' => 'images/savageinteractive-logo.png',
                'content' => '<h1>Savage Interactive</h1>',
                'website' => 'https://procreate.art',
                'industry' => 'Software',
                'founding_date' => '2011-01-01',
                'approved' => 1
            ],
            [
                'name' => 'Time Base Technology',
                'description' => 'Creator of GoodNotes, an app that lets you take beautiful, searchable handwritten notes and annotate PDF documents',
                'logo_path' => 'images/timebase-logo.png',
                'content' => '<h1>Time Base Technology</h1>',
                'website' => 'https://www.goodnotes.com',
                'industry' => 'Software',
                'founding_date' => '2010-01-01',
                'approved' => 1
            ]
        ];

        CompanyPage::insert($companyPages);

        $adobe = CompanyPage::where('name', 'Adobe Inc.')->first();
        $figma = CompanyPage::where('name', 'Figma, Inc.')->first();
        $ableton = CompanyPage::where('name', 'Ableton Inc.')->first();
        $autodesk = CompanyPage::where('name', 'Autodesk, Inc.')->first();
        $notionLabs = CompanyPage::where('name', 'Notion Labs')->first();
        $slackTechnologies = CompanyPage::where('name', 'Slack Technologies')->first();
        $spotify = CompanyPage::where('name', 'Spotify')->first();
        $github = CompanyPage::where('name', 'GitHub, Inc.')->first();
        $unity = CompanyPage::where('name', 'Unity Technologies')->first();
        $openAI = CompanyPage::where('name', 'OpenAI Inc.')->first();
        $savageInteractive = CompanyPage::where('name', 'Savage Interactive')->first();
        $timeBaseTechnology = CompanyPage::where('name', 'Time Base Technology')->first();

        $products = [
            [
                'name' => 'Adobe Photoshop',
                'description' => 'Image editing and graphic design software',
                'logo_path' => 'images/photoshop-logo.png',
                'content' => '<h1>Adobe Photoshop</h1><p>Adobe Photoshop is a powerful software for image editing, graphic design, and photo manipulation. It provides a wide range of tools and features for professional photographers, designers, and artists.</p>',
                'release_date' => Carbon::create(1990, 2, 19),
                'company_id' => $adobe->id,
                'approved' => 2
            ],
            [
                'name' => 'Adobe Illustrator',
                'description' => 'Vector graphics editor and design program',
                'logo_path' => 'images/illustrator-logo.png',
                'content' => '<h1>Adobe Illustrator</h1><p>Adobe Illustrator is a software used to create vector graphics. It is used by designers across the globe to create digital graphics, illustrations, and typography for all kinds of media: print, web, interactive, video, and mobile.</p>',
                'release_date' => Carbon::create(1987, 3, 19),
                'company_id' => $adobe->id,
                'approved' => 2
            ],
            [
                'name' => 'Adobe Premiere Pro',
                'description' => 'Timeline-based video editing software',
                'logo_path' => 'images/premierpro-logo.png',
                'content' => '<h1>Adobe Premiere Pro</h1><p>Adobe Premiere Pro is a timeline-based video editing software application. It is part of the Adobe Creative Cloud, which includes video editing, graphic design, and web development programs.</p>',
                'release_date' => Carbon::create(2003, 8, 21),
                'company_id' => $adobe->id,
                'approved' => 2
            ],
            [
                'name' => 'Figma',
                'description' => 'Web-based vector graphics editor and prototyping tool',
                'logo_path' => 'images/figma-logo.png',
                'content' => '<h1>Figma</h1><p>Figma is a web-based graphics editing and user interface design app. It is known for its real-time collaboration capabilities and has become popular among UI and UX designers.</p>',
                'release_date' => Carbon::create(2016, 12, 3),
                'company_id' => $figma->id,
                'approved' => 2
            ],
            [
                'name' => 'Ableton Live',
                'description' => 'Music performance and production software',
                'logo_path' => 'images/ableton-logo.jpeg',
                'content' => '<h1>Ableton Live</h1><p>Ableton Live is a software music sequencer and digital audio workstation for macOS and Windows. It is designed to be an instrument for live performances as well as a tool for composing, recording, arranging, mixing, and mastering.</p>',
                'release_date' => Carbon::create(2001, 10, 30),
                'company_id' => $ableton->id,
                'approved' => 2
            ],
            [
                'name' => 'AutoCAD',
                'description' => '2D/3D CAD software',
                'logo_path' => 'images/autocad-logo.png',
                'content' => '<h1>AutoCAD</h1><p>AutoCAD is a commercial computer-aided design (CAD) and drafting software application. It is used across a wide range of industries, by architects, project managers, engineers, graphic designers, and other professionals.</p>',
                'release_date' => Carbon::create(1982, 12, 1),
                'company_id' => $autodesk->id,
                'approved' => 2
            ],
            [
                'name' => 'Notion',
                'description' => 'All-in-one workspace for note-taking, project management, and task management',
                'logo_path' => 'images/notion-logo.png',
                'content' => '<h1>Notion</h1><p>Notion is an all-in-one workspace where you can write, plan, collaborate and get organized. It allows you to take notes, add tasks, manage projects & more.</p>',
                'release_date' => Carbon::create(2016, 3, 1),
                'company_id' => $notionLabs->id,
                'approved' => 2
            ],
            [
                'name' => 'Slack',
                'description' => 'Team collaboration and communication platform',
                'logo_path' => 'images/slack-logo.png',
                'content' => '<h1>Slack</h1><p>Slack is a channel-based messaging platform. With Slack, people can work together more effectively, connect all their software tools and services, and find the information they need to do their best work — all within a secure, enterprise-grade environment.</p>',
                'release_date' => Carbon::create(2013, 8, 14),
                'company_id' => $slackTechnologies->id,
                'approved' => 2
            ],
            [
                'name' => 'Spotify',
                'description' => 'Digital music service that provides access to millions of songs',
                'logo_path' => 'images/spotify-logo.png',
                'content' => '<h1>Spotify</h1><p>Spotify is a digital music service that gives you access to millions of songs, podcasts, and videos from artists all over the world. Spotify is immediately appealing because you can access content for free by simply signing up using an email address or by connecting with Facebook.</p>',
                'release_date' => Carbon::create(2008, 10, 7),
                'company_id' => $spotify->id,
                'approved' => 2
            ],
            [
                'name' => 'GitHub',
                'description' => 'Web-based hosting service for version control and collaboration',
                'logo_path' => 'images/github-logo.png',
                'content' => '<h1>GitHub</h1><p>GitHub is a web-based hosting service for version control using Git. It offers all of the distributed version control and source code management (SCM) functionality of Git as well as adding its own features. It provides access control and several collaboration features such as bug tracking, feature requests, task management, continuous integration and wikis for every project.</p>',
                'release_date' => Carbon::create(2008, 4, 10),
                'company_id' => $github->id,
                'approved' => 2
            ],
            [
                'name' => 'Unity',
                'description' => 'Cross-platform game engine',
                'logo_path' => 'images/unity-logo.png',
                'content' => '<h1>Unity</h1><p>Unity is a cross-platform game engine developed by Unity Technologies, which is primarily used to create video games and simulations for computers, consoles, and mobile devices. Apart from games, it is also used in industries such as film, automotive, architecture, engineering, and construction.</p>',
                'release_date' => Carbon::create(2005, 6, 27),
                'company_id' => $unity->id,
                'approved' => 2
            ],
            [
                'name' => 'GPT-3',
                'description' => 'Language prediction model',
                'logo_path' => 'images/gpt3-logo.jpeg',
                'content' => '<h1>GPT-3</h1><p>GPT-3 (Generative Pretrained Transformer 3) is a state-of-the-art autoregressive language model that uses deep learning to produce human-like text. It is the third iteration of the GPT model series created by OpenAI.</p>',
                'release_date' => Carbon::create(2020, 6, 11),
                'company_id' => $openAI->id,
                'approved' => 2
            ],
            [
                'name' => 'Procreate',
                'description' => 'Raster graphics editor app for digital painting',
                'logo_path' => 'images/procreate-logo.png',
                'content' => '<h1>Procreate</h1><p>Procreate is a raster graphics editor app for digital painting developed and published by Savage Interactive for iOS and iPadOS. It is widely used for digital production in graphics, illustrations, and animations.</p>',
                'release_date' => Carbon::create(2011, 3, 16),
                'company_id' => $savageInteractive->id,
                'approved' => 2
            ],
            [
                'name' => 'Goodnotes',
                'description' => 'Note-taking app',
                'logo_path' => 'images/goodnotes-logo.png',
                'content' => '<h1>Goodnotes</h1><p>Goodnotes is a note-taking app that lets you write, draw, annotate, import photos, and it even does handwriting recognition. It is designed for both iPhone and iPad.</p>',
                'release_date' => Carbon::create(2013, 12, 19),
                'company_id' => $timeBaseTechnology->id,
                'approved' => 2
            ]
        ];

        foreach ($products as $product) {
            ProductPage::create($product);
        }

        $tags = [
            ['title' => 'Productivity'],
            ['title' => 'Communication'],
            ['title' => 'Design'],
            ['title' => 'Programming'],
            ['title' => 'Software Development'],
            ['title' => 'Web Development'],
            ['title' => 'Mobile Development'],
            ['title' => 'UX/UI'],
            ['title' => 'Collaboration'],
            ['title' => 'Data Science'],
            ['title' => 'Machine Learning'],
            ['title' => 'Artificial Intelligence'],
            ['title' => 'Cloud Computing'],
            ['title' => 'Virtual Reality'],
            ['title' => 'Augmented Reality'],
            ['title' => 'Gaming'],
            ['title' => 'Music Production'],
            ['title' => 'Graphic Design'],
            ['title' => '3D Modeling'],
            ['title' => 'Animation'],
            ['title' => 'Video Editing'],
            ['title' => 'Startups'],
            ['title' => 'Entrepreneurship'],
            ['title' => 'Remote Work'],
            ['title' => 'Project Management'],
            ['title' => 'Digital Marketing'],
            ['title' => 'Cybersecurity'],
            ['title' => 'Blockchain'],
            ['title' => 'Cryptocurrency'],
            ['title' => 'eCommerce'],
            ['title' => 'iOS Development'],
            ['title' => 'iPadOS Development'],
            ['title' => 'Vector Graphics'],
            ['title' => 'Note-Taking'],
            ['title' => 'Music Streaming'],
            ['title' => 'Version Control'],
            ['title' => 'Game Development'],
            ['title' => 'Handwritten Notes'],
            ['title' => 'Digital Art'],
            ['title' => 'Drawing and Painting'],
            ['title' => 'Image Editing'],
            ['title' => 'Audio Software'],
            ['title' => 'Task Management'],
            ['title' => 'Team Collaboration'],
            ['title' => 'All-in-One Workspace'],
            ['title' => 'Digital Music Service'],
            ['title' => 'Source Code Repository'],
            ['title' => 'Video Games'],
            ['title' => 'Software Prototyping'],
            ['title' => 'PDF Annotation'],
            ['title' => 'Sketching'],
            ['title' => 'Music Technology']
        ];

        Tag::insert($tags);

        $topicPages = [
            [
                'name' => 'Artificial Intelligence',
                'description' => 'Exploring the latest advancements and applications in artificial intelligence',
                'logo_path' => 'images/ai-logo.jpeg',
                'content' => '<h1>Artificial Intelligence</h1>',
                'approved' => 3
            ],
            [
                'name' => 'iOS Development',
                'description' => 'Learn and discuss about the development of applications for Apple\'s iOS platform',
                'logo_path' => 'images/iosdev-logo.png',
                'content' => '<h1>iOS Development</h1>',
                'approved' => 3
            ],
            [
                'name' => 'UX/UI Design',
                'description' => 'Designing intuitive and engaging interfaces for software and websites',
                'logo_path' => 'images/uxui-logo.png',
                'content' => '<h1>UX/UI Design</h1>',
                'approved' => 3
            ],
            [
                'name' => 'Music Production',
                'description' => 'Techniques, tips, and software for producing and mixing music',
                'logo_path' => 'images/musicprod-logo.jpeg',
                'content' => '<h1>Music Production</h1>',
                'approved' => 3
            ],
            [
                'name' => '3D Modeling',
                'description' => 'Learn and discuss about creating 3D models for games, simulations, and more',
                'logo_path' => 'images/3dmodeling-logo.png',
                'content' => '<h1>3D Modeling</h1>',
                'approved' => 3
            ],
            [
                'name' => 'Startups',
                'description' => 'Discussions on starting a company, entrepreneurship, and disruptive technology',
                'logo_path' => 'images/startups-logo.jpeg',
                'content' => '<h1>Startups</h1>',
                'approved' => 3
            ],
            [
                'name' => 'Machine Learning',
                'description' => 'Topics on machine learning, deep learning, and neural networks',
                'logo_path' => 'images/machinelearning-logo.png',
                'content' => '<h1>Machine Learning</h1>',
                'approved' => 3
            ],
        ];

        TopicPage::insert($topicPages);
    }
}
