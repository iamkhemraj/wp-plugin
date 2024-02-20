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
                
                $rewrite_slug = array(
                    'slug' => $slug,
                    'with_front' => false // This line removes the taxonomy slug from the URL
                );
                
                register_post_type($slug, array(  // Register custom post type
                    'labels'        => array(
                        'name'          => $post_type,
                        'singular_name' => $post_type
                    ),
                    'public'      => true,
                    'has_archive' => true,
                    'rewrite'     => $rewrite_slug,
                    'taxonomies'  => array('category','post_tag') // Use the new taxonomy name here
                ));

                if (isset($category_data) && !empty($category_data)) {  // Insert category       
                    $term = wp_insert_term($category_data, 'new_taxonomy_name', array('term_id' => $term_id));   
                }
                
                if (isset($tag_data) && !empty($tag_data)) { // Insert tags
                    $term = wp_insert_term($tag_data, 'new_taxonomy_name', array('term_id' => $term_id));     
                }
            }
        }
    }
}
?>
