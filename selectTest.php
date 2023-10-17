<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "speedTestDB";
$reps = 20; 

# read those 100 000 lines from the table, (they should be random values between 1 and 1000)
# first filter in php, then filter on the database. 

/*
#mySQLi
$conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

for($y=0; $y<$reps; $y++){
    
    $starttime = microtime(true);
    
    $sql = "SELECT * FROM testdata where number=500";
    $result = $conn->query($sql);
    $count=0; 
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if($row["number"]==500){
          // echo "id: " . $row["id"] . "<br>";
            $count++; 
        }
        
    }
    } else {
        echo "0 results";
    }
    
    $endtime = microtime(true); 
    $timediff = ($endtime - $starttime) * 1000; 
    echo "$count values found in $timediff ms<br>";
}
$conn->close();
/*
*/
# pdo 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
try {
    for($y=0; $y<$reps; $y++){
        // now re-opening the connection at each repetition
        $starttime = microtime(true);
        
        
        $stmt=$conn->prepare("select * from testdata where number=500");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute(); 
        $count=0; 
        while($row=$stmt->fetch()){
            if($row["number"]==500){
                # echo "id: " . $row["id"] . "<br>";
                $count++; 
            }
        }
            
        
        $endtime = microtime(true); 
        $timediff = ($endtime - $starttime) * 1000; 
        echo "$count pdo values found in $timediff ms<br>";
        
    }
    
  } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }
  $conn = null;
  /*
  */
  