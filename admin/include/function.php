<?php
/**
 * Created by PhpStorm.
 * User: theliberty
 * Date: 01/07/2017
 * Time: 7:53
 */
//Tambah kategori
function add_category(){
    global $dbc;
    if (isset($_POST['title'])) {
        $cat_title = mysqli_escape_string($dbc, strip_tags($_POST['title']));
        $query = "INSERT INTO category (cat_title) VALUES ('$cat_title')";
        if ($result = mysqli_query($dbc, $query)){
            print "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='icon fa fa-check'></i>Category added.
              </div>";
        }
    }
}

//Tampilkan kategori
function show_category(){
    global $dbc;
    global $page_total;
    global $page;
    $query = "SELECT * FROM category";
    $result = mysqli_query($dbc, $query);
    $per_page = 20;
    $item_total = mysqli_num_rows($result);
    $page_total = ceil($item_total / $per_page);
    if (isset($_GET['page'])){
        $page = mysqli_escape_string($dbc, $_GET['page']);
    }
    else {
        $page = "1";
    }
    if ($page == 1){
        $start_page = 0;
    }
    else {
        $start_page = ($page * $per_page)-$per_page;
    }
    $query_page = "SELECT * FROM category ORDER BY cat_id DESC LIMIT {$start_page},{$per_page}";
    if ($result_page = mysqli_query($dbc, $query_page)){
        while ($row = mysqli_fetch_array($result_page, MYSQLI_ASSOC)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            print "<tr>
                  <td>{$cat_id}</td>
                  <td>{$cat_title}</td>
                  <td><a href='categories.php?edit={$cat_id}'><i class='icon fa fa-edit'></i> Edit</a> | 
                      <a href='categories.php?delete={$cat_id}'><i class='icon fa fa-times'></i> Delete</a>
                  </td>                  
                </tr>";
        }
    }
}

//Hapus kategori
function delete_category(){
    global $dbc;
    if (isset($_GET['delete'])){
        if (isset($_SESSION['user_role'])) {
            $cat_id = mysqli_escape_string($dbc, $_GET['delete']);
            $query = "DELETE FROM category WHERE cat_id='{$cat_id}'";
            if ($result = mysqli_query($dbc, $query)) {
                header("Location: ../admin/categories.php");
            }
        }
    }
}

//Ubah kategori
function edit_category(){
    global $dbc;
    if (isset($_GET['edit'])){
        if (isset($_SESSION['user_role'])) {
            $cat_id = mysqli_escape_string($dbc, $_GET['edit']);
            $query = "SELECT * FROM category WHERE cat_id={$_GET['edit']}";
            if ($result = mysqli_query($dbc, $query)) {
                $count = mysqli_num_rows($result);
                if ($count == 1) {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $cat_title = $row['cat_title'];
                        print "<form action='categories.php' method='post'>
                <div class='input-group'>
                    <input type='text' class='form-control' name='edit' value='{$cat_title}' required>
                    <input type='hidden' class='form-control' name='id' value='{$cat_id}'>
                    <span class='input-group-btn'>
                        <button type='submit' class='btn btn-danger'>Edit</button>
                    </span>        
                </div>
            </form>";
                    }
                }
            }
        }
    }
    if (isset($_POST['edit'])){
        $cat_title = mysqli_escape_string($dbc, strip_tags($_POST['edit']));
        $cat_id = $_POST['id'];
        $query = "UPDATE category SET cat_title='{$cat_title}' WHERE cat_id='{$cat_id}'";
        if ($result = mysqli_query($dbc, $query)){
            header("Location: ../admin/categories.php");
        }
    }
}

//Hapus post
function delete_post(){
    global $dbc;
    if (isset($_GET['delete'])){
        if (isset($_SESSION['user_role'])) {
            $post_id = mysqli_escape_string($dbc, $_GET['delete']);
            $query = "DELETE FROM post WHERE post_id='{$post_id}'";
            if ($result = mysqli_query($dbc, $query)) {
                header("Location: ../admin/post.php");
            }
        }
    }
}

