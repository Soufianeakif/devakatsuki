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
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $servicep = $_POST['servicep'];
  $motif = $_POST['motif'];

  $stmt = $conn->prepare("SELECT * FROM client WHERE email=:email");
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $row1 = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($stmt->rowCount() > 0) {
    // email was found
    echo '<script type="text/JavaScript"> 
      if (window.confirm("Email déjà existant! Veuillez essayer avec un autre email.")) {
        window.location.href = "../add/index.php";
      }
    </script>';
  } else {
    // email was not found
    $sql = "INSERT INTO client (nom, prenom, email, servicep, motif) VALUES (:nom, :prenom, :email, :servicep, :motif)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':servicep', $servicep);
    $stmt->bindParam(':motif', $motif);

    if ($stmt->execute()) {
      echo '<script type="text/JavaScript"> 
        if (window.confirm("Client ajouté avec succès!")) {
          window.location.href = "../index.html";
        }
      </script>';
    } else {
      echo "Error: " . $sql . "<br>" . $stmt->errorInfo();
    }
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
    <title>DEV-AKATSUKI | ADD</title>
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
		<h2>Ajouter un client</h2>
		<input type="text" placeholder="Nom" name="nom" required>
		<input type="text" placeholder="Prénom" name="prenom" required>
		<input type="email" placeholder="Email@devakatsuki.ma" name="email" required>
		<input type="text" placeholder="Type de service" name="servicep" required>
		<textarea placeholder="Motif..." name="motif"></textarea>
		
		<button class="button-27" role="button" type="submit">Ajouter</button>
	</form>
  	</div>
	  <footer>By <span style="font-family: 'MyWebFont'; color: rgb(0, 0, 0);">DEV-AKATSUKI</span> TEAM 🖤</footer>
</body>
</html>