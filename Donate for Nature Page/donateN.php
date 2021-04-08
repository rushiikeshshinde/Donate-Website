<?php
//php script to store donation details in database
 //connect to database
 $servername='localhost';
 $username='root';
 $password='';
 $dbname = "iris_db";

 $conn = new mysqli($servername,$username,$password,"$dbname");
 if($conn->connect_error){
   die('Could not Connect My Sql:' .mysql_error());
 }
 //store details
 if($_SERVER['REQUEST_METHOD']== 'POST') {
    //save amount of money donated, name on card, card number
      $error = '';
	 $amount = $_POST['amount'];
	 $card = $_POST['card'];
	 $number = $_POST['number'];
    //sql query
	 $sql = "INSERT INTO donations (amount, card, number) VALUES ('{$amount}', '{$card}', '${number}')";
   if ($conn->query($sql) === TRUE) { $error='success'; }
 }
 //if no error occurred display following html page
 if (!empty($error)) {
  echo '<title>Donation</title>
  <!--icons-->
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!--external css-->
<link rel="stylesheet" href="style.css">

<!--Javascript-->
<script src="javascript.js"></script> 

<!--internal css-->
<style>
 body {
  background-image: url("nature.jpg");/*!!!!!*/
  height: 100%;/*!!!!!*/
}
 .topnav .search button {
  padding: 0.62vw 0.7vw;
}
  /*close modal button*/
 .close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    text-decoration: none;
    padding-right: 37%;
    padding-top: 20px;
 }
 @media (min-width: 768px) and (max-width: 992px){ 
  .close {
      padding-right: 33%;
  }
 }
 @media (max-width: 766px){ 
  .close {
      padding-right: 30%;
  }
 }
</style>
</head>

<body>
<!--navigation bar-->
 <div class="topnav">
  <a  href="css.html"><i class="fa fa-home"></i> Home</a>
  <div class="dropdown">
   <button class="drpbutton" ><i class="fa fa-globe"></i> Donate</button>
   <div class="droplist">
    <a href="donateN.php"><i class="fa fa-tree"><u> Nature</u></i></a>
    <a href="donateP.php"><i class="fa fa-child"><u> People</u></i></a>
   </div>
  </div>
  <a href="contact.html"><i class="fa fa-envelope"></i> Contact</a>
  <a href="login.php"><i class="fa fa-user"></i> Log in/out</a> 
 <!--search bar-->
  <div class="search">
   <input type="text" placeholder="Search..." class="text1" autocomplete="off" onkeyup="myFunction()">
   <button type="submit"><i class="fa fa-search"></i></button>
   <ul class="myUL">
    <li><a href="css.html"> About Us</a></li>
    <li><a href="contact.html"> Contact</a></li>
    <li><a href="donateN.php"> Donate Nature</a></li>
    <li><a href="donateP.php"> Donate People</a></li>
    <li><a href="Contact.html"> Email</a></li>
    <li><a href="login.php"> Login</a></li>
    <li><a href="signup.php"> Sign Up</a></li>
    <li><a href="css.html"> Social media</a></li>
    <li><a href="policy.html" target="_blank">Terms & Policy</a></li>
    <li><a href="#" style="cursor:context-menu;background-color:white;color:black;"><i>No results found..</i></a></li>
   </ul>
  </div>
 </div>

<!--background image-->
 <div class="bg">
  <div class="heading">
   <!--background text-->
   <p>Be a participant</p>
 </div>

<!--box donate once-->
 <a class="now" href="#modal1">
 </br>
 <i class="fas fa-leaf"></i>
 <p><b>Plant a tree!<b></p>
 <p>Minimum donation<br/> amount: 0,50 &euro; </p>
 </a>

<!--box donate monthly-->
 <a class="month" href="#modal2">
 </br>
 <i class="fas fa-tree"></i>
 <p><b>Donate monthly!<b></p>
 <p>Minimum donation<br/> amount: 40 &euro; </p>
 </a>

<!--box take part-->
 <div class="part">
  </br>
  <i class="fas fa-hiking"></i>
  <p><a href="contact.html"> <b>Take part in an <br/>  action!</b></p>
  <p>Contact us.</a> </p>
 </div>

<!--success message modal-->
 <div id="modal">
  <a class="close" href="donateN.php">&times;</a>
  <div class="modal-content">
   <i class="fas fa-gift"></i>
   <p>Your donation was successful.</br> Thank you for your support!</p>
   <a href="css.html">Home</a>
  </div>
 </div>

</body>
</html>';
exit;
}
//end of php file
?>

<!--html page before after connection to database-->
<!DOCTYPE html>
<html>
<head>

<title>Donation</title>

<!--met tags-->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--icons-->
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!--external css-->
<link rel="stylesheet" href="style.css">

<!--Javascript-->
<script src="javascript.js"></script> 

