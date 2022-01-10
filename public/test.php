<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=tts;charset=utf8','root', ''); 

$requete = $pdo->prepare('SELECT * FROM departement');
    $requete->execute();

    $departs = $requete->fetchAll(PDO::FETCH_OBJ);
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
        <div class="msg"><?php echo $message ?? ''; ?></div>
        <form method="POST">
            <input class="FormsRow 1row" type="text" placeholder="Titre" name="title">
            
            <input class="FormsRow 2row" type="text" placeholder="Adresse" name="adresse">
            
            <input class="FormsRow 2row" type="text" placeholder="Code Postal" name="ville">

            <select name="departement" class="combo FormsRow 2row">
                <option value="">Selectionner un département</option>
                <?php foreach($departs as $depart): ?>
                    <?php $value = $depart->departement_nom ?>
                    <option value=<?php echo $value ?>><?php echo $value ?></option>
                <?php endforeach; ?>
            </select>
            
            <input class="FormsRow 2row" type="date" name="date">
            
            <textarea class="FormsRow 2row description" type="text" rows="5" name="description" ></textarea>
            <div class="checkpv">
                <input type="checkbox" id="private" name="Private" value=1>
                <label for="private">Cochez cette case si vous voulez que les infos soient privées.</label>
            </div>
            <button class="Validate" name="submit">Valider</button>
        </form>
        <?php if(isset($_POST['submit'])){
          echo $_POST['departement'];
          echo $_POST['Private'];
        } ?>
    </main>
    <footer>
        <div class="copyright">
            © Copyright <?php echo date("Y");?>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>