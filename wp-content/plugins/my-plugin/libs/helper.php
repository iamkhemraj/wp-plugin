<?php

function register_post_types($cpt_data) // Register Custom post type
{
    if ($cpt_data) {
        foreach ($cpt_data as $cpt) {
            if ($cpt->is_activate == true) { // Check if status is active
                $post_type = $cpt->post_type;
                $slug      = $cpt->slug;
                register_post_type($slug , array(  // Register custom post type
                    'labels' => array(
                        'name'         => $post_type,          
                        'singular_name'=> $post_type
                    ),
                    'public'     => true,
                    'has_archive'=> true,
                    'rewrite'    => array(
                    'slug'       =>  $slug ),
                    'taxonomies' => array('category', 'post_tag')
                ));
            }
        }
    }
}

