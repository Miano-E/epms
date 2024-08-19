<?php
    include 'includes/database.php';
    include 'includes/loginServer.php';
    session_start();
    // instantiating LoginServer class to access its functions/methods
    $data = new LoginServer();
    // variable to store message
    $message = "";
    // check if login was clicked
    if(isset($_POST["login"])){
        $field = array(
            "Username" => $_POST["Username"],
            "Password" => $_POST["Password"]
        );
        if($data->loginValidation($field)){
            if($data->canLogin("User", $field)){
                $_SESSION["Username"] = $_POST["Username"];
                header("location: dashboard.php");
            }else{
                $message = $data->error;
            }
        }else{
            // if input fields are blank, execute else statement: if both input fields are blank
            $message = $data->error;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title>Login</title>
</head>
<body>
    <header>
        <img src="./chicken.png" alt="" class="login-logo">
    </header>

    <div class="container">
        <h2> Login</h2>
        <?php
            // display error message
            if(isset($message)){
                echo '<label class="text-danger">' . $message . '</label>';
            }
        ?>
        <form action="" method="post">
            <label for = "username">Username</label>
            <input type = "text" name = "Username" value="<?php echo isset($_POST['Username']) ? htmlspecialchars($_POST['Username']) : ''; ?>">
                        
			<label for = "password">Password</label>
			<input type = "password" name = "Password" id = "myInput">
                    
			<input type = "checkbox" onclick = "myFunction()">Show Password
					
			<button type = "submit" name = "login" class = "submitbtn">Login</button>
            <p class="test">Test Credentials: admin | admin</p>
        </form>
    </div>   

        <script>
			function myFunction(){
				var a = document.getElementById("myInput");
				if(a.type === "password"){
					a.type = "text";
				}else{
					a.type = "password";
				}
			}
		</script>

</body>
</html>