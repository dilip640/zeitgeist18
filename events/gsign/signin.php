<?php
//   namespace Zeitgeist;
  require_once 'vendor/autoload.php';
  require_once '../include/include.php';
  require 'PHPMailer/PHPMailerAutoload.php';
  
  error_reporting(E_ALL);
ini_set('display_errors', 'on');

  $idtoken = $_POST['idtoken'];
  $email = $_POST['email'];
  $name = $_POST['name'];
  $college = mysqli_real_escape_string($conn, $_POST['college']);
  $contact = $_POST['contact'];
  $whyca = mysqli_real_escape_string($conn, $_POST['whyca']);
  $anyexp = mysqli_real_escape_string($conn, $_POST['anyexp']);
  $data = array();

  // depends on gmail api credentials Fsg7TMTBaUBOjQiax81jyn-S
  $CLIENT_ID = "204692535692-ipmo50umbbcrau57dkpfmkhrh7ah540q.apps.googleusercontent.com";
  $client = new Google_Client(['client_id' => $CLIENT_ID]);
  $payload = $client->verifyIdToken($idtoken);

  if($payload) {
    // $userid = $payload['sub'];
    if(!isset($_SESSION['email'])) {
      if(preg_match("/^[1-9][0-9]{9}$/", $contact)) {
        $refferalCode = strtolower(substr($name, 0, 4));
        $code = rand(100, 1000);
        $referralCode = "$refferalCode"."$code"."ze";
        $sql = "INSERT INTO ca_tb (name, email, college, phone, whyca, anyexp, referral) VALUES ('$name', '$email', '$college' ,'$contact', '$whyca', '$anyexp', '$referralCode')";
        if ($conn->query($sql) == TRUE) {
          session_start();
          $_SESSION['email'] = $email;
          $_SESSION['id'] = mysqli_insert_id($conn);
          $data['status'] = "ok";
          $data['result'] = "Successfully Registered :)";
          
          $mail = new PHPMailer();
          $mail->IsSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->Port = 587;
          $mail->SMTPSecure = 'tls';
          $mail->SMTPAuth = true;
          $mail->Username = 'zeitgeist.pr@iitrpr.ac.in';
          $mail->Password = 'winteriscoming';
          $mail->setFrom('zeitgeist.pr@iitrpr.ac.in', 'ZEITGEIST, IIT Ropar');
          $mail->addAddress($email, $name);
          $mail->Subject = 'Referral code for zeitgeist';
          $mail->Body = implode("\r\n", array('Thank You',
          'You have been successfully registered for College Representative program for Zeitgeist 2018.',
          'We are excited for your journey with us.',
          'Your College Representative referral code is '.$referralCode.".",
          'CR Policy : https://www.zeitgeist.org.in/cr/CR%20Policy.pdf',
          '',
          'Team Zeitgeist',
          'Indian Institute of Technology (IIT), Ropar',
          'Rupnagar, Punjab, 140001'));
          $mail->send();
          
        //   $fromEmail = "admin@zeitgeist.org.in";
        //   $toEmail = $email;
        //   $emailMessage = array(
        //     "Hello ".$name,
        //     "We are excited for your journey with us.",
        //     "Your campus representative referral code is ".$refferalCode."."
        //   );
        //   $emailMessage = implode("\r\n", $emailMessage);
        //   $header = array(
        //     "From: ".$fromEmail,
        //     "Reply-To: ".$fromEmail,
        //     "X-Mailer: PHP/" . PHP_VERSION
        //   );
        //   $header = implode("\r\n", $header);
        //   $output = mail($toEmail, "Referral code for zeitgeist", $emailMessage, $header, "-f".$fromEmail);
        //   var_dump($output);

        } else {
          $data['status'] = "error";
          $data['result'] = $conn->error;
        }
      } else {
        $data['status'] = "notok";
        $data['result'] = "Invalid Phone Number";
      }
    }else {
      $data['status'] = "ok";
      $data['result'] = "Already Registered ;)";
    }
  } else {
    $data['status'] = "notok";
    $data['result'] = "Invalid Sign-In";
  }
echo json_encode($data);
?>
