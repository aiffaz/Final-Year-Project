<?php
session_start();

if($_SESSION["stud_id"]) {
	unset($_SESSION["stud_id"]);
	header("location: home.html");
}
elseif($_SESSION["staff_id"]) {
	unset($_SESSION["staff_id"]);
	header("location: home.html");
}
?>
