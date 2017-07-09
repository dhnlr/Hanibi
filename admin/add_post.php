<?php
/**
 * Created by PhpStorm.
 * User: theliberty
 * Date: 01/07/2017
 * Time: 13:13
 */
ob_start();
define('TITLE', 'Add Post');
include "include/header.html";
//Menambahkan post
if (isset($_POST['add_post'])){
    if ($_FILES['post_image']['error'] == 0){
        $post_title = mysqli_escape_string($dbc, strip_tags($_POST['post_title']));
        $post_category = $_POST['post_category'];
        $post_author = mysqli_escape_string($dbc, strip_tags($_POST['post_author']));
        $post_image = $_FILES['post_image']['name'];
        $post_image_tmp = $_FILES['post_image']['tmp_name'];
        $post_content = mysqli_escape_string($dbc, $_POST['post_content']);
        $post_resume = mysqli_escape_string($dbc, substr($_POST['post_resume'],0,160));
        $post_tags = mysqli_escape_string($dbc, strip_tags($_POST['post_tags']));
        $post_status = mysqli_escape_string($dbc, strip_tags($_POST['post_status']));
        if (empty($post_resume)){
            $post_resume = substr($post_content,0,160);
        }
        $query = "INSERT INTO post (post_title, post_category_id, post_author, post_image, post_content, post_resume, post_tags, post_status) VALUES ('$post_title', '$post_category', '$post_author', '$post_image', '$post_content', '$post_tags', '$post_status')";
        if (move_uploaded_file("$post_image_tmp","../images/{$post_image}")){
            if ($result = mysqli_query($dbc, $query)){
                header("Location:../admin/post.php");
            }
        }
    }
}
print "<!-- Main content -->
    <section class='content'>
              <form role='form' action='add_post.php' method='post' enctype='multipart/form-data'>
                <div class='form-group'>
                  <label>Title</label>
                  <input type='text' class='form-control' name='post_title' required>
                </div>
                <div class='form-group'>
                  <label>Category</label>
                  <select class='form-control' name='post_category' required>";
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
                  <input type='text' class='form-control' name='post_author' value='{$_SESSION["username"]}' readonly required>
                </div>
                <div class='form-group'>
                  <label>Image</label>
                  <input type='hidden' name='MAX_FILE_SIZE' value='200000'>
                  <input type='file' name='post_image'>
                  <p class='help-block'>Upload image</p>
                </div>
                <div class='form-group'>
                  <label>Content</label>
                  <script src='https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js'></script>
                  <textarea id='editor1' class='form-control' name='post_content' rows='3' required></textarea>
                  <script>
                    CKEDITOR.replace( 'editor1' );
                  </script>
                </div>
                <div class='form-group'>
                  <label>Resume</label>
                  <textarea class='form-control' name='post_resume' rows='3' placeholder='Resume of your content (max. 160 characters)'></textarea>
                </div>
                <div class='form-group'>
                  <label>Tags</label>
                  <input type='text' class='form-control' name='post_tags' required>
                </div>
                <div class='form-group'>
                    <label>Status:</label>
                  <div class='checkbox'>
                    <label>
                      <input type='checkbox' name='post_status' value='published'>
                      Publish
                    </label>
                  </div>
                </div>
                <div class='form-group'><span class='input-group-btn'>
                <button class='btn btn-success' type='submit' name='add_post'>Add</button>
                </div>
              </form>
              
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->";
include "include/footer.html";