<head>
    <meta charset="utf-8">
    <title> BE PHP </title>
</head>

<?php
include("config.php");
session_start();
$status = "";
if (($_SERVER["REQUEST_METHOD"] == "POST") and ($_POST["lastName"] !== "") and ($_POST["password"] !== "")) {
    // username and password sent from form 

    $mylastname = $_POST['lastName'];
    $mypassword = $_POST['password'];
    $requete = "SELECT idpersonne, libraire FROM `personnes` WHERE nom='$mylastname' AND password='$mypassword'";
    $statement = $pdo->query($requete);
    $arrayResultat = $statement->fetch();
    if (empty($arrayResultat)){
        $status = "Your Login Name or Password is invalid";
    }
    else {
        $_SESSION['user_id'] = $arrayResultat['idpersonne'];
        $_SESSION['is_libraire'] = $arrayResultat['libraire'];
        $status = "Connecté";
        
    }
}
?>

<link rel="stylesheet" type="text/css" href="style.css">

<body>
    <h1 id="titre"> Bienvenue ! </h1>
    <?php include "navbar.php"; ?>
    <h1>Connexion</h1>

    <form method="POST" action="">
        <h4>Nom de famille</h4>
        <input type="text" name="lastName" required/>
        <h4>Mot de passe</h4>
        <input type="text" name="password" required/>
        <div></div>
        <input type="submit" value="Se connecter" />
    </form>

    <div> 
        <?php echo $status;?>
    </div>

    <?php include "footer.html"; ?>
</body>