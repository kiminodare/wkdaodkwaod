
<?php
  session_start();
 if (isset($_SESSION['is_login'])) {
   header('location:checker.php');
 } 

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="Vendor/CSS/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
</head>

<body>

  <form method="post" action="login.php" class="login-form" onSubmit="return validasi()">
    <h1>Login</h1>

    <div class="error" id="error" style="display: none;">
          <p> Please input Username and Password </p>
      </div>
      <div class="wrong" id="wrong" style="display: none;">
          <p> Username atau Password Salah </p>
      </div>

    <div class="txtb">
      <input type="text" name="username" id="username">
      <span data-placeholder="Username"></span>
    </div>

    <div class="txtb">
      <input type="password" name="password" id="password">
      <span data-placeholder="Password"></span>
    </div>

    <input type="submit" class="logbtn" value="Login">

    <div class="bottom-text">
      Don't have account? <a href="signup.php">Sign up</a>
    </div>

  </form>

  <script type="text/javascript">
    $(".txtb input").on("focus", function () {
      $(this).addClass("focus");
    });

    $(".txtb input").on("blur", function () {
      if ($(this).val() == "")
        $(this).removeClass("focus");
    });
  </script>
  <script type="text/javascript">
    function validasi() {
      var username = document.getElementById("username").value;
      var password = document.getElementById("password").value;
      if (username != "" && password != "") {
        return true;
      } else {
        document.getElementById("error").style.display = "block";
        return false;
      }
    }
  </script>


</body>

</html>