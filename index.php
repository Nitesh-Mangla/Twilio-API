<?php session_start();?>
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
<div class="bs-example">
    <form action="send_otp.php" method="post">
         <p style="color:green; text-align: center;margin: 1% 0 1% 0"><?php echo isset( $_SESSION['msg'] )? $_SESSION['msg']:''; unset($_SESSION['msg']);?></p>  
        <p style="color:red; text-align: center;margin: 1% 0 1% 0"><?php echo isset( $_SESSION['error'] )? $_SESSION['error']:''; unset($_SESSION['error']);?></p>
        <div class="form-group">
            <label for="inputEmail">Country Code</label>
            <input type="text" class="form-control" id="inputEmail" placeholder="Country Code" name="country_code" required>
        </div>
        <div class="form-group">
            <label for="inputPassword">Phone No</label>
            <input type="text" class="form-control" id="inputPassword" placeholder="Phone No" name="phone_number" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Send OTP</button>
    </form>
</div>
</body>
</html>                            