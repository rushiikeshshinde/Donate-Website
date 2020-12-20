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
<!--css-->
 <style>
  * {box-sizing: border-box}
  body {
   margin: 0;
   font-family: "Palatino Linotype", Helvetica, sans-serif;
  }
  /*navigation bar*/
  .topnav {
    position: fixed;
    background-color: #000;
    width: 100%;
    z-index: 10;
  }
  /*navigation bar links*/
  .topnav a {
    float: left;
    color: white;
    text-align: center;
    padding: 1.3vw 1.4vw;
    text-decoration: underline;
    font-size: 15px;
  }
  .topnav a:hover {
    background-color: #fff;
    color: black;
  }
  /*donate options*/
  .drpbutton {
    font-family: inherit;
    color: black;
    padding: 1.3vw 1.5vw;
    text-decoration: underline;
    font-size: 15px;
    border: none;
    outline: none;
  }
  .dropdown {
    float: left;
    overflow: hidden;
  }
  .drpbutton:hover {
    background-color: #fff;
    color: black;
  }
  /*donate options list*/
  .droplist {
    display: none;
    position: absolute;
    background-color: #fff;
    min-width: 10px;
  }
  /*donate options links*/
  .droplist a {
    float: none;
    color: black;
    padding: 1.3vw 1.7vw;
    display: block;
    text-align: left;
    cursor: pointer;
    font-family:  "Palatino Linotype";
  }
  .droplist a:hover {
    background-color: #000;
    color: white;
  }
  .dropdown:hover .droplist {
    display: block;
  }
  /*search bar*/
  .topnav .search {
    float: right;
  }
  /*search bar field*/
  .topnav input[type=text] {
    padding: 0.6vw;
    margin-top: 1vw;
    font-size: 15px;
    border: none; 
    background-color: #fff;
    color: black;
    outline: none;
  }
  /*search icon button*/
  .topnav .search button {
    float: right;
    padding: 0.62vw 0.7vw;
    margin-top: 1vw;
    margin-right: 10px;
    background: #ddd;
    font-size: 16px;
    border: none;
    outline: none;
  }
  /*search bar options list*/
  .myUL {
    list-style-type: none;
    padding-left: 0px;
    padding-right: 49px;
    margin-top: 0.5px;
    display: none;
    position: absolute;
  }
  .search {
    float: left;
    overflow: auto;
  }
  /*search bar list links*/
  .myUL li a {
    text-align: left;
    border: 1px solid #ddd;
    margin-top: -1px; /* Prevent double borders */
    background-color: #fff;
    padding: 5px;
    text-decoration: none;
    font-size: 15px;
    color: black;
    display: block;
    min-width: 208px;
    overflow: auto;
  }
  .myUL li a:hover{
    background-color: #000;
    color: #fff;
  }
 
  /*background image*/
  .bg img {
    padding-top: 50px;
    width:100%;
    display: block;
  }
  /*success message modal background*/
  #modal {
    display: block; 
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
  /*success message modal*/
  .modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 30px;
    border: 1px solid #888;
    width: 30%;
    font-size: 15px;
    font-weight: normal;
    text-align: center;
  }
  .modal-content i {
    text-align: center;
    font-size: 30px;
  }
  .modal-content a{
    color: dodgerblue;
  }

  /*heading title of page*/
  .heading {
    font-size: 80px;
    font-style: oblique;
    position: absolute;
    bottom: 0;
    padding:320px 400px;
    width: 100%;
    color: #000;
    text-shadow: 2px 2px white;
  }
  /*box donate once*/
  .now {
    left: 200px;
    top: 300px;
    text-align: center;
    font-size: 20px;
    font-style: bold;
    position: absolute;
    margin: 60px 0 0 30px;
    padding: 15px 30px;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    background: rgb(0, 0, 0); /* Fallback color */
    background: rgba(0, 0, 0, 0.8);   
    color: white;
    text-decoration:none;
  }
  .now:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.8);
    cursor: pointer;
  }
  .now i {
    font-size: 30px;
  }

  /*box donate monthly*/
  .month {
    left: 500px;
    top: 300px;
    text-align: center;
    font-size: 20px;
    font-style: bold;
    position: absolute;
    margin: 60px 0 0 30px;
    padding: 15px 30px;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    background: rgb(0, 0, 0); /* Fallback color */
    background: rgba(0, 0, 0, 0.8);   
    color: white;
    text-decoration: none;
  }
  .month:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.8);
    cursor: pointer;
  }
  .month i {
    font-size: 30px;
  }
  /*box take part in*/
  .part {
    left: 800px;
    top: 300px;
    text-align: center;
    font-size: 20px;
    font-style: bold;
    position: absolute;
    margin: 60px 0 0 30px;
    padding: 15px 52px;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    background: rgb(0, 0, 0); /* Fallback color */
    background: rgba(0, 0, 0, 0.8);   
    color: white;
  }
  .part:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.8);
    cursor: pointer;
  }
  .part i {
    font-size: 30px;
  }
  .part a{
    color: white;
    text-decoration: none;
  }
  /*close modal button*/
  .close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    text-decoration: none;
    padding-right: 500px;
    padding-top: 20px;
  }
  .close:hover, .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
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
   <input type="text" placeholder="Search..." class="text" autocomplete="off" onkeyup="myFunction()">
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
 <img src="nature.jpg" alt="">
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

