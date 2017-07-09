<?php
/**
 * Created by PhpStorm.
 * User: theliberty
 * Date: 07/07/2017
 * Time: 18:54
 */
ob_start();
define('TITLE', 'Add User');
include "include/header.html";
//Menambahkan user
if (isset($_user['add_user'])){
    if ($_FILES['user_image']['error'] == 0){
        $user_id = $_user['user_id'];
        $username = mysqli_escape_string($dbc, strip_tags($_user['username']));
        $user_fullname = mysqli_escape_string($dbc, strip_tags($_user['user_fullname']));
        $user_image = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];
        $user_email = mysqli_escape_string($dbc, $_user['user_email']);
        $user_role = mysqli_escape_string($dbc, strip_tags($_user['user_role']));
        $query = "INSERT INTO user (username, user_fullname, user_image, user_email, user_role) VALUES ('$username', '$user_fullname', '$user_image', '$user_email', '$user_role')";
        if (move_uploaded_file("$user_image_tmp","../images/{$user_image}")){
            if ($result = mysqli_query($dbc, $query)){
                header("Location:../admin/user.php");
            }
        }
    }
}
print "<!-- Main content -->
    <section class='content'>
              <form role='form' action='add_user.php' method='user' enctype='multipart/form-data'>
                <div class='form-group'>
                  <label>Title</label>
                  <input type='text' class='form-control' name='user_title' required>
                </div>
                <div class='form-group'>
                  <label>Category</label>
                  <select class='form-control' name='user_category' required>";
//Menampilkan kategori
$query = "SELECT * FROM category";
if ($result = mysqli_query($dbc, $query)){
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        print "<option value='{$cat_id}'>{$cat_title}</option>";
    }
}
print "
                  </select>
                </div>
                <div class='form-group'>
                  <label>Author</label>
                  <input type='text' class='form-control' name='user_author' value='theliberty' readonly required>
                </div>
                <div class='form-group'>
                  <label>Image</label>
                  <input type='hidden' name='MAX_FILE_SIZE' value='200000'>
                  <input type='file' name='user_image'>
                  <p class='help-block'>Upload image</p>
                </div>
                <div class='form-group'>
                  <label>Content</label>
                  <script src='https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js'></script>
                  <textarea id='editor1' class='form-control' name='user_content' rows='3' required></textarea>
                  <script>
    CKEDITOR.replace( 'editor1' );
</script>
                </div>
                <div class='form-group'>
                  <label>Tags</label>
                  <input type='text' class='form-control' name='user_tags' required>
                </div>
                <div class='form-group'>
                    <label>Status:</label>
                  <div class='checkbox'>
                    <label>
                      <input type='checkbox' name='user_status' value='published'>
                      Publish
                    </label>
                  </div>
                </div>
                <div class='form-group'><span class='input-group-btn'>
                <button class='btn btn-success' type='submit' name='add_user'>Add</button>
                </div>
              </form>
              
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->";
include "include/footer.html";