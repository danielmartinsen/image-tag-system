<?php
	session_start();	if(!isset($_SESSION['login'])){
		header("Location: login.php");
    exit();
	}
?>

<link href="https://fonts.googleapis.com/css?family=Noto+Sans:700" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<style>
h1, h2, h3, h4, h5, h6 {
  font-family: 'Noto Sans', sans-serif;
}

a {
  text-decoration: none;
  color: black;
}
</style>

<center>

<br><br>
<h1><a href="index.php"><-</a> &nbsp;&nbsp; LAST OPP ELEVER</h1>
<h4>OSB! Bare CSV filer støttes!</h4>
<br><br>

<form method="post" enctype="multipart/form-data">
 <div align="center">
	<input type="file" name="file" />
	<input type="submit" name="submit" value="Last opp"/>
 </div>
</form>

</center>

<?php
function generateRandomString($length = 8) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$connect = mysqli_connect("ungias.com.mysql", "ungias_com_img", "ungias_com_img", "ungias_com_img");
if(isset($_POST["submit"]))
{
 if($_FILES['file']['name'])
 {
  $filename = explode(".", $_FILES['file']['name']);
  if($filename[1] == 'csv')
  {
   $handle = fopen($_FILES['file']['tmp_name'], "r");
   while($data = fgetcsv($handle, null, ";"))
   {
    	$item1 = mysqli_real_escape_string($connect, $data[0]);
    	$item2 = mysqli_real_escape_string($connect, $data[1]);
        $item3 = generateRandomString();;
    	$query = "INSERT into users(name, klasse, code) values('$item1','$item2', '$item3')";
			mysqli_query($connect, $query);
   }
   fclose($handle);
   echo "<script>alert('Import done');</script>";
  }
 }
}
?>
