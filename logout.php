<?php
    session_start();
    unset($_SESSION['niituser']);
    header('Location: index.php');
