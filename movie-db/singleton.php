<?php
/**
 * Plugin Name: Movie DB
 * Description: Get movie details from Movie DB
 * Version: 1.0
 * Author: Tareq Hasan
 * Author URI: https://tareq.co
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */
class Movie_Db {
    static $instance;
    private function __construct() {
        $this->require_classes();
    }

    public static function get_instance() {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function require_classes() {

        require_once plugin_dir_path( __FILE__ ) . 'includes/registing-post-type.php';

        new MovieDb_Post_Type();
    }
}
Movie_Db::get_instance();