<?php

use Illuminate\Database\Seeder;

class MovieTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('movies')->insert([
            
        ]);

        DB::table('permissions')->insert([
            [
                'slug'      => 'movies.movie.view',
                'name'      => 'View Movie',
            ],
            [
                'slug'      => 'movies.movie.create',
                'name'      => 'Create Movie',
            ],
            [
                'slug'      => 'movies.movie.edit',
                'name'      => 'Update Movie',
            ],
            [
                'slug'      => 'movies.movie.delete',
                'name'      => 'Delete Movie',
            ],
            /*
            [
                'slug'      => 'movies.movie.verify',
                'name'      => 'Verify Movie',
            ],
            [
                'slug'      => 'movies.movie.approve',
                'name'      => 'Approve Movie',
            ],
            [
                'slug'      => 'movies.movie.publish',
                'name'      => 'Publish Movie',
            ],
            [
                'slug'      => 'movies.movie.unpublish',
                'name'      => 'Unpublish Movie',
            ],
            [
                'slug'      => 'movies.movie.cancel',
                'name'      => 'Cancel Movie',
            ],
            [
                'slug'      => 'movies.movie.archive',
                'name'      => 'Archive Movie',
            ],
            */
        ]);

        DB::table('menus')->insert([

            [
                'parent_id'   => 1,
                'key'         => null,
                'url'         => 'admin/movies/movie',
                'name'        => 'Movie',
                'description' => null,
                'icon'        => 'fa fa-newspaper-o',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

            [
                'parent_id'   => 2,
                'key'         => null,
                'url'         => 'user/movies/movie',
                'name'        => 'Movie',
                'description' => null,
                'icon'        => 'icon-book-open',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

            [
                'parent_id'   => 3,
                'key'         => null,
                'url'         => 'movie',
                'name'        => 'Movie',
                'description' => null,
                'icon'        => null,
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

        ]);

        DB::table('settings')->insert([
            // Uncomment  and edit this section for entering value to settings table.
            /*
            [
                'key'      => 'movies.movie.key',
                'name'     => 'Some name',
                'value'    => 'Some value',
                'type'     => 'Default',
            ],
            */
        ]);
    }
}
