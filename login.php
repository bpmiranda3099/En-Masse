<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @font-face {
            font-family: 'Nothing';
            src: url('/assets/fonts/nothing-font.otf');
        }
        body {
            font-family: 'Nothing', sans-serif;
            background-color: #fff;
            color: #000;
            margin: 0;
            padding: 0;
        }
        .login-container {
            text-align: center;
            margin-top: 50px;
        }
        .login-container .card {
            border: none;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Adding a subtle drop shadow */
        }
        .login-container .card-header {
            background-color: #fff;
            border: none;
            font-size: 24px;
            font-weight: bold;
            padding: 20px 0;
        }
        .login-container .card-body {
            background-color: #fff;
            padding: 20px;
        }
        .login-container .form-control {
            border: 1px solid #ddd;
            border-radius: 0;
            margin-bottom: 20px;
        }
        .login-container .btn-primary {
            background-color: #000;
            border: none;
            border-radius: 0;
            font-weight: bold;
            padding: 10px 20px;
        }
        .login-container .btn-primary:hover {
            background-color: #333;
        }
        .login-container p {
            margin-top: 20px;
        }
    </style>
</head>
<body>
	<header>
		<?php include 'menu.html'; ?>
	</header>
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-8"> <!-- Adjusted width of login form for different screen sizes -->
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form action="login_process.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="login" name="login" placeholder="Username or Email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                        <p>Don't have an account? <a href="register.php">Register here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
