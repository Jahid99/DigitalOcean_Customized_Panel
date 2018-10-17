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


if ($_SERVER['REQUEST_METHOD']=='POST') {
            $name =  trim($_POST['name']);
            $memory = trim($_POST['memory']);
            $image = trim($_POST['image']);
            $region = trim($_POST['region']);
            $number = trim($_POST['number']);



            if($image=='ubuntu-14'){
              $image = 'ubuntu-14-04-x64';
            }else{
              $image = 37363159;
            }


            for($m=1;$m<=$number;$m++){

              if($number>1){
                $created = $droplet->create($name.$m, $region, $memory, $image);
              }else{
                $created = $droplet->create($name, $region, $memory, $image);
              }

              


              sleep(4);

            }


            




            $_SESSION['message'] = 'Droplet Created Successfully';


 

            echo "<script>window.location='./'</script>"; 

            exit;

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
  <h2>Create New Droplet</h2>
  <form action="" method="POST">


    <div class="form-group">
      <label for="name">Name:</label>
      <p>Only valid hostname characters are allowed. (a-z, A-Z, 0-9, . and -) </p>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
    </div>

    <div class="form-group">
      <label for="memory">Image:</label>
       <select class="form-control" name="image">

        <option value="ubuntu-14">Ubuntu 14.x64</option>
        <option value="ubuntu-s">Ubuntu-s-1vcpu(Snapshot)</option>
        
      </select>
    </div>

    <div class="form-group">
      <label for="memory">Region:</label>
       <select class="form-control" name="region">

        <option value="nyc1">New York 1</option>
        <option value="nyc3">New York 3</option>
        <option value="sfo1">San Francisco 1</option>
        <option value="ams3">Amsterdam 3</option>
        <option value="sgp1">Singapore 1</option>
        <option value="lon1">London 1</option>
        <option value="fra1">Frankfurt 1</option>
        <option value="tor1">Toronto 1</option>
        <option value="blr1">Bangalore 1</option>
        
      </select>
    </div>

    <div class="form-group">
      <label for="memory">Memory:</label>
       <select class="form-control" name="memory">
        <!--<option value="512mb">512 MB</option> -->
        <option value="1gb">1 GB</option>
        <option value="2gb">2 GB</option>
        <option value="4gb">4 GB</option>
        
      </select>
    </div>
    
     <div class="form-group">
      <label for="name">Put the Number of Droplets u want to create:</label>
      <input type="number" class="form-control" id="name" placeholder="Enter the number" name="number" required min="1" value="1" max="200">
    </div>

   
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>
