<?php

    namespace Database\Seeders;

    use App\Models\Page;
    use App\Models\PageBlock;
    use App\Models\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Str;

    class PostListPageSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
             $schemas = [
                [
                    'page' => [
                        'title' => 'Post list',
                        'link' => '/post/list',
                    ],
                    'blocks' => [
                        [
                            'name' => 'rent',
                            'data' => [
                                'day' => [
                                    'value' => 'Type days number...',
                                    'type' => 'text',
                                ],
                                'price' => [
                                    'value' => 'Add price...',
                                    'type' => 'text',
                                ],
                            ]
                        ],
                    ]
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
