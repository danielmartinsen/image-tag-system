<?php
	session_start();	if(!isset($_SESSION['login'])){
		header("Location: login.php");
    exit();
	}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://fonts.googleapis.com/css?family=Noto+Sans:700" rel="stylesheet">

<?php
  $img = $_GET['img'];
  $id = $_GET['img'];
  $sortert = $_GET['sortert'];
?>

<?php
$db_host = 'ungias.com.mysql';
$db_user = 'ungias_com_img';
$db_pass = 'ungias_com_img';
$db_name = 'ungias_com_img';

$conn2 = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn2) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$id = $_GET['id'];

$sql2 = "SELECT * FROM images WHERE id = $id";
$result2 = mysqli_query($conn2, $sql2);

$row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
$textareatags = $row2["tags"];

$conn2->close();
?>

<?php
$db_host = 'ungias.com.mysql'; // Server Name
$db_user = 'ungias_com_img'; // Username
$db_pass = 'ungias_com_img'; // Password
$db_name = 'ungias_com_img'; // Database Name

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$users = "users";

$sql = "SELECT * FROM $users";

$query = mysqli_query($conn, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}

?>
<?php
$con=mysqli_connect("ungias.com.mysql","ungias_com_img","ungias_com_img","ungias_com_img");

if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

if( isset($_POST['submit']) ) {

$imgnavn = $_GET['img'];
$tags = htmlspecialchars($_POST['tagsPerson']);
$id = $_GET['id'];

if ($tags != "") {
  $sql="UPDATE images SET tags='$tags' WHERE id=$id";
  $result=mysqli_query($con,$sql);
	$textareatags = $tags;
}

mysqli_close($con);
}

if( isset($_POST['submit2']) ) {

$imgnavn = $_GET['img'];
$tags = htmlspecialchars($_POST['tagsPerson']);
$id = $_GET['id'];

if ($tags != "") {
  $sql="UPDATE images SET tags='$tags', ferdig='1' WHERE id=$id";
  $result=mysqli_query($con,$sql);
	$textareatags = $tags;
}

mysqli_close($con);
}
?>

<style>
h1, h2, h3, h4, h5, h6, a, td {
  font-family: 'Noto Sans', sans-serif;
  font-weight: 400;
}

img {
    margin-bottom: 20px;
    max-width: 400px;
    max-height: 500px;
}
</style>

<style>
* {
  box-sizing: border-box;
}

#myInput {
  width: 400px;
  font-size: 16px;
  padding: 12px 20px 12px 10px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 15px;
}

#myTable td {
  text-align: left;
  padding: 12px;
}
</style>

<style>
button, input[type=submit] {
    padding: 10px;
    border: 2px solid #db3340;
    border-radius: 7px;
    background-color: transparent;
    font-weight: 700;
    color: #db3340;
    cursor: pointer;
}
</style>

</head>
<body>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Søk etter navn.." title="Skriv inn et navn">

<table style="display: block; width: 400px; height: 150px; overflow-y: scroll" id="myTable">
  <tr class="header">
    <th style="width:400px;"></th>
    <th style="width:100px;"></th>
  </tr>
  <tbody>
  <?php
  while ($row = mysqli_fetch_array($query)){

      $name = str_replace(' ', '_', $row['name']);
      $code = $row['code'];

    echo '<tr>
        	<td>'.$row['name'].', '.$row['klasse'].'</td>
					<td><a style="cursor: pointer;" onclick=addperson("'.$name.'&nbsp('.$code.'),")>Legg til</a></td>
      		</tr>';
  }?>
</tbody>
</table>

<br>
<p style="color:red"><?php if($sortert==="1"){echo "BILDET ER FERDIG SORTERT!";}; ?></p>
<img src="../uploads/<?php echo $img; ?>">
<br>

<form action="" method="post">
<textarea name="tagsPerson" id="tagsPersons1" rows="9" cols="52.5" readonly><?php echo $textareatags; ?></textarea>
<br>
<br>
<input type="submit" name="submit" value="LAGRE">
<input type="submit" name="submit2" value="LAGRE OG MARKER SOM FERDIG">
</form>
<button onclick="endremanuelt()">ENDRE NAVN MANUELT</button>
<button onclick="fjernallenavn()">FJERN ALLE NAVN</button>

<br><br><br><br>

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}


function addperson(name) {
  document.getElementById("tagsPersons1").value += name + "\n";
}

function deleteValue(deleteValue) {
			var textarea = document.getElementById("tagsPersons1");
			textarea.value = textarea.value.replace(deleteValue, "");
	}

function endremanuelt() {
	document.getElementById("tagsPersons1").removeAttribute('readonly');
}

function fjernallenavn() {
	<?php $textareatags = ""; ?>
	document.getElementById("tagsPersons1").value = "";
}
</script>

</body>
</html>
