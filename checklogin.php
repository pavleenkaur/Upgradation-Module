<?php

  session_start();
  $email = mysql_real_escape_string($_POST['email']);
  $password = mysql_real_escape_string($_POST['password']);
  mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
  mysql_select_db("upgradation") or die("Cannot connect to database"); //Connect to database
  $query = mysql_query("SELECT * from adminAccount WHERE email='$email'"); //Query the users table if there are matching rows equal to $email
  $exists = mysql_num_rows($query); //Checks if email exists
  $table_users = "";
  $table_password = "";
  if($exists > 0) //IF there are no returning rows or no existing email
  {
    while($row = mysql_fetch_assoc($query)) //display all rows from query
    {
      $table_users = $row['email']; // the first email row is passed on to $table_users, and so on until the query is finished
      $table_password = $row['password']; // the first password row is passed on to $table_users, and so on until the query is finished
    }
    if(($email == $table_users) && ($password == $table_password)) // checks if there are any matching fields
    {
          $_SESSION['user'] = $email;
          header("location: admin.php");
    }
    else
    {
      Print '<script>alert("Incorrect Password!");</script>'; //Prompts the user
      Print '<script>window.location.assign("index.php");</script>'; // redirects to login.php
    }
  }
  else
  {
    Print '<script>alert("Incorrect email!");</script>'; //Prompts the user
    Print '<script>window.location.assign("index.php");</script>'; // redirects to login.php
  }
?>