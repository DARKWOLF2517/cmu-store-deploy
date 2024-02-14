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
  <style>
    .top-nav {
    position: absolute;
    width: 100%;
    top: 0;
    background-color: #42b385;
    color: #ffffff;
    padding: 0.875rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 3.125rem;

    }
    .top-nav {
        align-items: center;
        color: #ffffff;
        text-decoration: none;
        margin-right: 0.625rem;
    }
  </style>
</head>

<body>
  <div id="app">
      <!-- TOP NAV BAR -->
      <div class="wrapper">
        <div class="top-nav text-center">
            <span class="nav-link-text"> CMU-STORE-AMS</span>
        </div>
    </div>

    <div class="content">
        <div class="container d-flex ">
            <div class="row ">
              <div class="col-md-8 col-lg-5 d-flex flex-column mb-4 mb-md-0">
                <div class="p-4 p-md-5 flex-fill ">
                        <div class="logo">
                            <img src="/assets/CSA_logo.png" alt="CMULogo">
                            <h5>CMU-STORE-AMS</h5>
                          </div>
                          <div class="row justify-content-center align-items-center">

                          <small class="mt-2 mb-2 text-center text-muted">
                            "Welcome to CMU-STORE-AMS, your hub for exploring events, managing accountabilities, and conducting evaluations."</small>
                          <login-form>
                          </login-form>
                    </div>

                </div>
              </div>
              <div class="image-container col-md-6 col-lg-5 d-flex ">
                <img src="/assets/login-image.png" alt="image" class="align-self-stretch">
              </div>
            </div>
          </div>
      <div>
    </div>
</div>
</div>
</div>

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
