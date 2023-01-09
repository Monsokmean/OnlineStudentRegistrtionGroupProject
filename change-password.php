<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) === 0) {
  header('location:index.php');
} else {
  date_default_timezone_set('Asia/Phnom_Penh'); //Set ambodia timezone for display on page
  $currentTime = date('d-m-Y h:i:s A', time());

  if (isset($_POST['submit'])) {
    $sql = mysqli_query($bd, "SELECT password FROM  students where password='" . md5($_POST['cpass']) . "' && studentRegno='" . $_SESSION['login'] . "'");
    $num = mysqli_fetch_array($sql);
    if ($num > 0) {
      $con = mysqli_query($bd, "update students set password='" . md5($_POST['newpass']) . "', updationDate='$currentTime' where studentRegno='" . $_SESSION['login'] . "'");
      $_SESSION['msg'] = "Password Changed Successfully !!";
    } else {
      $_SESSION['msg'] = "Current Password not match !!";
    }
  }
  ?>

  <!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Student Password</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
  </head>
  <script type="text/javascript">
    function valid() {
      if (document.chngpwd.cpass.value == "") {
        alert("Current Password Filed is Empty !!");
        document.chngpwd.cpass.focus();
        return false;
      }
      else if (document.chngpwd.newpass.value == "") {
        alert("New Password Filed is Empty !!");
        document.chngpwd.newpass.focus();
        return false;
      }
      else if (document.chngpwd.cnfpass.value == "") {
        alert("Confirm Password Filed is Empty !!");
        document.chngpwd.cnfpass.focus();
        return false;
      }
      else if (document.chngpwd.newpass.value != document.chngpwd.cnfpass.value) {
        alert("Password and Confirm Password Field do not match  !!");
        document.chngpwd.cnfpass.focus();
        return false;
      }
      return true;
    }
  </script>

  <body>
    <?php include('includes/header.php'); ?>

    <?php if ($_SESSION['login'] !== "") {
    include('includes/menubar.php');
  }
  ?>

    <div class="content-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-head-line">Student Change Password  </h1>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading badge bg-warning text-wrap text-uppercase fs-5 font-monospace d-flex justify-content-center  ">
                Change Password
              </div>
              <font color="green" align="center">
                <?php echo htmlentities($_SESSION['msg']); ?>
                <?php echo htmlentities($_SESSION['msg'] = ""); ?>
              </font>
                <div class="card">
                    <div class="card-body" style="box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;">
                        <form name="chngpwd" method="post" onSubmit="return valid();">
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="mt-3 font-monospace fw-bold card-title">Current Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="cpass"
                                       placeholder="Password" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="mt-3 font-monospace fw-bold card-title">New Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword2" name="newpass"
                                       placeholder="Password" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="mt-3 font-monospace fw-bold card-title">Confirm Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword3" name="cnfpass"
                                       placeholder="Password" />
                            </div>

                            <button type="submit" name="submit" class="btn btn-warning mt-3" style="border-radius: 15px">Submit</button>
                            <hr />




                        </form>
                    </div>
                </div>

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
<?php } ?>