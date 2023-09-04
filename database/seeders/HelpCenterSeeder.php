<?php

namespace Database\Seeders;

use App\Models\HelpCenterCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HelpCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $answer = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci commodi cum soluta.';
        $items = [
            [
                'title' => 'FAQ',
                'content' => 'Find the most popular questions and answers that may you help.',
                'is_active' => true,
                'questions' => [
                    [
                        'question' => 'FAQ question',
                        'answer' => $answer,
                        'meta_title' => 'meta_title',
                        'meta_description' => 'meta_description',
                        'meta_keyword' => 'meta_keyword',
                        'is_active' => true,
                    ],
                    [
                        'question' => 'Need help?',
                        'answer' => $answer,
                        'meta_title' => 'meta_title',
                        'meta_description' => 'meta_description',
                        'meta_keyword' => 'meta_keyword',
                        'is_active' => true,
                    ],
                    [
                        'question' => "Where's my order?",
                        'answer' => $answer,
                        'meta_title' => 'meta_title',
                        'meta_description' => 'meta_description',
                        'meta_keyword' => 'meta_keyword',
                        'is_active' => true,
                    ],
                    [
                        'question' => 'How to make a return?',
                        'answer' => $answer,
                        'meta_title' => 'meta_title',
                        'meta_description' => 'meta_description',
                        'meta_keyword' => 'meta_keyword',
                        'is_active' => true,
                    ]
                ]
            ],
            [
                'title' => 'HOW IT WORKS',
                'content' => 'Find the most popular questions and answers that may you help.',
                'is_active' => true,
                'questions' => [
                    [
                        'question' => 'HOW IT WORKS question',
                        'answer' => $answer,
                        'meta_title' => 'meta_title',
                        'meta_description' => 'meta_description',
                        'meta_keyword' => 'meta_keyword',
                        'is_active' => true,
                    ]
                ]
            ],
            [
                'title' => 'MY ACCOUNT',
                'content' => 'Find the most popular questions and answers that may you help.',
                'is_active' => true,
                'questions' => [
                    [
                        'question' => 'MY ACCOUNT question',
                        'answer' => $answer,
                        'meta_title' => 'meta_title',
                        'meta_description' => 'meta_description',
                        'meta_keyword' => 'meta_keyword',
                        'is_active' => true,
                    ]
                ]
            ],
            [
                'title' => 'RENTING',
                'content' => 'Find the most popular questions and answers that may you help.',
                'is_active' => true,
                'questions' => [
                    [
                        'question' => 'RENTING question',
                        'answer' => $answer,
                        'meta_title' => 'meta_title',
                        'meta_description' => 'meta_description',
                        'meta_keyword' => 'meta_keyword',
                        'is_active' => true,
                    ]
                ]
            ]
        ];
         try{
             DB::beginTransaction();
             foreach ($items as $item) {
                 $question_data = $item['questions'][0];
                 $category = HelpCenterCategory::updateOrCreate(['title' => $item['title']], [
                     'title' => $item['title'],
                     'content' => $item['content'],
                     'is_active' => $item['is_active'],
                 ]);

                 $category->questions()->updateOrCreate(['question' => $question_data['question']], [
                     'question' => $question_data['question'],
                     'answer' => $question_data['answer'],
                     'meta_title' => $question_data['meta_title'],
                     'meta_description' => $question_data['meta_description'],
                     'meta_keyword' => $question_data['meta_keyword'],
                     'is_active' => $question_data['is_active'],
                 ]);

             }
             DB::commit();
         }catch (\Exception $exception){
             DB::rollBack();
             dd($exception);
         }

    }
}
