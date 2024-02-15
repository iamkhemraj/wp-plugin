<?php
    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom post</title>
</head>

<body>

    <div class="container p-4">
        <div class="register__form">
            <div class="row">
                <div class="col-md-12">
                    <div class="register__form__section">
                        <div class="post_title">
                            <h1>Register Post Type</h1>
                        </div>
                        <form id="form" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="post_type" class="form-label">Post Type:</label>
                                        <input type="text" name="post_type" id="post_type" class=" form-control  input-sm"
                                            size="50px" placeholder="Enter post type" maxlength="20">
                                        <span class="error">
                                            <?= !empty($_SESSION['error_message']) ? $_SESSION['error_message'] : ''; ?>
                                            <?= !empty($_SESSION['cpt_exists']) ? $_SESSION['cpt_exists'] : ''; ?>
                                        </span>
    
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="checkbox" id="category_check">
                                        <label for="category_check" class="form-label">Category</label>
                                        <input type="text" name="category" id="category"
                                            class=" form-control input-sm  input-sm d-none"
                                            placeholder="Enter category name" maxlength="20">
                                        <span class="error d-block">
                                            <?php if (!empty($_SESSION['category_err'])) {
                                                echo $_SESSION['category_err'];
                                            } ?>
                                        </span>
    
                                        <input type="checkbox" id="tags_check">
                                        <label for="tags_check" class="form-label">Tags</label>
                                        <input type="text" name="tags" id="tags" class=" form-control  input-sm d-none"
                                            placeholder="Enter tags name">
                                        <span class="error d-block">
                                            <?php if (!empty($_SESSION['tag_err'])) {
                                                echo $_SESSION['tag_err'];
                                            } ?>
                                        </span>
                                    </div>
                                </div>
                            </div><br>
                            <button type="submit" id="create-custom-post" class="btn" name="create_post_type">Create
                                Post</button>
                        </form>
                    </div>
                </div>
    
                <div class="col-md-12">
                    <!-- Show all custom post type -->
                    <?php 
                        if (isset($_SESSION['get_post_type']) && !empty($_SESSION['get_post_type'])) { ?>
                            <div class="get_post_type">
                                <div class="post-title">
                                    <h6>All Post Type</h6>
                                </div>
                                <div class="post_type-list"> <?php
                                    $cpt_lists = $_SESSION['get_post_type'];
                                    foreach ($cpt_lists as $list) {
                                        $cpt_name  = !empty($list->post_type) ? $list->post_type : '';
                                        $cpt_ID  = !empty($list->id) ? $list->id : '';
                                        ($list->is_activate == true) ?  $checked = 'checked' : $checked = '';
                                        echo !empty($cpt_name) ?  "<input type='checkbox' name='cpt-list' class='cpt-list' value='$cpt_ID' $checked> $cpt_name <br>" : '' ;     
                                    } ?> 
                                </div>
                            </div> <?php
                        } 
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
jQuery(document).ready(function($){

    $('.cpt-list').change(function () {
        const postID = $(this).val().trim(); // Get post type value
        const path = '<?php echo plugin_dir_url(__dir__).'/libs/unregister-cpt.php' ?>'; // Get the path to 
        $.ajax({
            url: path,
            type: 'POST',
            data: {postID: postID},
            success: function(response) {
                if (response == true) {
                    alert(response);
                    setTimeout(function() {
                        location.reload();
                    }, 1000); // Reload page after 1 second (1000 milliseconds)
                } else {
                    alert(response);
                    setTimeout(function() {
                        location.reload();
                    }, 1000); // Refresh page after this message
                }
            }
        });
    });
});
</script>

</html>
