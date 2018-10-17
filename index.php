<?php 
  session_start();
  

 ?>





<!DOCTYPE html>
<html lang="en">
<head>
  <title>Digital Ocean</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

  <style type="text/css">

  @media only screen and (max-width: 400px) {
   
    .pull-right {
    float: none!important;
}
}

  </style>

</head>
<body>


<div class="container">
 
    
<div class="pull-left"> <h2>Digital Ocean</h2>

    <p>Droplets:(<a href="new.php">Create New Droplet</a>)</p> 
    
    <p><a href="delete.php">Click Here</a> to Delete Droplet</p>
    
    </div>

  <center><div class="pull-right">
   <a href="ip.txt" class="btn btn-info" role="button" style="    margin-top: 30px;
    " download>Export all IPs to TXT File</a>
  </div></center>
  
</div><br>

<div class="container">
       
  

<?php 

  if(isset($_SESSION['message'])){ ?>
  <div class="alert alert-success" role="alert">

<center> <strong><?php echo $_SESSION['message']; ?></strong> </center>
 </div>

  <?php session_destroy(); }

 ?>  

<?php 

  $output = '';

  if(isset($_SESSION['red_message'])){ ?>
  <div class="alert alert-danger" role="alert">

<center> <strong><?php echo $_SESSION['red_message']; ?></strong> </center>
 </div>

  <?php session_destroy(); }

 ?>

       
       
  <table class="table table-bordered" id="myTable">
    <thead>
      <tr>
        <th>Name</th>
        <th>Memory</th>
        <th>Disk</th>
        <th>IP Address</th>
        <th>Created at</th>
        <!--<th>Delete</th>-->
      </tr>
    </thead>
    <tbody>

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

// if(isset($_GET['delete']) && $_GET['delete']!=''){

//     $id = $_GET['delete'];  

//     $droplet->delete($id);

//     $_SESSION['message'] = 'Droplet Deleted Successfully';


//     //header('location: http://' . $_SERVER['SCRIPT_NAME']); 

//     header('location: http://techjahid.com/digitalocean/'); 

//     //exit;

//   }

// $image = $digitalocean->image();

// // return a collection of Image entity
// $images = $image->getAll();

//$created = $droplet->create('the-name-4', 'nyc1', '512mb', 'ubuntu-14-04-x64');

$droplets = $droplet->getAll();

$droplets_sec_pages = $droplet->getAll(200,2);

$droplets_third_pages = $droplet->getAll(200,3);

$droplets_fourth_pages = $droplet->getAll(200,4);

$droplets_fifth_pages = $droplet->getAll(200,5);

// echo "<pre>";

// print_r($droplets);



?>

    <?php 



      for($i=0;$i<count($droplets);$i++){ ?>






    <tr>
        <td><?php echo $droplets[$i]->name;

        

         ?></td>
        <td><?php echo $droplets[$i]->memory; ?></td>
        <td><?php echo $droplets[$i]->disk; ?></td>
        <td><?php echo $droplets[$i]->networks[0]->ipAddress;

        $output.=$droplets[$i]->networks[0]->ipAddress." \n";

         ?></td>
         <td><?php echo $droplets[$i]->image->createdAt; ?></td>
        <!--<td> <a href="delete.php" title="Delete This Droplet" ><i class="fa fa-fw fa-trash" style="
    font-size: 30px;
"></i></a> </td> -->
      </tr>



<?php }


     ?>

      
       <?php 



      for($i=0;$i<count($droplets_sec_pages);$i++){ ?>






    <tr>
        <td><?php echo $droplets_sec_pages[$i]->name;

        

         ?></td>
        <td><?php echo $droplets_sec_pages[$i]->memory; ?></td>
        <td><?php echo $droplets_sec_pages[$i]->disk; ?></td>
        <td><?php echo $droplets_sec_pages[$i]->networks[0]->ipAddress;

        $output.=$droplets_sec_pages[$i]->networks[0]->ipAddress." \n";

         ?></td>
         <td><?php echo $droplets_sec_pages[$i]->image->createdAt; ?></td>
        <!--<td> <a href="delete.php" title="Delete This Droplet" ><i class="fa fa-fw fa-trash" style="
    font-size: 30px;
"></i></a> </td> -->
      </tr>



<?php }


     ?>



        <?php 



      for($i=0;$i<count($droplets_third_pages);$i++){ ?>






    <tr>
        <td><?php echo $droplets_third_pages[$i]->name;

        

         ?></td>
        <td><?php echo $droplets_third_pages[$i]->memory; ?></td>
        <td><?php echo $droplets_third_pages[$i]->disk; ?></td>
        <td><?php echo $droplets_third_pages[$i]->networks[0]->ipAddress;

        $output.=$droplets_third_pages[$i]->networks[0]->ipAddress." \n";

         ?></td>
         <td><?php echo $droplets_third_pages[$i]->image->createdAt; ?></td>
        <!--<td> <a href="delete.php" title="Delete This Droplet" ><i class="fa fa-fw fa-trash" style="
    font-size: 30px;
"></i></a> </td> -->
      </tr>



<?php }


     ?>


      <?php 



      for($i=0;$i<count($droplets_fourth_pages);$i++){ ?>






    <tr>
        <td><?php echo $droplets_fourth_pages[$i]->name;

        

         ?></td>
        <td><?php echo $droplets_fourth_pages[$i]->memory; ?></td>
        <td><?php echo $droplets_fourth_pages[$i]->disk; ?></td>
        <td><?php echo $droplets_fourth_pages[$i]->networks[0]->ipAddress;

        $output.=$droplets_fourth_pages[$i]->networks[0]->ipAddress." \n";

         ?></td>
         <td><?php echo $droplets_fourth_pages[$i]->image->createdAt; ?></td>
        <!--<td> <a href="delete.php" title="Delete This Droplet" ><i class="fa fa-fw fa-trash" style="
    font-size: 30px;
"></i></a> </td> -->
      </tr>



<?php }


     ?>


     <?php 



      for($i=0;$i<count($droplets_fifth_pages);$i++){ ?>






    <tr>
        <td><?php echo $droplets_fifth_pages[$i]->name;

        

         ?></td>
        <td><?php echo $droplets_fifth_pages[$i]->memory; ?></td>
        <td><?php echo $droplets_fifth_pages[$i]->disk; ?></td>
        <td><?php echo $droplets_fifth_pages[$i]->networks[0]->ipAddress;

        $output.=$droplets_fifth_pages[$i]->networks[0]->ipAddress." \n";

         ?></td>
         <td><?php echo $droplets_fifth_pages[$i]->image->createdAt; ?></td>
        <!--<td> <a href="delete.php" title="Delete This Droplet" ><i class="fa fa-fw fa-trash" style="
    font-size: 30px;
"></i></a> </td> -->
      </tr>



<?php }


     ?>


    </tbody>
  </table>
</div>

<?php 

  $myfile = fopen("ip.txt", "w")  ;


fwrite($myfile, $output);
fclose($myfile);


 ?>

<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>

  <script type="text/javascript">



    $(document).ready( function () {
    
   $('#myTable').dataTable( {
  "pageLength": 100,
  dom: 'Blfrtip',
        buttons: [
             
            {
                extend: 'csv',
                text: 'Export Filtered IPs to CSV File',
                exportOptions: {
                    columns: [ 3 ]
                }
            }
        ]
} );




} );

 





    </script>

</body>
</html>
