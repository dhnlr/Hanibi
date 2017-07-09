<?php
/**
 * Created by PhpStorm.
 * User: theliberty
 * Date: 06/07/2017
 * Time: 9:12
 */
ob_start();
define('TITLE', 'Edit Post');
include "include/header.html";
//Menampilkan post untuk borang
if (isset($_GET['edit'])){
    if (isset($_SESSION['user_role'])) {
        $post_id = mysqli_escape_string($dbc, $_GET['edit']);
        $query = "SELECT * FROM post WHERE post_id={$post_id}";
        if ($result = mysqli_query($dbc, $query)) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $post_title = $row['post_title'];
                $post_category = $row['post_category_id'];
                $post_author = $row['post_author'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_resume = $row['post_resume'];
                $post_tags = $row['post_tags'];
                $post_status = $row['post_status'];
            }
        }
    }
}
//Mengubah post
if (isset($_POST['edit_post'])){
    $post_id = $_POST['post_id'];
    $post_title = mysqli_escape_string($dbc, strip_tags($_POST['post_title']));
    $post_category = $_POST['post_category'];
    $post_author = mysqli_escape_string($dbc, strip_tags($_POST['post_author']));
    $post_image = $_FILES['post_image']['name'];
    $post_image_tmp = $_FILES['post_image']['tmp_name'];
    $post_content = mysqli_escape_string($dbc, $_POST['post_content']);
    $post_resume = mysqli_escape_string($dbc, strip_tags(substr($_POST['post_resume'],0,160)));
    $post_tags = mysqli_escape_string($dbc, strip_tags($_POST['post_tags']));
    $post_status = mysqli_escape_string($dbc, strip_tags($_POST['post_status']));
    if (empty($post_resume)){
        $post_resume = strip_tags(substr($post_content,0,160));
    }
    move_uploaded_file("$post_image_tmp","../images/{$post_image}");
    if (empty($post_image_tmp)){
        $query = "SELECT post_image FROM post WHERE post_id='{$post_id}'";
        if ($result = mysqli_query($dbc, $query)){
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $post_image = $row['post_image'];
            }
        }
    }
    $query = "UPDATE post SET post_title='{$post_title}', post_category_id='{$post_category}', post_author='{$post_author}', post_image='{$post_image}', post_content='{$post_content}', post_resume='{$post_resume}' , post_tags='{$post_tags}', post_status='{$post_status}' WHERE post_id='{$post_id}'";
    if ($result = mysqli_query($dbc, $query)){
        header("Location:../admin/post.php");
    }
}
print "<!-- Main content -->
    <section class='content'>
    <form role='form' action='' method='post' enctype='multipart/form-data'>
              <input type='hidden' name='post_id' value='{$post_id}'>
                <div class='form-group'>
                  <label>Title</label>
                  <input type='text' class='form-control' name='post_title' value='{$post_title}' required>
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
                        print "<option value='{$cat_id}'";
                        if ($post_category == $cat_id){
                            print "selected";
                        }
                        print ">{$cat_title}</option>";
                    }
                }
                print "
                  </select>
                </div>
                <div class='form-group'>
                  <label>Author</label>
                  <input type='text' class='form-control' name='post_author' value='{$post_author}' readonly required>
                </div>
                <div class='form-group'>
                  <label>Image</label>
                  <p><img class='img-responsive' src='../images/{$post_image}' alt=''></p>
                  <input type='hidden' name='MAX_FILE_SIZE' value='200000'>
                  <input type='file' name='post_image'>
                  <p class='help-block'>Upload image</p>
                </div>
                <div class='form-group'>
                  <label>Content</label>
                  <script src='https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js'></script>
                  <textarea id='editor1' class='form-control' name='post_content' rows='3' required>{$post_content}</textarea>
                  <script>
                    CKEDITOR.replace( 'editor1' );
                  </script>
                </div>
                <div class='form-group'>
                  <label>Resume</label>
                  <textarea class='form-control' name='post_resume' rows='3' placeholder='Resume of your content (max. 160 characters)'>{$post_resume}</textarea>
                </div>
                <div class='form-group'>
                  <label>Tags</label>
                  <input type='text' class='form-control' name='post_tags' value='{$post_tags}' required>
                </div>
                <div class='form-group'>
                    <label>Status:</label>
                  <div class='checkbox'>
                    <label>
                      <input type='checkbox' name='post_status' value='published'";
                        if ($post_status == 'published'){
                            print "checked";
                        }
                        print">
                      Publish
                    </label>
                  </div>
                </div>
                <div class='form-group'><span class='input-group-btn'>
                <button class='btn btn-success' type='submit' name='edit_post'>Edit</button>
                </div>
              </form>
              
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->";
include "include/footer.html";