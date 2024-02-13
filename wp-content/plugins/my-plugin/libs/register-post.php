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

?>