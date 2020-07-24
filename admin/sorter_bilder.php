<?php
	session_start();	if(!isset($_SESSION['login'])){
	header("Location: login.php");
    exit();
	}
?>

<link href="https://fonts.googleapis.com/css?family=Noto+Sans:700" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<h2 style="margin: 20px 50px 20px 50px;"><a href="index.php"><-</a>&nbsp;&nbsp;Klikk på et bilde for å tagge det med navn!</h2>

<div style="margin: 0px 800px 0px 50px">
    <h2>Til sortering</h2>
		<?php
		include_once 'dbConfig.php';

		$query = $db->query("SELECT * FROM images WHERE ferdig='0' ORDER BY id DESC");

		if($query->num_rows > 0){
		    while($row = $query->fetch_assoc()){
		        $imageURL = '../uploads/'.$row["file_name"];
		?>
		    <img src="<?php echo $imageURL; ?>" alt="" height="100px" width="auto" onclick="endreiframsrc('<?php echo $row["file_name"]; ?>','<?php echo $row["id"]; ?>')" />
		<?php }
		}else{ ?>
		    <p>No image(s) found...</p>
		<?php } ?>
</div>

<div style="margin: 20px 800px 0px 50px">
    <h2>Ferdig sortert</h2>
		<?php
		include_once 'dbConfig.php';

		$query = $db->query("SELECT * FROM images WHERE ferdig='1' ORDER BY id DESC");

		if($query->num_rows > 0){
		    while($row = $query->fetch_assoc()){
		        $imageURL = '../uploads/'.$row["file_name"];
		?>
		    <img src="<?php echo $imageURL; ?>" alt="" height="100px" width="auto" onclick="endreiframsrc('<?php echo $row["file_name"]; ?>','<?php echo $row["id"]; ?>','<?php echo $row["ferdig"]; ?>')" />
		<?php }
		}else{ ?>
		    <p>No image(s) found...</p>
		<?php } ?>
    </div>

<div class="sidebyside-1">
    <iframe id="addtagsiframe" src="add_tags.php?img=velg_bilde.png&id=00" height="950" width="450"></iframe>
</div>

<script>
function endreiframsrc (img, id, sortert) {
	document.getElementById('addtagsiframe').src = "add_tags.php?img=" + img + "&id=" + id + "&sortert=" + sortert;
}
</script>

<style>
.sidebyside {
    display: inline-block;
}

.sidebyside-1 {
    position: fixed;
    display: inline-block;
    top: 8;
    right: 10;
}

h1, h2, h3, h4, h5, h6 {
  font-family: 'Noto Sans', sans-serif;
}

a {
  text-decoration: none;
  color: black;
}

iframe {
    border: none;
}

img {
    cursor: pointer;
}
</style>
