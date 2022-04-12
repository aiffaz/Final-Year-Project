<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="asset/image/uitm-vector-logo.png"/>
    <link rel="stylesheet" href="asset/css/main.css"/>
    <link rel="stylesheet" href="asset/css/style.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
    <title>Tentang Kami</title>
  </head>
  <body>
    <div class="header">
      <nav>
        <ul>
          <img src="asset/image/logouitm.png">
          <li><a href="stud_login.php">PELAJAR</a></li>
          <li><a href="login_staff.php">STAF</a></li>
          <li><a href="scan_qr.php">IMBAS KOD QR</a></li>
          <li><a href="contactus.html">HUBUNGI KAMI</a></li>
          <li><a href="aboutus.html">TENTANG KAMI</a></li>
          <li><a href="home.html">UTAMA</a></li>
        </ul>
      </nav>
    </div>
    <center>
    <body background="asset/image/bckguitm.png" width="1349" height="620"><br>
    <div class="box">
      <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
            <label>IMBAS KOD QR</label><br><br>
            <video style="border: 6px dashed black; "id="preview" width="40%"></video><br>
                <p style="color:red;">*Pastikan gambar kod QR dalam keadaan yang jelas dan terang bagi memudahkan imbasan tersebut.</p><br>
                    <textarea id="text" style="text-align: center" width=50px height=50px onkeydown="return false;"
                    style="caret-color: transparent !important;pointer-events: none;" required pattern="[T]{1}[0-9]{4}"></textarea>
           <script>
           let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
           Instascan.Camera.getCameras().then(function(cameras){
               if(cameras.length > 0 ){
                   scanner.start(cameras[0]);
               } else{
                   alert('No cameras found');
               }

           }).catch(function(e) {
               console.error(e);
           });

           scanner.addListener('scan',function(c){
               document.getElementById('text').value=c;
           });
        </script>
    </div><br><br><br><br>
    <div class="footer">
      &copy; Hak Cipta UiTM Kampus Arau Perlis. HAK CIPTA TERPELIHARA.
    </div>
    </center>
  </body>
</html>