<!--internal css-->
<style>
body {
  background-image: url('nature.jpg');/*!!!!!*/
  height: 100%;/*!!!!!*/
}
/*payment modal for donate once*/
#modal1 {
  display: none; 
  position: fixed; 
  z-index: 1; 
  padding-top: 100px; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  overflow: auto; 
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.6); 
  font-family: sans-serif;
}

/*payment modal for donate monthly*/
#modal2 {
  display: none; 
  position: fixed; 
  z-index: 1; 
  padding-top: 100px; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  overflow: auto; 
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.6); 
  font-family: sans-serif;
}

/*modal background*/
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 30px;
  border: 1px solid #888;
  width: 50%;
  text-align: left;
}

/*close modals*/
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  text-decoration: none;
  padding-right: 28%;
  padding-top: 20px;
}
/*RESPONSIVE*//*!!!!!*/
/*tablet view*/
@media (min-width: 768px) and (max-width: 992px){ 
  .modal-content {
      width: 70%;
  }
  .close {
      padding-right: 20%;
    }
}
/*mobile view*/
@media (max-width: 766px){ 

  .modal-content {
    width: 90%;
  }
  .close {
      padding-right: 15%;
    }
}
</style>
</head>

<body>
<!--navigation bar-->
 <div class="topnav">
  <a  href="css.html"><i class="fa fa-home"></i> Home</a>
  <div class="dropdown">
   <button class="drpbutton" ><i class="fa fa-globe"></i> Donate</button>
   <div class="droplist">
    <a href="donateN.php"><i class="fa fa-tree"><u> Nature</u></i></a>
    <a href="donateP.php"><i class="fa fa-child"><u> People</u></i></a>
   </div>
  </div>
  <a href="contact.html"><i class="fa fa-envelope"></i> Contact</a>
  <a href="login.php"><i class="fa fa-user"></i> Log in/out</a> 
<!--search bar-->
  <div class="search">
   <input type="text" placeholder="Search..." autocomplete="off" class="text1" onkeyup="myFunction()">
   <button type="submit"><i class="fa fa-search"></i></button>
   <ul class="myUL">
    <li><a href="css.html"> About Us</a></li>
    <li><a href="contact.html"> Contact</a></li>
    <li><a href="donateN.php"> Donate Nature</a></li>
    <li><a href="donateP.php"> Donate People</a></li>
    <li><a href="Contact.html"> Email</a></li>
    <li><a href="login.php"> Login</a></li>
    <li><a href="signup.php"> Sign Up</a></li>
    <li><a href="css.html"> Social media</a></li>
    <li><a href="policy.html" target="_blank">Terms & Policy</a></li>
    <li><a href="#" style="cursor:context-menu;background-color:white;color:black;"><i>No results found..</i></a></li>
   </ul>
 </div>
</div>

<!--background image-->
<div class="bg">
 <div class="heading">
  <p>Be a participant</p>
 </div>

<!--donate once box-->
 <a class="now" href="#modal1">
 </br>
 <i class="fas fa-leaf"></i>
 <p><b>Plant a tree!<b></p>
 <p>Minimum donation<br/> amount: 0,50 &euro; </p>
 </a>

<!--donate monthly box-->
 <a class="month" href="#modal2">
 </br>
 <i class="fas fa-tree"></i>
 <p><b>Donate monthly!<b></p>
 <p>Minimum donation<br/> amount: 20 &euro; </p>
 </a>

<!--take part in box-->
 <div class="part">
  </br>
  <i class="fas fa-hiking"></i>
  <p><a href="contact.html"> <b>Take part in an <br/>  action!</b></p>
  <p>Contact us.</a> </p>
 </div>
</div>

