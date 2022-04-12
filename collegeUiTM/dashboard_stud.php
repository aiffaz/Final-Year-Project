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
    <title>Pelajar</title>
   </head>
<body>
  <?php
  $servername = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "college";

    if (isset($_SESSION["stud_id"])) {
      $user = $_SESSION["stud_id"];
    // Create connection
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM student WHERE stud_id = '$user'";
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
          <a href="dashboard_stud.php" class="active">
            <i class='fi fi-rr-apps'></i>  <!--logo-->
            <span class="links_name">Profil</span>
          </a>
        </li>
        <li>
          <a href="stud_application.php">
            <i class="fi fi-rr-form"></i>  <!--logo-->
            <span class="links_name">Permohonan Kolej</span>
          </a>
        </li>
        <li>
          <a href="print_details.php">
            <i class="fi fi-rr-Address-book"></i> <!--logo-->
            <span class="links_name">Butiran Pelajar</span>
          </a>
        </li>
        <li>
          <a href="result.php">
            <i class="fi fi-rr-envelope-open"></i>  <!--logo-->
            <span class="links_name">Keputusan Permohonan<br>Kolej</span>
          </a>
        </li>
        <li>
          <a href="feedback_stud.php">
            <i class="fi fi-rr-comment-alt"></i><!--logo-->
            <span class="links_name">Borang Maklum Balas<br>Kolej</span>
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
        <span class="dashboard">e-Kolej</span>
      </div>
      <div class="profile-details">
        <?php echo '<img src="data:image;base64, '.base64_encode($row["stud_pic"]).' ">';?>
        <span class="admin_name"><?php echo $stud_name?></span>
      </div>
    </nav>

    <div class="home-content">
      <div class="sales-boxes">
        <h3>Profil</h3><br>
        <table id="list">
          <tr>
            <td>ID Pelajar</td>
            <td>&nbsp;<?php echo $stud_id?></td>
          </tr>
          <tr>
            <td>Nama Pelajar</td>
            <td>&nbsp;<?php echo $stud_name?></td>
          </tr>
          <tr>
            <td>No. Telefon</td>
            <td>&nbsp;<?php echo $stud_phonenum?></td>
          </tr>
          <tr>
            <td>Kod Program</td>
            <td>&nbsp;<?php echo $stud_progcode?></td>
          </tr>
          <tr>
            <td>Semester</td>
            <td>&nbsp;<?php echo $stud_sem?></td>
          </tr>
          <tr>
            <td>Email</td>
            <td>&nbsp;<?php echo $stud_email?></td>
          </tr>
        </table><br>
        <button class="button_update" onClick="window.location.href='stud_update.php?stud_id=<?php echo $row["stud_id"] ?>'"><b>Kemaskini</b></button><br>
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
