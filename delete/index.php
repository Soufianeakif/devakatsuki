<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_devakatsuki";
// Create connection
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $email = $_POST['email'];

  $sql = "DELETE FROM client WHERE email=:email";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':email', $email);

  if ($stmt->execute()) {
    echo '<script type="text/JavaScript"> 
    if (window.confirm("Client supprimé avec succès!")) {
      window.location.href = "../index.html";
    }
    </script>';
  } else {
    echo "Error: " . $sql . "<br>" . $stmt->errorInfo();
  }

  $conn = null;
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