<?php

    namespace Database\Seeders;

    use App\Models\Page;
    use App\Models\PageBlock;
    use App\Models\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Str;

    class PageSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $content='Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid assumenda beatae debitis eius, error ipsa magnam minima nostrum obcaecati odio, quod sit, soluta. Architecto consequuntur, dolores laboriosam magnam molestias nam!';
            $schemas = [
                [
                    'page' => [
                        'title' => 'Landing',
                        'link' => '/',
                    ],
                    'blocks' => [
                        [
                            'name' => 'sliders',
                            'data' => [

                                'items' => [
                                    'blocks' => [
                                        [
                                            'title' => [
                                                'value' => 'Jane Cooper',
                                                'type' => 'text',
                                            ],
                                            'icon' => [
                                                'value' => 'home-intro-icon-1.png',
                                                'type' => 'image',
                                            ],
                                            'image' => [
                                                'value' => 'home-intro-img-1.png',
                                                'type' => 'image'
                                            ],
                                        ],

                                        [
                                            'title' => [
                                                'value' => 'Jane Cooper',
                                                'type' => 'text',
                                            ],
                                            'icon' => [
                                                'value' => 'home-intro-icon-2.png',
                                                'type' => 'image',
                                            ],
                                            'image' => [
                                                'value' => 'home-intro-img-2.png',
                                                'type' => 'image'
                                            ],
                                        ],

                                        [
                                            'title' => [
                                                'value' => 'Jane Cooper',
                                                'type' => 'text',
                                            ],
                                            'icon' => [
                                                'value' => 'home-intro-icon-3.png',
                                                'type' => 'image',
                                            ],
                                            'image' => [
                                                'value' => 'home-intro-img-3.png',
                                                'type' => 'image'
                                            ],
                                        ],

                                        [
                                            'title' => [
                                                'value' => 'Jane Cooper',
                                                'type' => 'text',
                                            ],
                                            'icon' => [
                                                'value' => 'home-intro-icon-4.png',
                                                'type' => 'image',
                                            ],
                                            'image' => [
                                                'value' => 'home-intro-img-4.png',
                                                'type' => 'image'
                                            ],
                                        ],

                                        [
                                            'title' => [
                                                'value' => 'Jane Cooper',
                                                'type' => 'text',
                                            ],
                                            'icon' => [
                                                'value' => 'home-intro-icon-5.png',
                                                'type' => 'image',
                                            ],
                                            'image' => [
                                                'value' => 'home-intro-img-5.png',
                                                'type' => 'image'
                                            ],
                                        ],
                                    ],
                                    'type' => 'dynamic',
                                ],
                            ]
                        ],
                        [
                            'name' => 'faq',
                            'data' => [
                                'title' => [
                                    'value' => 'FAQ',
                                    'type'  => 'text',
                                ],
                                'text' => [
                                    'value' => 'Find the most popular questions and answers that may you help. You can contact us if you need help.',
                                    'type'  => 'textarea',
                                ],
                                'url'=>[
                                    'value'=>route('main.help-center.question',['question'=>2]),
                                    'type'=>'url'
                                ],
                                'button' => [
                                    'value' => 'learn more',
                                    'type' => 'text',
                                ],
                            ]
                        ],
                        [
                            'name' => 'how_it_works',
                            'data' => [
                                'title' => [
                                    'value' => 'HOW IT WORKS',
                                    'type'  => 'text',
                                ],
                                'text' => [
                                    'value' => 'Learn how it works and start renting your clothes or rent something for you..',
                                    'type'  => 'textarea',
                                ],
                                'url'=>[
                                    'value'=>route('main.help-center.question',['question'=>2]),
                                    'type'=>'url'
                                ],
                                'button' => [
                                    'value' => 'learn more',
                                    'type' => 'text',
                                ],
                            ]
                        ],
                        [
                            'name' => 'what_is_our_mission',
                            'data' => [
                                'title' => [
                                    'value' => 'WHAT IS OUR MISSION',
                                    'type'  => 'text',
                                ],
                                'text' => [
                                    'value' => 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet',
                                    'type'  => 'textarea',
                                ],
                                'url'=>[
                                    'value'=>route('main.page',['static_page'=>'what-is-our-mission']),
                                    'type'=>'url'
                                ],
                                'image' => [
                                    'value' => 'what-is.png',
                                    'type' => 'image'
                                ],
                                'button' => [
                                    'value' => 'learn more',
                                    'type' => 'text',
                                ],
                            ]
                        ],
                        
                    ]
                ],
                [
                    'page' => [
                        'title' => 'What is our mission',
                        'meta_title' => 'What is our mission',
                        'meta_description' => 'What is our mission',
                        'meta_keywords' => 'What is our mission',
                        'content' => $content,
                        'link' => 'what-is-our-mission',
                        'status' => 'published',
                    ],
                ],
                [
                    'page' => [
                        'title' => 'Delivery',
                        'meta_title' => 'Delivery',
                        'meta_description' => 'Delivery',
                        'meta_keywords' => 'Delivery',
                        'content' => $content,
                        'link' => 'delivery',
                        'status' => 'published',
                    ],
                ],
                [
                    'page' => [
                        'title' => 'Dry Cleaning',
                        'meta_title' => 'Dry Cleaning',
                        'meta_description' => 'Dry Cleaning',
                        'meta_keywords' => 'Dry Cleaning',
                        'content' => $content,
                        'link' => 'dry-cleaning',
                        'status' => 'published',
                    ],
                ],
                [
                    'page' => [
                        'title' => 'About Us',
                        'meta_title' => 'About Us',
                        'meta_description' => 'About Us',
                        'meta_keywords' => 'About Us',
                        'content' => $content,
                        'link' => 'about-us',
                        'status' => 'published',
                    ],
                ],
                [
                    'page' => [
                        'title' => 'Careers',
                        'meta_title' => 'Careers',
                        'meta_description' => 'Careers',
                        'meta_keywords' => 'Careers',
                        'content' => $content,
                        'link' => 'careers',
                        'status' => 'published',
                    ],
                ],
                [
                    'page' => [
                        'title' => 'Contact Us',
                        'meta_title' => 'Contact Us',
                        'meta_description' => 'Contact Us',
                        'meta_keywords' => 'Contact Us',
                        'content' => $content,
                        'link' => 'contact-us',
                        'status' => 'published',
                    ],
                ],
                [
                    'page' => [
                        'title' => 'Sustainability',
                        'meta_title' => 'Sustainability',
                        'meta_description' => 'Sustainability',
                        'meta_keywords' => 'Sustainability',
                        'content' => $content,
                        'link' => 'sustainability',
                        'status' => 'published',
                    ],
                ],
                [
                    'page' => [
                        'title' => 'Terms of Service',
                        'meta_title' => 'Terms of Service',
                        'meta_description' => 'Terms of Service',
                        'meta_keywords' => 'Terms of Service',
                        'content' => $content,
                        'link' => 'terms-of-service',
                        'status' => 'published',
                    ],
                ],
                [
                    'page' => [
                        'title' => 'Privacy Policy',
                        'meta_title' => 'Privacy Policy',
                        'meta_description' => 'Privacy Policy',
                        'meta_keywords' => 'Privacy Policy',
                        'content' => $content,
                        'link' => 'privacy-policy',
                        'status' => 'published',
                    ],
                ],
                [
                    'page' => [
                        'title' => 'Cookie Policy',
                        'meta_title' => 'Cookie Policy',
                        'meta_description' => 'Cookie Policy',
                        'meta_keywords' => 'Cookie Policy',
                        'content' => $content,
                        'link' => 'cookie-policy',
                        'status' => 'published',
                    ],
                ],

            ];

            foreach ($schemas as $schema) {
                $model = $schema['page'];
                $model['meta_title'] = $model['title'] . ' | ' . env('APP_NAME');
                $model['meta_description'] = $model['title'] . ' | ' . env('APP_NAME');
                $model['status'] = $model['status'] ?? 'static';
                $p = Page::updateOrCreate(
                    [
                        'link' => $model['link']
                    ],
                    $model
                );

                foreach ($schema['blocks']??[] as $block){

                    PageBlock::updateOrCreate(
                        [
                            'page_id' => $p->id,
                            'name' => $block['name'],
                        ],
                        [
                            'name' => $block['name'],
                            'page_id' => $p->id,
                            'data' => $block['data'],
                        ]);
                }
            }

            //TODO: copy images from 'database/seeders/images/' to 'storage/app/public/pages/'
        }
    }
