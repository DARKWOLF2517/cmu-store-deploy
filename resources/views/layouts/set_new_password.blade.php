<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="custom_css/Login.css" rel="stylesheet">
    {{-- <script src="{{ asset('js/app.js') }}" defer> --}}


    <link rel="icon" href="{{ url('https://i.pinimg.com/736x/00/eb/c7/00ebc7ed5034e9f18acae56a19966099--flat-illustration-stock-illustrations.jpg') }}">

    {{-- @vite('resources/js/app.js''vendor/courier/build') --}}
    @vite('resources/js/app.js', 'build')


</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="login-wrap p-4 p-md-5">
    <div><h3> Change Password </h3>
        <hr>
        <div id="app">
            <change-password>

            </change-password>
        </div>

        </div>

    </div>
    <div class="text-center mt-2">
        <small>
            By changing the password, you have agreed to our
            <a type="button" data-toggle="modal" data-target="#conditionsModal" href="#">conditions</a>.
        </small>
    </div>
<!-- Condition Bootstrap Modal -->
<div class="modal fade" id="conditionsModal" tabindex="-1" role="dialog" aria-labelledby="conditionsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="conditionsModalLabel">Terms and Conditions</h5> --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="modal-title text-primary text-center" id="conditionsModalLabel">Terms and Conditions</h4>
                <h5 class="mt-2"> Welcome to CMU-STORE-AMS! </h5>
                <p>By changing the password, you agree to the following terms and conditions:</p>

                <h6 style="font-weight: bold;">1. Account Security:</h6>
                <p>Changing your password grants you full control of your account. It is essential to keep your password secure and not share it with others.</p>

                <h6 style="font-weight: bold;">2. Remember Your Password:</h6>
                <p>It is your responsibility to remember and safeguard your password. The student organization is not responsible for password retrieval or recovery.</p>

                <h6 style="font-weight: bold;">3. Personal Responsibility:</h6>
                <p>You are solely responsible for maintaining the confidentiality of your password and account information. Any activities that occur under your account are your responsibility.</p>

                <p>These terms and conditions may be subject to change. Please review them periodically for any updates.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




</body>


</html>
