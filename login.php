<?php
ob_start();
session_start();
include "admin/include/db.php";
if (isset($_SESSION['username'])){
    echo $_SESSION['username'];
    header("Location: index.php");
}
else {
    print "<head>
    <meta charset='utf-8' />
    <link rel='apple-touch-icon' sizes='76x76' href='../CMS/assets/img/apple-icon.png'>
    <link rel='icon' type='image/png' href='../CMS/assets/img/favicon.png'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
    <title>Login - Hanibi</title>
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
                        <a class='nav-link' href='../CMS/index.php'>Back to Home</a>
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
                    <form class='form' method='post' action=''>
                        <div class='header header-primary text-center'>
                            <div class='container'>
                                <h1 class='title'>Login</h1>
                            </div>
                        </div>";

//Memanggil user
    if (isset($_POST['login'])) {
        $username = mysqli_escape_string($dbc, strip_tags($_POST['username']));
        $user_password = mysqli_escape_string($dbc, $_POST['user_password']);
        $query = "SELECT * FROM users WHERE username='{$username}'";
        if ($result = mysqli_query($dbc, $query)) {
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $hash = $row['user_password'];
                if ($username == $row['username'] && password_verify("$user_password", "$hash")) {
                    session_start();
                    $_SESSION['username'] = $username;
                    $_SESSION['user_fullname'] = $row['user_fullname'];
                    $_SESSION['user_image'] = $row['user_image'];
                    $_SESSION['user_email'] = $row['user_email'];
                    $_SESSION['user_role'] = $row['user_role'];
                    header("Location: index.php");
                } else {
                    print "<div class=\"alert alert-danger\" role=\"alert\">
	            <div class=\"container\">
			        <i class=\"now-ui-icons objects_support-17\"></i>
		            <strong>Oh snap!</strong> Check and retry.
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
                                    <i class='now-ui-icons ui-1_lock-circle-open'></i>
                                </span>
                                <input type='password' placeholder='Password' class='form-control' name='user_password' required>
                            </div>
                        </div>
                        <div class='footer text-center'>
                            <button class='btn btn-primary btn-round btn-lg btn-block' type='submit' name='login'>Get Started</button>
                        </div>
                        <div class='pull-left'>
                            <h6>
                                <a href='register.php' class='link'>Create Account</a>
                            </h6>
                        </div>
                        <div class='pull-right'>
                            <h6>
                                <a href='index.php' class='link'>Home</a>
                            </h6>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class='footer'>
            <div class='container'>                
                <div class='copyright'>
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>, Thanks to
                    <a href=\"http://www.invisionapp.com\" target=\"_blank\" rel=\"nofollow\">Invision</a> and
            <a href=\"https://www.creative-tim.com\" target=\"_blank\" rel=\"nofollow\">Creative Tim</a>.
                </div>
            </div>
        </footer>
    </div>
</body>
<!--   Core JS Files   -->
<script src='../CMS/assets/js/core/jquery.3.2.1.min.js' type='text/javascript'></script>
<script src='../CMS/assets/js/core/tether.min.js' type='text/javascript'></script>
<script src='../CMS/assets/js/core/bootstrap.min.js' type='text/javascript'></script>
<script src='../CMS/assets/js/now-ui-kit.js' type='text/javascript'></script>

</html>";
}