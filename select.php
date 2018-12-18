 <?php

$url1=$_SERVER['REQUEST_URI'];
header("Refresh: 30; URL=$url1");

$servername = "mysql.cc.puv.fi";
$username = "e1801117";
$password = "KQwMdChW87Zk";
$dbname = "e1801117_primapower";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT user, time, msg, file, id FROM messages ORDER BY id DESC LIMIT 100";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
       echo '<br><div class="asdf"><div>'.
            '<table class="levenna"><tr><td rowspan="2"><img class="naama" src="http://worldartsme.com/images/business-person-clipart-1.jpg"></td>'.   
            
            '<td><b>' . $row["user"]. 
            '</b> &#64; '. $row["time"].
            '</td></tr>'.
            
            '<tr><td><p class="viesti">'.
            $row["msg"];
            
        if ($row["file"] != 0){
            echo '<br>' . $row["file"];
        }
            
       echo '</p></td></tr></table></div>';

       //DELETE FROM `e1801117_primapower`.`messages` WHERE `messages`.`id` = 45;
        
        //if there are comments... 

        $rsql = "SELECT parent, r_user, r_time, r_msg, r_file, r_id FROM replies ORDER BY r_id";
        $rresult = $conn->query($rsql);

            while($rrow = $rresult->fetch_assoc()) {
                if ($row["id"] == $rrow["parent"]){
                echo '<div class="kommentti"><table><tr>'.
                
                '<td><b>' . $rrow["r_user"]. 
                '</b> &#64; '. $rrow["r_time"].
                '</td><td rowspan="2"><img class="naama" src="http://worldartsme.com/images/business-person-clipart-1.jpg"></td></tr>'.
                
                '<tr><td><p class="viesti">'.
                $rrow["r_msg"].
                '</p></td></tr></table></div><br>';
                }
            }

        //send a comment!!!

       echo '<script>
            function rsend' . $row["id"] . '(){
             if($("#r_msg' . $row["id"] . '").val() != 0){
                var r_user = localStorage.getItem("storedname");
                var r_msg = $("#r_msg' . $row["id"] . '").val();
                var parent = ' . $row["id"] . ';
        
        $.ajax({
             url: "http://www.cc.puv.fi/~e1801117/cgi-bin/primareply.php/",
             type: "GET", 
             data:"parent="+encodeURIComponent(parent)+"&r_msg="+encodeURIComponent(r_msg)+"&r_user="+encodeURIComponent(r_user)
        });;
       console.log("comment sent! parent:"+parent+" r_user:"+r_user+" r_msg:"+r_msg)
       document.getElementById("r_msg' . $row["id"] . '").value = "";
     }}</script>';
    
       echo '<textarea class="kfield" maxlength="512" id="r_msg' . $row["id"] . '" placeholder="Kirjoita kommentti" onkeypress="if(event.keyCode==13) {rsend' . $row["id"] . '();};"></textarea></td></div>';
    
    }
} else {
    echo "se on rikki ny.";
}

echo '<link rel="stylesheet" type="text/css" href="http://www.cc.puv.fi/~e1801117/koodausjuttuja/JohdatusohjelmointiinTKA/dat/primapower.css">'.
     '<script language="JavaScript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';


$conn->close();
?>