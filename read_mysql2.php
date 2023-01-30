<?php
$servername = "localhost";
$username = "root";
$password = "mypassword";
$dbname = "HangLung";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) 
    {
      die("Connection failed: " . $conn->connect_error);
    }
$conn -> set_charset("utf8");

//從氣象站計算THI指數
$sql="SELECT id FROM RFID_error WHERE day= CURDATE()";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) 
{ 
     //輸出每行數據 
     while($row = $result->fetch_assoc()) 
     { 
        $array[] = $row['id'];
     } 
}
else
{ 
    $data = "0 個結果"; 
}

// //查看現場溫度
// $sql="SELECT * FROM P011_氣象站 WHERE barn='和榮意屠宰場' order by datetimes desc limit 1";
// $result = mysqli_query($conn, $sql);
// if ($result->num_rows > 0) 
// { 
//      //輸出每行數據 
//      while($row = $result->fetch_assoc()) 
//      { 
//         $data2=$row["temp"];
//         //echo (1.8*$row["temp"]+32) - (0.55*$row["rh"]/100)*((1.8*$row["temp"]+32)-58);
//      } 
// }
// else
// { 
//     $data2 = "0 個結果"; 
// }


// //合併資料
echo json_encode(array("error2" => $array));


$conn->close();
//echo $data;
/*while($row = mysqli_fetch_assoc($result)) 
    {
        echo $row["day"];
    };*/
//$data=json_encode($array, JSON_UNESCAPED_UNICODE);
//print_r($data);
?>