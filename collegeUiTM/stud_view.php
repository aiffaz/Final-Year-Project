<?php
session_start();
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="icon" href="asset/image/uitm-vector-logo.png"/>
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staf</title>
   </head>
  <body>
    <?php
      $servername = "localhost";
      $dbusername = "root";
      $dbpassword = "";
      $dbname = "college";

      if (isset($_SESSION["staff_id"])) {
        $user = $_SESSION["staff_id"];
      // Create connection
      $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
      // Check connection
      if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
      }
      $sql = "SELECT * FROM staff WHERE staff_id = '$user'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
      // output data of each row
      $row = mysqli_fetch_assoc($result);
      $staff_name = $row['staff_name'];
      } else {
      echo "Tiada rekod ditemui.";
      }
      mysqli_close($conn);
    }
    ?>
    <div class="sidebar">
      <div class="logo">
        <img src="asset/image/logouitm.png" width="240">
      </div>
        <ul class="nav-links">
          <li>
            <a href="dashboard_staff.php" class="active">
              <i class="fi fi-rr-Apps"></i>  <!--logo-->
              <span class="links_name">Profil</span>
            </a>
          </li>
          <li>
            <a href="app_list.php">
              <i class="fi fi-rr-Folder"></i>  <!--logo-->
              <span class="links_name">Senarai Pemohon</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fi fi-rr-Expand"></i>  <!--logo-->
              <span class="links_name">Menjana Kod QR</span>
            </a>
          </li>
          <li>
            <a href="feedback_staff.php">
              <i class="fi fi-rr-Comment-alt"> </i><!--logo-->
              <span class="links_name">Semakan Borang Maklum<br>Balas Pelajar</span>
            </a>
          </li>
          <li>
            <a href="add_staff.php">
              <i class="fi fi-rr-User-add"></i> <!--logo-->
              <span class="links_name">Daftar Staf Baru</span>
            </a>
          </li>
          <li>
            <a href="view_staff.php">
              <i class="fi fi-rr-List"></i> <!--logo-->
              <span class="links_name">Senarai Staf</span>
            </a>
          </li>
          <li class="log_out">
            <a href="logout.php">
              <i class='bx bx-log-out'></i>  <!--logo-->
              <span class="links_name">Log Keluar</span>
            </a>
          </li>
        </ul>
    </div>
    <section class="home-section">
      <nav>
        <div class="sidebar-button">
          <i class='bx bx-menu sidebarBtn'></i> <!--logo-->
          <span class="dashboard">Dashboard</span>
        </div>
        <div class="profile-details">
          <?php echo '<img src="data:image;base64, '.base64_encode($row["staff_pic"]).' ">';?>
          <span class="admin_name"><?php echo $staff_name?></span>
        </div>
      </nav>
      <div class="home-content">
        <div class="sales-boxes">
          <?php
            $servername = "localhost";
            $dbusername = "root";
            $dbpassword = "";
            $dbname = "college";

            if (isset($_GET["view"])) {
            $user = $_GET["view"];
            // Create connection
            $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
            // Check connection
            if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "SELECT * FROM student
            WHERE stud_id = '$user'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $row = mysqli_fetch_assoc($result);
            $stud_id = $row['stud_id'];
            $stud_name = $row['stud_name'];
            $stud_phonenum = $row['stud_phonenum'];
            $stud_progcode = $row['stud_progcode'];
            $stud_sem = $row['stud_sem'];
            $stud_email = $row['stud_email'];
            $heir_name = $row['heir_name'];
            $heir_phonenum = $row['heir_phonenum'];
            $heir_relation = $row['heir_relation'];
            } else {
                  echo "Tiada rekod ditemui.";
            }
            mysqli_close($conn);
           }
         ?>
          <h3>Profil</h3><br>
          <table id="list">
            <tr>
              <td>ID Staff</td>
              <td>&nbsp;<?php echo $staff_id?></td>
            </tr>
            <tr>
              <td>Nama Staff</td>
              <td>&nbsp;<?php echo $staff_name?></td>
            </tr>
            <tr>
              <td>No. Telefon</td>
              <td>&nbsp;<?php echo $staff_phonenum?></td>
            </tr>
            <tr>
              <td>Email</td>
              <td>&nbsp;<?php echo $staff_email?></td>
            </tr>
          </table><br>
          <button class="button_update" onClick="window.location.href='stud_update1.php?stud_id=<?php echo $row["staff_id"] ?>'"><b>Kemaskini</b></button><br>
        </div>
      </div>
    </section>
    <script>
     let sidebar = document.querySelector(".sidebar");
     let sidebarBtn = document.querySelector(".sidebarBtn");
     sidebarBtn.onclick = function() {
       sidebar.classList.toggle("active");
       if(sidebar.classList.contains("active")){
         sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
       }else
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      }
    </script>
  </body>
</html>