<!--JavaScript-->
<!--Script for search bar-->
<script>
function myFunction() {
  //variables
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementsByClassName("text")[0];
  filter = input.value.toUpperCase();
  ul = document.getElementsByClassName("myUL")[0];
  li = ul.getElementsByTagName("li");
   if(input.value.length == 0){
      ul.style.display = "none";
      return;
   }else{
      ul.style.display = "block";
   }
  for (i = 0; i < li.length-1; i++) {
    a = li[i].getElementsByTagName("a")[0];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}
</script>

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

<!--css-->
<style>
* {box-sizing: border-box}
body {
  margin: 0;
  font-family: "Palatino Linotype", Helvetica, sans-serif;
}

/*navigation bar*/
.topnav {
  position: fixed;
  background-color: #000;
  width: 100%;
  z-index: 10;
}
/*navigation bar links*/
.topnav a {
  float: left;
  color: white;
  text-align: center;
  padding: 1.3vw 1.4vw;
  text-decoration: underline;
  font-size: 15px;
}
.topnav a:hover {
  background-color: #fff;
  color: black;
}
/*donate options*/
.drpbutton {
  font-family: inherit;
  color: black;
  padding: 1.3vw 1.4vw;
  text-decoration: underline;
  font-size: 15px;
  border: none;
  outline: none;
}
.dropdown {
  float: left;
  overflow: hidden;
}
.drpbutton:hover {
  background-color: #fff;
  color: black;
}
/*donate options list*/
.droplist {
  display: none;
  position: absolute;
  background-color: #fff;
  min-width: 10px;
}
/*donate options links*/
.droplist a {
  float: none;
  color: black;
  padding: 1.3 vw 1.7vw;
  display: block;
  text-align: left;
  cursor: pointer;
  font-family:  "Palatino Linotype";
}
.droplist a:hover {
  background-color: #000;
  color: white;
}
.dropdown:hover .droplist {
  display: block;
}
/*search bar*/
.topnav .search {
  float: right;
}
/*search bar input field*/
.topnav input[type=text] {
  padding: 0.6vw;
  margin-top: 1vw;
  font-size: 15px;
  border: none; 
  background-color: #fff;
  color: black;
  outline: none;
}
/*search icon button*/
.topnav .search button {
  float: right;
  padding: 0.56vw 0.7vw;
  margin-top: 1vw;
  margin-right: 10px;
  background: #ddd;
  font-size: 16px;
  border: none;
  outline: none;
}
/*serach bar options list*/
.myUL {
  list-style-type: none;
  padding-left: 0px;
  padding-right: 49px;
  margin-top: 0.5px;
  display: none;
  position: absolute;
}
.search {
  float: left;
  overflow: auto;
}
/*search bar options links*/
.myUL li a {
  text-align: left;
  border: 1px solid #ddd;
  margin-top: -1px; /* Prevent double borders */
  background-color: #fff;
  padding: 5px;
  text-decoration: none;
  font-size: 15px;
  color: black;
  display: block;
  min-width: 208px;
  overflow: auto;
}
.myUL li a:hover{
  background-color: #000;
  color: #fff;
}

/*background image*/
.bg img {
  padding-top: 4vw;
  max-width:100%;
  height: auto;
  display: block;
  background-repeat: repeat;
}

/*background text*/
.heading {
  font-size: 6vw;
  font-style: oblique;
  position: absolute;
  bottom: 0;
  padding: 20vw 30vw;
  width: 100%;
  color: #000;
  text-shadow: 0.1vw 0.1vw white;
}

/*box donate once*/
.now {
  left: 200px;
  top: 300px;
  text-align: center;
  font-size: 20px;
  font-style: bold;
  position: absolute;
  margin: 60px 0 0 30px;
  padding: 15px 30px;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  background: rgb(0, 0, 0); /* Fallback color */
  background: rgba(0, 0, 0, 0.8);   
  color: white;
  text-decoration:none;
}
.now:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.8);
  cursor: pointer;
}
.now i {
  font-size: 30px;
}

