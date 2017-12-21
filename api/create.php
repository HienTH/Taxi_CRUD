<?php
require 'db_config.php';

  $post = $_POST;

  $sql = "INSERT INTO orderform(orderid, name,mobile, email, date, pnr, orderfrom, orderto, status) VALUES('". $post['orderid']."', '". $post['name']."', '". $post['mobile']."','". $post['email']."','". $post['date']."','". $post['pnr']."','". $post['orderfrom']."','". $post['orderto']."','". $post['status']."')";
  mysqli_query("SET NAMES utf8;");
  $result = $mysqli->query($sql);

  $sql = "SELECT * FROM orderform Order by orderid desc";
  $result = $mysqli->query($sql);

  $data = $result->fetch_assoc();


echo json_encode($data);
?>