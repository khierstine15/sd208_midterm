<?php 

$con;
    function connection(){
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db_users";
    
        $con = new mysqli($host,$username,$password,$dbname);
    
        if($con->connect_error){
            echo $con-> connect_error;
    
        }
        else{
            return $con;
        }
        
    }
    // Close connection
    function closeConnection()
    {
        global $con;
        $con->close();
    }
?>

