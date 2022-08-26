<?php
include './private/database.php';

if($_GET['id'] !== '' && $_GET['event'] !== ''){
    $id = $_GET['id'];
    $event = $_GET['event'];
    echo $id . $event;
    if($_GET['event'] == 'off'){
        $result = $connection->query("SELECT * FROM links WHERE `ID`='$id' AND `status` = 1");
        if($result->num_rows > 0){
            $result = $connection->query("UPDATE links SET `status`=0 WHERE `ID`='$id'");
            header('location:index.php?event=url_list');
        }
    }

    if($_GET['event'] == 'on'){
        $result = $connection->query("SELECT * FROM links WHERE `ID`='$id' AND `status`=0");
        if($result->num_rows >0){
            $result = $connection->query("UPDATE links SET `status`=1 WHERE `ID`='$id'");
            header('location:index.php?event=url_list');
        }
    }

}else {
    echo "wrong";
}


?>