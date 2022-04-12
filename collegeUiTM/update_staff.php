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
    <title>Staff</title>
   </head>
  <body>
        <?php
          $servername = "localhost";
          $dbusername = "root";
          $dbpassword = "";
          $dbname = "college";

          if (isset($_GET["staff_id"])) {
            $user = $_GET["staff_id"];
          // Create connection
          $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
          // Check connection
          if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
          }
          $sql = "SELECT staff_id, staff_name, staff_phonenum, staff_email, staff_pws, staff_pic
          FROM staff
          WHERE staff_id = '$user'";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
          // output data of each row
          $row = mysqli_fetch_assoc($result);
          $staff_id = $row['staff_id'];
          $staff_name = $row['staff_name'];
          $staff_phonenum = $row['staff_phonenum'];
          $staff_email = $row['staff_email'];
          $staff_pws = $row['staff_pws'];
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
            <h3>Kemaskini Profil</h3><br>
              <form action="<?php echo $_SERVER['PHP_SELF']?>?staff_id=<?php echo $staff_id?>" method="post">
                  <label for="staff_id">ID Staff</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="staff_id" id="staff_id" value="<?php echo $staff_id?>"><br><br>
                  <label for="stud_name">Nama Staff</label>
                    &nbsp;<input type="text" name="staff_name" id="staff_name" value="<?php echo $staff_name?>" oninput="this.value = this.value.toUpperCase()"><br><br>
                  <label for="staff_phonenum">No. Telefon</label>
                    &nbsp;&nbsp;<input type="text" name="staff_phonenum" id="staff_phonenum" value="<?php echo $staff_phonenum ?>"><br><br>
                  <label for="stud_email">Email</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="staff_email" id="staff_email" value="<?php echo $staff_email?>"><br><br>
                  <label for="staff_pws">Kata Laluan</label>
                    <input type="password" name="staff_pws" id="staff_pws" value="<?php echo $staff_pws?>">&nbsp;<input type="checkbox" onclick="myFunction()">&nbsp;Lihat Kata Laluan<br><br>
                  <button class="button_update" type="submit" name="updateStaff"><b>Kemaskini</b></button><br><br>
              </form>
              <?php
                if (isset($_POST['updateStaff'])){
                  $staff_id = $_POST['staff_id'];
                  $staff_name = $_POST['staff_name'];
                  $staff_phonenum = $_POST['staff_phonenum'];
                  $staff_email = $_POST['staff_email'];
                  $staff_pws = $_POST['staff_pws'];

                  $conn = mysqli_connect("127.0.0.1", "root", "", "college") or die (mysql_error ());
                  // SQL query
                  $sql = "UPDATE staff SET
                  staff_id = '$staff_id',
                  staff_name = '$staff_name',
                  staff_phonenum = '$staff_phonenum',
                  staff_email = '$staff_email',
                  staff_pws = '$staff_pws'
                  WHERE staff_id = '$staff_id'";

                  // Execute the query (the recordset $rs contains the result)
                  if (mysqli_query($conn, $sql)) {
                    echo '<script>alert("Rekod ini berjaya dikemas kini")</script>';
                    header("Location: view_staff.php");
                  } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