//Tampilkan post
function show_post(){
    global $dbc;
    global $page_total;
    global $page;
    $query = "SELECT post_id FROM post";
    $result = mysqli_query($dbc, $query);
    $per_page = 20;
    $item_total = mysqli_num_rows($result);
    $page_total = ceil($item_total / $per_page);
    if (isset($_GET['page'])){
        $page = mysqli_escape_string($dbc, $_GET['page']);
    }
    else {
        $page = "1";
    }
    if ($page == 1){
        $start_page = 0;
    }
    else {
        $start_page = ($page * $per_page)-$per_page;
    }
    $query_page = "SELECT post_id, post_title, post_author, post_status FROM post ORDER BY post_date DESC LIMIT {$start_page},{$per_page}";
    if ($result_page = mysqli_query($dbc, $query_page)){
        while ($row = mysqli_fetch_array($result_page, MYSQLI_ASSOC)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_status = $row['post_status'];
            print "<tr>
                  <td>{$post_id}</td>
                  <td>{$post_title}</td>
                  <td>{$post_author}</td>
                  <td>{$post_status}</td>
                  <td><a href='edit_post.php?edit={$post_id}'><i class='icon fa fa-edit'></i> Edit</a> | 
                      <a href='post.php?delete={$post_id}'><i class='icon fa fa-times'></i> Delete</a>
                  </td>                  
                </tr>";
        }
    }
}

//Tampilkan diskusi
function show_disc(){
    global $dbc;
    global $page_total;
    global $page;
    $query = "SELECT disc_id, disc_post_id, disc_subject, disc_email, disc_content ,disc_status FROM discuss ORDER BY disc_date DESC ";
    $result = mysqli_query($dbc, $query);
    $per_page = 20;
    $item_total = mysqli_num_rows($result);
    $page_total = ceil($item_total / $per_page);
    if (isset($_GET['page'])){
        $page = mysqli_escape_string($dbc, $_GET['page']);
    }
    else {
        $page = "1";
    }
    if ($page == 1){
        $start_page = 0;
    }
    else {
        $start_page = ($page * $per_page)-$per_page;
    }
    $query_page = "SELECT disc_id, disc_post_id, disc_subject, disc_email, disc_content ,disc_status FROM discuss ORDER BY disc_date DESC LIMIT {$start_page},{$per_page}";
    if ($result_page = mysqli_query($dbc, $query_page)){
        while ($row = mysqli_fetch_array($result_page, MYSQLI_ASSOC)){
            $disc_id = $row['disc_id'];
            $disc_post_id = $row['disc_post_id'];
            $disc_subject = $row['disc_subject'];
            $disc_email = $row['disc_email'];
            $disc_content = substr($row['disc_content'], 0, 50);
            $disc_status = $row['disc_status'];
            $query_id = "SELECT post_title FROM post WHERE post_id='{$disc_post_id}'";
            if ($result_id = mysqli_query($dbc, $query_id)){
                $row_id = mysqli_fetch_array($result_id, MYSQLI_ASSOC);
                $disc_post = $row_id['post_title'];
            }
            print "<tr>
                  <td>{$disc_id}</td>
                  <td>{$disc_subject}</td>
                  <td>{$disc_email}</td>
                  <td>{$disc_post}</td>
                  <td>{$disc_content}...</td>
                  <td>{$disc_status}</td>
                  <td><a href='all_comment.php?approve={$disc_id}'><i class='icon fa fa-check-square-o'></i> Approve</a> |
                      <a href='all_comment.php?delete={$disc_id}'><i class='icon fa fa-times'></i> Delete</a>
                  </td>                  
            </tr>";
        }
    }
}

//Terima diskusi
function approve_disc(){
    global $dbc;
    if (isset($_GET['approve'])){
        if (isset($_SESSION['user_role'])) {
            $disc_id = mysqli_escape_string($dbc, $_GET['approve']);
            $query = "UPDATE discuss SET disc_status='1' WHERE disc_id='{$disc_id}'";
            if ($result = mysqli_query($dbc, $query)) {
                header("Location: ../admin/all_comment.php");
            }
        }
    }
}

//Hapus disc
function delete_disc(){
    global $dbc;
    if (isset($_GET['delete'])){
        if (isset($_SESSION['user_role'])) {
            $disc_id = mysqli_escape_string($dbc, $_GET['delete']);
            $query = "DELETE FROM discuss WHERE disc_id='{$disc_id}'";
            if ($result = mysqli_query($dbc, $query)) {
                header("Location: ../admin/all_comment.php");
            }
        }
    }
}

