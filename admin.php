
<html>
    <head>
       <title>Admin Page</title>
  </head>
    <style>
        body
        {
            margin:0px;
            background-color:#848484;
        }
        #header 
        {
            background-color:white;
            padding: 1px;
        }
        p{
          padding-left: 30px;
        }
        #btnCompute
        {
          width: 200px;
          height: 30px;
          font-size: 18px;
          margin-left: 550px;
        }
        #btnView
        {
          width:200px;
          height:30px;
          font-size: 18px;
          margin-left: 50px;
        }
        #btnSubmit{
          width:200px;
          height:30px;
          font-size: 18px;
          margin-left: 20px;
        }
        a
        {
          margin-left: 30px;
        }
        #myform
        {
          margin-left: 200px;
        }
        .log_table
        {
          width: 800px;
          margin-left: 300px;
        }
        
    }
    </style>
   <?php
   session_start(); //starts the session
   if($_SESSION['user']){ // checks if the user is logged in  
   }
   else{
      header("location: index.php"); // redirects if user is not logged in
   }
   $user = $_SESSION['user']; //assigns user value
   ?>
    <body>
       <div id="header">
        <p><b>Indira Gandhi Delhi Technical University for Women, Kashmere Gate</b><br>
        Upgradation Details</p>
      </div>
        <p >Hello <?php Print "$user"?>!</p>  <!--Display's user name-->
        <a href="index.php">Click here to go logout</a><br/>
         
        <form id="myform" action="admin.php" method="POST">
        </br>
            CSE : <input type="number" name="cse">
            IT : <input type="number" name="it">
            ECE : <input type ="number" name="ece">
            MAE : <input type="number" name="mae">
            <input id="btnSubmit" type="submit" name="submitseat" value="Submit Seats">
          </form>

            <form action="admin.php" method="POST">

          <input id="btnCompute" class="printable" type="submit" name="compute" value="Compute Upgrade Details"> 
          <input id="btnView" class="printable" type="submit" name="view" value="View Upgrade Details">  
        </form>

  </body>
</html>
<?php
        
    if ( isset($_POST['submitseat']))   // To enter the number of available seats in each branch
    {
       mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
       mysql_select_db("upgradation") or die("Cannot connect to database"); //Connect to database
       $cse = $_POST['cse'];
       $it = $_POST['it'];
       $ece = $_POST['ece'];
       $mae = $_POST['mae'];
       mysql_query("UPDATE seatsDetails set availableSeats='$cse' WHERE Branch='CSE'"); //Query the users table 
       mysql_query("UPDATE seatsDetails set availableSeats='$it' WHERE Branch='IT'");
       mysql_query("UPDATE seatsDetails set availableSeats='$ece' WHERE Branch='ECE'");
       mysql_query("UPDATE seatsDetails set availableSeats='$mae' WHERE Branch='MAE'");
 
       mysql_query("UPDATE studentDetails set Allocated='' WHERE CPI BETWEEN 0 AND 100");    // To update the number of the available seats in each branch

    }    
    if(isset($_POST['compute']))
    {
       mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
       mysql_select_db("upgradation") or die("Cannot connect to database"); //Connect to database
       $student = mysql_query("SELECT * from studentDetails ORDER BY CPI DESC"); //Query the Student Details Table
       //  $seat = mysql_query("SELECT * from seatsDetails");  // Query the Available seats Table
       $field[0] = mysql_field_name($student, 4);  // Name of the First Preference column. 
       $field[1] = mysql_field_name($student, 5);  // Name of the Second Preference column
       $field[2] = mysql_field_name($student, 6);
       
       while ($row = mysql_fetch_assoc($student) )
       {
          $i=0;
          $enrollNo = $row['EnrollmentNumber'];   // Erollment Number of the student
          $currentBranch = $row['Branch'];        // Current Branch of the student

          for ( ; $i<=2; $i++ )
          {
             $preference = $row["$field[$i]"]; // Extracting the Preference Column Names 

             $p = mysql_query("SELECT availableSeats from seatsDetails where Branch='$preference'");    // Computing the available seats for the preferred Branch
             $r = mysql_fetch_assoc($p);
             $w = $r['availableSeats'];

             if ( $w!=0)   //  Checking if the seats are available or not
             {
                mysql_query("UPDATE studentDetails SET Allocated='$preference' WHERE EnrollmentNumber='$enrollNo'");   // Allocated the preferred branch to the student
                mysql_query("UPDATE seatsDetails SET availableSeats=availableSeats - 1 WHERE Branch = '$preference'");   // Decreasing the seats in the Preferred branch
                mysql_query("UPDATE seatsDetails SET availableSeats=availableSeats + 1 WHERE Branch = '$currentBranch'");  // Increasing the seat in the current Branch
                break;
             }
          }
       }
    }

    if ( isset($_POST['view']))    // To view the details of the students who have been allocated the new branches
    {
       mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
       mysql_select_db("upgradation") or die("Cannot connect to database"); //Connect to database
       $student = mysql_query("SELECT * from studentDetails where Allocated!='' ORDER BY CPI DESC"); //Query the users table
       $table = '<table border="1" class="log_table" ><tr><th>Name</th><th>Enrollment Number</th><th>Current Branch</th><th>CPI</th><th>Allocated Branch</th></tr>';
       while ( $row = mysql_fetch_assoc($student))
       {
          $Name = $row['Name'];
          $EnrollmentNumber = $row['EnrollmentNumber'];
          $Branch = $row['Branch'];
          $CPI = $row['CPI'];
          $Allocated = $row['Allocated'];

          $table .="<tr><td>$Name</td><td>$EnrollmentNumber</td><td>$Branch</td><td>$CPI</td><td>$Allocated</td></tr>"; 
       } 
       echo $table;
       $table .='</table>';
       
    }
?>
