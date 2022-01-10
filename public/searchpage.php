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

$search = $_SESSION['search'];
$searchparam = '%'.$search.'%';
$requete = $pdo -> prepare('SELECT * FROM party WHERE UPPER(Ville) LIKE UPPER(?) OR UPPER(Département) LIKE UPPER(?) OR UPPER(Title) LIKE UPPER(?)');
$requete->execute(array($searchparam, $searchparam, $searchparam));

$datas = $requete->fetchAll(PDO::FETCH_OBJ);


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
        <section class="affsoirée">
            <div class="annonce">
                <?php foreach($datas as $data): ?>
                    <article class="article">
                        <h2><?php echo htmlspecialchars($data->Title, ENT_QUOTES); ?><h2>
                        <p><?php echo htmlspecialchars($data->Description, ENT_QUOTES); ?></p>
                        <p><?php echo htmlspecialchars(date('d/m/Y', strtotime($data->Date)), ENT_QUOTES); ?></p>
                        <p><?php echo htmlspecialchars($data->Adresse, ENT_QUOTES); ?></p>
                        <p><?php echo htmlspecialchars($data->Ville, ENT_QUOTES); ?></p>
                        <button class="joinFav">Voir l'infos</button>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
</body>