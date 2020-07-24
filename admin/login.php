<?php
session_start();

if ( isset($_SESSION['login'])!="" ) {
	header("Location: index.php");
	exit;
}

$pass = $_POST['pass'];

if($pass == "admin123")
{
        header("Location: index.php");
        $_SESSION['login'] = "OK";
}
else
{
    if(isset($_POST))
    {?>
    
            <center>
    
            <br><br><br>
            
            <h1>Logg inn!</h1>

            <br>

            <form method="POST" action="">
                <input type="password" name="pass" placeholder="Passord"></input>
                <br><br>
                <input type="submit" name="submit" value="Login"></input>
            </form>
            
    <?}
}
?>

<style>
* {
  background-color: #0A466E;
}

h1, h2, h3, h4, h5, h6 {
  font-family: 'Poppins', sans-serif;
  color: white;
}

input {
  height: 50px;
  width: 330px;
  border: 1px solid #FF6340;
  border-radius: 5px;
  background-color: #FFE0D9;
  outline: none;
  padding: 10px;
  font-size: 20px;
  color: #3d3d3d;
  font-weight: 900;
}
</style>

</center>