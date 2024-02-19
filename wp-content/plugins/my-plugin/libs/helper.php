<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function register_post_types($cpt_data) // Register Custom post type
{
    if (isset($cpt_data)) {
        foreach ($cpt_data as $cpt) {
            if ($cpt->is_activate == true) { // Check if status is active
                $post_type = $cpt->post_type;
                $slug      = $cpt->slug;
                $category  = $cpt->category;
                $tag  = $cpt->tag;
                register_post_type($slug, array(  // Register custom post type
                    'labels' => array(
                        'name'         => $post_type,
                        'singular_name'=> $post_type
                    ),
                    'public'     => true,
                    'has_archive'=> true,
                    'rewrite'    => array(
                        'slug'       =>  $slug
                    ),
                    'taxonomies' => array('category', 'post_tag')
                ));

                if (function_exists('register_taxonomy_cpt') ||function_exists('register_taxonomy_tag')) {
                    register_taxonomy_cpt($category);
                    register_taxonomy_tag($tag);
                }
    
            }
        }
    }
}
add_action('init', 'register_taxonomy_cpt');
function register_taxonomy_cpt($category )
{
    if (isset($category) && !empty($category) ) { // insert categories 
        $term = wp_insert_term($category, 'category');
    }
}
add_action('init', 'register_taxonomy_tag');
function register_taxonomy_tag($tag)
{
    if (isset($tag) && !empty($tag) ) { // insert tags
        $term = wp_insert_term($tag, 'post_tag');
    }
}
?>
