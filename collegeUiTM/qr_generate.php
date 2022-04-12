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
    <title>Senarai Nama Pemohon</title>
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
      <div class="sales-boxes">
                  <?php
                  $servername = "localhost";
                  $dbusername = "root";
                  $dbpassword = "";
                  $dbname = "college";

                    if (isset($_GET["stud_id"])) {
                      $user1 = $_GET["stud_id"];
                    // Create connection
                    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
                    // Check connection
                    if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                    }
                    $sql = "SELECT s.stud_id, s.stud_name, r.room_id, r.stud_id FROM student s, room r WHERE s.stud_id = r.stud_id AND r.stud_id = '$user1'";
                    $result = mysqli_query($conn, $sql);
                  ?>
                    <form method="post"><br>
                      <?php
                      if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                      while($row = mysqli_fetch_assoc($result)) {
                       ?>
                    <label for="stud_id">ID Pelajar</label>
                    <input type="text" name="stud_id" value="<?php echo $row["stud_id"]?>"><br><br>
                    <label for="stud_name">Nama Pelajar</label>
                    <input type="text" name="stud_name" value="<?php echo $row["stud_name"]?>"><br><br>
                    <label for="room_id">No. Bilik</label>
                    <input type="text" name="room_id" value="<?php echo $row["room_id"]?>"><br><br>
                  <center>
                    <button class="button_view" type="submit" name="generate"><b>Kod QR</b></button>
                  </center>
                </form><br><br>
                  <?php
                    }
                    } else {
                    echo "Penempatan bilik kolej pelajar belum dibuat lagi.";
                    }
                    mysqli_close($conn);
                  }
                    ?>
                  <?php
                    if (isset($_POST['generate'])){
                        $id = $_POST['stud_id'];
                        $name = $_POST['stud_name'];
                        $id1 = $_POST['room_id'];
                        $url = "https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl={$id} {$name} {$id1}&choe=UTF-8";
                        $data["img"] = $url;
                      }
                    ?>
                    <?php if(isset($data)){ ?>
                    <center>
                      <img src="<?php echo $data["img"]?>" name="qrcode" alt="QR Code" width="150px" height="150px"> <br>
                      <a href="<?php echo $data["img"]?>"><button class="button_submit" download="QR Code"><b>Cetak</b></button></a>
                    </center>
                    <?php } ?>
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
