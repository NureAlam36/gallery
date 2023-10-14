<!doctype html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="Favicon.png">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="lib/css/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <title>Admin Login</title>
</head>

<body>
    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <?php
                    if (isset($_GET["status"]) && isset($_GET["message"])) {
                    ?>
                        <div class="alert <?php echo $_GET["status"]; ?>" role="alert">
                            <?php echo $_GET["message"]; ?>
                        </div>

                    <?php
                    }
                    ?>
                    <div class="card">
                        <div class="card-header">Admin Login</div>
                        <div class="card-body">
                            <form action="login_core.php" method="post">
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input type="email" id="email-address" class="form-control" name="email_addr" placeholder="Enter Email Account" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" placeholder="Enter Password" required>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit submit-btn" class="btn primary">
                                        Login In
                                    </button>
                                </div>
                        </div>
                        </form>
                    </div>
                    <div class="mt-4 text-muted">
                        <span><i>Email: admin@gmail.com</i></span>
                        <br>
                        <span><i>Password: 1234</i></span>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </main>







</body>

</html>