//Tampilkan user
function show_user(){
    global $dbc;
    global $page;
    global $page_total;
    $query = "SELECT user_id, username, user_fullname, user_role FROM users ORDER BY user_id ASC ";
    $result = mysqli_query($dbc, $query);
    $per_page = 20;
    $item_total = mysqli_num_rows($result);
    $page_total = ceil($item_total / $per_page);
    if (isset($_GET['page'])){
        $page = mysqli_escape_string($dbc, $_GET['page']);
    }
    else {
        $page = "1";
    }
    if ($page == 1){
        $start_page = 0;
    }
    else {
        $start_page = ($page * $per_page)-$per_page;
    }
    $query_page = "SELECT user_id, username, user_fullname, user_role FROM users ORDER BY user_id ASC LIMIT {$start_page},{$per_page}";
    if ($result_page = mysqli_query($dbc, $query_page)){
        while ($row = mysqli_fetch_array($result_page, MYSQLI_ASSOC)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_fullname = $row['user_fullname'];
            $user_role = $row['user_role'];
            print "<tr>
                  <td>{$user_id}</td>
                  <td>{$username}</td>
                  <td>{$user_fullname}</td>
                  <td>{$user_role}</td>
                  <td><a href='edit_user.php?edit={$user_id}'><i class='icon fa fa-edit'></i> Edit</a> | 
                      <a href='user.php?delete={$user_id}'><i class='icon fa fa-times'></i> Delete</a>
                  </td>                  
                </tr>";
        }
    }
}

//Hapus user
function delete_user(){
    global $dbc;
    if (isset($_GET['delete'])){
        if (isset($_SESSION['user_role'])) {
            $user_id = mysqli_escape_string($dbc, $_GET['delete']);
            $query = "DELETE FROM users WHERE user_id='{$user_id}'";
            if ($result = mysqli_query($dbc, $query)) {
                header("Location: ../admin/all_user.php");
            }
        }
    }
}

function counting($type){
    global $dbc;
    switch ($type){
        case "post":
            $query = "SELECT post_id FROM post";
            $result = mysqli_query($dbc, $query);
            $count = mysqli_num_rows($result);
            echo "$count";
            break;
        case "draft":
            $query = "SELECT post_id FROM post WHERE post_status='draft'";
            $result = mysqli_query($dbc, $query);
            $count = mysqli_num_rows($result);
            echo "$count";
            break;
        case "category":
            $query = "SELECT cat_id FROM category";
            $result = mysqli_query($dbc, $query);
            $count = mysqli_num_rows($result);
            echo "$count";
            break;
        case "user":
            $query = "SELECT user_id FROM users";
            $result = mysqli_query($dbc, $query);
            $count = mysqli_num_rows($result);
            echo "$count";
            break;
        case "comment":
            $query = "SELECT disc_id FROM discuss";
            $result = mysqli_query($dbc, $query);
            $count = mysqli_num_rows($result);
            echo "$count";
            break;
        case "pending":
            $query = "SELECT disc_id FROM discuss WHERE disc_status=0";
            $result = mysqli_query($dbc, $query);
            $count = mysqli_num_rows($result);
            echo "$count";
            break;
    }
}

