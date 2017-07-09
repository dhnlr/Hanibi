<?php
ob_start();
include "admin/include/db.php";
print "<head>
    <meta charset='utf-8' />
    <link rel='apple-touch-icon' sizes='76x76' href='../CMS/assets/img/apple-icon.png'>
    <link rel='icon' type='image/png' href='../CMS/assets/img/favicon.png'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
    <title>Register - Hanibi</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700,200' rel='stylesheet' />
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' />
    <!-- CSS Files -->
    <link href='../CMS/assets/css/bootstrap.min.css' rel='stylesheet' />
    <link href='../CMS/assets/css/now-ui-kit.css' rel='stylesheet' />
</head>";

print "<body class='login-page'>
    <!-- Navbar -->
    <nav class='navbar navbar-toggleable-md bg-primary fixed-top navbar-transparent ' color-on-scroll='500'>
        <div class='container'>            
            <div class='navbar-translate'>
                <button class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse' data-target='#navigation' aria-controls='navigation-index' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-bar bar1'></span>
                    <span class='navbar-toggler-bar bar2'></span>
                    <span class='navbar-toggler-bar bar3'></span>
                </button>
                <a class='navbar-brand' href='index.php' rel='tooltip' title='Hanibi' data-placement='bottom'>
                    Hanibi
                </a>
            </div>
            <div class='collapse navbar-collapse justify-content-end' id='navigation' data-nav-image='../CMS/assets/img/blurred-image-1.jpg'>
                <ul class='navbar-nav'>
                    <li class='nav-item'>
                        <a class='nav-link' href='index.php'>Back to Home</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' rel='tooltip' title='Follow us on Twitter' data-placement='bottom' href='https://twitter.com/dhnlr' target='_blank'>
                            <i class='fa fa-twitter'></i>
                            <p class='hidden-lg-up'>Twitter</p>
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' rel='tooltip' title='Like us on Facebook' data-placement='bottom' href='https://www.facebook.com/dhnlr' target='_blank'>
                            <i class='fa fa-facebook-square'></i>
                            <p class='hidden-lg-up'>Facebook</p>
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' rel='tooltip' title='Follow us on Instagram' data-placement='bottom' href='https://www.instagram.com/dhnlr' target='_blank'>
                            <i class='fa fa-instagram'></i>
                            <p class='hidden-lg-up'>Instagram</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class='page-header' filter-color='orange'>
        <div class='page-header-image' style='background-image:url(../CMS/assets/img/login.jpg)'></div>
        <div class='container'>
            <div class='col-md-4 content-center'>
                <div class='card card-login card-plain'>
                    <form class='form' method='post' action='register.php'>
                        <div class='header header-primary text-center'>
                            <div class='logo-container'>
                                <img src='../CMS/assets/img/now-logo.png' alt=''>
                            </div>
                        </div>";

