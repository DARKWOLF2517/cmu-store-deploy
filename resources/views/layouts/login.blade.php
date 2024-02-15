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

<body class="h-100">
  <div id="app">
      <!-- TOP NAV BAR -->
      <div class="wrapper">
            <div class="top-nav text-center">
                <span class="nav-link-text"> CMU-STORE-AMS</span>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            </div>
        </nav>

<div class="container-fluid">
    <div class="flex-container ">
      <div class="col-lg-6 col-md-12 mb-4">
        <div class="container">
            <div class="login-content p-4">
                <div class="logo text-center">
                    <img src="/assets/CSA_logo.png" alt="CMULogo">
                    <h5>CMU-STORE-AMS</h5>
                </div>
                <div class="text-center mt-4">
                    <small class="text-muted">
                        "Welcome to CMU-STORE-AMS, track and manage easily."
                    </small>
                </div>
                <div class="mt-4">
                    <login-form></login-form>
                </div>
            </div>
        </div>
      </div>

      <!-- Second Container with Image -->
      <div class="col-lg-6 col-md-12 ">
        <div class="container">
            <img src="/assets/login-image.png" alt="image" class="img-fluid align-image-stretch">
        </div>
      </div>
    </div>
  </div>
</div>
    {{-- <div class="page-content-wapper">
        <div class="page-container">
            <div class="login-wrap d-flex justify-content-center align-items-center">
                <div class="row">
                    <div class="col-md-6 mt-4">
                        <div class="login-content p-4">
                            <div class="logo text-center">
                                <img src="/assets/CSA_logo.png" alt="CMULogo">
                                <h5>CMU-STORE-AMS</h5>
                            </div>
                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    "Welcome to CMU-STORE-AMS, track and manage easily."
                                </small>
                            </div>
                            <div class="mt-3">
                                <login-form></login-form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center align-items-center mt-4">
                        <div class="login-image ">
                            <img src="/assets/login-image.png" alt="image" class="img-fluid align-image-stretch">
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div> --}}

{{--
  <script>
    function validateForm() {
      var username = document.getElementById("username").value;
      var password = document.getElementById("password").value;

      // You can replace these with your actual username and password validation logic
      var correctUsername = "yourUsername";
      var correctPassword = "yourPassword";

      if (username !== correctUsername || password !== correctPassword) {
        var errorMessage = document.getElementById("error-message");
        errorMessage.textContent = "Incorrect username or password. Please try again.";
        return false; // Prevent form submission
      }

      return true; // Allow form submission if username and password are correct
    }
  </script> --}}
    </body>


</html>
