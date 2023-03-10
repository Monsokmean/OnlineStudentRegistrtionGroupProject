<?php
session_start();
error_reporting(0);
include("includes/config.php");
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $query = mysqli_query($bd, "SELECT * FROM admin WHERE username='$username' and password='$password'");
    $num = mysqli_fetch_array($query);
    if ($num > 0) {
        $extra = "change-password.php";
        $_SESSION['alogin'] = $_POST['username'];
        $_SESSION['id'] = $num['id'];
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("location:http://$host$uri/$extra");
        //=> http://localhost:63342/Online%20Course%20Registration/admin/change-password.php
        //$host = localhost:63342
        //$uri = /Online%20Course%20Registration/admin
        //$extra = "change-password.php";
        exit();
    } else {
        $_SESSION['errmsg'] = "Invalid username or password";
        $extra = "index.php";
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("location:http://$host$uri/$extra");
        exit();
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>

    <title>Admin Login</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/font-awesome.css" rel="stylesheet"/>
    <link href="assets/css/style.css" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/55c193e227.js" crossorigin="anonymous"></script>
    <style>
        body{
            font-family: 'Roboto', sans-serif;
        }
    </style>

</head>
<body>
<?php include('includes/header.php'); ?>
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Please Login Your Account </h4>
            </div>

        </div>
        <span style="color:red;"><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg'] = ""); ?></span>
        <div class="card center-block" style="width: 50rem;box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;">
            <div class="card-body">
                <form name="admin" method="post">
                    <label class="fw-bold">Enter Username : </label>
                    <input type="text" name="username" class="form-control" required/>
                    <label class="fw-bold mt-3">Enter Password : </label>
                    <input type="password" name="password" class="form-control" required/>
                    <hr/>
                    <button type="submit" name="submit" class="btn btn-info fw-bold" style="border-radius: 10px; --bs-btn-hover-bg:#eeff06 "><span
                                class="glyphicon glyphicon-user"></span> &nbsp;Log Me In
                    </button>&nbsp;
                </form>
            </div>
            <div class="text-center mt-2">
                <p>Don't have an account? <a href="add_admin.php"> Register here</a></p>
            </div>
        </div>

    </div>
</div>
</div>

<?php include('includes/footer.php'); ?>

<script src="assets/js/jquery-1.11.1.js"></script>

<script src="assets/js/bootstrap.js"></script>
</body>
</html>
