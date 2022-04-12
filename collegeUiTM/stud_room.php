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
          ?>
              <form method="post"><br>
              No. Bilik : &nbsp;
              <select name="room_id" id="roomid" style="width: 100px">
               <option value="A101">A101</option>
               <option value="A102">A102</option>
               <option value="A103">A103</option>
               <option value="A104">A104</option>
               <option value="A105">A105</option>
               <option value="A106">A106</option>
               <option value="A107">A107</option>
               <option value="A108">A108</option>
               <option value="B101">B101</option>
               <option value="B102">B102</option>
               <option value="B103">B103</option>
               <option value="B104">B104</option>
               <option value="B105">B105</option>
               <option value="B106">B106</option>
               <option value="B107">B107</option>
               <option value="B108">B108</option>
               <option value="C101">C101</option>
               <option value="C102">C102</option>
               <option value="C103">C103</option>
               <option value="C104">C104</option>
               <option value="C105">C105</option>
               <option value="C106">C106</option>
               <option value="C107">C107</option>
               <option value="C108">C108</option>
              </select><br><br>
              <label for="stud_id">ID Pelajar</label>
                <input type="text" name="stud_id" value="<?php echo $_GET["stud_id"]?>"><br><br>
              <label for="staff_id">ID Staf</label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="staff_id" value="<?php echo $_SESSION["staff_id"]?>"><br><br>
            <center>
              <button class="button_submit" type="submit" name="room" value="validate"><b>Hantar</b></button>
            </center>
            </form>
            <?php
             } else {
               echo "Tiada rekod ditemui.";
              }
              mysqli_close($conn);
             ?>
            <?php
              if (isset($_POST['room'])){
                  $room_id = $_POST['room_id'];
                  $stud_id = $_POST['stud_id'];
                  $staff_id = $_POST['staff_id'];
                  // Create connection
                  $conn = mysqli_connect("127.0.0.1", "root", "", "college") or die (mysql_error ());
                  // SQL query
                  $sql = "INSERT INTO room (room_id, stud_id, staff_id)
                  VALUES
                  ('$room_id', '$stud_id', '$staff_id')";

                  // Execute the query (the recordset $rs contains the result)
                  if (mysqli_query($conn, $sql)) {
                      echo '<script>alert("Rekod bilik pelajar berjaya dimasukkan.")</script>';
                      echo "<script> window.location.href = 'generate.php'; </script>";
                  } else {
                          echo "Ralat: " . $sql . "<br>" . mysqli_error($conn);
                          }
                    mysqli_close($conn);
                  }
             ?>
          </div>
        </div>
     </section>
    </script>
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
