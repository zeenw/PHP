<!-- 
  Developed by: Zeen Wu
  Creat Date: Jun 27, 2022 
-->
<!--  0 Template head start  ------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- jquery-3.6.0.min.js -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- common CSS -->
  <link rel="stylesheet" href="../common/common.css">
  <!-- common js -->
  <script src="../common/common.js"></script>
  <link rel="icon" href="../common/images/favicon.png" type="image/gif" sizes="16x16">
  

  <style>
    .box {
      border: 1px solid #cecece;
      padding: 1rem;
      margin: 1rem;
    }

    .tab {
      border-bottom: 1px solid #cecece;
      border-left: 1px solid #cecece;
      border-right: 1px solid #cecece;
      padding: 1rem;
      margin: 0rem;
    }

    .msg_err {
      color: red;
    }
  </style>


  <?php // php code start --------------------------------------//
  require_once '../../config/Database.php';
  session_start();
  $db = new Database;
  $conn = $db->conn;
  $r_message = array();
  $r_msg = "none";
  $r_name = "";
  $r_phone = "";
  $r_email = "";

  if (isset($_POST['r_reset'])) {
    $r_msg = "none";
    $r_name = "";
    $r_phone = "";
    $r_email = "";
    unset($r_message);
  }

  if (isset($_POST['register'])) {
    unset($r_message);
    $r_uname = trim($_POST["r_uname"]);
    $r_phone = trim($_POST["r_phone"]);
    $r_email = trim($_POST["r_email"]);
    $validation = validation($r_uname, $r_phone, $r_email);
    if ($validation[0]) {
      $r_pword1 = trim($_POST["r_pword1"]);
      $r_pword2 = trim($_POST["r_pword2"]);
      $verifyPword = verifyPword($r_pword1, $r_pword2);
      if ($verifyPword[0]) {
        $result = getUserByEmail($r_email);
        if (mysqli_num_rows($result) > 0) {
          $r_message["addUser"] = " User is already exist. If you forgot your password, please reset your password.";
        } else {
          if (addUser($r_uname, md5($r_pword1), $r_phone, $r_email)) {
            $r_message["addUser"] = "Great! User has been added. User name is " . $r_uname . ", phone number is " . $r_phone . ", email is " . $r_email;
            $r_uname = "";
            $r_phone = "";
            $r_email = "";
          } else {
            $r_message["addUser"] = "Some thing wrong when add a new user. User name is " . $r_uname . ", phone number is " . $r_phone . ", email is " . $r_email;
          }
        }
      } else {
        $r_message["pword"] = $verifyPword[1];
      }
    } else {
      $r_message["validation"] = $validation[1];
    }
    $r_msg = "inline";
  } else {
    $r_uname = "";
    $r_phone = "";
    $r_email = "";
  }


  function addUser($uname, $pword, $phone, $email)
  {
    global $conn;
    $sql = "insert into user (fname, lname, pword, phone, uemail, creat_date, member_type) values('$uname', '$uname', '$pword', '$phone', '$email', current_timestamp(), 1)";
    return (mysqli_query($conn, $sql)) ? true : false;
  }

  function getUserByEmail($email)
  {
    global $conn;
    $sql = "select * from user where uemail = '$email'";
    $result = mysqli_query($conn, $sql);
    return $result;
  }

  function verifyPword($pword1, $pword2)
  {
    $r = array();
    $rs = true;
    $message = "";
    $reg_pword = "/^[a-zA-Z0-9]{4,}$/";
    // validation 
    if (empty($pword1)) {
      $message = "Please enter your password.";
      $rs = false;
    } else {
      if (!preg_match($reg_pword, $pword1)) {
        $message = "Please check rule of password.";
        $rs = false;
      }
    }

    if (empty($pword2)) {
      $message = $message . " Please repeat your password.";
      $rs = false;
    } else {
      if ($pword2 != $pword1) {
        $message = $message . " Password repeat is not match your password.";
        $rs = false;
      }
    }
    $r = array($rs, $message);
    return $r;
  }


  function validation($name, $phone, $email)
  {
    $r = array();
    $err_name = "";
    $err_phone = "";
    $err_email = "";
    $reg_name = "/^[a-zA-Z][a-zA-Z\s.-]{1,}$/";
    $reg_phone = "/[0-9().+-]{7,}$/";
    $reg_email = "/^\w+([-+.]\w+)*@\w+([-.]\ w+)*\.\w+([-.]\ w+)*$/";
    $rs = true;
    // validation for name
    if (empty($name)) {
      $err_name = "Please enter your name.";
      $rs = false;
    } else {
      if (preg_match($reg_name, $name)) {
        $err_name = "";
      } else {
        $err_name = "Please check your name: $name. Must start with a letter, can contain a-z, A_Z, period, dash only.";
        $rs = false;
      }
    }
    // validation for phone
    if (empty($phone)) {
      $err_phone = "Please enter your phone number.";
      $rs = false;
    } else {
      if (preg_match($reg_phone, $phone)) {
        $err_phone = "";
      } else {
        $err_phone = "Please check your phone number: $phone. Enter a valid phone number.";
        $rs = false;
      }
    }
    // validation for email  
    if (empty($email)) {
      $err_email = "Please enter your email.";
      $rs = false;
    } else {
      if (preg_match($reg_email, $email)) {
        $err_email = "";
      } else {
        $err_email = "Please check your email: $email. Enter a valid email.";
        $rs = false;
      }
    }
    $message =  $err_name . " " . $err_phone . " " . $err_email;

    $r = array($rs, $message);
    return $r;
  }


  // php code end ------------------------------------- //
  ?>



  <title>Member Register</title>
