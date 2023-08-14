<?php
$error=0;
// include('config.php');
$servername = "localhost";
$username = "root";
$password = "";
$mydb = "mydb";

// Create connection
$conn = new mysqli($servername, $username, $password,$mydb);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

if(isset($_REQUEST['submit']))
{
  $name = $_REQUEST['name'];
  $dob = $_REQUEST['dob'];
  $email = $_REQUEST['email'];
  $mobile = $_REQUEST['mobile'];

  if(empty($name))
  {
    $name_error = "Please enter the Name";
    $error=1;
  }
  else if(!preg_match("/^[a-zA-Z ]*$/", $name))
  {
    $name_error = "Only letters are allowed";
    $error=1;
  }
  if(empty($dob))
  {
    $dob_error = "Please enter the Date of Birth";
    $error=1;
  }
  if(empty($email))
  {
    $email_error = "Please enter the Email Id";
    $error=1;
  }
  else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
    $email_error = "Invalid Email Format";
    $error=1;
  }

if(!preg_match('/^[0-9]{10}+$/', $mobile)) {
$mobile_error = "Invalid Phone Number";
  $error=1;
}

  // if(empty($mobile))
  // {
  //   $mobile_error = "Please enter the Mobile Number";
  //   $error=1;

  // }

  if($error==0)
  {
  $insert_query = mysqli_query($conn,"INSERT INTO `contactform`(`name`, `dob`, `email`, `mobile`) VALUES ('$name','$dob','$email','$mobile')");
  if($insert_query>0)
  {
    $msg = "Registration successfull";
  }
  else
  {
    $msg = "Error!";
  }
}
else
{
  $msg = "Please fill all fields";
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
    <style>
 .box
 {
  width:100%;
  max-width:600px;
  background-color:#f9f9f9;
  border:1px solid #ccc;
  border-radius:5px;
  padding:16px;
  margin:0 auto;
 }
 .error
{
  color: red;
  font-weight: 700;
} 
</style>
</head>

<body>  
    <div class="container">  
    <div class="table-responsive">  
    <h3 align="center">Server Side Validation</h3><br/>
     <div class="box">
     <form id="validate_form" method="post" >
     <div class="form-group">
       <label for="name">Name</label>
       <input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php if(isset($name)){ echo $name; }?>"/>
       <span class="text-danger"><?php if(!empty($name_error)){ echo $name_error; } ?></span>
      </div> 
      <div class="form-group">
       <label for="dob">Date of Birth</label>
       <input type="date" name="dob" class="form-control" value="<?php if(isset($dob)){ echo $dob; }?>"/>
       <span class="text-danger"><?php if(!empty($dob_error)){ echo $dob_error; } ?></span>
      </div> 
       <div class="form-group">
       <label for="email">Email</label>
       <input type="text" name="email" placeholder="Enter Email" class="form-control" value="<?php if(isset($email)){ echo $email; }?>"/>
       <span class="text-danger"><?php if(!empty($email_error)){ echo $email_error; } ?></span>
      </div>
      <div class="form-group">
       <label for="mobile">Mobile No.</label>
       <input type="text" name="mobile" id="mob" placeholder="Enter Mobile" class="form-control" value="<?php if(isset($mobile)){ echo $mobile; }?>"/>
       <span class="text-danger"><?php if(!empty($mobile_error)){ echo $mobile_error; } ?></span>
      </div>
      <div class="form-group">
       <input type="submit" name="submit" value="Submit" class="btn btn-success" />
       </div>
       <p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
     </form>
     </div>
   </div>  
  </div>
 </body>  
</html>