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
    <title>Menjana Kod QR</title>
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
            <h3>Senarai Pemohon Yang Berjaya</h3><br>
            <?php
              $servername = "localhost";
              $dbusername = "root";
              $dbpassword = "";
              $dbname = "college";

              // Create connection
              $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
              // Check connection
              if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
              }

              $sql = "SELECT s.stud_id, s.stud_name, s.stud_pic, a.app_id, a.stud_id, a.status FROM student s, application a WHERE s.stud_id = a.stud_id AND a.status = 'LULUS'";
              $result = mysqli_query($conn, $sql);
            ?>
            <!--student list-->
            <table id="list">
              <tr>
                <th></th>
                <th>ID Borang</th>
                <th>Status</th>
                <th>ID Pelajar</th>
                <th>Nama Pelajar</th>
                <th></th>
              </tr>
              <?php
              if (mysqli_num_rows($result) > 0) {
                // output data of each row
              while($row = mysqli_fetch_assoc($result)) {
               ?>
              <tr>
                <td><center><?php echo '<img src="data:image;base64, '.base64_encode($row["stud_pic"]).' " style="width: 80px; height: 90px;">';?></center></td>
                <td style="text-align:center"><?php echo $row["app_id"] ?></td>
                <td style="text-align:center"><?php echo $row["status"] ?></td>
                <td style="text-align:center"><?php echo $row["stud_id"] ?></td>
                <td style="text-align:center"><?php echo $row["stud_name"] ?></td>
                <td><center>
                  <button class="button_view" onClick="window.location.href='stud_room.php?stud_id=<?php echo $row["stud_id"] ?>'"><b>Bilik Kolej</b></button><br>
                  <button class="button_update" onClick="window.location.href='qr_generate.php?stud_id=<?php echo $row["stud_id"] ?>'"><b>Kod QR</b></button><br>
                </center></td>
              </tr>
              <?php
                }
                } else {
                echo "<tr><td colspan='6'>Tiada rekod ditemui.</td></tr>";
                }
                mysqli_close($conn);
                ?>
            </table>
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
