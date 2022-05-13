<?php
    require '../includes/init.php';

    $db = new Database();
    $conn =  $db->getConn();

    

    $sql = "SELECT *
        FROM items";

        

        $re = $conn->query($sql);

        $results = $re->fetchAll(PDO::FETCH_ASSOC);
        $r =json_encode($results);
        exit ($r);
?>




