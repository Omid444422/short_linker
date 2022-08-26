<?php
include './private/database.php';
include './private/jdf.php';
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <!-- bootstrap link-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    </head>
    <body>

        <a href="index.php">link creator</a>
        <a href="index.php?event=url_list">show url list</a>




    <?php
    
    
    $error = '';
    $success = '';
    $link = '';
        if(isset($_POST['btn_submit'])){
            if(isset($_POST['txt_short_link']) && $_POST['txt_short_link'] !== '' 
            && isset($_POST['txt_send']) && $_POST['txt_send'] !== ''){

            //short name | short link
            $short_link = strtolower(trim($_POST['txt_short_link']));
            // where link you want to send user
            $send_link = $_POST['txt_send'];

            if(file_exists("./links/$short_link.php")){
                $error = 'این نام قبلا استفاده شده لطفا از نام دیگری استفاده کنید !';
            }else {
            
                $result = $connection->query("SELECT * FROM links WHERE link_address ='$short_link'");

                if($result->num_rows == 0){

                    $time = jdate('H:i:s O ,l, j F Y');
                    $push_data = $connection->query("INSERT INTO links 
                    (`ID`,`creator`,`link_address`,`link_url`,`create_time`,`status`)
                    VALUES (NULL,'admin','$short_link','$send_link','$time',1)");
                    



                    $file = fopen("./links/$short_link.php",'w') or die($error = 'عملیات با شکست مواجه شد لطفا مجدد تلاش کنید');
                    $text = "<?php \$file = '$short_link';
                    \$send_link = '$send_link';
                    ".'
                    
                    include "./../private/database.php";
                    include "./../private/jdf.php";
                    
    
                    $result = $connection->query("SELECT * FROM links WHERE `link_address` = '."'\$file'".' AND `status` =1");
                  
                    if($result->num_rows >0){
                        header("location:$send_link");
                    }else {
                        header("location:../index.php");
                    }
    
                    ?>';
                    fwrite($file,$text);
                    fclose($file);



                    $success = 'عملیات با موفقیت انجام شد';
                    $link = "<span class='alert-success p-2 m-2'>"."localhost:4444/short_linker/"."links/".$short_link.".php"."</span>";
                }else {
                    $error = 'این لینک قبلا استفاده شده است';
                }
              
            }
        }else {
            $error = 'لطفا فرم را پر کنید';
        }
        }
    
    ?>
    
        <?php  if(!isset($_GET['event'])){ ?>
    <div class="container-fluid row justify-content-center mt-5">
            <div class="col-8 bg-light mt-3">
                <form action="./index.php" method="POST">
            <label class="form-label" for="txt_short_link">لینک کوچیک شده</label>
            <input type="text" name="txt_short_link" class="form-control">
            <br>
            <label class="form-label" for="txt_send">آدرس مورد نظر</label>
            <input type="text" name="txt_send" class="form-control">
            <hr>
            <button type="submit" name="btn_submit" class="btn btn-success">ارسال</button>
                </form>
                <?php }?>
                <br>
                <?php if($error !== ''){ ?>
                <span class="alert-danger p-2 m-2d"><?php echo $error; ?></span>
                <?php }?>

                <?php if($success !== ''){ ?>
                <span class="alert-success p-2 m-2d"><?php echo $success; ?></span>
                <?php }?>


                <?php if($link !== ''){ ?>
                    <?php echo $link; ?>
                <?php }?>
            </div>
    </div>







    <div class="container-fluid row justify-content-center mt-5">
    <div class="col-10">
                        
                    
                        <?php 
                        
                        if(isset($_GET['event']) && $_GET['event'] === 'url_list'){
                                 ?>
    
    <table class="table table-dark">
                    <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">creator</th>
          <th scope="col">link address</th>
          <th scope="col">send user link</th>
          <th scope="col">create time</th>
          <th scope="col">status</th>
          <th scope="col">events</th>
    
        </tr>
      </thead>
      <tbody>
                          <?php  $get_links = $connection->query("SELECT * FROM links");
    
                            if($get_links->num_rows >0){
                                while($links = $get_links->fetch_assoc()){
                        ?>
     
        <tr>
          <th scope="row"><?php echo $links['ID']; ?></th>
          <td>
            <?php echo $links['creator']; ?>
          </td>
    
          <td>
          <a href="./links/<?php echo $links['link_address']; ?>.php"><?php echo $links['link_address']; ?></a>
          </td>
    
          <td>
          <a href="<?php echo $links['link_url']; ?>"><?php echo $links['link_url']; ?></a>
          </td>
    
          <td>
         <?php echo $links['create_time']; ?>
          </td>
    
          <td>
         <?php echo $links['status']; ?>
          </td>
    
          <td>
            <a class="btn btn-danger" href="event.php?event=delete&id=<?php echo $links['ID']?>">delete</a>
                     <?php if($links['status'] == 1){ ?>
                 <a class="btn btn-warning" href="event.php?event=off&id=<?php echo $links['ID']?>">turn off</a>
                        <?php }else{?>
                <a class="btn btn-warning" href="event.php?event=on&id=<?php echo $links['ID']?>">turn on</a>
                            <?php }?>
            </td>
        </tr>
    
                                    <?php }}}?>
    
                                    </tbody>
    </table>
    
    
            </div>
    </div>












    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    </body>
</html>