//Menambahkan user
if (isset($_POST['add_user'])){
    $username = mysqli_escape_string($dbc, strip_tags($_POST['username']));
    $user_fullname = mysqli_escape_string($dbc, strip_tags($_POST['user_fullname']));
    $user_email = mysqli_escape_string($dbc, $_POST['user_email']);
    $user_role = mysqli_escape_string($dbc, strip_tags($_POST['user_role']));
    $user_password = mysqli_escape_string($dbc, strip_tags($_POST['user_password']));
    $confirm_password = mysqli_escape_string($dbc, strip_tags($_POST['confirm_password']));
    $user_pass = password_hash($user_password, PASSWORD_DEFAULT);
    if ($user_password == $confirm_password) {
        $query_confirm = "SELECT username, user_email FROM users WHERE (username = '{$username}' OR user_email='{$user_email}')";
        $result = mysqli_query($dbc, $query_confirm);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if ($username == $row['username'] or $user_email == $row['user_email']) {
            print "<div class=\"alert alert-danger\" role=\"alert\">
	            <div class=\"container\">
			        <i class=\"now-ui-icons objects_support-17\"></i>
		            <strong>Oh snap!</strong> Username or email used.
		            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
			        <span aria-hidden=\"true\">
				        <i class=\"now-ui-icons ui-1_simple-remove\"></i>
			        </span>
		            </button>
	            </div>
            </div>";
        }
        else {
            $query = "INSERT INTO users (username, user_fullname, user_password, user_email, user_role) VALUES ('$username', '$user_fullname', '$user_pass', '$user_email', '$user_role')";
            if ($result = mysqli_query($dbc, $query)) {
                print "<div class=\"alert alert-success\" role=\"alert\">
	                    <div class=\"container\">
			                <i class=\"now-ui-icons ui-2_like\"></i>
		                    <strong>Done!</strong> Account registered.
		                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				                <span aria-hidden=\"true\">
				                    <i class=\"now-ui-icons ui-1_simple-remove\"></i>
			                    </span>
		                    </button>
	                    </div>
                </div>";
            }
        }
    }
    else {
        print "<div class=\"alert alert-warning\" role=\"alert\">
	        <div class=\"container\">
			    <i class=\"now-ui-icons ui-1_bell-53\"></i>		        
		        <strong>Warning!</strong> Confirm password.
		        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
			        <span aria-hidden=\"true\">
				        <i class=\"now-ui-icons ui-1_simple-remove\"></i>
			        </span>
		        </button>
	        </div>
        </div>";
    }
}

                        print "<div class='content'>
                            <div class='input-group form-group-no-border input-lg'>
                                <span class='input-group-addon'>
                                    <i class='now-ui-icons users_circle-08'></i>
                                </span>
                                <input type='text' class='form-control' placeholder='Username' name='username' required>
                            </div>
                            <div class='input-group form-group-no-border input-lg'>
                                <span class='input-group-addon'>
                                    <i class='now-ui-icons ui-1_email-85'></i>
                                </span>
                                <input type='email' class='form-control' placeholder='Email' name='user_email' required>
                            </div>
                            <div class='input-group form-group-no-border input-lg'>
                                <span class='input-group-addon'>
                                    <i class='now-ui-icons business_badge'></i>
                                </span>
                                <input type='text' class='form-control' placeholder='Fullname' name='user_fullname' required>
                            </div>
                            <div class='input-group form-group-no-border input-lg'>
                                <span class='input-group-addon'>
                                    <i class='now-ui-icons ui-1_lock-circle-open'></i>
                                </span>
                                <input type='password' placeholder='Password' class='form-control' name='user_password' required>
                            </div>
                             <div class='input-group form-group-no-border input-lg'>
                                <span class='input-group-addon'>
                                    <i class='now-ui-icons ui-1_lock-circle-open'></i>
                                </span>
                                <input type='password' placeholder='Confirm Password' class='form-control' name='confirm_password' required>
                            </div>                           
                            <div class='input-group form-group-no-border input-lg'>
                                <span class='input-group-addon'>
                                    <i class='now-ui-icons objects_diamond'></i>
                                </span>
                                <select class='form-control dropdown-toggle-split' name='user_role' required>
                                <option value='admin' class='dropdown-item'>Admin</option>
                                <option value='editor' class='dropdown-item'>Editor</option>
                                </select>
                            </div>
                        </div>
                        <div class='footer text-center'>
                            <button class='btn btn-primary btn-round btn-lg btn-block' type='submit' name='add_user'>Register</button>
                        </div>
                        <div class='pull-left'>
                            <h6>
                                <a href='login.php' class='link'>Login</a>
                            </h6>
                        </div>
                        <div class='pull-right'>
                            <h6>
                                <a href='index.php' class='link'>Home</a>
                            </h6>
                        </div>
                    </form>";
                print "</div>
            </div>
        </div>
        <footer class='footer'>
            <div class='container'>
                <nav>
                    <ul>
                        <li>
                            <a href='https://www.creative-tim.com'>
                                Creative Tim
                            </a>
                        </li>
                        <li>
                            <a href='http://presentation.creative-tim.com'>
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href='http://blog.creative-tim.com'>
                                Blog
                            </a>
                        </li>
                        <li>
                            <a href='https://github.com/creativetimofficial/now-ui-kit/blob/master/LICENSE.md'>
                                MIT License
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class='copyright'>
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>, Thanks to
                    <a href='http://www.invisionapp.com' target='_blank'>Invision</a> and
                    <a href='https://www.creative-tim.com' target='_blank'>Creative Tim</a>.
                </div>
            </div>
        </footer>
    </div>
</body>
<!--   Core JS Files   -->
<script src='../CMS/assets/js/core/jquery.3.2.1.min.js' type='text/javascript'></script>
<script src='../CMS/assets/js/core/tether.min.js' type='text/javascript'></script>
<script src='../CMS/assets/js/core/bootstrap.min.js' type='text/javascript'></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src='../CMS/assets/js/plugins/bootstrap-switch.js'></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src='../CMS/assets/js/plugins/nouislider.min.js' type='text/javascript'></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src='../CMS/assets/js/plugins/bootstrap-datepicker.js' type='text/javascript'></script>
<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script src='../CMS/assets/js/now-ui-kit.js' type='text/javascript'></script>

</html>";