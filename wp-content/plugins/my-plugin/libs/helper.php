<?php
class CustomPostTypeRegistration {
    public function __construct() {
        add_action('init', array($this, 'register_custom_post_type'));
    }

    public function register_custom_post_type() {
        $post_type = $category = $tag = '';

        // Retrieve the serialized form data
        $post_type = isset($_POST["post"]) ? $_POST["post"] : '';
        $category  = isset($_POST["catname"]) ? $_POST["catname"] : '';
        $tag       = isset($_POST["tagname"]) ? $_POST["tagname"] : '';

        if (!empty($post_type) && !empty($category) && !empty($tag)) { 
            add_action('init', array($this, 'create_post_type'));
        }
    }

    public function create_post_type() {
        register_post_type('talent',
            array(
                'labels' => array(
                    'name' => __('Talent'),
                    'singular_name' => __('Talent')
                ),
                'public' => true,
                'has_archive' => true
            )
        );
    }
}

// Instantiate the class to trigger registration
new CustomPostTypeRegistration();


?>
