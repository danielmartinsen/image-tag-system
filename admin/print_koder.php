<a href="index.php">Tilbake</a><br><br>

<?php
$servername = "ungias.com.mysql";
$username = "ungias_com_img";
$password = "ungias_com_img";
$dbname = "ungias_com_img";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users ORDER BY klasse";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo "
    <table style='width:100%; text-align:left'>
        <tr>
            <th>Navn</th>
            <th>Klasse</th>
            <th>Kode</th>
        </tr>
    ";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>" .
             "<td>" .
             $row["name"] . 
             "</td>" .
             "<td>" .
             $row["klasse"] . 
             "</td>" .
             "<td>" .
             $row["code"] . 
             "</td></tr>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>

<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 5px;
  font-size: 20px;
}

@media print
{
  table { page-break-after:auto }
  tr    { page-break-inside:avoid; page-break-after:auto }
  td    { page-break-inside:avoid; page-break-after:auto }
  thead { display:table-header-group }
  tfoot { display:table-footer-group }
}
</style>