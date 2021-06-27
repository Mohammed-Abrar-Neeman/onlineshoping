<?php
session_start();
$message = '';
if ( isset($_POST['securityCode']) && ($_POST['securityCode']!="")){
	if(strcasecmp($_SESSION['captcha'], $_POST['securityCode']) != 0){
		$message = "You have entered incorrect security code! Please try again.";
	}else{
		$message = "Your have entered correct security code."; 
		echo '<script type="text/javascript">
				location.replace("home.php");
			  </script>';
	}
} else {
	$message = "Enter security code."; 
	//include('inc/header.php');
}
?>
<title>Shop Indiana</title> 
<script src="js/load_captcha.js"></script>
<style> {
    font-family: 'Raleway', sans-serif;
    background-color: #e7e7e7;
}
.wrapper {
    width: 800px;
    height: 600px;
    position: relative;
    margin: 3% auto;
    box-shadow: 2px 18px 70px 0px #9D9D9D;
    overflow: hidden;
}

.login-text {
    width: 800px;
    height:450px;
    background: linear-gradient(to left, #ab68ca, #de67a3); 
    position: absolute;
    top: -300px;
    box-sizing: border-box;
    padding: 6%;
    transition: all 0.5s ease-in-out;
    z-index: 11;
}

.text {
    margin-left: 20px;
    color: #fff;
    display: none;
    transition: all 0.5s ease-in-out;
    transition-delay: 0.3s;

    a, a:visited {
        font-size: 36px;
        color: #fff;
        text-decoration: none;  
        font-weight: bold;
        display: block;
    }

    hr {
        width: 10%;
        float: left;
        background-color: #fff;
        font-size: 16px;
    }

    input {
        margin-top: 30px;
        height: 40px;
        width: 300px;
        border-radius: 2px;
        border: none;
        background-color: #444;
        opacity: 0.6;
        outline: none;
        color: #fff;
        padding-left: 10px;
    }

    input[type=text] {
        margin-top: 60px;
    }

    button {
        margin-top: 60px;
        height: 40px;
        width: 140px;
        outline: none;
    }

    .login-btn {
        background: #fff;
        border: none;
        border-radius: 2px;
        color: #696a86;
    }

    .signup-btn {
        background: transparent;
        border: 2px solid #fff;;
        border-radius: 2px;
        color: #fff;
        margin-left: 30px;
    }
}

.cta {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #000000;
    border: 2px solid #fff;
    position: absolute;
    bottom: -30px;
    left: 370px;
    color: #fff;
    outline: none;
    cursor: pointer;
    z-index: 11;
}

.btn {
	width: 60px;
    height: 60px;
    border-radius: 500%;
    background: linear-gradient(to left, #ab68ca, #de67a3);;
    
	box-shadow: 2px 18px 70px 0px #9D9D9D;
    bottom: -30px;
    left: 370px;
    
    
}

.call-text {
    background-color: #fff;
    width: 800px;
    height: 450px;
    position: absolute;
    bottom: 0;
    padding: 10%;
    box-sizing: border-box;
    text-align: center;

    h1 {
        font-size: 42px;
        margin-top: 10%;
        color: #696a86;

        span {
            color: #333;
            font-weight: bolder;
            
        }
    }

    button {
        height: 40px;
        width: 180px;
        border: none;
        border-radius: 20px;
        background: linear-gradient(to left, #ab68ca, #de67a3); 
        color: #fff;
        font-weight: bolder;
        margin-top: 30px;
        cursor: pointer;
        outline: none;
    }
}

.show-hide {
    display: block;
}

.expand {
    transform: translateY(300px);
} </style>

<div class="wrapper">
  <div class="login-text">
    <button class="cta"><i class="fas fa-chevron-down fa-1x"></i></button>
  </div>
  <div class="call-text">
    <h1>Enter the captcha <span>to visit</span>Vagator Store</h1>
	<div class="container">
	<div class="row">			
		<div class="col-md-6">
			<div class="col-md-12">
				<form name="form" class="form" action="" method="post">								
					<div class="form-group">
						<label for="captcha" class="text-info">
						<?php if($message) { ?>
							<span class="text-warning"><strong><?php echo $message; ?></strong></span>
						<?php } ?>	
						</label><br>
						<input type="text" name="securityCode" id="securityCode" class="form-control" placeholder="Enter Security Code">
					</div>
					<div class="form-group">								
						<img src="get_captcha.php?rand=<?php echo rand(); ?>" id='captcha'>
						<br>
						<p><br>Need another security code? <button style="background-color:#696a86; onClick="window.location.reload();">click</button></p>
					</div>										
					<div class="form-group">	
						<input  type="submit" name="submit" class="btn btn-info btn-md" value="Submit">								
					</div>							
				</form>
			</div>
		</div>
	</div>
</div>

  </div>

</div>
