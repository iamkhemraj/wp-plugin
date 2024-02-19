<?php
if (!defined('ABSPATH')) {
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
    <!-- Registration and gets custom post here  -->
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
                                        <input type="text" name="post_type" id="post_type"
                                            class=" form-control  input-sm" size="50px" placeholder="Enter post type"
                                            maxlength="20"
                                            value="<?= isset($_POST['post_type']) ? $_POST['post_type'] : '' ?>">
                                        <span class="error">
                                            <?= !empty($_SESSION['post_type_err']) ? $_SESSION['post_type_err'] : ''; ?>
                                            <?= !empty($_SESSION['cpt_exists']) ? $_SESSION['cpt_exists'] : ''; ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="checkbox" id="category_check" name="category_check">
                                        <label for="category_check" class="form-label">Category</label>
                                        <input type="text" name="category" id="category"
                                            class=" form-control input-sm  input-sm d-none"
                                            placeholder="Enter category name" maxlength="20"
                                            value="<?= isset($_POST['category']) ? $_POST['category'] : '' ?>">
                                        <span class="error d-block">
                                            <?= !empty($_SESSION['category_err']) ? $_SESSION['category_err'] : ''; ?>
                                        </span>
                                        <input type="checkbox" id="tags_check" name="tags_check">
                                        <label for="tags_check" class="form-label">Tags</label>
                                        <input type="text" name="tags" id="tags" class=" form-control  input-sm d-none"
                                            placeholder="Enter tags name"
                                            value="<?= isset($_POST['tags']) ? $_POST['tags'] : '' ?>">
                                        <span class="error d-block">
                                            <?= !empty($_SESSION['tag_err']) ? $_SESSION['tag_err'] : ''; ?>
                                        </span>
                                    </div>
                                </div>
                            </div><br>
                            <button type="submit" id="create-custom-post" class="btn" name="create_post_type">Create
                                post</button>
                            <?= isset($_SESSION['dataInsert']) ? ' <span class="alert " id="alert"> ' . $_SESSION["dataInsert"] . '</span>' : ''; ?>
                        </form>
                    </div>
                </div>
                <div class="col-md-12"> <?php
                    // Show all custom post type 
                    if (isset($_SESSION['get_post_type']) && !empty($_SESSION['get_post_type'])) { ?>
                        <div class="get_post_type">
                            <div class="post-title">
                             <span class="alert text-success" id="alert"></span> 
                                <h6>All Post Type</h6>
                            </div>
                            <div class="post_type-list d-inline">
                                <table class="table-bordered " cellpadding="10px">
                                    <thead>
                                        <tr>
                                            <th scope="col">Post Type</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody> <?php
                                        $cpt_lists = $_SESSION['get_post_type'];
                                        foreach ($cpt_lists as $list) {
                                            $cpt_name = !empty($list->post_type) ? $list->post_type : '';
                                            $cpt_ID = !empty($list->id) ? $list->id : '';
                                            ($list->is_activate == true) ? $checked = 'checked' : $checked = ''; ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="cpt-list" class="cpt-list" value="<?= $cpt_ID ?>" <?= $checked ?>> <?= $cpt_name ?>
                                                </td>
                                                <td>
                                                    <form class="deleteForm" method="POST" action="">
                                                        <input type="hidden" name="del" class="delete_cpt" value="<?= $cpt_ID ?>">
                                                        <button type="button" class="deleteButton btn btn-danger" value="Delete" >delete</button>
                                                    </form>
                                                </td>
                                            </tr><?php 
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> <?php
                    } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    jQuery(document).ready(function($){

        $('.cpt-list').change(function () {
            const postID = $(this).val().trim(); // Get post type value
            const path   = '<?php echo plugin_dir_url(__DIR__) . '/libs/unregister-cpt.php' ?>'; // Get the path to 
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

        $('.deleteButton').click(function(e){ // Delete custom post type Query here
            $deleteCpt =  $(this).prev('.delete_cpt').val();
            const path = '<?php echo plugin_dir_url(__DIR__) . '/libs/unregister-cpt.php' ?>';
            $('.deleteButton').click(function(){
              
                if (confirm("Do you want delete this post type ?")) {
                    $.ajax({
                        url: path,
                        type: 'post',
                        data:{ deleteCpt: $deleteCpt },
                        success : function(response){
                            $('.alert').text(response);
                        }
                    });
                   
                }else{
                    $('.alert').text('Post type does not delete !');
                } 
            }); 
            
        });
    });
    
</script> 