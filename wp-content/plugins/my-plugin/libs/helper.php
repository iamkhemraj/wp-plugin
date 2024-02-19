<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function register_post_types($cpt_data) // Register Custom post type
{
    if (isset($cpt_data)) {
        foreach ($cpt_data as $cpt) {
            if ($cpt->is_activate == true) { // Check if status is active
                $post_type     = $cpt->post_type;
                $slug          = $cpt->slug;
                $tag_data      = $cpt->tag;
                $term_id       = $cpt->id;
                $category_data = $cpt->category;
                
                register_post_type($slug, array(  // Register custom post type
                    'labels' => array(
                        'name'          => $post_type,
                        'singular_name' => $post_type
                    ),
                    'public'      => true,
                    'has_archive' => true,
                    'rewrite'     => array(
                        'slug'    =>  $slug
                    ),
                    'taxonomies'  => array('category', 'post_tag')
                ));

                if (isset($category_data) && !empty($category_data)) {         
                    $term = wp_insert_term($category_data, 'category', array('term_id' => $term_id));   
                }
                
                if (isset($tag_data) && !empty($tag_data)) {
                    $term = wp_insert_term($tag_data, 'post_tag', array('term_id' => $term_id));     
                }
            }
        }
    }
}
?>
