<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'menu' => [
                    'name' => 'Header',
                    'code' => 'header'
                ],
                'items' => [
                    [
                        'title' => 'All Categories',
                        'link' => route('main.category.list')
                    ],
                    [
                        'title' => 'New in',
                        'link' => route('main.product.new')
                    ],
                    [
                        'title' => 'Brands',
                        'link' => route('main.brand.index')
                    ],
                    [
                        'title' => 'Trending',
                        'link' => route('main.product.trend')
                    ],
                    [
                        'title' => 'Menswear',
                        'link' => route('main.category.products',['category'=>'menswear'])
                    ],
                    [
                        'title' => 'Womenswear',
                        'link' => route('main.category.products',['category'=>'womenswear'])
                    ],
                    [
                        'title' => 'Jewellery',
                        'link' => route('main.category.products',['category'=>'jewellery'])
                    ],

                ]
            ],
            [
            'menu' => [
                'name' => 'Explore',
                'code' => 'explore'
            ],
            'items' => [
                [
                    'title' => 'How it works',
                    'link' => route('main.help-center.question',['question'=>1])
                ],
                [
                    'title' => 'FAQs',
                    'link' => route('main.help-center.question',['question'=>2])
                ],
                [
                    'title' => 'Categories',
                    'link' => route('main.category.list')
                ],
                [
                    'title' => 'Delivery',
                    'link' => route('main.page.deliver',['static_page'=>'delivery'])
                ],
                [
                    'title' => 'Dry Cleaning',
                    'link' => route('main.page',['static_page'=>'dry-cleaning'])
                ]
            ]
        ],
            [
                'menu' => [
                    'name' => 'Company',
                    'code' => 'company'
                ],
                'items' => [
                    [
                        'title' => 'About Us',
                        'link' => route('main.page',['static_page'=>'about-us'])
                    ],
                    [
                        'title' => 'FAQs',
                        'link' => route('main.help-center.question',['question'=>2])
                    ],
                    [
                        'title' => 'Careers',
                        'link' => route('main.page',['static_page'=>'careers'])
                    ],
                    [
                        'title' => 'Contact Us',
                        'link' => route('main.page',['static_page'=>'contact-us'])
                    ],
                    [
                        'title' => 'Sustainability',
                        'link' => route('main.page',['static_page'=>'sustainability'])
                    ]
                ]
            ],
            [
                'menu' => [
                    'name' => 'Legal',
                    'code' => 'legal'
                ],
                'items' => [
                    [
                        'title' => 'Terms of Service',
                        'link' => route('main.page',['static_page'=>'terms-of-service'])
                    ],
                    [
                        'title' => 'Privacy Policy',
                        'link' => route('main.page',['static_page'=>'privacy-policy'])
                    ],
                    [
                        'title' => 'Cookie Policy',
                        'link' => route('main.page',['static_page'=>'cookie-policy'])
                    ]
                ]
            ]
            ];

        foreach ($menus as $menu) {
            $m = Menu::updateOrCreate(
                [
                    'code' => $menu['menu']['code']
                ],
                $menu['menu']
            );

            foreach ($menu['items'] as $i => $item) {
                $item['sort'] = $i;
                $iObj = $m->items()->updateOrCreate(
                    [
                        'title' => $item['title'],
                        'link' => $item['link']??null,
                    ],
                    [
                        'title' => $item['title'],
                        'link' => $item['link']??null,
                        'icon' => $item['icon']??null,
                        'sort' => $i,
                    ]
                );

                foreach ($item['items']??[] as $ii => $child) {
                    $m->items()->updateOrCreate(
                        [
                            'title' => $child['title'],
                            'link' => $child['link']??null,
                            'parent_id' => $iObj->id
                        ],
                        [
                            'title' => $child['title'],
                            'link' => $child['link']??null,
                            'sort' => $ii,
                            'parent_id' => $iObj->id
                        ]
                    );
                }
            }
        }
    }
}
