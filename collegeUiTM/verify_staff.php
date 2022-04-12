<?php
session_start();
?>
<html>
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
    <title>Pengesahan</title>
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
          <?php
            $servername = "localhost";
            $dbusername = "root";
            $dbpassword = "";
            $dbname = "college";

            if (isset($_GET["app_id"])) {
              $user1 = $_GET["app_id"];
            // Create connection
            $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
            // Check connection
            if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "SELECT * FROM application WHERE app_id = '$user1' ";
            $result = mysqli_query($conn, $sql);
            ?>
          <center><h3>Pengesahan</h3></center><br>
          <?php
          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $row = mysqli_fetch_assoc($result);
           ?>
            <form method="post"><br>
            <label for="app_id">ID Borang</label>
              <input type="text" name="app_id" value="<?php echo $row["app_id"]?>"><br><br>
            <label for="stud_id">ID Pelajar</label>
              &nbsp;<input type="text" name="stud_id" value="<?php echo $row["stud_id"]?>"><br><br>
            <label for="staff_id">ID Staf</label>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="staff_id" value="<?php echo $_SESSION["staff_id"]?>"><br><br>
            <?php echo '<img src="data:image;base64, '.base64_encode($row["card"]).'" style="width: 380px; height: 420px;">';?><br><br>
            <label for="status">Status</label><br><br>
            <label class="container">LULUS
              <input type="radio" checked="checked" name="status" value="LULUS" required>
              <span class="checkmark"></span>
            </label>
            <label class="container">GAGAL
              <input type="radio" name="status" value="GAGAL" required>
              <span class="checkmark"></span>
            </label><br>
          <center>
            <button class="button_submit" type="submit" name="verify1"><b>Hantar</b></button>
          </center>
          </form>
          <?php
            } else {
              echo "Tiada rekod ditemui.";
            }
            mysqli_close($conn);
           }
          ?>
          <?php
            if (isset($_POST['verify1'])){
                $app_id = $_POST['app_id'];
                $stud_id = $_POST['stud_id'];
                $staff_id = $_POST['staff_id'];
                $status = $_POST['status'];
                // Create connection
                $conn = mysqli_connect("127.0.0.1", "root", "", "college") or die (mysql_error ());
                // SQL query
                $sql = "UPDATE application SET
                app_id = '$app_id',
                stud_id = '$stud_id',
                staff_id = '$staff_id',
                status = '$status'
                WHERE app_id = '$app_id'";
                // Execute the query (the recordset $rs contains the result)
                if (mysqli_query($conn, $sql)) {
                    echo '<script>alert("Berjaya membuat pengesahan.")</script>';
                    echo "<script> window.location.href = 'email.php'; </script>";
                } else {
                        echo "Ralat: " . $sql . "<br>" . mysqli_error($conn);
                }
                mysqli_close($conn);
                }
            ?>
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
