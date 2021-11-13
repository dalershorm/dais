<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'title' => 'Как зарегистироваться ?',
            'short_description' => 'I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine.',
            'is_active'=> 1
        ]);

        Post::create([
            'title' => 'Справочник',
            'short_description' => 'I feel that I never was a greater artist than now. When, while the lovely valley teems with vapour around me. ',
            'is_active'=> 1
        ]);
    }
}
