<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="asset/image/uitm-vector-logo.png"/>
    <link rel="stylesheet" href="asset/css/main.css"/>
    <link rel="stylesheet" href="asset/css/login.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
    <title>Log Masuk Pelajar</title>
  </head>
  <body>
  <?php
    session_start();
    $message="";
    if(count($_POST)>0) {
      $con = mysqli_connect("127.0.0.1", "root", "", "college") or die('Unable To connect');
      $result = mysqli_query($con,"SELECT stud_id, stud_pws FROM student WHERE stud_id='" . $_POST["stud_id"] . "' and stud_pws= '". $_POST["stud_pws"]."'");
      $row  = mysqli_fetch_array($result);
      if(is_array($row)) {
        $_SESSION["stud_id"] = $row['stud_id'];
        } else {
          $message = "email atau kata laluan anda tidak sah!";
          }
        }
      if(isset($_SESSION["stud_id"])) {
        header("location: dashboard_stud.php");
      }
    ?>
    <div class="header">
      <nav>
        <ul>
          <img src="asset/image/logouitm.png">
          <li><a href="stud_login.php">PELAJAR</a></li>
          <li><a href="login_staff.php">STAF</a></li>
          <li><a href="scan_qr.php">IMBAS KOD QR</a></li>
          <li><a href="contactus.html">HUBUNGI KAMI</a></li>
          <li><a href="aboutus.html">TENTANG KAMI</a></li>
          <li><a href="home.html">UTAMA</a></li>
        </ul>
      </nav>
    </div>
    <center>
    <body background="asset/image/bckguitm.png" width="1349" height="620"><br>
    <div class="box">
      <h2>Log Masuk</h2>
      <form name="login_stud" method="post"><br>
        <?php if(!empty($message)){?>
        <p style="color:red;"><?php echo $message; }?></p>
        <h2>Pelajar</h2>
        <label for="username">ID Pelajar</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="stud_id" placeholder="ID.." required><br>
        <label for="pws">Kata Laluan</label>&nbsp;
        <input type="password" name="stud_pws" id="myInput" placeholder="Kata Laluan.." required><br>
        <input type="checkbox" onclick="myFunction()">Lihat Kata Laluan<br>
        <input type="submit" name="Log Masuk" value="Log Masuk">
        <input type="reset" value="Padam">
      </form>
    </div><br><br><br><br><br>
    <div class="footer">
      &copy; Hak Cipta UiTM Kampus Arau Perlis. HAK CIPTA TERPELIHARA.
    </div>
    </center>
    <script>
      function myFunction() {
       var x = document.getElementById("myInput");
       if (x.type === "password") {
         x.type = "text";
       } else {
         x.type = "password";
        }
      }
    </script>
  </body>
</html>
