<?php
  if (isset($_POST['emailbtn'])) {
      $fromEmail = $_POST['fromEmail'];
      $toEmail = $_POST['toEmail'];
      $subjectName = $_POST['subject'];
      $message = "  Assalamualaikum W.B.T & Salam Sejahtera.<br>
        Salam UiTM Dihatiku,<br>
        Pelajar yang dihormati,<br>
        PENGUMUMAN: Keputusan Permohonan Kolej Sudah Dikeluarkan. Sila Buat Semakan Pada Portal UiTM Kolej.<br>
        Sekian, dimaklumkan.<br>
        Terima Kasih.<br>
        #UiTMDihatiku <br> ";

      $to = $toEmail;
      $subject = $subjectName;
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      $headers .= 'From: '.$fromEmail.'<'.$fromEmail.'>' . "\r\n".'Reply-To: '.$fromEmail."\r\n" . 'X-Mailer: PHP/' . phpversion();
      $message = '<!doctype html>
  		<html lang="en">
  			<head>
  				<meta charset="UTF-8">
  				<meta name="viewport"
  					  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  				<title>Document</title>
  			</head>
  			<body>
  			<span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">'.$message.'</span>
  				<div class="container">
                   '.$message.'<br/>
                   Unit Pengurusan Kolej,<br/>
                   UiTM Perlis<br/>
                    '.$fromEmail.'
  				</div>
  			</body>
  		</html>';
      $result = @mail($to, $subject, $message, $headers);

      echo '<script>alert("Mail berjaya dihantar.")</script>';
      echo '<script>window.location.href="list.php";</script>';
}