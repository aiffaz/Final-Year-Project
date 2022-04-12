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
    <title>Borang Permohonan Kolej</title>
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
          <h3>Borang Permohonan Kolej</h3><br>
          <form method="post" enctype="multipart/form-data"><br>
             <label for="card">Tarikh</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <input type="date" value="<?php echo date("d-m-y") ?>" name="date"><br>
             <label for="card">Masa</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <?php date_default_timezone_set("Asia/Kuala_Lumpur"); ?>
             <input type="text" value="<?php echo date("h:i:sa") ?>" name="time"><br>
             <label for="stud_id">ID Pelajar</label>
             <input type="text" name="stud_id" value="<?php echo $stud_id?>"><br><br>
             <label for="card">Kupon</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <input type="file" name="image"><br>
             <center>
             <button class="button_submit" type="submit" name="upload"><b>Hantar</b></button>
             </center>
          </form>
         <?php

             if (isset($_POST['upload']) && isset($_FILES['image'])){
                 $date = $_POST['date'];
                 $time = $_POST['time'];
                 $stud_id = $_POST['stud_id'];
                 $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                 // Create connection
                 $conn = mysqli_connect("127.0.0.1", "root", "", "college") or die (mysql_error ());
                 // SQL query
                 $sql = "INSERT INTO application (date, time, card, stud_id)
                 VALUES
                 ('$date', '$time', '$image', '$stud_id')";
                 // Execute the query (the recordset $rs contains the result)
                 if (mysqli_query($conn, $sql)) {
                     echo '<script>alert("Permohonan berjaya dihantar.")</script>';
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
