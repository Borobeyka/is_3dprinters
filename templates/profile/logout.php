<?php
    if(!isUserLogged()) redirect("/");
    setcookie("hash", "", time()-AUTH_SESSION_TIME, "/");
    redirect("/");
?>