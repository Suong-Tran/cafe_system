<?php
$dbname = "humber";
$user = "root";
$password = "";

$dsn = "mysql:host=localhost;dbname=$dbname";

$dbcon =  new PDO($dsn,$user,$password);
$dbcon->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = "select * from student";

$pdostm = $dbcon->prepare($sql);

$pdostm->setFetchMode(PDO::FETCH_ASSOC);

$pdostm->execute();

//var_dump($pdostm->fetchAll());

foreach($pdostm as $student){
    echo "<li>" . $student["name"] . "</li>";
}

?>