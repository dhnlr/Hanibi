<?php
/**
 * Created by PhpStorm.
 * User: theliberty
 * Date: 01/07/2017
 * Time: 6:37
 */
ob_start();
define('TITLE', 'Category List');
include "include/header.html";
print "<!-- Main content -->
    <section class='content'>
    <!-- Add Categories -->
    <div class='row'>
        <div class='col-lg-5 col-md-12'>
            <form action='categories.php' method='post'>
                <div class='input-group'>
                    <input type='text' class='form-control' name='title' placeholder='Category name' required>
                    <span class='input-group-btn'>
                        <button type='submit' class='btn btn-success'>Add</button>
                    </span>        
                </div>
            </form>";
        add_category();
        print "</div>
        <div class='col-lg-7 col-md-12'>
            <div class='box-body no-padding'>
              <table class='table table-striped'>
                <tr>
                  <th style='width: 10px'>#</th>
                  <th>Categories</th>
                  <th>Action</th>                  
                </tr>";
                show_category();
                delete_category();
                edit_category();
print "</table>
<ul class='pagination pagination-sm'>";
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
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->";

include "include/footer.html";
?>