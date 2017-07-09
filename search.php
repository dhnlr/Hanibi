<?php
/**
 * Created by PhpStorm.
 * User: theliberty
 * Date: 30/06/2017
 * Time: 14:51
 */
ob_start();
include ('include/header.html');
print "<div class='section text-center'>
            <div class='container'>";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $query = "SELECT * FROM post WHERE post_tags LIKE '%$search%' OR post_title LIKE '%$search%'";
    if ($result = mysqli_query($dbc, $query)) {
        $count = mysqli_num_rows($result);
        if ($count == 0) {
            echo "<div class='section text-center'>
            <div class='container'><h2 class='title'>Data tidak ditemukan</h2></div></div>";
            echo $count;
        }
        else {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $post_title = $row["post_title"];
                $post_id = $row["post_id"];
                $post_author = $row["post_author"];
                $post_date = $row["post_date"];
                $post_image = $row["post_image"];
                $post_status = $row["post_status"];
                $post_content = $row["post_content"];
                if ($post_status == "published") {
                    print "<h2 class='title'><a href='post.php?post_id={$post_id}'>{$post_title}</a></h2>
                        <h5 class='description'><i class='now-ui-icons users_single-02'></i> by <a href='index.php'>{$post_author}</a> <i class='now-ui-icons ui-2_time-alarm'></i> Posted on {$post_date}</h5>
                        <div class='image-container'>
                                <img class='img-responsive' src='images/{$post_image}' alt=''>
                        </div>                        
                        <p>{$post_content}...</p>
                        <a class='btn btn-primary' href='post.php?post_id={$post_id}'>Read More <i class='now-ui-icons arrows-1minimal-right'></i></a>
                        <div class='separator separator-primary'></div>";
                }
            }
        }
    }
}
print "</div></div>";
include "include/footer.html";
?>