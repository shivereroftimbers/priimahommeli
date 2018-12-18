 <?php
$servername = "mysql.cc.puv.fi";
$username = "e1801117";
$password = "KQwMdChW87Zk";
$dbname = "e1801117_primapower";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$date = date("D d.m.Y h:i:s");
echo $date;

$sql = "INSERT INTO messages (msg, user, time)
VALUES ('" . $_GET["msg"] ."','" . $_GET["user"] ."','" . $date ."')";

if ($conn->query($sql) === TRUE) {
    echo "New message sent successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 