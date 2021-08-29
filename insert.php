<?php

# Author: maciejel
# https://maciejel.pl
# discord: maciejel#9493

session_start();

if(isset($_POST['link'])) {
    include('config.php');
    include('functions.php');
    $custom_url = $_POST['custom_url'];
    if(empty($custom_url)) {
        $custom_url = randomStr();
    }
    if(str_starts_with($_POST['link'], 'http')) {
        $stmt = $connection->prepare("SELECT link, custom_url FROM redirects WHERE custom_url = ?");
        $stmt->execute([
            $custom_url
        ]); 
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if(!$result[0]) {
            try {
                $sql = "INSERT INTO redirects (link, custom_url) VALUES (?,?)";
                $stmt= $connection->prepare($sql);
                $stmt->execute([
                    $_POST['link'],
                    $custom_url
                ]);
                $link = "$domain$custom_url/";
                $_SESSION['info'] = "<p style=\"color:#00FF00;\">Generated link: <a href=\"$link\">$link</a></p>";
                redirect($domain);
            } catch(PDOException $e) {
                echo '<br>PDO Error: ' . $e->getMessage();
            }
        } else {
            $_SESSION['info'] = "<p style=\"color:red\">Personalized link is already in use</p>";
            redirect($domain);
        }
    } else {
        $_SESSION['info'] = "<p style=\"color:red\">The link must start with http</p>";
        redirect($domain);
    }
}