function active_link(){
    //Cek URL untuk aktivasi href link
    $pageName = basename($_SERVER['PHP_SELF']);
    switch ($pageName){
        case "post.php":
        case "add_post.php":
        case "edit_post.php":
            echo "<li class=''><a href='index.php'><i class='fa fa-dashboard'></i> <span>Dashoard</span></a></li>
                <li class='treeview active'>
                    <a href='#'><i class='fa fa-book'></i> <span>Post</span>
                        <span class='pull-right-container'>
              <i class='fa fa-angle-left pull-right'></i>
            </span>
                    </a>
                    <ul class='treeview-menu'>
                        <li><a href='add_post.php'>Add new post</a></li>
                        <li><a href='post.php'>All post</a></li>
                    </ul>
                </li>
                <li class=''><a href='categories.php'><i class='fa fa-tasks'></i> <span>Categories</span></a></li>
                <li class=''><a href='all_comment.php'><i class='fa fa-comments-o'></i> <span>Discussion</span></a></li>
                <li class=''><a href='all_user.php'><i class='fa fa-user'></i> <span>Users</span></a></li>";
            break;
        case "all_user.php":
        case "profile.php":
        case "edit_user.php":
            echo "<li class=''><a href='index.php'><i class='fa fa-dashboard'></i> <span>Dashoard</span></a></li>
                <li class='treeview'>
                    <a href='#'><i class='fa fa-book'></i> <span>Post</span>
                        <span class='pull-right-container'>
              <i class='fa fa-angle-left pull-right'></i>
            </span>
                    </a>
                    <ul class='treeview-menu'>
                        <li><a href='add_post.php'>Add new post</a></li>
                        <li><a href='post.php'>All post</a></li>
                    </ul>
                </li>
                <li class=''><a href='categories.php'><i class='fa fa-tasks'></i> <span>Categories</span></a></li>
                <li class=''><a href='all_comment.php'><i class='fa fa-comments-o'></i> <span>Discussion</span></a></li>
                <li class='active'><a href='all_user.php'><i class='fa fa-user'></i> <span>Users</span></a></li>";
            break;
        case "all_comment.php":
            echo "<li class=''><a href='index.php'><i class='fa fa-dashboard'></i> <span>Dashoard</span></a></li>
                <li class='treeview'>
                    <a href='#'><i class='fa fa-book'></i> <span>Post</span>
                        <span class='pull-right-container'>
              <i class='fa fa-angle-left pull-right'></i>
            </span>
                    </a>
                    <ul class='treeview-menu'>
                        <li><a href='add_post.php'>Add new post</a></li>
                        <li><a href='post.php'>All post</a></li>
                    </ul>
                </li>
                <li class=''><a href='categories.php'><i class='fa fa-tasks'></i> <span>Categories</span></a></li>
                <li class='active'><a href='all_comment.php'><i class='fa fa-comments-o'></i> <span>Discussion</span></a></li>
                <li class=''><a href='all_user.php'><i class='fa fa-user'></i> <span>Users</span></a></li>";
            break;
        case "categories.php":
            echo "<li class=''><a href='index.php'><i class='fa fa-dashboard'></i> <span>Dashoard</span></a></li>
                <li class='treeview'>
                    <a href='#'><i class='fa fa-book'></i> <span>Post</span>
                        <span class='pull-right-container'>
              <i class='fa fa-angle-left pull-right'></i>
            </span>
                    </a>
                    <ul class='treeview-menu'>
                        <li><a href='add_post.php'>Add new post</a></li>
                        <li><a href='post.php'>All post</a></li>
                    </ul>
                </li>
                <li class='active'><a href='categories.php'><i class='fa fa-tasks'></i> <span>Categories</span></a></li>
                <li class=''><a href='all_comment.php'><i class='fa fa-comments-o'></i> <span>Discussion</span></a></li>
                <li class=''><a href='all_user.php'><i class='fa fa-user'></i> <span>Users</span></a></li>";
            break;
        case "index.php":
            echo "<li class='active'><a href='index.php'><i class='fa fa-dashboard'></i> <span>Dashoard</span></a></li>
                <li class='treeview'>
                    <a href='#'><i class='fa fa-book'></i> <span>Post</span>
                        <span class='pull-right-container'>
              <i class='fa fa-angle-left pull-right'></i>
            </span>
                    </a>
                    <ul class='treeview-menu'>
                        <li><a href='add_post.php'>Add new post</a></li>
                        <li><a href='post.php'>All post</a></li>
                    </ul>
                </li>
                <li class=''><a href='categories.php'><i class='fa fa-tasks'></i> <span>Categories</span></a></li>
                <li class=''><a href='all_comment.php'><i class='fa fa-comments-o'></i> <span>Discussion</span></a></li>
                <li class=''><a href='all_user.php'><i class='fa fa-user'></i> <span>Users</span></a></li>";
            break;
        default:
            echo "<li class=''><a href='index.php'><i class='fa fa-dashboard'></i> <span>Dashoard</span></a></li>
                <li class='treeview'>
                    <a href='#'><i class='fa fa-book'></i> <span>Post</span>
                        <span class='pull-right-container'>
              <i class='fa fa-angle-left pull-right'></i>
            </span>
                    </a>
                    <ul class='treeview-menu'>
                        <li><a href='add_post.php'>Add new post</a></li>
                        <li><a href='post.php'>All post</a></li>
                    </ul>
                </li>
                <li class=''><a href='categories.php'><i class='fa fa-tasks'></i> <span>Categories</span></a></li>
                <li class=''><a href='all_comment.php'><i class='fa fa-comments-o'></i> <span>Discussion</span></a></li>
                <li class=''><a href='all_user.php'><i class='fa fa-user'></i> <span>Users</span></a></li>";
    }
}