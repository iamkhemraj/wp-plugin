
    <?php
    /**
     * Plugin Name: Custom Cpt
     * Description: This is my custom plugin created for testing purposes.
     * Author: Khemraj
     * Author URI: https://author.com
     * Version: 1.0.0
     */

        // Register post type file
        require_once("libs/register-post.php");
        require_once( __DIR__ . "/functions.php");
        
        // Wp activation hook 
        register_activation_hook( __FILE__, 'wp_plugin_activation' );
        function wp_plugin_activation(){
            global $wpdb, $table_prefix; 
            $table_name = $table_prefix.'cpt'; 

            // Create table
            $sql = "CREATE TABLE IF NOT EXISTS $table_name (
                `id` INT NOT NULL AUTO_INCREMENT,
                `post_type` VARCHAR(34) NOT NULL,
                `category` VARCHAR(34) NOT NULL,
                `tag` VARCHAR(15) NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE = InnoDB";
            $wpdb->query($sql);
        }

        // Register custom post type based on user input
        function create_cpt() {
       
            global $wpdb, $table_prefix; 
        
            $table_name = $table_prefix . 'cpt'; 
            $get_cpt    = "SELECT * FROM $table_name WHERE id != 0";
            $cpt_data   = $wpdb->get_results($get_cpt);
            register_post_types($cpt_data);
            
            // Check if the form is submitted
            $post_typeErr = $categoryErr = $tagErr = $cpt_exist_err = "";
            if(isset($_POST['create_post_type'])) {
              
                $post_type  = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : '';
                $category   = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
                $tag        = isset($_POST['tags']) ? sanitize_text_field($_POST['tags']) : '';
                $get_cpt    = "SELECT post_type FROM $table_name WHERE post_type = $post_type ";
                $cpt_data   = $wpdb->get_results($get_cpt); // check post type esxit or not.
                if( $cpt_data ){
                    session_start(); // sesssion start here
                    $cpt_exist_err          = "The post the post type $post_type has already esxit !";
                    $_SESSION['cpt_esxits'] = $cpt_exist_err;
                   
                }else{
                    // Validate post type
                    if(empty($post_type)) {
                        $post_typeErr = 'Please enter post type!';
                        $_SESSION['error_message'] =   $post_typeErr;
                    }else{
                        if(!preg_match("/^[A-Za-z ]*$/", $_POST["post_type"])){

                            $post_typeErr = 'Only alphabetic characters are allowed!';
                            $_SESSION['error_message'] =   $post_typeErr;
                        }
                    }
            
                    // Validate category
                    if(empty($category)) {
                        $categoryErr = 'Please enter category!';
                        $_SESSION['category_err'] =  $categoryErr ;
                    }else{
                        if(!preg_match("/^[A-Za-z ]*$/", $_POST["category"])){

                            $categoryErr = 'Only alphabetic characters are allowed!';
                            $_SESSION['category_err'] =   $categoryErr;
                        }
                    }
                    
                    // Validate tag
                    if(empty($tag)) {
                        $tagErr = 'Please enter tag!';
                        $_SESSION['tag_err'] = $tagErr;
                    }else{
                        if(!preg_match("/^[A-Za-z ]*$/", $_POST["tags"])){

                            $tagErr = 'Only alphabetic characters are allowed!';
                            $_SESSION['tag_err'] =   $post_typeErr;
                        }
                    }
            
                    // If no errors, insert data into the database
                    if(empty($post_typeErr) && empty($categoryErr) && empty($tagErr)) {
                        $wpdb->insert($table_name, array(
                            'post_type' => $post_type,
                            'category'  => $category,
                            'tag'       => $tag
                        ));
                    }
            
                    // Refresh CPT data after insertion
                    $cpt_data = $wpdb->get_results($get_cpt);
                    register_post_types($cpt_data);
                }
            }
        }
        
        
        add_action('init', 'create_cpt');
        function display_cpt_form() {  // Dispaly cpt form 
            require_once("admin-dashboard/index.php"); // include cpt form
        
        } 
        function plugin_menu_page() {   // Register a custom menu page.
            add_menu_page(
                'Custom Plugin Settings',    // Page title
                'Custom Plugin',             // Menu title
                'manage_options',            // Capability required to access
                'custom-plugin-settings',    // Menu slug
                'display_cpt_form', // Callback function
                'dashicons-admin-generic'    // Icon URL or dashicon name
            );
        }
        add_action('admin_menu', 'plugin_menu_page'); 
        
        
        add_action('init', 'get_cpt'); 
        function get_cpt(){

            echo  "The show data";

        }
    ?>
