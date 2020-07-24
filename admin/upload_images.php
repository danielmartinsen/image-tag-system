<?php
	session_start();	if(!isset($_SESSION['login'])){
		header("Location: login.php");
    exit();
	}
?>

<link href="https://fonts.googleapis.com/css?family=Noto+Sans:700" rel="stylesheet">

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
<h1><a href="index.php"><-</a> &nbsp;&nbsp; LAST OPP BILDER</h1>
<br><br>

<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="files[]" multiple >
    <input type="submit" name="submit" value="Last opp">
</form>
</center>

<?php
if(isset($_POST['submit'])){
    // Include the database configuration file
    include_once 'dbConfig.php';

    // File upload configuration
    $targetDir = "../uploads/";
    $allowTypes = array('jpg','png','jpeg','gif');

    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    if(!empty(array_filter($_FILES['files']['name']))){
        foreach($_FILES['files']['name'] as $key=>$val){
            // File upload path
            $fileName = basename($_FILES['files']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;

            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                    // Image db insert sql
                    $insertValuesSQL .= "('".$fileName."', NOW()),";
                }else{
                    $errorUpload .= $_FILES['files']['name'][$key].', ';
                }
            }else{
                $errorUploadType .= $_FILES['files']['name'][$key].', ';
            }
        }

        if(!empty($insertValuesSQL)){
            $insertValuesSQL = trim($insertValuesSQL,',');
            // Insert image file name into database

            $sql = "INSERT INTO images (file_name, uploaded_on) VALUES $insertValuesSQL";

            if ($db->query($sql) === TRUE) {
                $errorUpload = !empty($errorUpload)?'Opplastnings error: '.$errorUpload:'';
                $errorUploadType = !empty($errorUploadType)?'Filtype error: '.$errorUploadType:'';
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
                $statusMsg = "Filene er lastet opp!".$errorMsg;
            } else {
                echo "Error: " . $sql . "<br>" . $db->error;
            }
        }
    }else{
        $statusMsg = 'Vennligst velg filene du vil laste opp!';
    }

    // Display status message
    echo "<br><br>";
    echo "<center><h4>";
    echo $statusMsg;
    echo "</h4></center>";
}
?>
