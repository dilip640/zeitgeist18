<?php
    require_once 'gsign/vendor/autoload.php';
  //require_once '../include/include.php';
 require 'gsign/PHPMailer/PHPMailerAutoload.php';
 
  error_reporting(E_ALL);
ini_set('display_errors', 'on');

  
      $mysql_pass = "ZeitgeistDb"; // or $mysql_pass = "thisispass"
      $mysql_user = "zeitgeist_z18_user1"; // or $mysql_user = "ausr";
      $servername = "localhost"; //
      $conn = new mysqli($servername, $mysql_user, $mysql_pass, "zeitgeist_z18_entries");

if(isset($_POST['eid'])&&isset($_POST['idtok'])){
    
  $idtoken = $_POST['idtok'];
  if($idtoken!=''){
  $CLIENT_ID = "204692535692-ipmo50umbbcrau57dkpfmkhrh7ah540q.apps.googleusercontent.com";
  $client = new Google_Client(['client_id' => $CLIENT_ID]);
  $payload = $client->verifyIdToken($idtoken);

  if($payload) {
    // $userid = $payload['sub'];
    //print_r($payload);
    
   $em =  $payload['email'];
    
  
    $eid = $_POST['eid'];
    $fnd = 0;
    $ename = '';
    $ft = mysqli_query($conn,"Select * from events where id = '$eid'");
	  while($fta = mysqli_fetch_array($ft)){
	      $mnp = $fta['min_pat'];
	      $mx = $fta['max_pat'];
	      $ename = $fta['ename'];
	      $fee = $fta['fee'];
	      $fnd=1;
	      $solo=$fta['solo'];
	 }
	  
    $tnm = $_POST['tname'];
    $contct = $_POST['contact'];
    $cllg = $_POST['cllg'];
    $crref = $_POST['crref'];
    
    $nmvr = $_POST['nms'];
   // echo $tnm.$contct.$cllg.$em.$nmvr.$eid;
    if($eid&&$tnm&&$contct&&$cllg&&$em&&$nmvr&&$fnd){
        $pers = explode('_',$nmvr);
        $nms = array();
        $acnm = array();
        $acgn = array();
        $acdy = array();
        $gens = array();
        $amount = $fee;
        if($solo)$acf=300;else $acf=250;
        $acco = array();
        $prcd=0;
        if(sizeof($pers)<$mnp)$prcd=1;
        if(sizeof($pers)>$mx)$prcd=2;
        if(sizeof($pers)>0&&$prcd==0){
            for($i=0;$i<sizeof($pers);$i++){
                $tmper = explode('#',$pers[$i]);
                $nms[$i] = $tmper[1];
                $gens[$i] = $tmper[2];
                if($tmper[3]||$tmper[4]||$tmper[5]){
                  array_push($acnm,$tmper[1]);
                  array_push($acgn,$tmper[2]);
                  $dy = $tmper[3]."#".$tmper[4]."#".$tmper[5];
                  array_push($acdy,$dy);
                  $acfee = $acf*$tmper[3]+$acf*$tmper[4]+$acf*$tmper[5];
                  $amount+=$acfee;
                  
                }
                
                
            }
        }
        
        if($amount==0){
            date_default_timezone_set('Asia/Kolkata');
            $dt = date('d-m-Y H:i');
            $nm = implode('#',$nms);
            $rf=0;
            $gen = implode('#',$gens);
            $sqll = mysqli_query($conn,"insert into events_entries values('','$eid','$tnm','$nm','$gen','$contct','$cllg','$crref','$dt','$amount','$em',0,2)");
            $ftm = mysqli_query($conn,"Select id from events_entries where email = '$em' and dates = '$dt'");
        	  while($ftam = mysqli_fetch_array($ftm)){
        	      $rf = $ftam['id'];
        	  }
        	 $rf=$ename."_".$rf;
        	 
            if($sqll){
                 $mail = new PHPMailer();
                  $mail->IsSMTP();
                  $mail->Host = 'smtp.gmail.com';
                  $mail->Port = 587;
                  $mail->SMTPSecure = 'tls';
                  $mail->SMTPAuth = true;
                  $mail->Username = 'zeitgeist.pr@iitrpr.ac.in';
                  $mail->Password = 'winteriscoming';
                  $mail->setFrom('zeitgeist.pr@iitrpr.ac.in', 'ZEITGEIST, IIT Ropar');
                  $mail->addAddress($em);
                  $mail->Subject = 'Referral code for zeitgeist';
                  $mail->Body = implode("\r\n", array('Thank You',
                  'You have been successfully registered for '.$ename.' for Zeitgeist 2018.',
                  'We are excited for your journey with us.',
                  'Your referral code is '.$rf.".",
                  'CR Policy : https://www.zeitgeist.org.in/cr/CR%20Policy.pdf',
                  '',
                  'Team Zeitgeist',
                  'Indian Institute of Technology (IIT), Ropar',
                  'Rupnagar, Punjab, 140001'));
                  $mail->send();
            }
            
            echo "1";
        }
      // echo implode('#',$nms)."  ".implode('#',$gens)."  ".implode('#',$acnm)."  ".implode('#',$acgn)."  ".implode('#',$acdy)."  ".implode('#',$acco)."  ".$amount."  ".$em;
    }
}
}

}



?>