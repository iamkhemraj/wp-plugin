<?php
       
    function register_post_types($cpt_data)    // Register Custom post type
    {
        if ($cpt_data) {
            foreach ($cpt_data as $cpt) {
                $post_type = $cpt->post_type;
                register_post_type($post_type, array(   // Register custom post type
                    'labels' => array(
                        'name'         => $post_type,          
                        'singular_name'=> $post_type
                    ),
                    'public'      => true,
                    'has_archive' => true,
                    'taxonomies'  => array('category', 'post_tag')
                ));
            }
        }
    }
    
