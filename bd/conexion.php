<?php
/*** db mariadb marianame***/

$hostname = 'localhost';//servidor dgi

//$hostname = 'localhost'; //Locale



/*** db maria username ***/

$username = 'root';

//$username = 'root';
//$username = "localhost";
//$username = 'holkan';


/*** db maria password ***/
$password = '';//serverdgi
//$password = 'rootdgi2015';//serversei
//$password ='h0lk4nmx'; //localhost lap 
//$password = 'H0lk4N2015';


try {
  
  $dbh = new PDO("mysql:host=$hostname;dbname=bd_dgi", $username, $password); //server dgi
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->exec("set names utf8");
    return $dbh;
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }


?>
