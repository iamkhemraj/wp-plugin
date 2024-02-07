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
      <div class="post-title">
        <h3>Create Post Type</h3>
      </div>
      <form id="form">
        <div class="row">
          <div class="col-md-6">
            <div class="group-field">            
              <input type="text " name = "post" placeholder="Enter post type" class="form-control">
              <label for="post">Post Type</label>
               
            </div>  
          </div>
          <div class="col-md-6">
            <div class="group-field">
                <input type="checkbox" name="category" id="category">
                <label for="category">Category</label><br>
                <input type="text" name="catname" id="catname" placeholder ="Enter category name"  class="d-none"><br>
                <input type="checkbox" name="tags" id="tags">
                <label for="tags">Tags</label><br>
                <input type="text" name="tagname" id="tagname" placeholder ="Enter tags name" class="d-none">
              </div>
          </div>
         
        </div><br>
        <input type="button" value="Create post" class="btn bg-dark text-white">
      </form>
  </div>

    <!-- script links cdn  -->
    <script src="<?= plugins_url()?>/my-plugin/admin-dashboard/js/main.js"></script>
</body>
</html>