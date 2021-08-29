<?php

# Author: maciejel
# https://maciejel.pl
# discord: maciejel#9493

session_start();
$url = explode('/', $_SERVER['REQUEST_URI']);
$url = array_filter($url);

if($url[2]){
    include('config.php');
    include('functions.php');
    $stmt = $connection->prepare("SELECT link, custom_url FROM redirects WHERE custom_url = ?");
    $stmt->execute([
        $url[2]
    ]); 
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    if($result[0]['link']) {
        redirect($result[0]['link']);
    } else {
        redirect($domain);
    }
}

if(!$url[2]):
    if(isset($_SESSION['info'])) {
        echo $_SESSION['info'];
        unset($_SESSION['info']);
    }
?>
<form action="insert.php" method="post">
    <label for="link">Long link</label><br>
    <input type="text" name="link" required><br>
    <label for="custom_url">Personalized link</label><br>
    <input type="text" name="custom_url"><br>
    <input type="submit" value="Potwierdź">
</form>
<? endif; ?>