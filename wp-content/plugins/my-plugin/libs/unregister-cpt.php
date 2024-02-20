<?php

    // Load WordPress environment
    require_once $_SERVER["DOCUMENT_ROOT"] . "/wp-load.php";
    if (isset($_POST["deleteCpt"])) {// Delete custom post type Query here
        global $wpdb;
        $del_postID = isset($_POST["deleteCpt"]) ? intval($_POST["deleteCpt"]) : "";
        $table_name = $wpdb->prefix . "cpt";
        $get_cpt    = "SELECT post_type FROM $table_name WHERE id =  $del_postID "; // Get currecnt field
        $cpt_data   = $wpdb->get_results($get_cpt);
        //Post type delete query here
        $wpdb->delete($table_name, ["id" => $del_postID], ["%d"]);
        foreach ($cpt_data as $cpt_field) {
            echo " $cpt_field->post_type Post type deleted successfully.";
        }
        die();
    }

    if (isset($_POST["postID"])) {
        global $wpdb, $table_prefix;
        $table_name = $table_prefix . "cpt";
        $postID     = $_POST["postID"];
        $get_cpt    = "SELECT * FROM $table_name WHERE id =  $postID "; // Get currecnt field
        $cpt_data   = $wpdb->get_results($get_cpt);

        foreach ($cpt_data as $cpt_field) {
            // Check is activate field is active or not
            $is_activate = $cpt_field->is_activate == true ? "0" : "1";
            if ($is_activate == "0") {
                echo "Unregister post type " . $cpt_field->post_type;
            } else {
                echo "Register post type " . $cpt_field->post_type;
            }

            $update_db = $wpdb->query(
                "UPDATE $table_name SET is_activate = '$is_activate'  WHERE id=$postID"
            );
        }
    } else {
        echo "no post type found ! ";
    }

?>
