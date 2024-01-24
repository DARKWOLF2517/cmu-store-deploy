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
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
          <div class="login-wrap p-4 p-md-5">
              <div class="logo">
                <img src="/assets/CSA_logo.png" alt="CMULogo">
              </div>
              <h5>CMU-STORE-AMS</h5>
              <login-form>

              </login-form>
              {{-- <form action="{{ route('authentication') }}" method="POST" class="login-form">
                @csrf
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fas fa-user"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control rounded-left" placeholder="Username" required name="email">
                  </div>
                </div>
                <div class="form-group d-flex">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control rounded-left" placeholder="Password" required name="password">
                  </div>
                </div>
                <div class="form-group d-md-flex">
                  <div class="w-50">
                    <label>
                      <input type="checkbox" checked="">
                      Remember Me
                    </label>
                  </div>
                  <div class="w-50 text-md-right">
                    <a href="#">Forgot Password</a>

                </div>
                <div class="form-group text-right">
                  <button type="submit" class="btn btn-primary rounded submit">Log In</button>
                </div>
              </form> --}}
          </div>
        </div>
      </div>
    </div>
  <div>
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
