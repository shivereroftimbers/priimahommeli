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

$sql = "INSERT INTO replies (parent, r_msg, r_user, r_time)
VALUES ('" . $_GET["parent"] ."','" . $_GET["r_msg"] ."','" . $_GET["r_user"] ."','" . $date ."')";

if ($conn->query($sql) === TRUE) {
    echo "New message sent successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 