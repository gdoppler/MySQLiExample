<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "speedTestDB";
$reps = 15; 

/*
#mySQLi
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

for($y=0; $y<$reps; $y++){
    $numValues = 1000; 
    $starttime = microtime(true);
    $stmt=$conn->prepare("insert into testdata(number) values(?)");
    for($x=0; $x<$numValues;$x++){
        $n=rand(1,1000);
        $stmt->bind_param("i",$n);
        $stmt->execute(); 
    }
    $endtime = microtime(true); 
    $timediff = ($endtime - $starttime) * 1000; 
    echo "$numValues inserted in $timediff ms<br>";
}
$conn->close();

/*
1000 inserted in 1446.888923645 ms
1000 inserted in 1370.5430030823 ms
1000 inserted in 1127.4120807648 ms
1000 inserted in 1081.9520950317 ms
1000 inserted in 1067.4901008606 ms
1000 inserted in 1548.6009120941 ms
1000 inserted in 1538.9828681946 ms
1000 inserted in 1527.1718502045 ms
1000 inserted in 1578.2191753387 ms
1000 inserted in 1534.5528125763 ms
1000 inserted in 1533.7829589844 ms
1000 inserted in 1424.2849349976 ms
1000 inserted in 1498.3329772949 ms
1000 inserted in 1709.2728614807 ms
1000 inserted in 1540.4779911041 ms
1000 inserted in 1300.076007843 ms
1000 inserted in 1879.6420097351 ms
1000 inserted in 1761.3809108734 ms
1000 inserted in 1406.0108661652 ms
1000 inserted in 1472.5198745728 ms

*/


#now with PDO 
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    for($y=0; $y<$reps; $y++){
        $numValues = 1000; 
        $starttime = microtime(true);
        $stmt=$conn->prepare("insert into testdata(number) values(:n)");

        $stmt->bindParam(":n",$n);
            
        for($x=0; $x<$numValues;$x++){
            $n=rand(1,1000);
            $stmt->execute(); 
        }
        $endtime = microtime(true); 
        $timediff = ($endtime - $starttime) * 1000; 
        echo "$numValues pdo inserted in $timediff ms<br>";
    }
    
  } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }
  
  $conn = null;

  /*
1000 pdo inserted in 1252.2201538086 ms
1000 pdo inserted in 1562.9518032074 ms
1000 pdo inserted in 1619.1589832306 ms
1000 pdo inserted in 1897.2828388214 ms
1000 pdo inserted in 1835.254907608 ms
1000 pdo inserted in 1623.3038902283 ms
1000 pdo inserted in 1517.6608562469 ms
1000 pdo inserted in 1560.8170032501 ms
1000 pdo inserted in 1352.1509170532 ms
1000 pdo inserted in 1397.1400260925 ms
1000 pdo inserted in 1670.832157135 ms
1000 pdo inserted in 1618.1390285492 ms
1000 pdo inserted in 1273.9479541779 ms
1000 pdo inserted in 1170.902967453 ms
1000 pdo inserted in 1818.1610107422 ms
1000 pdo inserted in 1578.1869888306 ms
1000 pdo inserted in 1499.5529651642 ms
1000 pdo inserted in 1560.01496315 ms
1000 pdo inserted in 1509.0811252594 ms
1000 pdo inserted in 1783.7898731232 ms
  */