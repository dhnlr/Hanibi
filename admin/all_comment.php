<?php
/**
 * Created by PhpStorm.
 * User: theliberty
 * Date: 01/07/2017
 * Time: 15:19
 */
ob_start();
define('TITLE', 'Discussion List');
include "include/header.html";
print "<!-- Main content -->
    <section class='content'>
        <div class='box-body no-padding'>
              <table class='table table-striped'>
                <tr>
                  <th style='width: 10px'>#</th>
                  <th>Subject</th>
                  <th>Email</th>
                  <th>Article</th>
                  <th>Content</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>";
show_disc();
delete_disc();
approve_disc();
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
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->";
include "include/footer.html";