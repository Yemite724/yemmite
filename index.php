
<?php 
    include "auth.php";

    // store Authentication message and clear session
    $mssg = $_SESSION['message'] ?? null;
    $_SESSION['message'] = null;

    //Logged in user Key
    $user = $_SESSION['user'][$_SESSION['id'] ?? null] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Simple Authentication</title>
</head>
<body>
    <div class="container">
        <div class="formHead">Login</div>
        <form id="login" method="post">
            <div class="row">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" autofocus placeholder="Email" autocomplete="off">
            </div>
            <div class="row">
                <label for="password">Password</label>
                <input type="password" name="pass" class="form-control" id="password" placeholder="Password" autocomplete="off">
            </div>
            <div class="row">
                <input type="submit" value="Login" class="btn">
                <a href="#/register" id="register">Don't have an account</a>
            </div>  
        </form>
        <form id="registerAcc" method="POST">
            <div class="row">
                <label for="reg_name">Name</label>
                <input type="text" class="form-control" name="reg_name" id="reg_name" autofocus placeholder="Name" autocomplete="off">
            </div>
            <div class="row">
                <label for="reg_email">Email</label>
                <input type="email" class="form-control" name="reg_email" id="reg_email" autofocus placeholder="Email" autocomplete="off">
            </div>
            <div class="row">
                <label for="reg_password">Password</label>
                <input type="password" class="form-control" name="reg_password" id="reg_password" placeholder="Password" autocomplete="off">
            </div>
            <div class="row">
                <input type="submit" value="Register" class="btn">
                <a href="#/login" id="loginAcc">Already have an account</a>
            </div>
        </form>
        <form method="post" id="account">
            <ul>
                <li><b>Name:</b> <?= $user['name'] ?? null ?></li>
                <li><b>Email:</b> <?= $user['email'] ?? null ?></li>
            </ul>
            <input type="submit" class="btn" name="logout" value="Logout">
        </form>
        <span><?php echo $mssg ?? null ?></span>
    </div>
</body>
</html>
<script>

    let login = document.getElementById('login')
    let head = document.querySelector('.formHead')
    let register = document.getElementById('registerAcc')

    document.getElementById('register').onclick = () => {
        login.style.display = 'none'
        head.textContent = 'Register'
        register.style.display = 'block'
    }
    document.getElementById('loginAcc').onclick = () => {
        document.getElementById('login').style.display = 'block'
        head.textContent = 'Login'
        register.style.display = 'none'
    }
    let page = window.location.hash
    if(page == '#/register'){
        document.getElementById('login').style.display = 'none'
        head.textContent = 'Register'
        register.style.display = 'block'
    }
    else if(page == '#/account'){
        document.getElementById('login').style.display = 'none'
        head.textContent = 'My Account'
        account.style.display = 'block'
    }
</script>