<?php

class MovieDb_Post_Type {

    public function __construct() {
        add_action( 'init', array( $this, 'register_post_type' ) );
        add_action( 'init', array( $this, 'register_taxonomy' ) );
    }

    public function register_post_type() {
        $args = [
            'label' => 'Movies',
            'public' => true,
            'labels' => [
                'name' => 'Movies',
                'singular_name' => 'Movie',
                'add_new_item' => 'Add New Movie',
                'edit_item' => 'Edit Movie',
                'new_item' => 'New Movie',
                'view_item' => 'View Movie',
                'search_items' => 'Search Movies',
                'not_found' => 'No Movies Found',
                'not_found_in_trash' => 'No Movies Found in Trash',
                'menu_name' => 'Movies',
            ]
        ];

        register_post_type( 'movie', $args );
    }

    public function register_taxonomy() {
        $args = [
            'label' => 'Genre',
            'public' => true,
            'labels' => [
                'name'          => 'Genre',
                'singular_name' => 'Genre',
                'menu_name'          => 'Genre',
            ],
            'hierarchical'           => false
        ];
        register_taxonomy( 'genre', 'movie', $args );


        $args = [
            'label'  => 'actor',
            'public' => true,
            'labels' => [
                'name'          => 'Actors',
                'singular_name' => 'actor',
                'menu_name'     => 'Genre',
            ],
            'hierarchical'      => false
        ];
        register_taxonomy( 'actor', 'movie', $args );

        $args = [
            'label'  => 'Director',
            'public' => true,
            'labels' => [
                'name'          => 'Directors',
                'singular_name' => 'director',
                'menu_name'     => 'director',
            ],
            'hierarchical'           => false
        ];
        register_taxonomy( 'director', 'movie', $args );
    }
}