<?php

   ob_start();
   session_start();


$user="root";
$pass="mysql123";
$pdo = new PDO('mysql:host=localhost;dbname=todaytransit', $user, $pass);
include 'connection.php'; 

// connect to database
$connection = connect();
$username = $password = "";
$username_err = $password_err = $successmsg= "";
 //
?>
<?php

if (isset($_POST['submit']))
{
	echo "hello";
 $user=$_POST['username'];
$password=md5($_POST['password']);
echo $user;

$q1=$pdo->prepare("select * from users where username='$user' and password='$password' and isactive=1");
 $q1->execute();
 $result=$q1->rowCount();
 echo $result;

 /* $sql = "select pstateID from users where username='$user' and passwordSlug='$password' and isactive=1";

    $result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
echo "Result: " . $row['value']; */
 $sql3="select * from users where username='$user' and password='$password' and isactive=1";
$userinfo=$connection->query($sql3)->fetchAll(PDO::FETCH_ASSOC);
$stateID=$userinfo[0]['stateID'];
$companyID=$userinfo[0]['companyID'];
$fullNM=strtoupper($userinfo[0]['first_name'].' '.$userinfo[0]['last_name']);
$userID=$userinfo[0]['ID'];
$driverID=$userinfo[0]['driverID'];
$userTY=$userinfo[0]['userTY'];
$pstateID=$userinfo[0]['pstateID'];
$pcompanyID=$userinfo[0]['pcompanyID'];
print_r($userinfo);
//echo $stateID;
 //exit;
 $q2="select * from states where ID='$stateID'";
  $stateinfo=$connection->query($q2)->fetchAll(PDO::FETCH_ASSOC);
$colorLN=$stateinfo[0]['colorLN'];
$colorSB=$stateinfo[0]['colorSB'];
$imageFile=$stateinfo[0]['imageFile'];
$headerBT=$stateinfo[0]['headerBT'];
$title=$stateinfo[0]['title'];
 //print_r($stateinfo);
//exit;
 //$states  = $connection->query($ql)->fetchAll(PDO::FETCH_ASSOC);
 /* $state=$userinfo['pstateID'];
 if ($state <=0){echo"hello"; */
// exit;/* } */
 if($result>0){
	 $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = $user;
					$_SESSION['stateID'] = $stateID;
					$_SESSION['companyID'] = $companyID;
					$_SESSION['title'] = $title;
				$_SESSION['fullNM']=$fullNM;
				$_SESSION['userID']=$userID;
				$_SESSION['driverID']=$driverID;
				$_SESSION['userTY']=$userTY;
				$_SESSION['colorLN']=$colorLN;
				$_SESSION['colorSB']=$colorSB;
				$_SESSION['imageFile']=$imageFile;
				$_SESSION['headerBT']=$headerBT;
				$_SESSION['pstateID']=$pstateID;
				$_SESSION['pcompanyID']=$pcompanyID;
	 echo 'hello again'.$_SESSION['username'];
	 $msg=" Login Successful".$_SESSION['username']; 
	 echo $msg;
	 header('Location:dashboard.php');
	 exit();
  }	
  else
	  $msg="Please check your username and password".$user.$password;
}	
?>
<html>
<head>
 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | General Form Elements</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
  .form-horizontal{
	margin-left:200px;
	margin-right:200px;
	margin-top:300px;
  }
  
  </style>
</head>
<body>

<div class="card card-info" >
              <div class="card-header">
                <h3 class="card-title">LogIn Page</h3>
              </div>
 <form class="form-horizontal" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="check">
                        <label class="form-check-label" for="exampleCheck2">Remember me</label>
                      </div>
                    </div>
                  </div>
				  <span class="error">* <?php echo $msg;?></span>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="submit">Sign in</button>
                  <!--button type="submit" class="btn btn-default float-right">Cancel</button-->
                </div>
                <!-- /.card-footer -->
              </form>
			  </div>
</body>

</html>