<!--payment modal for donate once-->
 <div id="modal1">
 <a class="close" href="donateN.php">&times;</a>
 <div class="modal-content">
  <!--donate form-->
  <form method="POST">
   <h1 align="center">Payment</h1>
   <!--amount of money-->
   <label>Donation</label>
   <input type="number" class="currency" min="0.50" max="2500.00" value="0.50" step="0.10" name="amount">
   <!--name on card-->
   <label for="card">Name on Card</label>
   <input type="text" class="cname" name="card" placeholder="MILAN A THOMSON" required style="text-transform:uppercase" autocomplete="off" pattern="[A-Za-z ]{1,}" title="Enter letters only.">
   <!--card number-->
   <label for="number">Credit card number</label>
   <input type="text" class="ccnum" placeholder="0000 0000 0000 0000" required maxlength="19" autocomplete="off" name="number" pattern="[0-9 ]{20}" title="Enter only numbers(16).">
   <!--input fields in same row-->
   <div class="row">
    <!--input fields in column-->
    <div class="col">
     <!--expire date on card-->
     <label for="expmonth">Expire Month/Year</label>
     <input type="text" class="expmonth" name="expmonth" placeholder="MM/YYYY" required maxlength="7" autocomplete="off" onkeyup="addSlashes(this)"; pattern="(?:0[1-9]|1[0-2])/(?:20[2-9][0-9])" title="Enter valid date." name="date">
     </div>
     <!--input field in other column-->
     <div class="col">
      <!--cvv on card-->
      <label for="cvv">CVV</label>
      <input type="text" class="cvv" name="cvv" placeholder="000" required maxlength="3" autocomplete="off" pattern="[0-9]{3}" title="Enter only numbers(3)." name="cvv">
     </div>
     <!--input field in other column-->
     <div class="col">
      <!--accepted cards-->
      <label for="fname">Accepted Cards</label>
        <!--add in same row-->
        <div class="row">
         <!--card icons-->
         <i class="fa fa-cc-visa" style="color:navy;"></i>
         <i class="fa fa-cc-amex" style="color:blue;"></i>
         <i class="fa fa-cc-mastercard" style="color:red;"></i>
         <i class="fa fa-cc-discover" style="color:orange;"></i>
        </div>
     </div>
     <!--terms and privacy links-->
     <p class="policy" style="font-size:12px">By making a donation you agree to <a href="policy.html" target="_blank">Terms and Privacy</a></p>
     <!--submit payment form-->
     <input type="submit" class="donate" value="Donate" id="sub" name"send">
    </div>
   </div>
  </form>
  </div>
 </div>

 <!--payment modal for donate monthly-->
 <div id="modal2">
  <a class="close" href="donateN.php">&times;</a>
  <div class="modal-content">
  <!--payment form-->
   <form method="post">
    <h1 align="center">Payment</h1>
    <!--amount of money-->
    <label>Donation</label>
    <input type="number" class="currency" min="20.00" max="5000.00" value="20.00" step="0.10" name="amount">
    <!--name on card-->
    <label for="cname">Name on Card</label>
    <input type="text" class="cname" name="card" placeholder="MILAN A THOMSON" required style="text-transform:uppercase" autocomplete="off" pattern="[A-Za-z ]{1,}" title="Enter letters only.">
    <!--card number-->
    <label for="ccnum">Credit card number</label>
    <input type="text" class="ccnum" name="number" placeholder="0000 0000 0000 0000" required maxlength="19" autocomplete="off" pattern="[0-9 ]{20}" title="Enter only numbers(16).">
     <!--input fields in same row-->
     <div class="row"> 
      <!--input fields in column-->
      <div class="col">
       <!--expire date on card-->
       <label for="expmonth">Expire Month/Year</label>
       <input type="text" class="expmonth" name="expmonth" placeholder="MM/YYYY" required maxlength="7" autocomplete="off" onkeyup="addSlashesM(this)"; pattern="(?:0[1-9]|1[0-2])/(?:20[2-9][0-9])" title="Enter valid date.">
      </div>
      <!--input fields in column-->
      <div class="col">
       <!--cvv-->
       <label for="cvv">CVV</label>
       <input type="text" class="cvv" name="cvv" placeholder="000" required maxlength="3" autocomplete="off" pattern="[0-9]{3}" title="Enter only numbers(3).">
      </div>
      <!--cards in column-->
      <div class="col">
       <!--accepted cards-->
       <label for="fname">Accepted Cards</label>
       <!--accepted cards in one row-->
       <div class="row">
        <!--card icons-->
        <i class="fa fa-cc-visa" style="color:navy;"></i>
        <i class="fa fa-cc-amex" style="color:blue;"></i>
        <i class="fa fa-cc-mastercard" style="color:red;"></i>
        <i class="fa fa-cc-discover" style="color:orange;"></i>
       </div>
      </div>
      <!--terms and privacy link-->
      <p class="policy" style="font-size:12px">By making a donation you agree to <a href="policy.html" target="_blank">Terms and Privacy</a></p>
      <!--sumbit form button-->
      <input type="submit" class="donate" value="Donate" id="sub">
    </div>
  </div>
  </form>
 </div>
</div>

<!--JavaScript-->
<!--include JQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!--JQuery script for checking if amount of money donated less than what is expected-->
<script>
(function($) {
  $.fn.currencyInput = function() {
    this.each(function() {
      var wrapper = $("<div class='currency-input' />");
      $(this).wrap(wrapper);
      $(this).before("<span class='currency-symbol'>&euro;</span>");
      $(this).change(function() {
        var min = parseFloat($(this).attr("min"));
        var max = parseFloat($(this).attr("max"));
        var value = this.valueAsNumber;
        //if value less than the minimum amount, payment gets the minimum amount
        if(value < min)
          value = min;
        //else gets the value typed
        else if(value > max)
          value = max;
        $(this).val(value.toFixed(2)); 
      });
    });
  };
})(jQuery);
$(document).ready(function() {
  $('input.currency').currencyInput();
});
</script>

<!--Jquery script for adding spaces between 4 digits in card number-->
<script>
$('.ccnum').on('keypress change', function () {
  $(this).val(function (index, value) {
    return value.replace(/\W/gi, '').replace(/(.{4})/g, '$1 ');
  });
});
</script>

</body>
</html>
