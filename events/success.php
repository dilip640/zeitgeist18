<?php

 require 'gsign/PHPMailer/PHPMailerAutoload.php';
 
  error_reporting(E_ALL);
ini_set('display_errors', 'on');

  
      $mysql_pass = "ZeitgeistDb"; // or $mysql_pass = "thisispass"
      $mysql_user = "zeitgeist_z18_user1"; // or $mysql_user = "ausr";
      $servername = "localhost"; //
      $conn = new mysqli($servername, $mysql_user, $mysql_pass, "zeitgeist_z18_entries");


function slug($data)
     {
         $data_slug = trim($data," ");
         $search = array('+','=','|','"',"'",',','&');
         $data_slug = str_replace($search, "", $data_slug);
         return $data_slug;
     }
$msg='';
$payid =$_GET['payment_request_id'];
$pyid=$_GET['payment_id'];

$l='';
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/'.$payid.'/'.$pyid.'/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

curl_setopt($ch, CURLOPT_HTTPHEADER,
             array("X-Api-Key:15008969d4902737458ad8ec76c9ed15",
                                "X-Auth-Token:d9c955533220c03f32781cdb762636ed"));

$response = curl_exec($ch);
curl_close($ch);

$get = explode('"',$response);

$ch=0;$r=0;$z=0;$l=0;$nn=0;
$g=sizeof($get);

for($i=0;$i<$g;$i++){
if($get[$i]=="longurl")$l=$get[$i+2];
if($get[$i]=="purpose")$z=$i;
if($get[$i]=="email")$r=$i;
if($get[$i]=="buyer_name"){ $nn=$i;}
if($get[$i]=="Failed"){ $ch=1;}
}

$email=$get[$r+2];
$pr=$get[$z+2];
$nname=$get[$nn+2];
$get2 = explode('_',$pr);

if($ch==1){
  $msg="Your transaction has been failed";
  $l="<br><a href=".$l." >Click here to try again (Save the url for future try)</a>";
  echo "<br>".$email."<br>".$nname."<br>".$msg."<br>".$get2[0]."+".$get2[1]."<br>".$l;
}
 else {
   $msg= "Payment successfully";
  $o=0;
  echo "<br>".$email."<br>".$nname."<br>".$msg."<br>".$get2[0]."+".$get2[1]."<br>";
  $l="<br><a href='http://advitiya.in/VbNvu5WaJ6/Website'>click here to Advitiya.in</a>";
  echo $l;
  $sqli = mysqli_query($conn,"UPDATE events_entries SET paid=1 WHERE id='$get2[1]'");
  
  if($sqli) echo "Thank you!";
}






 ?>
