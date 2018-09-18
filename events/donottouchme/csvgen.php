<?php

    $mysql_pass = "ZeitgeistDb"; // or $mysql_pass = "thisispass"
    $mysql_user = "zeitgeist_z18_user1"; // or $mysql_user = "ausr";
    $servername = "localhost"; //
    $conn = new mysqli($servername, $mysql_user, $mysql_pass, "zeitgeist_z18_entries");
    
    $data = 'name,college,email,id,cr_time,phone,referral' . "\n";
    
    $ft = mysqli_query($conn,"Select * from ca_tb ");
	  while($fta = mysqli_fetch_array($ft)){
	      $data .='"'.$fta['name'].'"'.','. '"'.$fta['college'].'"'.','. '"'.$fta['email'].'"'.','. '"'.$fta['id'].'"'.','. '"'.$fta['cr_time'].'"'.','. '"'.$fta['phone'].'"'.','. '"'.$fta['referral'].'"'."\n";
	  }



 
$f = fopen('crdata.csv' , 'wb');
fwrite($f , $data );
fclose($f);

$file = 'crdata.csv'; 

header("Content-Description: File Transfer"); 
header("Content-Type: application/octet-stream"); 
header("Content-Disposition: attachment; filename='" . basename($file) . "'"); 

readfile ($file);
exit(); 

?>