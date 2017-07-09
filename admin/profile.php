<?php
/**
 * Created by PhpStorm.
 * User: theliberty
 * Date: 09/07/2017
 * Time: 7:07
 */
ob_start();
define('TITLE', 'Profile Page');
include "include/header.html";
print "<!-- Main content -->
    <section class='content'>

      <div class='row'>
        <div class='col-md-3'>

          <!-- Profile Image -->
          <div class='box box-primary'>
            <div class='box-body box-profile'>
              <img class='profile-user-img img-responsive img-circle' src='../images/user/";echo $_SESSION["user_image"];print"' alt='User profile picture'>

              <h3 class='profile-username text-center'>"; echo $_SESSION['user_fullname'];print"</h3>
              <p class='text-muted text-center'>"; echo $_SESSION['user_email'];print"</p>
<a class='btn btn-primary btn-block' href='../change_password.php?username={$_SESSION["username"]}'>Change Password</a>
            </div>
          </div>
        </div>
        <div class='col-md-9'>
          <div class='post'>
           <table class='table table-striped'>
                <tr>
                  <th style='width: 10px'>#</th>
                  <th>Title</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>";
$query = "SELECT post_id, post_title, post_status FROM post WHERE post_author='{$_SESSION["username"]}' BY post_date DESC ";
if ($result = mysqli_query($dbc, $query)){
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_status = $row['post_status'];
        print "<tr>
                  <td>{$post_id}</td>
                  <td>{$post_title}</td>
                  <td>{$post_status}</td>
                  <td><a href='edit_post.php?edit={$post_id}'><i class='icon fa fa-edit'></i> Edit</a> | 
                      <a href='post.php?delete={$post_id}'><i class='icon fa fa-times'></i> Delete</a>
                  </td>                  
                </tr>";
    }
}
          print "</table></div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>";