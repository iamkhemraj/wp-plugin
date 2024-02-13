<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom post</title>
    <style>
        .post-type-section {
            border: 1px solid #c3c4c7;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .04);
            padding: 20px 0px 20px 20px;
            width: 70%;
        }

        .post-title h1 {
            font-weight: 400;
            font-size: 23px;
        }

        input[type='text'] {
            width: 80%;
        }

        .error {
            color: red;
        }

        #create-custom-post {
            color: #fff !important;
            background-color: #2271b1 !important;
        }

        .get_post_type {
            border: 1px solid #c3c4c7;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .04);
            padding: 20px 0px 20px 20px;
            width: 30%;
            margin-top: 53px;
        }
    </style>
</head>

<body>

    <div class="container p-4">
        <div class="row">
            <div class="col-md-12">
                <div class="post-type-section">
                    <div class="post-title">
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
                <div class="get_post_type">
                    <div class="post-title">
                        <h6>All Post Type</h6>
                    </div>
                    <?php

                    if (isset($_SESSION['get_post_type']) && !empty($_SESSION['get_post_type'])) {
                        $cpt_lists = $_SESSION['get_post_type'];

                        foreach ($cpt_lists as $list) {
                            $cpt_name = !empty($list->post_type) ? $list->post_type : '';

                            // Check if the current post type is 'Book'
                            if ($cpt_name === $cpt_name) {
                                $checked = 'checked';
                            } else {
                                $checked = ''; // Ensure checkbox is unchecked for other post types
                            }
                            ?>
                            <div class="post_type-list">
                                <input type="checkbox" name="cpt-list" id="cpt-list" <?= $checked ?>>
                                <?= $cpt_name ?>
                            </div>
                            <?php
                        }
                    } ?>

                </div>
            </div>

        </div>
    </div>
    <script>
        jQuery(document).ready(function ($) {
            // When the checkbox is clicked
            $('#cpt-list').change(function () {
                var postType = $(this).data('post-type');
                alert(postType);

                // If checkbox is unchecked
                if (!$(this).is(':checked')) {
                    // Display confirmation dialog
                    var confirmDelete = confirm("Are you sure you want to remove post type '" + postType + "'?");
                    if (confirmDelete) {
                        // If confirmed, make AJAX call to unregister the post type
                        var currentPageURL = window.location.href;
                        $.ajax({
                            url: currentPageURL, // Path to your PHP script to handle unregistration
                            type: 'POST',
                            data: { post_type: postType },
                            success: function (response) {
                                alert(response); // Show success message or handle response as needed
                            },
                            error: function (xhr, status, error) {
                                console.error(error); // Log error to console
                            }
                        });
                    } else {
                        // If not confirmed, re-check the checkbox
                        $(this).prop('checked', true);
                    }
                }
            });
        });
    </script>



</body>

</html>