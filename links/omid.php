<?php $file = 'omid';
                    $send_link = 'https://digikala.com';
                    
                    
                    include "./../private/database.php";
                    include "./../private/jdf.php";
                    
    
                    $result = $connection->query("SELECT * FROM links WHERE `link_address` = '$file' AND `status` =1");
                  
                    if($result->num_rows >0){
                        header("location:$send_link");
                    }else {
                        header("location:../index.php");
                    }
    
                    ?>