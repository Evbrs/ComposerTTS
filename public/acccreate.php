
<?php  
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=tts;charset=utf8','root', '');
$message = "";

if(!empty($_SESSION['pseudo'])){
    $href="/profil.php";
}else{
    $href ="/login.php";
}

if(isset($_POST['submit'])){
    if(!empty($_POST['email']) AND !empty($_POST['mdp']) AND !empty($_POST['name']) AND !empty($_POST['prenom'])){
        $name = htmlspecialchars($_POST['name']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
        $enterprise = $_POST['entreprise'];
        

        $compare = $pdo->prepare('SELECT idusers FROM users WHERE email=?');
        $compare ->execute(array($email));
        $data = $compare->rowCount();
        

        if($data == 0){
            $requete = $pdo->prepare('INSERT INTO users(fname, lname, email, password, entreprise) VALUES (?,?,?,?,?)');
            $requete->execute(array($prenom, $name, $email, $mdp, $enterprise));
            header('Location: login.php');
        }else{
            $message = "Ce mail est déjà utilisé pour une autre compte"; 
        }
    }else{
        $message = "Veuillez compléter tout les champs.";
    }}
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
    <title>Nouveau compte | Trouve-ta-soirée.fr</title>
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
        <form method="POST" action="">
            <input class="FormsRow 1row" type="text" placeholder="Nom / Nom de l'entreprise " name="name" required>
            <input class="FormsRow 2row" type="text" placeholder="Prenom" name="prenom">
            <input class="FormsRow 2row" type="email" placeholder="Email" name="email" required>
            
            <input class="FormsRow 2row passwd" type="password" placeholder="Mot de Passe" name="mdp" required>
            <div class="checkent">
                <input type="checkbox" name="entreprise" value=1>
                <label for="entreprise" >Cochez cette case si vous êtes une entreprise.</label>
            </div>
            <button class="Validate" name="submit">Valider</button>
        </form>
        <?php echo $data;
        echo $row; ?>
        <p>Déjà un compte ? <a href="/login.php"> Identifiez-vous</a></p>
    </main>
    <footer>
        <div class="copyright">
            © Copyright <?php echo date("Y");?>
        </div>
    </footer>
</body>