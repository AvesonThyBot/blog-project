<?php

setcookie('email', $email, time() - 86400); // 1 day, email
setcookie('is_logged_in', true, time() - 86400); // 1 day, logged in

header("Location:index.php");
