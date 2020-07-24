<?php
	session_start();
	if(!isset($_SESSION['login'])){
		header("Location: login.php");
    exit();
	}
?>

<link href="https://fonts.googleapis.com/css?family=Noto+Sans:700" rel="stylesheet">

<style>
h1, h2, h3, h4, h5, h6 {
  font-family: 'Noto Sans', sans-serif;
}

.color-box-1 {
  display: inline-block;
  padding: 30px;
  background-color: #d8d8d8;
  width: 300px;
  margin: 10px;
  cursor: pointer;
}

.color-box-1:hover {
  background-color: #db3340;
}

.color-box-2 {
  padding: 30px;
  background-color: #d8d8d8;
  width: 685px;
  margin: 10px;
  cursor: pointer;
}

.color-box-2:hover {
  background-color: #db3340;
}
</style>

<center>

<br>
<br>
<h1>VELKOMMEN</h1>
<br>
<br>

<div onclick="window.location.href = 'upload_users.php'" class="color-box-1">
  <h2>Last opp elever</h2>
</div>

<div onclick="window.location.href = 'upload_images.php'" class="color-box-1">
  <h2>Last opp bilder</h2>
</div>

<br>

<div onclick="window.location.href = 'sorter_bilder.php'" class="color-box-1">
  <h2>Sorter bilder</h2>
</div>

<div onclick="window.location.href = 'print_koder.php'" class="color-box-1">
  <h2>Print ut koder</h2>
</div>

</center>
