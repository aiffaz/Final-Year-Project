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

    <title>Staf Baru</title>
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
      $staff_pic = $row['staff_pic'];
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
              <i class='fi fi-rr-apps'></i>  <!--logo-->
              <span class="links_name">Profil</span>
            </a>
          </li>
          <li>
            <a href="list.php">
              <i class="fi fi-rr-folder"></i>  <!--logo-->
              <span class="links_name">Senarai Pemohon</span>
            </a>
          </li>
          <li>
            <a href="generate.php">
              <i class="fi fi-rr-expand"></i>  <!--logo-->
              <span class="links_name">Menjana Kod QR</span>
            </a>
          </li>
          <li>
            <a href="feedback_staff.php">
              <i class="fi fi-rr-comment-alt"></i><!--logo-->
              <span class="links_name">Semakan Borang Maklum<br>Balas Pelajar</span>
            </a>
          </li>
          <li>
            <a href="add_staff.php">
              <i class="fi fi-rr-User-add"></i><!--logo-->
              <span class="links_name">Daftar Staf Baru</span>
            </a>
          </li>
          <li>
            <a href="view_staff.php">
              <i class="fi fi-rr-list"></i></i><!--logo-->
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
        <div class="sales-boxes">
            <h3>Daftar Staf Baru</h3><br>
            <form method="post" enctype="multipart/form-data"><br>
            <label for="staff_id">ID Staf &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" name="staff_id1" id="staff_id" required><br><br>
            <label for="staff_name">Nama Staf &nbsp;</label>
              <input type="text" name="staff_name" id="staff_name" oninput="this.value = this.value.toUpperCase()" required><br><br>
            <label for="staff_phonenum">No. Telefon &nbsp;</label>
              <input type="text" name="staff_phonenum" id="staff_phonenum"  placeholder="isi tanpa '-'" required><br><br>
            <label for="staff_gender">Jantina</label><br><br>
            <label class="container">PEREMPUAN
              <input type="radio" checked="checked" name="staff_gender" value="PEREMPUAN" required>
              <span class="checkmark"></span>
            </label>
            <label class="container">LELAKI
              <input type="radio" name="staff_gender" value="LELAKI" required>
              <span class="checkmark"></span>
            </label><br>
            <label for="staff_email">Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" name="staff_email" id="staff_email" placeholder="isi seperti xxx@uitm.edu.my" required><br><br>
            <label for="staff_pws">Kata Laluan</label>
              <input type="password" name="staff_pws" id="staff_pws" required>&nbsp;<input type="checkbox" onclick="myFunction()">&nbsp;Lihat Kata Laluan<br><br>
            <label for="staff_pic">Gambar  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="file" name="image"><br><br>
            <center>
              <button class="button_view" type="submit" name="addStaff"><b>Hantar</b></button>
              <button class="button_delete" type="reset"><b>Padam</b></button>
            </center>
            <?php

            if (isset($_POST['addStaff']) && isset($_FILES['image'])){
              $staff_id1= $_POST['staff_id1'];
              $staff_name = $_POST['staff_name'];
              $staff_phonenum = $_POST['staff_phonenum'];
              $staff_gender = $_POST['staff_gender'];
              $staff_email = $_POST['staff_email'];
              $staff_pws = $_POST['staff_pws'];
              $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

              // Create connection
              $conn = mysqli_connect("127.0.0.1", "root", "", "college") or die (mysql_error ());
              // SQL query
              $sql = "INSERT INTO staff (staff_id, staff_name, staff_phonenum, staff_gender, staff_email, staff_pws, staff_pic)
              VALUES
              ('$staff_id1', '$staff_name', '$staff_phonenum', '$staff_gender', '$staff_email', '$staff_pws', '$image')";
              // Execute the query (the recordset $rs contains the result)
              if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Rekod staf baru telah berjaya dimasukkan.')</script>";
                echo "<script> window.location.href = 'view_staff.php'; </script>";
              } else {
                echo "Ralat: " . $sql . "<br>" . mysqli_error($conn);
              }
              mysqli_close($conn);
              }
              ?>
            </form>
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
    <script>
      function myFunction() {
        var x = document.getElementById("staff_pws");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
    </script>
  </body>
</html>