</head>

<body>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <div class="container">
    <!-- Template head end  ------------------------------------------------------->
    
    <!-- 1 Template nav bar start          -->
    <nav class="navbar navbar-expand-lg navbar-light" id="nav_top">
      <div class="container-fluid">
        <a class="navbar-brand" href="../home/home.html">MYTRIP</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="../home/home.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../about/about.html">About Us</a>
            </li>
              <div id="categoryList">            </div>
            <li class="nav-item"><a class="nav-link" href="../contact/contact.html">Contact</a></li>
          </ul>

          <div id="user">
            <form class="d-flex">
              <input class="form-control me-1" type="Email" placeholder="Email" aria-label="Email" id="email">
              <input class="form-control me-1" type="password" placeholder="Password" aria-label="Password" id="pword">
              <button class="btn btn-outline-success" type="button" id="login" onclick="userLogin();">Login</button>
              <a class="nav-link" href="../user/register.php">Register</a>
              
            </form>
          </div>

        </div>
      </div>
    </nav>
    <!-- Template nav bar end          -->


    <!-- 2 sub module title           -->
    <div class="container-fluid" id="sub_title">
      <p class="display-5">Member Register</p>
    </div>
    <!-- sub module title end          -->


    <!-- 3 sub module nav bar           -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../home/home.html">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Member Register</li>
      </ol>
    </nav>
    <!-- sub module nav bar end         -->

    <!-- 4 sub module main     -->
  <div class="container">


    <div class="box">

        <form id="f1" name="f1" class="row g-3 needs-validation" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
          <div class="alert alert-primary" role="alert" id="r_message" name="r_alert_msg" style="display:<?= $r_msg ?>">
            <?php
            if (isset($r_message)) {
              foreach ($r_message as $key => $value) {
                echo $value . "<br />";
              }
            }
            ?>
          </div>
          <div class="col-md-4">
            <div>
              <label for="r_uname" class="form-label">User Name</label>
              <input type="text" class="form-control" name="r_uname" value="<?= $r_uname ?>">
            </div>
          </div>

          <div class="col-md-4">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="r_pword1">
          </div>

          <div class="col-md-4">
            <label class="form-label">Repeat Password</label>
            <input type="password" class="form-control" name="r_pword2">
          </div>

          <div class="col-md-4">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control" placeholder="(514)123-4567" name="r_phone" value="<?= $r_phone ?>">
          </div>

          <div class="col-md-4">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" placeholder="user@example.com" name="r_email" value="<?= $r_email ?>">
          </div>

          <div class="col-5">
            <button class="btn btn-success" type="submit" name="register">Register</button>
            <button class="btn btn-secondary" type="submit" name="r_reset">Cancel</button>
          </div>

        </form>


    </div><br /><br /><br /><br /><br />



    <!-- sub module main end       -->

    <!-- 5 Template footer start          -->
    <iframe src="../common/footer.html" width="100%" height="1100" style="border:none;">
    </iframe>
    <!-- Template footer end         -->
  </div>
</body>

</html>