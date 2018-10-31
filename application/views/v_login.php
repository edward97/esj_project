<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login .:</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css') ?>" />
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/img/favicon.png') ?>" />
</head>

<body>
    <div class="container">
        <form class="form-login">
            <h2 class="form-login-heading bg-info text-white">sign in now</h2>

            <div class="login-wrap">
                <div class="form-group">
                    <input type="text" name="username" class="form-control form-control-sm" id="username" placeholder="Username" autofocus>
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-sm" id="password" placeholder="Password">
                </div>

                <div class="clearfix">
                    <div class="form-group form-check float-left">
                        <input type="checkbox" class="form-check-input" id="remember-me">
                        <label for="remember-me" class="form-check-label">Remember me</label>
                    </div>

                    <div class="form-group float-right">
                        <a href="javascript:;" class="badge badge-light" data-toggle="modal" data-target="#forgotPassword">Forgot Password?</a>
                    </div>
                </div>

                <button type="button" class="btn btn-info btn-sm btn-block" id="sign-in">
                    <i class="fas fa-lock"></i> SIGN IN
                </button>
                <hr>

                <div class="text-center">
                    Don't have an account yet?
                    <br />
                    <a href="javascript:;">Create an account</a>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="forgotPassword" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title text-white" id="forgotPasswordLabel">Forgot Password</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <p>Enter your e-mail address below to reset your password.</p>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" placeholder="E-mail" autocomplete="off">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-sm btn-info">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- Backstretch - You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="<?php echo base_url('assets/vendor/jquery.backstretch.min.js') ?>"></script>
    
    <!-- Custom JS -->
    <script src="<?php echo base_url('assets/js/beta.js') ?>"></script>

    <script>
        let url = "<?php echo base_url() ?>";

        // login-background
        $.backstretch(url+"assets/img/login-bg.jpg", { speed: 500 });
    </script>
</body>
</html>