<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo esc_html(get_bloginfo('title')); ?></title>
</head>

<body>
    <!-- Registration and gets custom post here  -->
    <div class="container p-4">
        <div class="register__form">
            <div class="row">
                <div class="col-md-12">
                    <div class="register__form__section">
                        <div class="post_title">
                            <h1><?php esc_html_e('Register Post Type'); ?></h1>
                        </div>
                        <form id="form" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="post_type" class="form-label"><?php esc_html_e('Post Type:'); ?></label>
                                        <input type="text" name="post_type" id="post_type" class="form-control input-sm" size="50px" placeholder="<?php esc_attr_e('Enter post type'); ?>" maxlength="20" value="<?= isset($_POST['post_type']) ? esc_attr($_POST['post_type']) : ''; ?>">
                                        <span class="error">
                                            <?= !empty($_SESSION['post_type_err']) ? esc_html($_SESSION['post_type_err']) : ''; ?>
                                            <?= !empty($_SESSION['cpt_exists']) ? esc_html($_SESSION['cpt_exists']) : ''; ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <?= !empty($_SESSION['ctg_tag_err']) ? '<span class="error">' . esc_html($_SESSION['ctg_tag_err']) . '</span>' : ''; ?>
                                    <div class="form-group">
                                        <input type="checkbox" id="category_check" name="category_check">
                                        <label for="category_check" class="form-label"><?php esc_html_e('Category'); ?></label>
                                        <input type="text" name="category" id="category" class="form-control input-sm d-none" placeholder="<?php esc_attr_e('Enter category name'); ?>" maxlength="20" value="<?= isset($_POST['category']) ? esc_attr($_POST['category']) : ''; ?>">
                                        <span class="error d-block">
                                            <?= !empty($_SESSION['category_err']) ? esc_html($_SESSION['category_err']) : ''; ?>
                                        </span>
                                        <input type="checkbox" id="tags_check" name="tags_check">
                                        <label for="tags_check" class="form-label"><?php esc_html_e('Tags'); ?></label>
                                        <input type="text" name="tags" id="tags" class="form-control input-sm d-none" placeholder="<?php esc_attr_e('Enter tags name'); ?>" value="<?= isset($_POST['tags']) ? esc_attr($_POST['tags']) : ''; ?>">
                                        <span class="error d-block">
                                            <?= !empty($_SESSION['tag_err']) ? esc_html($_SESSION['tag_err']) : ''; ?>
                                        </span>
                                    </div>
                                </div>
                            </div><br>
                            <button type="submit" id="create-custom-post" class="btn" name="create_post_type"><?php esc_html_e('Create post'); ?></button>
                            <?= isset($_SESSION['dataInsert']) ? '<span class="alert">' . esc_html($_SESSION["dataInsert"]) . '</span>' : ''; ?>
                        </form>
                    </div>
                </div>
                <div class="col-md-12">  <?php
                    // Show all custom post type 
                    if (isset($_SESSION['get_post_type']) && !empty($_SESSION['get_post_type'])) { ?>
                        <div class="get_post_type">
                            <div class="post-title">
                                <span class="alert text-success" id="alert"></span>
                                <h6><?php esc_html_e('All Post Type'); ?></h6>
                            </div>
                            <div class="post_type-list d-inline">
                                <table class="table-bordered" cellpadding="10px">
                                    <thead>
                                        <tr>
                                            <th scope="col"><?php esc_html_e('Post Type'); ?></th>
                                            <th scope="col"><?php esc_html_e('Actions'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody> <?php
                                        $cpt_lists = $_SESSION['get_post_type'];
                                        foreach ($cpt_lists as $list) {
                                            $cpt_name = !empty($list->post_type) ? esc_html($list->post_type) : '';
                                            $cpt_ID = !empty($list->id) ? esc_attr($list->id) : '';
                                            $checked = ($list->is_activate == true) ? 'checked' : ''; ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="cpt-list" class="cpt-list" value="<?= $cpt_ID ?>" <?= $checked ?>> <?= $cpt_name ?>
                                                </td>
                                                <td>
                                                    <form class="deleteForm" method="POST" action="">
                                                        <input type="hidden" name="del" class="delete_cpt" value="<?= $cpt_ID ?>">
                                                        <a href="#" class="deleteButton btn text-white " style="background-color:#2271b1;"><?php esc_html_e('delete'); ?></a>
                                                    </form>
                                                </td>
                                            </tr> <?php
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>  <?php
                    } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    jQuery(document).ready(function($) {
        // Event delegation for checkbox change
        $('.get_post_type').on('change', '.cpt-list', function() {
            const postID = $(this).val().trim();
            const path = '<?php echo esc_url(plugin_dir_url(__DIR__) . '/libs/unregister-cpt.php'); ?>';
            $.ajax({
                url: path,
                type: 'POST',
                data: {
                    postID: postID
                },
                success: function(response) {
                    alert(response);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
            });
        });

        // Event delegation for delete button click
        $('.get_post_type').on('click', '.deleteButton', function(event) {
            event.preventDefault();
            const deleteCpt = $(this).prev('.delete_cpt').val();
            const path = '<?php echo esc_url(plugin_dir_url(__DIR__) . '/libs/unregister-cpt.php'); ?>';
            if (confirm("<?php esc_html_e('Do you want to delete this post type?'); ?>")) {
                $.ajax({
                    url: path,
                    type: 'post',
                    data: {
                        deleteCpt: deleteCpt
                    },
                    success: function(response) {
                        alert(response);
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                });
            }
        });
    });
</script>
