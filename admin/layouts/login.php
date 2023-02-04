<?php
if (isset($_SESSION['account'])) {
    if ($_SESSION['account'] = "active") {
        header('Location:./index.php');
    }
} else {
    header('Location: /login.php');
}
?>