<?php $event_name="Register";
    
      $mysql_pass = "ZeitgeistDb"; // or $mysql_pass = "thisispass"
      $mysql_user = "zeitgeist_z18_user1"; // or $mysql_user = "ausr";
      $servername = "localhost"; //
      $conn = new mysqli($servername, $mysql_user, $mysql_pass, "zeitgeist_z18_entries");

	if(isset($_GET["event"]))
	  $event_name=preg_replace("/[']+/", "",$_GET["event"]);
	  $event_name=str_replace("%20"," ",$event_name);
	  $mnp = 0;
	  $mx = 0;
	  $fee = 10000;
	  $solo=0;
	  $id=0;
	  
	 $ft = mysqli_query($conn,"Select * from events where upper(ename) = Upper('$event_name')");
	  while($fta = mysqli_fetch_array($ft)){
	      $mnp = $fta['min_pat'];
	      $mx = $fta['max_pat'];
	      $fee = $fta['fee'];
	      $solo=$fta['solo'];
	      $id=$fta['id'];
	  }
	  
	  $pharray=array(3,4,5,6,7);
	  $mediaurl="";
	  if(in_array($id, $pharray))
	        $mediaurl="<li><input type='text' class='inputFields' placeholder='Google Drive Link' id='tnamer'></li>";
	  $frm = '';
	  for($i=2;$i<=$mnp;$i++){
	      $frm.="<ul id='row'" . $i . " class='noBullet'><hr>
	      <h5>Person " . $i . "</h5>
	      <li><input type='text' class='inputFields' placeholder='Participant Name' id='nm".$i."'></li>
	      <li><input type='text' class='inputFields'  placeholder='Gender:M/F' id='ge".$i."'></li>
	      <div class='form-check-inline'><li><label >Accomodation</label><br>
	      <label class='form-check-label'><input type='checkbox' class='form-check-input' id='c19h".$i."' value='1'>19th &nbsp;
	      </label><input type='checkbox' class='form-check-input' value='2' id='c20h".$i."'>20th &nbsp;
	      </label><input type='checkbox' class='form-check-input' value='3' id='c21h".$i."'>21st &nbsp;</label></li></div></ul>";
	  }
	
		
		
?>
		
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="204692535692-ipmo50umbbcrau57dkpfmkhrh7ah540q.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <title>Event Registration</title>
    <style>
        .delev{
            margin:10px;
        } 
        .adev{
            margin:10px;
        }
        hr{
            background-color:grey;
            height:2px;
            border-width:0px;
        }
        #emad{
            cursor:pointer;
        }
        #emad:hover{
            color:lightgrey;
        }
    </style>
    <link rel="shortcut icon" type="image/png" href="../images/zlogo.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/form.css">
    

</head>


