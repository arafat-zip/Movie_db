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
            'label' => 'Genres',
            'public' => true,
            'labels' => [
                'name' => 'Genres',
                'singular_name' => 'Genre',
                'add_new_item' => 'Add New Genre',
                'edit_item' => 'Edit Genre',
                'new_item' => 'New Genre',
                'view_item' => 'View Genre',
                'search_items' => 'Search Genres',
                'not_found' => 'No Genres Found',
                'not_found_in_trash' => 'No Genres Found in Trash',
                'menu_name' => 'Genres',
            ]
        ];
        register_taxonomy( 'genre', 'movie', $args );
    }
}