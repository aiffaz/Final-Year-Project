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
    $sql = "SELECT stud_id, stud_name, heir_name, heir_phonenum, heir_relation
    FROM student
    WHERE stud_id = '$user'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);
    $stud_id = $row['stud_id'];
    $stud_name = $row['stud_name'];
    $heir_name = $row['heir_name'];
    $heir_phonenum = $row['heir_phonenum'];
    $heir_relation = $row['heir_relation'];
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
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="form.php">
            <i class="fi fi-rr-form"></i>  <!--logo-->
            <span class="links_name">Permohonan Kolej</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fi fi-rr-list"></i>  <!--logo-->
            <span class="links_name">Butiran Pelajar</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fi fi-rr-envelope-open"></i>  <!--logo-->
            <span class="links_name">Keputusan Permohonan<br>Kolej</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fi fi-rr-comment-alt"></i><!--logo-->
            <span class="links_name">Borang Maklum Balas<br>Kolej</span>
          </a>
        </li>
        <li>
          <a href="add_staff.php">
            <i class="fi fi-rr-User-add"></i><!--logo-->
            <span class="links_name">Daftar Staf Baru</span>
          </a>
        </li>
        <li>
          <a href="">
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
        <span class="dashboard">Dashboard</span>
      </div>
      <div class="profile-details">
        <span class="admin_name"><?php echo $stud_name?></span>
      </div>
    </nav>

    <div class="home-content">
      <div class="sales-boxes">
        <h3>Kemaskini Maklumat Pewaris</h3><br>
          <form action="<?php echo $_SERVER['PHP_SELF']?>?stud_id=<?php echo $stud_id?>" method="post" >
              <label for="stud_id">ID Pelajar</label>
              <input type="text" name="stud_id" id="stud_id" value="<?php echo $stud_id?>"><br><br>
              <hr><br>
              <label for="heir_name">Nama Pewaris</label>
              <input type="text" name="heir_name" id="heir_name" value="<?php echo $heir_name?>"><br><br>
              <label for="heir_phonenum">No. Telefon Pewaris</label>
              <input type="text" name="heir_phonenum" id="heir_phonenum" value="<?php echo $heir_phonenum?>"><br><br>
              <label for="heir_relation">Nama Pewaris</label>
              <input type="text" name="heir_relation" id="heir_relation" value="<?php echo $heir_relation?>"><br><br>
              <center>
              <button class="button_update" type="submit" name="updateStud"><b>Kemaskini</b></button><br><br>
              </center>

              <?php
              if (isset($_POST['updateStud'])){
                $stud_id = $_POST['stud_id'];
                $heir_name = $_POST['heir_name'];
                $heir_phonenum = $_POST['heir_phonenum'];
                $heir_relation = $_POST['heir_relation'];
                $conn = mysqli_connect("127.0.0.1", "root", "", "college") or die (mysql_error ());
                // SQL query
                $sql = "UPDATE student SET 
                stud_id = '$stud_id', 
                heir_name = '$heir_name',
                heir_phonenum = '$heir_phonenum',
                heir_relation = '$heir_relation'
                WHERE stud_id = '$stud_id'";

                // Execute the query (the recordset $rs contains the result)
                if (mysqli_query($conn, $sql)) {
                  echo '<script>alert("Rekod ini berjaya dikemas kini.")</script>';
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
</body>
</html>
