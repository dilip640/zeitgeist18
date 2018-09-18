<?php

  
      $mysql_pass = "ZeitgeistDb"; // or $mysql_pass = "thisispass"
      $mysql_user = "zeitgeist_z18_user1"; // or $mysql_user = "ausr";
      $servername = "localhost"; //
      $conn = new mysqli($servername, $mysql_user, $mysql_pass, "zeitgeist_z18_entries");
      
      $entry = $_GET['entry'];
      
      $amount = 10000;
      $phone = '';
      $email = '';
      
       $ft = mysqli_query($conn,"Select amount from events_entries where id = '$entry'");
    	  while($fta = mysqli_fetch_array($ft)){
    	      $amount = $fta['amount'];
    	      $phone = $fta['contact'];
    	      $email = $fta['email'];
    	      $entry = $fta['id'];
    	      $evid = $fta['ev_id'];
    	  }
    	  
      $purpose = "Event Registration_".$entry;
    	  
      $ft = mysqli_query($conn,"Select amount from accomodation where en_id = '$entry'");
    	  while($fta = mysqli_fetch_array($ft)){
    	      $amount += $fta['amount'];
    	  }
    	  
    	  
              $name=$email;
              $email = $email;

                $fee = $amount;

              $ch = curl_init();

              curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
              curl_setopt($ch, CURLOPT_HEADER, FALSE);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
              curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
              curl_setopt($ch, CURLOPT_HTTPHEADER,
                          array("X-Api-Key:15008969d4902737458ad8ec76c9ed15",
                                "X-Auth-Token:d9c955533220c03f32781cdb762636ed"));
              $payload = Array(
                      "purpose" => $purpose,
                      "amount" => $fee,
              		    "buyer_name" => $name,
              		    "phone" => $phone,
                      'send_email' => false,
                      "send_sms" => false,
                      "email" => $email,
                      'allow_repeated_payment' => false,
                      "redirect_url" => "https://www.zeitgeist.org.in/events/success.php",
              		    "webhook" => "https://www.zeitgeist.org.in/events/success.php"
                      );
              curl_setopt($ch, CURLOPT_POST, true);
              curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
              $response = curl_exec($ch);
              curl_close($ch);
              $get = explode('"',$response);
$p=0;
              $p=sizeof($get);
if($p>0){
              $z=0;
              for($i=0;$i<$p;$i++){
              if($get[$i]=="longurl") $z=$i;}

              $ge=$get[$z+2];
              echo $ge;
              header("Location:$ge");
}else{
echo "Redirect Failed<br>";
echo "Click on the link below to complete the payment and Enter Name : ".$purpose;
echo '<br><a href="https://www.instamojo.com/@advitiya2018/l1882e14d837d4753b2a7353582b8e7f6/">Pay (INR 2000)</a>';

}
      
      
      
      
      ?>