/*box donate monthly*/
.month {
  left: 500px;
  top: 300px;
  text-align: center;
  font-size: 20px;
  font-style: bold;
  position: absolute;
  margin: 60px 0 0 30px;
  padding: 15px 30px;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  background: rgb(0, 0, 0); /* Fallback color */
  background: rgba(0, 0, 0, 0.8);   
  color: white;
  text-decoration: none;
}
.month:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.8);
  cursor: pointer;
}
.month i {
  font-size: 30px;
}

/*box take part in*/
.part {
  left: 800px;
  top: 300px;
  text-align: center;
  font-size: 20px;
  font-style: bold;
  position: absolute;
  margin: 60px 0 0 30px;
  padding: 15px 52px;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  background: rgb(0, 0, 0); /* Fallback color */
  background: rgba(0, 0, 0, 0.8);   
  color: white;
}
.part:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.8);
  cursor: pointer;
}
.part i {
  font-size: 30px;
}
.part a{
  color: white;
  text-decoration: none;
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
}

/*currency input field in payment*/
.currency {
  margin-bottom: 15px;
  padding: 12px;
  border: 1px solid #ccc;
  outline: none;
  width: 15%;
}

/*text fields in modals*/
#modal1 input[type=text] {
  margin-bottom: 15px;
  padding: 12px;
  border: 1px solid #ccc;
  outline: none;
  width: 100%;
}
#modal2 input[type=text] {
  margin-bottom: 15px;
  padding: 12px;
  border: 1px solid #ccc;
  outline: none;
  width: 100%;
}

/*columns and rows inside modal for text fields*/
.col{
  margin-bottom: 15px;
  padding: 12px 18px;
  width: 30%;  
 }
.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}
.row i{
 font-size: 25px;
 padding-left: 3px;
 padding-right: 6px;
}


/*label for input fields in payment*/
label {
  margin-bottom: 10px;
  display: block;
}

/*open modals*/
#modal1:target {
  display: block;
}
#modal2:target {
  display: block;
}

/*close modals*/
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  text-decoration: none;
  padding-right: 356px;
  padding-top: 20px;
}
.close:hover, .close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

/*submit button in payment*/
.donate {
  background-color: black;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  cursor: pointer;
  font-size: 17px;
  outline: none;
}
.donate:hover {
  background-color: grey;
  color: black;
}

/*terms and privacy link inside modal*/
.policy a {
  color: dodgerblue;
}
.policy {
  margin: -17px 17px;
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
   <input type="text" placeholder="Search..." class="text" autocomplete="off" onkeyup="myFunction()">
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
 <img src="nature.jpg" alt="">
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
<!--script for search bar-->
<script>
function myFunction() {
  //variables
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementsByClassName('text')[0];
  filter = input.value.toUpperCase();
  ul = document.getElementsByClassName("myUL")[0];
  li = ul.getElementsByTagName('li');
  if(input.value.length == 0){
    ul.style.display = "none";
    return;
  }else{
    ul.style.display = "block";
  }
  //Loop through all list items, and hide those who don't match
  for (i = 0; i < li.length-1; i++) {
    a = li[i].getElementsByTagName("a")[0];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}
</script>

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

<!--script for adding slash in expire date of card in donate once-->
<script>
function addSlashes (element) {	
  let ele = document.getElementsByClassName('expmonth')[0];
    ele = ele.value.split('/').join('');   
    if(ele.length < 4 && ele.length > 0){
        let finalVal = ele.match(/.{1,2}/g).join('/');
   document.getElementsByClassName('expmonth')[0].value = finalVal;
    }
}
</script>

<!--script for adding slash in expire date of card in donate monthly-->
<script>
function addSlashesM (element) {	
  let ele = document.getElementsByClassName('expmonth')[1];
    ele = ele.value.split('/').join('');   
    if(ele.length < 4 && ele.length > 0){
        let finalVal = ele.match(/.{1,2}/g).join('/');
   document.getElementsByClassName('expmonth')[1].value = finalVal;
    }
}
</script>

</body>
</html>