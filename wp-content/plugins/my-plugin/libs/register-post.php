<?php

    // Register Custom post type
    function register_post_types($cpt_data)
    {
        if ($cpt_data) {
            foreach ($cpt_data as $cpt) {
                $post_type = $cpt->post_type;

                // Register custom post type
                register_post_type($post_type, array(
                    'labels' => array(
                        'name' => $post_type,
                        'singular_name' => $post_type
                    ),
                    'public' => true,
                    'has_archive' => true,
                    'taxonomies' => array('category', 'post_tag')
                )
                );
            }
        }
    }


    
    // Load WordPress environment
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

    // Check if postName is sent via POST request
    if (isset($_POST['postName'])) {
        $postName = $_POST['postName'];

        // Check if the post type exists
        if (post_type_exists($postName)) {
            // Unregister the post type
            unregister_post_type($postName);
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }



?>