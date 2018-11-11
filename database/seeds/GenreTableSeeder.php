<?php

use Illuminate\Database\Seeder;

class GenreTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('genres')->insert([
            
        ]);

        DB::table('permissions')->insert([
            [
                'slug'      => 'movies.genre.view',
                'name'      => 'View Genre',
            ],
            [
                'slug'      => 'movies.genre.create',
                'name'      => 'Create Genre',
            ],
            [
                'slug'      => 'movies.genre.edit',
                'name'      => 'Update Genre',
            ],
            [
                'slug'      => 'movies.genre.delete',
                'name'      => 'Delete Genre',
            ],
            /*
            [
                'slug'      => 'movies.genre.verify',
                'name'      => 'Verify Genre',
            ],
            [
                'slug'      => 'movies.genre.approve',
                'name'      => 'Approve Genre',
            ],
            [
                'slug'      => 'movies.genre.publish',
                'name'      => 'Publish Genre',
            ],
            [
                'slug'      => 'movies.genre.unpublish',
                'name'      => 'Unpublish Genre',
            ],
            [
                'slug'      => 'movies.genre.cancel',
                'name'      => 'Cancel Genre',
            ],
            [
                'slug'      => 'movies.genre.archive',
                'name'      => 'Archive Genre',
            ],
            */
        ]);

        DB::table('menus')->insert([

            [
                'parent_id'   => 1,
                'key'         => null,
                'url'         => 'admin/movies/genre',
                'name'        => 'Genre',
                'description' => null,
                'icon'        => 'fa fa-newspaper-o',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

            [
                'parent_id'   => 2,
                'key'         => null,
                'url'         => 'user/movies/genre',
                'name'        => 'Genre',
                'description' => null,
                'icon'        => 'icon-book-open',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

            [
                'parent_id'   => 3,
                'key'         => null,
                'url'         => 'genre',
                'name'        => 'Genre',
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
                'key'      => 'movies.genre.key',
                'name'     => 'Some name',
                'value'    => 'Some value',
                'type'     => 'Default',
            ],
            */
        ]);
    }
}
