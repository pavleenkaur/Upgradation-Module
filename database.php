
<?php
    $conn = mysql_connect("localhost","root","") or die(mysql_error());
    $sql = "CREATE DATABASE IF NOT EXISTS upgradation";
    if(mysql_query($sql , $conn)){
        echo "Database Created Succesfully" ."</br>";
    }
    else{
        echo "Error creating database" ."</br>". mysql_error($conn);
    }

    mysql_select_db("upgradation" , $conn);

    $sql1 = "CREATE TABLE IF NOT EXISTS seatsDetails( 
        Branch text NOT NULL, 
        availableSeats int(11) NOT NULL)";

    if ( mysql_query($sql1,$conn))
        echo "Table created Succesfully1" ."</br>";
    else
        echo "Error creating Table 1"."</br>". mysql_error($conn);


    $sql1 = "CREATE TABLE IF NOT EXISTS studentDetails( 
        Name text NOT NULL, 
        EnrollmentNumber varchar(11) NOT NULL,
        Branch text NOT NULL,
        CPI text NOT NULL,
        preFirst text NOT NULL,
        preSecond text NOT NULL,
        preThird text NOT NULL,
        Allocated text)";

    if ( mysql_query($sql1,$conn))
        echo "Table created Succesfully2"."</br>";
    else
        echo "Error creating Table 2"."</br>". mysql_error($conn);

    $sql3 = "CREATE TABLE IF NOT EXISTS adminAccount( 
        email text NOT NULL,
        password text NOT NULL)";
    if ( mysql_query($sql3,$conn))
        echo "Table created Succesfully3"."</br>";
    else
        echo "Error creating Table 3"."</br>". mysql_error($conn);

    mysql_close($conn);
?>
