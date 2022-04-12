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
    $staff_id = $row['staff_id'];
    $staff_name = $row['staff_name'];
    $staff_phonenum = $row['staff_phonenum'];
    $staff_email = $row['staff_email'];
    } else {
    echo "Tiada rekod ditemui";
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
          <a href="list.php">
            <i class="fi fi-rr-Folder"></i>  <!--logo-->
            <span class="links_name">Senarai Pemohon</span>
          </a>
        </li>
        <li>
          <a href="generate.php">
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
        <span class="dashboard">e-Kolej</span>
      </div>
      <div class="profile-details">
        <?php echo '<img src="data:image;base64, '.base64_encode($row["staff_pic"]).' ">';?>
        <span class="admin_name"><?php echo $staff_name?></span>
      </div>
    </nav>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Jumlah Pemohon</div>
            <center><div class="number">5</div></center>
          </div>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Dalam Proses</div>
              <center><div class="number">5</div></center>
          </div>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Selesai</div>
              <center><div class="number">5</div></center>
          </div>
        </div>
      </div>
      <div class="sales-boxes">
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
        <button class="button_update" onClick="window.location.href='update_staff.php?staff_id=<?php echo $row["staff_id"] ?>'"><b>Kemaskini</b></button><br>
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
