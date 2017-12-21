<?php
require 'db_config.php';


  $id  = $_POST["id"];
  $post = $_POST;

  $sql = " UPDATE orderform SET name= '". $post['name']."', mobile='". $post['mobile']."', 
  email='". $post['email']."', date='". $post['date']."', pnr='". $post['pnr']."', 
  orderfrom='". $post['orderfrom']."', orderto='". $post['orderto']."', 
  status='". $post['status']."' WHERE orderid = '".$id."' ";
  mysqli_query("SET NAMES utf8;");

  $result = $mysqli->query($sql);


  $sql = "SELECT * FROM orderform Order by orderid desc"; 

  $result = $mysqli->query($sql);

  $data = $result->fetch_assoc();


echo json_encode($data);
?>