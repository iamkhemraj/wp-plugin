    <?php
    if (!defined('ABSPATH')) {
        exit; // Exit if accessed directly
    }

    function register_post_types($cpt_data) {
        if (isset($cpt_data)) {
            foreach ($cpt_data as $cpt) {
                if ($cpt->is_activate == true) {
                    $post_type = isset($cpt->post_type ) ? $cpt->post_type: '' ;
                    $slug      = isset($cpt->slug ) ? $cpt->slug: '' ;           
                    $tag_data  = isset($cpt->tag ) ? $cpt->tag: '' ;             
                    $term_id   = isset($cpt->id ) ? $cpt->id: '' ;             
                    $category  = isset($cpt->category )? ucwords($cpt->category) : '' ; 
                    $tax_slug  = str_replace(' ', '_', strtolower($category)); // Replace spaces with underscores

                    $rewrite_slug = array(
                        'slug' => $slug,
                        'with_front' => false // This line removes the taxonomy slug from the URL
                    );

                    // Register custom post type
                    register_post_type($slug, array(
                        'labels'        => array(
                            'name'          => $post_type,
                            'singular_name' => $post_type
                        ),
                        'public'      => true,
                        'has_archive' => true,
                        'rewrite'     => $rewrite_slug,
                        'taxonomies'  => array('post_tag') // Use the new taxonomy name here
                    ));

                    // Register custom taxonomy for categories 
                    register_taxonomy( $tax_slug , $slug, array(
                        "hierarchical"      => true,
                        "labels"            => array(
                            "name"          => "Categories",
                            "singular_name" => "Custom Category",
                        ),
                        "rewrite"           => array("slug" => $slug), // Rewrite slug  
                        "public"            => true,
                        "show_ui"           => true,
                        "show_in_rest"      => true,
                        "show_admin_column" => true,
                        "query_var"         => true,
                        "capabilities"      => array(
                            "manage_terms"  => "manage_categories",
                            "edit_terms"    => "edit_categories",
                            "delete_terms"  => "delete_categories",
                            "assign_terms"  => "assign_categories", 
                        ),
                        "show_in_nav_menus" => true,
                    ));

                    if (isset($category) && !empty($category)) {  // Insert category       
                        $term = wp_insert_term($category,   $tax_slug, array('term_id' => $term_id));   
                    }

                    if (isset($tag_data) && !empty($tag_data)) { // Insert tags
                        $term = wp_insert_term($tag_data, 'post_tag', array('term_id' => $term_id));     
                    }
                }
            }
        }
    }
    ?>
