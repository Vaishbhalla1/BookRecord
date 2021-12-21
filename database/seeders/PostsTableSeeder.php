<?php

namespace Database\Seeders;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
       $post=new Post;
       $post->user_id=2;
       $post->category_id=1;
       $post->title= 'Covid-19';
       $post->body='If you receive one dose of COVID-19 mRNA Vaccine BNT162b2, you should receive a second dose of the';
       $post->slug='covid';
       $post->image='laravel-wiki-5f92a8e71c7bc1603447015.jpg';
       $post->status=1;
       $post->view_count=3;
       $post->save();     
       
       
        $posts = Post::factory()->count(10)->create();
    }
}
