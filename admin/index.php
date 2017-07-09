<?php
ob_start();
define('TITLE', 'Dashboard');
include "include/header.html";
print "<!-- Main content -->
    <section class='content'>
      <!-- Info boxes -->
      <div class='row'>
        <div class='col-md-3 col-sm-6 col-xs-12'>
          <div class='info-box'>
            <span class='info-box-icon bg-aqua'><i class='fa fa-book'></i></span>

            <div class='info-box-content'>
              <span class='info-box-text'>Post</span>
              <span class='info-box-number'>"; counting("post"); print"<br><small class='label bg-aqua-gradient'>Draft: "; counting("draft"); print"</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class='col-md-3 col-sm-6 col-xs-12'>
          <div class='info-box'>
            <span class='info-box-icon bg-red'><i class='fa fa-tasks'></i></span>

            <div class='info-box-content'>
              <span class='info-box-text'>Categories</span>
              <span class='info-box-number'>"; counting("category"); print"</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class='clearfix visible-sm-block'></div>

        <div class='col-md-3 col-sm-6 col-xs-12'>
          <div class='info-box'>
            <span class='info-box-icon bg-green'><i class='fa fa-user'></i></span>

            <div class='info-box-content'>
              <span class='info-box-text'>Users</span>
              <span class='info-box-number'>"; counting("user"); print"</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class='col-md-3 col-sm-6 col-xs-12'>
          <div class='info-box'>
            <span class='info-box-icon bg-yellow'><i class='fa fa-comments-o'></i></span>

            <div class='info-box-content'>
              <span class='info-box-text'>Discussion</span>
              <span class='info-box-number'>"; counting("comment"); print"<br><small class='label bg-yellow-gradient'>Pending: "; counting("pending"); print"</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

      <!-- Your Page Content Here -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->";

 include "include/footer.html";
 ?>