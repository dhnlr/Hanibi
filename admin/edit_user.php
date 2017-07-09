<?php
/**
 * Created by PhpStorm.
 * User: theliberty
 * Date: 07/07/2017
 * Time: 18:34
 */
ob_start();
define('TITLE', 'Edit User');
include "include/header.html";
//Menampilkan user untuk borang
if (isset($_GET['edit'])){
    if (isset($_SESSION['user_role'])) {
        $user_id = mysqli_escape_string($dbc, $_GET['edit']);
        $query = "SELECT * FROM users WHERE user_id={$user_id}";
        if ($result = mysqli_query($dbc, $query)) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_fullname = $row['user_fullname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];
            }
        }
    }
}
//Mengubah user
if (isset($_user['edit_user'])){
    $user_id = $_user['user_id'];
    $username = mysqli_escape_string($dbc, strip_tags($_user['username']));
    $user_fullname = mysqli_escape_string($dbc, strip_tags($_user['user_fullname']));
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_email = mysqli_escape_string($dbc, $_user['user_email']);
    $user_role = mysqli_escape_string($dbc, strip_tags($_user['user_role']));
    move_uploaded_file("$user_image_tmp","../images/user/{$user_image}");
    if (empty($user_image_tmp)){
        $query = "SELECT user_image FROM users WHERE user_id='{$user_id}'";
        if ($result = mysqli_query($dbc, $query)){
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $user_image = $row['user_image'];
            }
        }
    }
    $query = "UPDATE users SET user_title='{$user_title}', username='{$username}', user_fullname='{$user_fullname}', user_image='{$user_image}', user_role='{$user_role}' WHERE user_id='{$user_id}'";
    if ($result = mysqli_query($dbc, $query)){
        header("Location:../admin/all_user.php");
    }
}
print "<!-- Main content -->
    <section class='content'>
    <form role='form' action='' method='user' enctype='multipart/form-data'>
              <input type='hidden' name='user_id' value='{$user_id}'>
                <div class='form-group'>
                  <label>Username</label>
                  <input type='text' class='form-control' name='username' value='{$username}' required>
                </div>
                <div class='form-group'>
                  <label>Fullname</label>
                  <input type='text' class='form-control' name='user_fullname' value='{$user_fullname}' required>
                </div>
                <div class='form-group'>
                  <label>Image</label>
                  <p><img class='img-responsive' src='../images/user/{$user_image}' alt=''></p>
                  <input type='hidden' name='MAX_FILE_SIZE' value='200000'>
                  <input type='file' name='user_image'>
                  <p class='help-block'>Upload image</p>
                </div>
                <div class='form-group'>
                  <label>Email</label>
                  <input type='email' class='form-control' name='user_email' value='{$user_email}' required>
                </div>
                <div class='form-group'>
                  <label>Role</label>
                  <select class='form-control' name='user_role' required>";
                    $query_role = "SELECT user_role FROM users WHERE user_id='{$user_id}'";
                    if ($result_role = mysqli_query($dbc, $query_role)){
                        $row_role = mysqli_fetch_assoc($result_role);
                        echo "<option value='admin'";if ($row_role['user_role'] == "admin"){ echo "selected";} echo ">Admin</option>";
                        echo "<option value='editor'";if ($row_role['user_role'] == "editor"){ echo "selected";} echo ">Editor</option>";
                    }
                  print "</select>
                </div>                
                <div class='form-group'><span class='input-group-btn'>
                <button class='btn btn-success' type='submit' name='edit_user'>Edit</button>
                </div>
              </form>
              
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->";
include "include/footer.html";