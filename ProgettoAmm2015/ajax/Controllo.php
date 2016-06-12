<?php

require_once 'Sicurezza.php';

$usr = false;
$pw = false;

$users = new Sicurezza();

if (isset($_REQUEST['username'])) {
    if (!empty($_REQUEST['username'])) {
        echo "$('#username').removeClass('valido');";
        $controlloUsername = $users->controlloUsername($_REQUEST['username']);
        if ($controlloUsername === true) {
            $usr = true;
            echo "$('#username').addClass('valido');";
            echo "$('#username').html('username valido');";
        } else {
            echo "$('#username').html('$controlloUsername');";
        }
    } else {
        echo "$('#username').html('! - inserire l'username - !);";
    }
}

if (isset($_REQUEST['password'])) {
    if (!empty($_REQUEST['password'])) {
        echo "$('#password').removeClass('valido');";
        $controlloPassword = $users->controlloPassword($_REQUEST['password']);
        if ($controlloPassword === true) {
            $pw = true;
            echo "$('#password').addClass('valido');";
            echo "$('#password').html('password valida');";
        } else {
            echo "$('#password').html('$controlloPassword');";
        }
    } else {
        echo "$('#password').html('! - inserire la password - !');";
    }
}

if ($usr == true && $pw == true) {
    echo "$('#submit').attr('disabled',false);";
} 

else {
    echo "$('#submit').attr('disabled',true);";
}
?>