<?php 

    $db = dbConnection();
    function dbConnection() : mysqli {
        $db = mysqli_connect('localhost', 'root', '', 'todo2', '3307');

        return $db;
    }

    if (!$db) {
        echo "hubo un error";
        exit;
    } 

    
?>
