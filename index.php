<?php
ob_start();
define('TITLE', 'Hanibi');
include ('include/header.html');
print "<div class='section section-nucleo-icons'>
            <div class='container'>
                <div class='row'>
                    <div class='col-lg-8 coll-md-12'>";
$query = 'SELECT * FROM post';
if ($result = mysqli_query($dbc,$query)){
    $per_page = 5;
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
    $query_page = "SELECT * FROM post ORDER BY post_date DESC LIMIT {$start_page},{$per_page}";
    $result_page = mysqli_query($dbc, $query_page);
    while ($row = mysqli_fetch_array($result_page, MYSQLI_ASSOC)){
        $post_title = $row["post_title"];
        $post_id = $row["post_id"];
        $post_author = $row["post_author"];
        $post_date = $row["post_date"];
        $post_image = $row["post_image"];
        $post_status = $row["post_status"];
        $post_content = substr($row['post_content'], 0, 400);
        $post_comment = $row["post_comment_count"];
        if ($post_status == "published") {
            print "<h2 class='title'><a href='post.php?post_id={$post_id}'>{$post_title}</a></h2>
                        <p class='description'><i class='now-ui-icons users_single-02'></i> by {$post_author} <i class='now-ui-icons ui-2_time-alarm'></i> Posted on {$post_date} <i class='now-ui-icons education_paper'></i> {$post_comment} discussion</p>
                        <div class='image-container'>
                                <img class='img-responsive' src='images/{$post_image}' alt='' style='max-height:500px;'>
                        </div>                        
                        <p>{$post_content}</p>
                        <a class='btn btn-primary' href='post.php?post_id={$post_id}'>Read More <i class='now-ui-icons arrows-1minimal-right'></i></a>
                        <div class='separator separator-primary'></div>";
        }
    }
}
print "<div class='container justify-content-center text-center'>
    <ul class='pagination pagination-primary'>";
    for ($i=1; $i<=$page_total; $i++) {
        if ($i == $page){
            print "<li class='page-item active'><a class='page-link' href='?page={$i}'>{$i}</a></li>";
        }
        else {
            print "<li class='page-item'><a class='page-link' href='?page={$i}'>{$i}</a></li>";
        }
    }
print "</ul>
</div>
</div>
                    <div class='col-lg-4 coll-md-12'>";
include 'include/sidebar.html';
print "</div>
                </div>
            </div>
            </div>";
include ('include/footer.html');
?>