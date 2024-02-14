<?php

    // Load WordPress environment
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
    if (isset($_POST['postName'])) {
        $postName = $_POST['postName'];

        // Check if the post type exists
        if (post_type_exists($postName)) {

            unregister_post_type($postName);
            echo  $postName.' post type unregister successfuly!';
        } else {
            echo  $postName.' post type does not unregister!';
        }
    } else {
        echo 'error';
    }



?>