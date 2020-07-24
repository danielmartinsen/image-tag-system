<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width">

<style>
body, html {
  background-color: #0A466E;
}

h1, h2, h3, h4, h5, h6, p {
  font-family: 'Poppins', sans-serif;
  color: white;
  padding-left:15px;
}

img {
  padding: 15px;
}
</style>

<br>

<?php
include_once 'dbConfig.php';
$tags = $_GET['kode'];

if ($tags  == "" or $tags == ",") {
  $tags = "ERROR 404";
}

$query = $db->query("SELECT * FROM images WHERE tags LIKE '%$tags%'");

if($query->num_rows > 0) {
    
    echo '
    <h3>Dine ballbilder</h3>
    <h5>Trykk på bildene du vil laste ned!</h5>
    <br>';
    
    while($row = $query->fetch_assoc()){
        $imageURL = 'uploads/'.$row["file_name"];
        echo '<a href="'.$imageURL.'" download><img src="'.$imageURL.'" height="300px" width="auto" alt=""/></a>';
    }
    
} else {
    
    echo '
    <center>
      <h3>Ingen bilder funnet...</h3>
    </center>
    ';
    
}
