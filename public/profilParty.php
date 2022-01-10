<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=tts;charset=utf8','root', '');
if(empty($_SESSION['pseudo'])){
  header('Location: login.php');
};

if(!empty($_SESSION['pseudo'])){
    $href="/profil.php";
}else{
    $href ="/login.php";
};
$id = $_SESSION['id'];
$requete = $pdo->prepare('SELECT * FROM party where creatorId = ?');
$requete->execute(array($id));

$partys = $requete->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="/Logo.png" type="image/x-icon">
    <title>Accueil | Trouve-ta-soirée.fr</title>
</head>
<body>
    <header>
    </header>
    <nav class="head">
        <div class="nav-menu">
            <a class="txtlogo nav-para" href="/index.php"><img src="/Logo.png" alt="" class="imglogo">Trouve-ta-soirée.fr</a>
            <a class="nav-para" href="/party.php"> Les soirées</a>
            <a class="nav-para" href="/etablissement.php"> Les établissements</a>
            <a class="nav-para" href="/city.php"> Les villes</a>
            <a class="nav-para" href="/favoris.php"> Les favoris</a>
            <a class="login nav-para" href=<?php echo $href ?>> <?php if(!empty($_SESSION['pseudo'])){echo $_SESSION['pseudo'];}else{echo "Login";} ?></a>
        </div>
    </nav>
    <main>
    <?php foreach($partys as $party): ?>
                    <article class="article">
                        <h2><?php echo htmlspecialchars($party->Title, ENT_QUOTES); ?><h2>
                        <p><?php echo htmlspecialchars($party->Description, ENT_QUOTES); ?></p>
                        <p><?php echo htmlspecialchars(date('d/m/Y', strtotime($party->Date)), ENT_QUOTES); ?></p>
                        <p><?php echo htmlspecialchars($party->Adresse, ENT_QUOTES); ?></p>
                        <p><?php echo htmlspecialchars($party->Ville, ENT_QUOTES); ?></p>
                        <button class="joinFav">Voir l'infos</button>
                    </article>
                <?php endforeach; ?>
    </main>
    <footer>
        <div class="copyright">
            © Copyright <?php echo date("Y");?>
        </div>
    </footer>
</body>
