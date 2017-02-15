
<html>
    <head>
       <title>Registration Page</title>
    </head>
    <style>
        body
        {
            margin:0px;
            background-color:#848484;
        }
        h1 
        {
            background-color:white;
            padding:30px;
        }
        form
        {
            padding-left:10px;
            padding-top:10px;
            padding-bottom:10px;
            margin-top:80px;
            margin-left:580px;
            margin-right:580px;
            background-color:white;
            font-size:30px;
        }
        input
        {
            width: 250px;
            font-size: 15px;
        }
        a{
            margin-left: 600px;
        }
        button
        {
            width: 80px;
            height: 30px;
        }
    </style>
    <body>
        <h1>Register Here</h1>
        <form action="register.php" method="POST">
            Name : <input type="text" name="username" placeholder="Enter your Name" required="required"><br>
            Enrollment Number : <input type="number" name="enrollmentNo" placeholder="Enter your Enrollment Number" required="required"><br>
            Branch : <input type="text" name="branch" placeholder="Enter your Branch" required="required"><br>
            CPI :<br> <input type="number" step="any" name="cpi" placeholder="Enter your CPI" required="required"><br>
            First Preference : <input type="text" name="firstPre" placeholder="Enter your first preference" required="required"><br>
            Second Preference : <input type="text" name="secondPre" placeholder="Enter your second preference"><br>
            Third Preference : <input type="text" name="thirdPre" placeholder="Enter your third preference" ><br>
            <button type=“button”>Register</button>
       </form>
       <a href = "index.php">Click here to Login</a>
    </body>
</html>
<?php

    if( $_SERVER["REQUEST_METHOD"] == "POST" )
    {
        $username = mysql_real_escape_string($_POST["username"]);
        $enrollmentNo = mysql_real_escape_string($_POST["enrollmentNo"]);
        $branch = mysql_real_escape_string($_POST["branch"]);
        $cpi = mysql_real_escape_string($_POST["cpi"]);
        $firstPre = mysql_real_escape_string($_POST["firstPre"]);
        $secondPre = mysql_real_escape_string($_POST["secondPre"]);
        $thirdPre = mysql_real_escape_string($_POST["thirdPre"]);

        $bool=true;

        mysql_connect("localhost","root","") or die (mysql_error());
        mysql_select_db("upgradation") or die("Cannot connect to Database");
        $query=mysql_query("Select * from studentDetails");
        while($row=mysql_fetch_array($query))
        {
            $table_users = $row["EnrollmentNumber"];
            if ( $enrollmentNo == $table_users )
            {
                $bool=false;
                Print '<script>alert("Enrollment Number already registered");</script>';
                Print '<script>Window.location.assign("register.php");</script>';
            }
        }

        if($bool)
        {
            mysql_query(" INSERT INTO studentDetails( Name, EnrollmentNumber, Branch, CPI, preFirst, preSecond, preThird ) VALUES ( '$username', '$enrollmentNo', '$branch', '$cpi', '$firstPre', '$secondPre', '$thirdPre' ) ");
            Print '<script>alert("Succesfully registered");</script>';
            //header("location: index.php");
           Print '<script>Window.location.assign("register.php");</script>';
        }
    }
?>