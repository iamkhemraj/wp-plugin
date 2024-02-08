<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom cpt</title>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post">
                    <div class="mb-3">
                        <label for="post_type" class="form-label">Post Type:</label>
                        <input type="text" id="post_type" name="post_type" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category:</label>
                        <input type="text" id="category" name="category" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="tag" class="form-label">Tag:</label>
                        <input type="text" id="tag" name="tag" class="form-control">
                    </div>
                    <button type="submit" name="create_post_type" class="btn btn-primary">Create Post Type</button>
                </form>
            </div>
        </div>
    </div>

    <!-- script links cdn  -->

</body>

</html>