<?php

return [

    /**
     * Singlular and plural name of the module
     */
    'name'          => 'Movie',
    'names'         => 'Movies',
    'title'       => [
        'user'  => 'My Movies',
        'admin' => 'Movies',
        'sub'   => [
            'user'  => 'Movies created by me',
            'admin' => 'Movies',
        ],
    ],

    /**
     * Options for select/radio/check.
     */
    'options'       => [
            
    ],

    /**
     * Placeholder for inputs
     */
    'placeholder'   => [
        'id'                         => '',
        'title'                      => '',
    ],

    /**
     * Labels for inputs.
     */
    'label'         => [
        'id'                         => '',
        'title'                      => '',
        'status'                     => 'Status',
        'created_at'                 => 'Created at',
        'updated_at'                 => 'Updated at',
    ],

    /**
     * Tab labels
     */
    'tab'           => [
        'name'  => 'Name',
    ],

    /**
     * Texts  for the module
     */
    'text'          => [
        'preview' => 'Click on the below list for preview',
    ],
];
