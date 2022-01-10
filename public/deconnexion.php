<?php  
session_start();
$_SESSION = array();
session_destroy();

header('Location: index.php')
?>
<!DOCTYPE html>
<html lang="fr">