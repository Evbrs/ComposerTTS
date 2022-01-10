<?php  
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=tts;charset=utf8','root', '');
$error = "";
if(!empty($_SESSION['pseudo'])){
    $href="/profil.php";
}else{
    $href ="/login.php";}
    
if(isset($_POST['submit'])){
    if(!empty($_POST['Email']) AND !empty($_POST['mdp'])){
        $email = htmlspecialchars($_POST['Email']);
        
        $requete = $pdo->prepare('SELECT idusers, fname, password, email  FROM users WHERE email = ?');
        $requete->execute(array($email));
        
        $data = $requete->fetch(PDO::FETCH_OBJ);

        $id = $data->idusers;
        $mdp = $data->password;
        $username = $data->fname;
        $inputMdp = $_POST['mdp'];
        if(password_verify($inputMdp, $mdp)){
            $_SESSION['id'] = $id;
            $_SESSION['pseudo'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['mdp'] = $inputMdp;
            header('Location: profil.php');
        }
        else{
            $error = "votre mdp ou email n'est pas bon";
        }
    }else{
        $error= "Veuillez completer tous les champs...";
    }
}

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
    <title>profil | Trouve-ta-soirée.fr</title>
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
            <a class="login nav-para" href="<?php $href ?>"> <?php if(!empty($_SESSION['pseudo'])){echo $_SESSION['pseudo']; $href="/profil.php";}else{echo "Login"; $href ="/login.php";} ?></a>
        </div>
    </nav>
    <main>
        <form method="POST">
            <input class="FormsRow 2row" type="email" placeholder="Email" name="Email">
            <input class="FormsRow 2row passwd" type="password" placeholder="Mot de Passe" name="mdp">
            <?php echo $error?>
            <button class="Validate" name="submit">Valider</button>
        </form>

        <p class="Accredirect">Vous n'avez pas de compte ? Créez en un <a href="/acccreate.php">ici</a></p>
    </main>
    <footer>
        <div class="copyright">
            © Copyright <?php echo date("Y");?>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
