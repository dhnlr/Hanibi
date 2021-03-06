<?php
/**
 * Created by PhpStorm.
 * User: theliberty
 * Date: 07/07/2017
 * Time: 18:21
 */
ob_start();
define('TITLE', 'User List');
include "include/header.html";
if (isset($_SESSION["username"])) {
    if ($_SESSION["user_role"] == "admin") {
        print "<!-- Main content -->
    <section class='content'>
        <div class='box-body no-padding'>
        <a href='../register.php' class='btn btn-success pull-right' type='submit' name='add_user'>Create User</a><br/>
              <table class='table table-striped'>
                <tr>
                  <th style='width: 10px'>#</th>
                  <th>Username</th>
                  <th>Name</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>";
        show_user();
        delete_user();
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
        print "</ul>";
    }
    else {
        print "<h3 class='text-center'>Access denied</h3>";
    }
}
print "</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->";
include "include/footer.html";