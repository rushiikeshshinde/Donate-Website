<?php
//iclude files
require_once "config.php";
require_once "session.php";
?>

<!DOCTYPE html>      
<html>
<head>

<title>Login to Iris</title>

<!--meta tags-->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--icons-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!--external css-->
<link rel="stylesheet" href="style.css">

<!--internal css-->
<style>
 * {
   box-sizing: border-box;
 }
  body {
  height: 100%;
}

/*sign up form*/
.container {
  top: 100px;
  position: relative;  
  width: 100%;
  padding: 18px;
  background-color: #000;
  color: white;
}
/*sign up form fields*/
.container input[type=text], input[type=password], input[type=email] {
  width: 250px;
  padding: 15px;
  margin: 19px 0 24px 0;
  outline: none;
  background: #fff;
}
input[type=text]:focus, input[type=password]:focus {
  background-color: #fff;
}

/*sign up button*/
.btn {
  background-color: #000000;
  color: white;
  padding: 10px;
  cursor: pointer;
  width: 250px;
}
.btn:hover {
  background-color: white;
  color: black;
}

/*show password*/
.see i{
  margin-left: -29px;
  cursor: pointer;
  color: black;
}

/*links*/
a{
  scroll-behavior: smooth;
  color: dodgerblue;
}

/*show errors*/
.error i{
  color: red;
}

/*show success login*/
.success {
  margin: auto;
  font-size: 20px;
  border-style: inset;
  width: 40%;
}
.success i {
  color: green;
  font-size: 30px;
}
</style>
</head>

<body>
 <!--navigation bar-->
 <div class="topnav">
  <a  href="css.html"><i class="fa fa-home"></i> Home</a>
  <div class="dropdown">
   <button class="drpbutton"><i class="fa fa-globe"></i> Donate</button>
   <div class="droplist">
    <a href="donateN.php"><i class="fa fa-tree"><u> Nature</u></i></a>
    <a href="donateP.php"><i class="fa fa-child"><u> People</u></i></a>
   </div>
  </div>
  <a href="contact.html"><i class="fa fa-envelope"></i> Contact</a>
  <a class="active" href="login.php"><i class="fa fa-user"></i> Log in/out</a> 
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

<!--sign up form-->
 <form method="post" class="container" id="form" align="center">
 <!--php sign up script-->
 <?php
   if($_SERVER['REQUEST_METHOD']==='POST'){
   //connection to database
   global $db;
   $db = new PDO("mysql:host=localhost;dbname=iris_db", "root", "");
   //get fields
   $email = trim($_POST['email']);
   $password = trim($_POST['psw']);
   $confirm = trim($_POST['psw-repeat']);
   $password_hash = password_hash($password, PASSWORD_DEFAULT);
   //sql query
   if($query = $db->prepare("SELECT * FROM users WHERE email = $email")) {
   $error = '';
   $query->bindParam(':email',$email, PDO::PARAM_STR);  
   $query->bindParam(':password',$password, PDO::PARAM_STR);          
   $query->execute(array(':email' => $email));
   if ($query->rowCount() > 0 ) {
    echo 'The email address used in an account';
   } else {
   //if passwoed does not match
   if (empty($error) && ($password != $confirm)) {
   $error .= '<p class="error"><i class="fa fa-warning"></i></br>Password does not match!<br>Try again.</p>';
   }
   //if no error occurred
   if (empty($error) ) {
   //sql query
    $insertQuery = $db->prepare("INSERT INTO users(email,   password) VALUES (?, ?);");
    $insertQuery->bindParam(1, $email, PDO::PARAM_STR );
    $insertQuery->bindParam(2, $password_hash, PDO::PARAM_STR);
    $result = $insertQuery->execute();
    if ($result) {
    //success sign up
     $error .= '<div class="success"></br><i class="fa fa-check"></i></br>Account created.</br>You are now a member!</br><a href="login.php">Log in to your account</a></br><a href="css.html" style="font-size:15px;">Home</a></br></br></div><br>';
    }else {
     //email already in use
      $error .= '<p class="error"><i class="fa fa-warning"></i></br>Email already in use.</br>Try to <a href="login.php">login in</a>. <br>Forgot your password? <a href="contact.html">Contact us</a>.</p>';
    }
   }
  }
 }
 $db = null;
 }
 ?>

<!--print reasult-->
 <?php if (isset($error)) {
 echo $error; }?> 

 <h1>Sign Up</h1>
 <!--email field-->
 <label for="email"><b>Email</b></label>
 </br>
 <input type="email" placeholder="Enter Email" name="email" required>
 </br>
 <!--password field-->
 <label for="psw"><b>Password</b></label>
 </br>
 <!--show password-->
 <div class="see">
  <input type="password" placeholder="Enter Password" name="psw" id="psw" required minlength="8">
  <i class="fa fa-eye" id="togglePassword"></i>
  </br>
  <!--confirm password-->
  <label for="psw-repeat"><b>Repeat Password</b></label>
  </br>
  <input type="password" placeholder="Repeat Password" name="psw-repeat" required minlength="8">
  </br>
  <!--terms and privacy links-->
  By creating an account you agree to our <a href="policy.html" target="_blank" style="color:dodgerblue">Terms & Privacy</a>.
  </br>
  </br>
  <!--sign up button-->
  <input type="submit" class="btn" value="Sign Up" id="submit">
  <br/>
 </form>

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

<!--show password-->
<script>
 //variables
 const togglePassword = document.querySelector('#togglePassword');
 const password = document.querySelector('#psw');
togglePassword.addEventListener('click', function (e) {
    //show password
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    //change icon
    this.classList.toggle('fa-eye-slash');
});
</script>

</body>
</html>