<body tcap-name="main">
    <div class="goback" onclick="location.href='../index.html'"><span>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                <style type="text/css">
                    .cd-nugget-info-arrow {
                        fill: #fff;
                    }
                </style>
                <polygon class="cd-nugget-info-arrow" points="15,7 4.4,7 8.4,3 7,1.6 0.6,8 0.6,8 0.6,8 7,14.4 8.4,13 4.4,9 15,9 "></polygon>
            </svg>
        </span><span> Zeitgeist</span>
        
    </div>
    <h6 style="text-align:right;padding-right:20px;" id="emad"></h6>
        
    <div class="container" style="margin-top:-20px;">
        <div class="row signupSection">
            <div class="col-md-6 info" style="background: url(img/<?php echo preg_replace("/[ -]+/", "_",strtolower($event_name)).".jpg"; ?>);background-repeat: no-repeat;background-position: center;
                background-size: cover;">
                <h2>
                    <?php echo $event_name; ?>
                </h2>
            </div>
            <div class="col-md-6 style-2">
                
                <?php 
                if($solo==0)
			echo '<form action="#" method="POST" class="signupForm" name="signupform">
			<h2>Register</h2>
			<ul class="noBullet">
			  <li>
				<label for="username"></label>
				<input type="text" class="inputFields" name="username" id="tnamer" placeholder="Team Name" value="" oninput="return userNameValidation(this.value)" required/>
			  </li>
			  <li>
				<label for="username"></label>
				<input type="text" class="inputFields" name="collagename" id="clnamer" placeholder="College Name" value="" oninput="return userNameValidation(this.value)" required/>
			  </li>
			  <li>
				<label for="username"></label>
				<input type="text" class="inputFields"  name="crcode" id="crref" placeholder="CR\'s Referral Code" value=""/>
			  </li>
			  '.$mediaurl.'
			</ul>
			<div id="employee_table">
				<ul id="row1" class="noBullet"><h5>Team Leader</h5><li>
				<input type="text" class="inputFields"  placeholder="Name" id="nm1"></li>
				<li><input type="text" class="inputFields"  placeholder="Contact Number" id="cont"></li>
				<li><input type="text" class="inputFields" placeholder="Gender:M/F" id="ge1"></li>
				<div class="form-check-inline"><li><label >Accomodation</label><br>
				<label class="form-check-label">
				<input type="checkbox" class="form-check-input" value="1" id="c19h1">19th &nbsp;
				</label><input type="checkbox" class="form-check-input" value="2" id="c20h1">20th &nbsp;
				</label><input type="checkbox" class="form-check-input" value="3" id="c21h1">21st &nbsp;</label>
				</li></div></ul>
			'.$frm.'
			</div>
			<ul class="noBullet">
				<li><input id="bt" type="button" onclick="add_row();" value="ADD PERSON" class="adev"><input class="delev" value="DELETE LAST" id="bt" type="button" onclick="delete_last()" style="display:none;"></li>
				<li id="center-btn">
					<input type="button" id="join-btn" class="joinbut" onclick="calcc();" name="join" alt="Join" value="Register">
					<div  id="gsinn" class="g-signin2" data-onsuccess="onSignIn" style="width:200px;display:inline-block;"></div>
				</li>
			</ul>
		</form>';
		else echo '<form action="#" method="POST" class="signupForm" name="signupform">
			<h2>Register</h2>
			<ul class="noBullet">
			  <li>
				<label for="username"></label>
				<input type="text" class="inputFields" id="clnamer" name="clnamer" placeholder="College Name" value=""  required/>
			  </li>
			  <li>
				<label for="username"></label>
				<input type="text" class="inputFields" id="crref" name="" placeholder="CR\'s Referal Code" value=""/>
			  </li>
			  '.$mediaurl.'
			</ul>
			<div id="employee_table">
				<ul id="row1" class="noBullet">
				<li><input type="text" class="inputFields"  placeholder="Name" id="nm1"></li>
				<li><input type="text" class="inputFields"  placeholder="Contact Number" id="cont"></li>
				<li><input type="text" class="inputFields" placeholder="Gender:M/F" id="ge1"></li>
				<div class="form-check-inline"><li><label >Accomodation</label><br>
				<label class="form-check-label">
				<input type="checkbox" class="form-check-input" value="1" id="c19h1">19th &nbsp;
				</label><input type="checkbox" class="form-check-input" value="2" id="c20h1">20th &nbsp;
				</label><input type="checkbox" class="form-check-input" value="3" id="c21h1">21st &nbsp;</label>
				</li></div></ul>
			'.$frm.'
			</div>
			<ul class="noBullet"><li id="center-btn">
					<input type="button" id="join-btn" class="joinbut" onclick="calcc();" name="join" alt="Join" value="Register">
					<div  id="gsinn" class="g-signin2" data-onsuccess="onSignIn" style="width:200px;display:inline-block;"></div>
				</li>
			</ul>
		</form>';
  ?>
  

            </div>
        </div>
    </div>
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Charges</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    Modal body..
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Proceed</button>
                </div>

            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        
        var alertRedInput = "#8C1010";
        var defaultInput = "rgba(10, 180, 180, 1)";

        function userNameValidation(usernameInput) {
            var username = document.getElementById("username");
            var issueArr = [];
            if (/[-!@#$%^&*()_+|~=`{}\[\]:";'<>?,.\/]/.test(usernameInput)) {
                issueArr.push("No special characters!");
            }
            if (issueArr.length > 0) {
                username.setCustomValidity(issueArr);
                username.style.borderColor = alertRedInput;
            } else {
                username.setCustomValidity("");
                username.style.borderColor = defaultInput;
            }
        }

        function passwordValidation(passwordInput) {
            var password = document.getElementById("password");
            var issueArr = [];
            if (!/^.{7,15}$/.test(passwordInput)) {
                issueArr.push("Password must be between 7-15 characters.");
            }
            if (!/\d/.test(passwordInput)) {
                issueArr.push("Must contain at least one number.");
            }
            if (!/[a-z]/.test(passwordInput)) {
                issueArr.push("Must contain a lowercase letter.");
            }
            if (!/[A-Z]/.test(passwordInput)) {
                issueArr.push("Must contain an uppercase letter.");
            }
            if (issueArr.length > 0) {
                password.setCustomValidity(issueArr.join("\n"));
                password.style.borderColor = alertRedInput;
            } else {
                password.setCustomValidity("");
                password.style.borderColor = defaultInput;
            }
        }
    </script>
        <script>
     var mnp = <?php echo $mnp;?>;var mxp = <?php echo $mx;?>;var fee = <?php echo $fee;?>;var evid = <?php echo $id;?>;
     var id_token = '';
     var tmp = mnp;
     
        var pers = new Array();
        var i;
        
        for(i=1;i<=mnp;i++) pers.push(i);
        
        function add_row() {
            //$rowno = $("#employee_table ul").length;
            var ls = pers.length;
            if(ls<mxp){
                //$rowno = $rowno + 1;
                ls++;
                pers.push(ls);
                $("#employee_table ul:last").after("<ul id='row" + ls + "' class='noBullet'><hr><h5>Person " + ls + "</h5><li><input type='text' class='inputFields' placeholder='Participant Name' id='nm"+ls+"'></li><li><input type='text' class='inputFields' id='ge"+ls+"' placeholder='Gender:M/F'></li><li></li><div class='form-check-inline'><li><label >Accomodation</label><br><label class='form-check-label'><input type='checkbox' class='form-check-input' value='1' id='c19h"+ls+"'>19th &nbsp;</label><input type='checkbox' class='form-check-input' id='c20h"+ls+"' value='2'>20th &nbsp;</label><input type='checkbox' class='form-check-input' id='c21h"+ls+"' value='3'>21st &nbsp;</label></li></div></ul>");
           
                }
                if(ls>mnp) $('.delev').show();else $('.delev').hide();
                if(ls<mxp) $('.adev').show();else $('.adev').hide();
             }
             
        function delete_row(rowno) {
            $('#' + rowno).remove();
        }

        function delete_last() { 
            var ls = pers.length;
            pers.pop();
            $('#row' + ls).remove();
            if(ls>mnp){
                $('.delev').show();
            }else{
                $('.delev').hide();
            }
            if(ls<=mxp) $('.adev').show();else $('.adev').hide();
        }

        function calc() {
            $per = $("#employee_table ul").length;
            $check = 0;
            for ($i = 1; $i <= $per; $i++) {
                $check += $("#row" + $i + " .form-check-inline :checked").length;
            }

            $('.modal-body').html("<p>Participation Charge : Rs. 250</p><p>Per person accomodation charge : Rs. 50</p><p>No. of Participants : " + $per + "</p><p>Accomodation  for " + $check + " nights</p><p>You have to pay a total of : " + (250 + $check * 50) + "</p>");
            $('#myModal').modal('show');
        }
        function chckd(p,q){
            if($('#c'+p+'h'+q).prop('checked'))
            return 1;
            else return 0;
        }
        
        
            function calcc(){
            var ls = pers.length;
            var parr = new Array();
            var fn=1;
            for(i=1;i<=ls;i++){
                var tparr = new Array();
                if($('#nm'+i).val().length>0){
                    tparr[0] = i;
                    tparr[1] = $('#nm'+i).val();
                    tparr[2] = $('#ge'+i).val();
                    tparr[3] = chckd(19,i);
                    tparr[4] = chckd(20,i);
                    tparr[5] = chckd(21,i);
                    var mm = tparr.join("#");
                    parr.push(mm);
                }else{
                    fn=0;
                    break;
                }
                
            }
            if(fn==1){
                var tname =$('#tnamer').val();
                var contact = $('#cont').val();
                var college = $('#clnamer').val();
                var crref  = $('#crref').val();
                var email = "email";
                
                if(tname&&contact&&college){
                
                var nms = parr.join('_');
                var eid = evid;
                //alert(id_token);
               
                $.ajax({
                    data: {'eid': eid,'tname':tname,'contact':contact,'cllg':college,'email':email,'nms':nms,'crref':crref,'idtok':id_token},
                    url: 'verifyevent.php',
                    method: 'POST',
                    success: function(msg){
                        
                        if(msg==1)
                            alert("You have been successfully registered! Check for the email!");
                        else{
                            alert('Unable to register');
                        }
                    }
                 });
                 
                }else{
                    alert("Please complete the form!");
                }
                
                
                 //alert(parr.join('_'));
            }
             
            else
              alert("Please complete the form!");
        }
        
        
    </script>
       
<script type="text/javascript">

    
    function signOut() {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function () {
        console.log('User signed out.');
        id_token='';
        email = '';
      });
      $('.joinbut').hide();
          var emsh = " (Logout)";
          
          $('#emad').html("");
          $('#gsinn').show();
    }
    
    // signOut();
    $('.joinbut').hide();
    function onSignIn(googleUser) {
      // Useful data for your client-side scripts:
      var profile = googleUser.getBasicProfile();
      console.log("ID: " + profile.getId()); // Don't send this directly to your server!
      console.log('Full Name: ' + profile.getName());
      console.log('Given Name: ' + profile.getGivenName());
      console.log('Family Name: ' + profile.getFamilyName());
      console.log("Image URL: " + profile.getImageUrl());
      console.log("Email: " + profile.getEmail());
      
      var email = profile.getEmail();
      
     // alert(email);
      
      // The ID token you need to pass to your backend:
       id_token = googleUser.getAuthResponse().id_token;
      // console.log("ID Token: " + id_token);
      //var name = document.getElementById("name").value;
      
          $('.joinbut').show();
          var emsh = "<img style='height:20px;width:20px;' src='"+profile.getImageUrl()+"'/> "+email+" (Logout)";
          
          $('#emad').html(emsh);
          $('#gsinn').hide();
     
    }
    $('#emad').click(function(){
        signOut();
    });
    
  </script>
</body>

</html>