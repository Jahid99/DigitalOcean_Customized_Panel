<?php 
  session_start();
  

 ?>



<?php

require 'vendor/autoload.php';


use DigitalOceanV2\DigitalOceanV2;
use DigitalOceanV2\Adapter\GuzzleAdapter;

// create an adapter with your access token which can be
// generated at https://cloud.digitalocean.com/settings/applications

require __DIR__ . '/config.php';

$adapter = new GuzzleAdapter(TOKEN);

// create a digital ocean object with the previous adapter
$digitalocean = new DigitalOceanV2($adapter);

$account = $digitalocean->account();

// return the Account entity
//$userInformation = $account->getUserInformation();



$droplet = $digitalocean->droplet();

$check = 0;


if ($_SERVER['REQUEST_METHOD']=='POST') {



           $ip =  trim($_POST['ip']);


$droplets = $droplet->getAll();

$droplets_sec_pages = $droplet->getAll(200,2);

$droplets_third_pages = $droplet->getAll(200,3);

$droplets_fourth_pages = $droplet->getAll(200,4);

$droplets_fifth_pages = $droplet->getAll(200,5);

           for($i=0;$i<count($droplets);$i++){

            if($droplets[$i]->networks[0]->ipAddress==$ip){
             
              $check = 1;
              
              $id = $droplets[$i]->id;
              
              break;
            }

           }

                      for($i=0;$i<count($droplets_sec_pages);$i++){

            if($droplets_sec_pages[$i]->networks[0]->ipAddress==$ip){
             
              $check = 1;
              
              $id = $droplets_sec_pages[$i]->id;
              
              break;
            }

           }
           

                      for($i=0;$i<count($droplets_third_pages);$i++){

            if($droplets_third_pages[$i]->networks[0]->ipAddress==$ip){
             
              $check = 1;
              
              $id = $droplets_third_pages[$i]->id;
              
              break;
            }

           }
           

                      for($i=0;$i<count($droplets_fourth_pages);$i++){

            if($droplets_fourth_pages[$i]->networks[0]->ipAddress==$ip){
             
              $check = 1;
              
              $id = $droplets_fourth_pages[$i]->id;
              
              break;
            }

           }
           

                      for($i=0;$i<count($droplets_fifth_pages);$i++){

            if($droplets_fifth_pages[$i]->networks[0]->ipAddress==$ip){
             
              $check = 1;
              
              $id = $droplets_fifth_pages[$i]->id;
              
              break;
            }

           }


           if($check == 1){
            $droplet->delete($id);
              $_SESSION['message'] = 'Droplet Deleted Successfully';

           sleep(2);

    //header('location: http://' . $_SERVER['SCRIPT_NAME']); 
    
    

    
    echo "<script>window.location='./'</script>";

    exit;

           }else{
            $_SESSION['red_message'] = 'IP did not match';


    //header('location: http://' . $_SERVER['SCRIPT_NAME']); 

    echo "<script>window.location='./'</script>";
    exit;
           }


            
          }









?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Digital Ocean</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">


  <h2>Enter IP to delete a Droplet</h2>


  <form action="" method="POST">


    <div class="form-group">
      <label for="ip">IP:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter ip" name="ip" required>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>

  </form>



  
</div>

</body>
</html>
