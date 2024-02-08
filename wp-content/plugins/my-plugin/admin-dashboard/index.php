<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom post</title>
    <style>
        .form-label {
            font-weight: bold;
            margin-top: 10px;
           
        }
        input[type='text'] {
            width: 50%;
        }
        .error{
            color:red;
        }
    </style>
</head>

<body>

    <div class="container p-4">
        <div class="post-title">
            <h3>Register Post Type</h3>
        </div>
        <form id="form" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="post_type" class="form-label">Post Type:</label>
                        <input type="text" name="post_type" id="post_type" class=" form-control  input-sm" size = "50px" placeholder="Enter post type"  maxlength="20" >
                        <span class="error"> </span> 
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="checkbox" id="category_check">
                        <label for="category_check" class="form-label">Category</label>
                        <input type="text" name="category" id="category" class=" form-control input-sm  input-sm d-none" placeholder="Enter category name" maxlength="20">
                        <br>
                        <input type="checkbox" id="tags_check">
                        <label for="tags_check" class="form-label">Tags</label>
                        <input type="text" name="tags" id="tags" class=" form-control  input-sm d-none" placeholder="Enter tags name">
                    </div>
                </div>
            </div><br>
            <button type="submit" id="create-custom-post" class="btn btn-dark text-white" name="create_post_type">Create
                Post</button>
        </form>
    </div>

</body>

</html>