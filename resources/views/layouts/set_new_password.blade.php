<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password @yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    {{-- <script src="{{ asset('js/app.js') }}" defer> --}}

    <link rel="icon" href="{{ asset('assets/CSA_logo.png') }}">
    {{-- @vite('resources/js/app.js''vendor/courier/build') --}}
    @vite('resources/js/app.js', 'build')
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .login-wrap {
            max-width: 400px;
            margin: 150px auto 0;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 5px;
        }

        .login-form .form-group {
            margin-bottom: 20px;
        }

        .login-form label {
            font-weight: bold;
        }

        .login-form .input-group-prepend .input-group-text {
            background-color: #fff;
        }

        .login-form .form-control {
            border-radius: 3px;
            border-color: #ccc;
        }

        .login-form .submit {
            background-color: #42B385;
            border-color: #42B385;
            font-weight: bold;
        }

        .login-form .submit:hover {
            background-color: #53967c;
            border-color: #53967c;
        }

        .login-form a {
            color: #53967c;
        }

        .login-form a:hover {
            color: #48be8f;
        }

        .login-wrap h5 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 40px;
            color: #42B385;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 100px;
            /* Adjust the width as needed */
        }

        .flex-container {
            display: flex;
            align-items: center;
            /* Align items vertically in the center */
            justify-content: center;
            /* Center the content horizontally */
            height: 100vh;
            /* Optional: Set a specific height for the container */
        }

        .wrapper {
            position: relative;
        }

        .top-nav {
            position: absolute;
            width: 100%;
            top: 0;
            background-color: #42b385;
            color: #ffffff;
            padding: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 3.125rem;
        }

        .login-wrap {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1)
        }

        .accordion-button {
            background-color: transparent;
            color: gray;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            transition: background-color 0.3s ease;
        }


        .accordion-body {
            border-top: none;
            border-radius: 0 0 10px 10px;
            padding: 1rem;
            background-color: #ffffff;
        }

        .accordion-body p {
            margin-bottom: 0.5rem;

        }

        .accordion-item {
            background-color: #f8f9fa;
        }

        .accordion-item:first-child {
            border-radius: 10px 10px 0 0;
        }

        .accordion-item:last-child {
            border-radius: 0 0 10px 10px;
        }

        .small {
            font-size: 10px;
        }
    </style>

</head>

<body>
    <div class="wrapper">
        <div class="top-nav">
            <span class="nav-link-text"> CMU-STORE-AMS</span>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-wrap p-4 p-md-5">
                    <div>
                        <h3> Change Password </h3>
                        <hr>
                        <div id="app">
                            <change-password>

                            </change-password>
                        </div>

                    </div>

                </div>
                <br>
                <div class="accordion accordion-terms-and-condition" id="accordionFlushExample">
                    <div class="accordion-item">
                        <small class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed btn btn-transparent" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                                By changing the password, you have agreed to our <span class="text-primary">Terms and
                                    Conditions </span>
                            </button>
                        </small>
                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <h4 class="modal-title text-primary text-center" id="conditionsModalLabel">Terms and
                                    Conditions</h4>
                                <h5 class="mt-2"> Welcome to CMU-STORE-AMS! </h5>
                                <p>By changing the password, you agree to the following terms and conditions:</p>

                                <h6 style="font-weight: bold;">1. Account Security:</h6>
                                <p>Changing your password grants you full control of your account. It is essential to
                                    keep your password secure and not share it with others.</p>

                                <h6 style="font-weight: bold;">2. Remember Your Password:</h6>
                                <p>It is your responsibility to remember and safeguard your password. The student
                                    organization is not responsible for password retrieval or recovery.</p>

                                <h6 style="font-weight: bold;">3. Personal Responsibility:</h6>
                                <p>You are solely responsible for maintaining the confidentiality of your password and
                                    account information. Any activities that occur under your account are your
                                    responsibility.</p>

                                <p>These terms and conditions may be subject to change. Please review them periodically
                                    for any updates.</p>
                            </div>
                        </div>
                    </div>
                </div>
