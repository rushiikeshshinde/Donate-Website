<?php
//php included files
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
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!--external css-->
<link rel="stylesheet" href="style.css">

<!--internal css-->
<style>

  body {
  height: 100%;
}
/*login form*/
.container {
  top: 100px;
  position: relative;  
  width: 100%;
  padding: 18px;
  background-color: #000;
  color: white;
}
/*login form fields*/
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

/*links in page*/
a{
  scroll-behavior: smooth;
  color: dodgerblue;
}

/*modal for logged in*/
#modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.6); /* Black w/ opacity */
  font-family: sans-serif;
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
<!--serch bar-->
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
    <li><a href="signUp.php"> Sign Up</a></li>
    <li><a href="css.html"> Social media</a></li>
    <li><a href="policy.html" target="_blank">Terms & Policy</a></li>
    <li><a href="#" style="cursor:context-menu;background-color:white;color:black;"><i>No results found..</i></a></li>
   </ul>
  </div>
 </div>

<!--login form-->
  <form class="container" align="center" method="post">
<!--php code for login form-->
   <?php
     //variables
     $error = '';
     $email = '';
     $password= '';

     if($_SERVER['REQUEST_METHOD']== 'POST'){
      //get username and password
       $email = trim($_POST["mail"]);   
       $password = trim($_POST["pswd"]);
       //if no error occured
       if(empty($error)){
        //sql query
        $sql = "SELECT email, password FROM users WHERE email = ?";
       if($stmt = mysqli_prepare($link, $sql)){
       mysqli_stmt_bind_param($stmt, "s", $param_username);
       $param_username = $email;
       //execute query
       if(mysqli_stmt_execute($stmt)){
         mysqli_stmt_store_result($stmt);
         if(mysqli_stmt_num_rows($stmt) == 1){  
           mysqli_stmt_bind_result($stmt, $email, $hashed_password);
           if(mysqli_stmt_fetch($stmt)){
            //check if password matches
            if(password_verify($password, $hashed_password)){
              $_SESSION["userid"] = true;
              $_SESSION["email"] = $email;   
            }
            //else set error
            else
            { $error .= '<p class="error"><i class="fa fa-warning"></i></br>The password you entered was not valid.<br>Forgot your password?<a href="contact.html">Contact Us</a>.</p>';
            }
            }
          } else{
          //if no username in database set error
          $error .= '<p class="error"><i class="fa fa-warning"></i></br>No account connected to this email!<br>Do not have an account?<a href="signup.php">SignUp</a>.</p>';
           }
         } 
         else{
         echo "Oops! Something went wrong. Please try again later.";
         }
         //if no error set login successfully
         if (empty($error))
         { $error .= '<div class="success"></br><i class="fa fa-check"></i><br>Logged in successfully!<br><a href="#modal">Log out</a>.<br><a href="css.html" style="font-size:15px;">Home</a></br></br></div><br>';
         }
         mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
  }
 ?>

<!--print error-->
 <?php if (empty($error)) {
 echo 'You are not connected to an account!';
  }
 else {
 echo $error;  }
 ?>
    <h1>Login</h1>
    </br>
    <!--email field-->
    <label for="email"><b>Email</b></label>
    </br>
    <input type="email" placeholder="Enter Email" name="mail" required>
    </br>
    <!--password field-->
    <label for="psw"><b>Password</b></label>
    </br>
    <!--show password-->
    <div class="see">
     <input type="password" placeholder="Enter Password" name="pswd" id="psw" required autocomplete="off">
     <i class="fa fa-eye" id="togglePassword"></i>
     </br>
     <!--login button-->
     <input type="submit" class="btn" value="Login"</input>
     <!--sign up link-->
     <div id="new">
      </br>
      <a href="signup.php"><p>Do not have an account?</p></a>
     </div>
    </form> 
   </div>

<!--log out modal-->
 <div id="modal">
  <a class="close" href="successLogin.html">&times;</a>
  <div class="modal-content">
   <i class="fas fa-user-slash"></i>
   <p>Are you sure you want to log out?<br>
   </br>
   <br>
   <a href="logout.php">Yes</a></br>
  </div>
 </div>

<!--JavaScript-->
<!--Script for search bar-->
<script>
function myFunction() {
  //variables
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementsByClassName('text1')[0];
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


<!--script for showing password-->
<script>
 //variables
 const togglePassword = document.querySelector('#togglePassword');
 const password = document.querySelector('#psw');
 //when eye icon clicked
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
