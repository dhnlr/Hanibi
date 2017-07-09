<?php
/**
 * Created by PhpStorm.
 * User: theliberty
 * Date: 30/06/2017
 * Time: 14:17
 */
ob_start();
include ('admin/include/db.php');
$query_title = "SELECT post_title, post_resume FROM post WHERE post_id={$_GET['post_id']}";
$result_title = mysqli_query($dbc, $query_title);
$row_title = mysqli_fetch_assoc($result_title);
$post_title = $row_title['post_title'];
$post_resume = $row_title['post_resume'];
define('TITLE', $post_title." - HANIBI");
define('DESCRIPTION', $post_resume);
include ('include/header.html');
//Menambah diskusi
if (isset($_POST['add_disc'])){
    $disc_subject = mysqli_escape_string($dbc, htmlspecialchars($_POST['disc_subject']));
    $disc_email = mysqli_escape_string($dbc, htmlspecialchars($_POST['disc_email']));
    $disc_content = mysqli_escape_string($dbc, nl2br(htmlspecialchars($_POST['disc_content'])));
    $disc_post_id = $_POST['disc_post_id'];
    $query = "INSERT INTO discuss (disc_post_id, disc_subject, disc_email, disc_content) VALUES ('$disc_post_id', '$disc_subject', '$disc_email', '$disc_content')";
    $result = mysqli_query($dbc, $query);
    $query_count = "UPDATE post SET post_comment_count = post_comment_count + 1 WHERE post_id='{$disc_post_id}'";
    $count_disc = mysqli_query($dbc,$query_count);
}
//Menampilkan post
if (isset($_GET['post_id'])){
    $disc_post_id = mysqli_escape_string($dbc, $_GET['post_id']);
    $query = "SELECT * FROM post WHERE post_id ={$_GET['post_id']}";
    if ($result = mysqli_query($dbc, $query)){
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $post_title = $row["post_title"];
        $post_id = $row["post_id"];
        $post_author = $row["post_author"];
        $post_date = $row["post_date"];
        $post_image = $row["post_image"];
        $post_status = $row["post_status"];
        $post_content = $row["post_content"];
        $post_tags = $row["post_tags"];
        print "<div class='section'>
            <div class='container text-center'>
                <h1 class='title'>{$post_title}</h1>
                <p class='description'><i class='now-ui-icons users_single-02'></i> by {$post_author} <i class='now-ui-icons ui-2_time-alarm'></i> Posted on {$post_date}</p>
                        <div class='image-container'>
                                <img class='img-responsive' src='images/{$post_image}' alt=''>
                        </div>
            </div>
                <div class='container'>
                        <p>{$post_content}</p>
                </div></div>";
    }

//Borang diskusi
    print "<div class='section section-contact-us' data-background-color='orange'>
                        <div class='container'>
                        <h5 class='title text-center'>Let's discuss this!</h5>
                        <form action='' method='post'>
                        <div class='row'>
                        <div class='col-lg-7 offset-lg-3 col-md-8 offset-md-2'>
                            <div class='input-group'>
                            <span class='input-group-addon'>
                                <i class='now-ui-icons users_circle-08'></i>
                            </span>
                            <input type='hidden' name='disc_post_id' value='{$disc_post_id}'>
                            <input type='text' name='disc_subject' placeholder='Your name' class='form-control' required>
                            </div>
                            <div class='input-group'>
                            <span class='input-group-addon'>
                                <i class='now-ui-icons ui-1_email-85'></i>
                            </span>
                            <input type='email' name='disc_email' placeholder='Your email' class='form-control' required>
                            </div>
                            <div class='input-group'>
                            <textarea class='form-control' name='disc_content' placeholder='Question, comment, or something to discuss' required></textarea>
                            </div>
                            <div class='send-button'>
                            <button class='btn btn-neutral btn-round btn-block btn-lg' type='submit' name='add_disc'>Discuss</button>
                            </div>
                            </div></div>
                        </form></div></div>
                                                ";
    //Menampilkan diskusi
    $query_disc = "SELECT disc_subject, disc_content, disc_status FROM discuss WHERE (disc_post_id='{$disc_post_id}' AND disc_status='1')ORDER BY disc_date DESC ";
    if ($result_disc = mysqli_query($dbc,$query_disc)){
        if (mysqli_num_rows($result_disc)>0) {
            print "<div class='section section-contact-us'>
                        <div class='container'>
                        <h5 class='title text-center'>Discussion</h5>
                        <div class='row'>
                        <div class='col-lg-9 offset-lg-2 col-md-8 offset-md-2'>";
            while ($row_disc = mysqli_fetch_array($result_disc, MYSQLI_ASSOC)) {
                $disc_subject = $row_disc["disc_subject"];
                $disc_content = $row_disc["disc_content"];
                $disc_status = $row_disc["disc_status"];
                print "<div class='row'>
                        <div class='col-md-1'><i class='now-ui-icons users_circle-08'></i></div> 
                        <div class='col-md-11'><p><strong>{$disc_subject}</strong></p></div>
                        <div class='col-md-1'><i class='now-ui-icons files_paper'></i></div>
                        <div class='col-md-11'><p>{$disc_content}</p></div>
                        </div>                         
                        <div class='separator separator-primary'></div>";
            }
            print "</div></div></div></div>";
        }
    }
}
include "include/footer.html";
