<?php 
session_start();
    if( isset( $_POST['submit'] ) ){    
        if( isset( $_POST['otp'] ) && !empty( $_POST['otp'] ) ){
            try{
                include_once 'config.php';
                $sql = $conn->prepare( 'SELECT opt FROM `user_verify` WHERE phone_number = :number' );
                $sql->bindParam( 'number', $_SESSION['phone'] );
                $sql->execute();
                $result = $sql->fetchAll();
                $verify_status = 1;
                if( count( $result ) > 0 ){
                     $sql = $conn->prepare( 'UPDATE `user_verify` SET verified = :otp WHERE phone_number = :number'  );
                    $sql->bindParam( ':otp',   $verify_status);
                    $sql->bindParam( ':number', $_SESSION['phone'] );
                    $sql->execute(); 
                    $_SESSION['msg'] = 'Number is verified';
                }else{
                    $_SESSION['error'] = 'Enter Correct Otp';
                }
               
            }catch( Exception $e ){
                echo $e->getMessage();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Example of Bootstrap 3 Vertical Form Layout</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style type="text/css">
    .bs-example{
    	margin: 20px;
    }
</style>
</head>
<body>
    <div>
<form action = "verified_otp.php" method="post">
    <div class="form-group"> <!-- Email field !-->
        <p style="color:green; text-align: center;margin: 1% 0 1% 0"><?php echo isset( $_SESSION['msg'] )? $_SESSION['msg']:''; unset($_SESSION['msg']);?></p>  
        <p style="color:red; text-align: center;margin: 1% 0 1% 0"><?php echo isset( $_SESSION['error'] )? $_SESSION['error']:''; unset($_SESSION['error']);?></p>  
        <label for="email_id" class="control-label">Enter Received OTP</label>
        <input type="number" class="form-control" id="email_id" name="otp" placeholder="Received OTP">
    </div>
    
    <div class="form-group"> <!-- Submit button !-->
        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            </div>  
</form>
</div>
</body>
</html>                            
