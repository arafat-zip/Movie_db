<?php

class MovieDb_Post_Type {

    public function __construct() {
        add_action( 'init', array( $this, 'register_post_type' ) );
        add_action( 'init', array( $this, 'register_taxonomy' ) );
        add_filter( 'the_content', [$this, 'add_movie_details'] );
        add_filter( 'the_title', [$this, 'add_movie_titles'] );
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
            ],
            'taxonomies' => [ 'genre', 'actor', 'director', 'year' ],
            'supports' => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
        ];

        register_post_type( 'movie', $args );
    }

    public function register_taxonomy() {
        $args = [
            'label'  => 'Genre',
            'public' => true,
            'labels' => [
                'name'               => 'Genre',
                'singular_name'      => 'Genre',
                'menu_name'          => 'Genre',
            ],
            'hierarchical'           => true
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
            'hierarchical'           => true
        ];
        register_taxonomy( 'director', 'movie', $args );

        $args = [
            'label'  => 'Years',
            'public' => true,
            'labels' => [
                'name'          => 'Years',
                'singular_name' => 'year',
                'menu_name'     => 'year',
            ],
            'hierarchical'           => true
        ];
        register_taxonomy( 'year', 'movie', $args );
    }
    function add_movie_details( $content ) {
        $post = get_post(get_the_ID());
        if ( $post->post_type !== 'movie' ) {
            return $content;
        }

        $genre = get_the_term_list(get_the_id(), 'genre', '', ', ');
        $actor = get_the_term_list(get_the_id(), 'actor', '', ', ');
        $director = get_the_term_list(get_the_id(), 'director', '', ', ');
        $year = get_the_term_list(get_the_id(), 'year', '', ', ');
        $info = "<ul>";
        if ( $genre ) {
            $info .="<li>";
            $info .= "<strong>Genre: </strong>";
            $info .= $genre;
            $info .="</li>";
        }
        if ( $actor ) {
            $info .="<li>";
            $info .= "<strong>Actors: </strong>";
            $info .= $actor;
            $info .="</li>";
        }
        if ( $director ) {
            $info .="<li>";
            $info .= "<strong>Directors: </strong>";
            $info .= $director;
            $info .="</li>";
        }
        $info .= "</ul>";
        $content .= $info;
        return $content;
    }
    function add_movie_titles( $title ) {
        $post = get_post(get_the_ID());
        if ( $post->post_type !== 'movie' ) {
            return $title;
        }
        $year = get_the_term_list( get_the_ID(), 'year', '', ', ', '' );
        if ( $year) {
            $title .= ' (' . $year . ')';
            return $title;
        }
    }
}