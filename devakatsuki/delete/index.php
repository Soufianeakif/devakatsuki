<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_devakatsuki";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$email = $_POST['email'];

$sql = "DELETE FROM client WHERE email='$email'";

if (mysqli_query($conn, $sql)) {
	echo '<script type="text/JavaScript"> 
	if (window.confirm("Client supprimé avec succès!")) {
	  window.location.href = "../index.html";
	}
  </script>';
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>DEV-AKATSUKI | DELETE</title>
</head>
<body>
    <a href="../index.html" class="logo">
		<img src="../devakatsuki.png" alt="">
	</a>

  	<input class="menu-icon" type="checkbox" id="menu-icon" name="menu-icon"/>
  	<label for="menu-icon"></label>
  	<nav class="nav"> 		
  		<ul class="pt-5">
			<li><a href="../index.html">Accueil</a></li>
  			<li><a href="../add/index.php">Ajouter un client</a></li>
  			<li><a href="../delete/index.php">Supprimer un client</a></li>
  		</ul>
  	</nav>

  	<div class="section-center">
	  <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

        <h2>Supprimer un client</h2>

		<input type="email" placeholder="Email@devakatsuki.ma" name="email">
		
		<button class="button-27" role="button" type="submit">Supprimer</button>

	</form>
  	</div>
	  <footer>By <span style="font-family: 'MyWebFont'; color: rgb(0, 0, 0);">DEV-AKATSUKI</span> TEAM 🖤</footer>
</body>
</html>