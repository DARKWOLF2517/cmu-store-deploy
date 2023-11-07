<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link href="{{ asset('custom_css/Login.css') }}" rel="stylesheet">

  {{-- icon for webpage tab --}}
  <link rel="icon" href="{{ url('https://i.pinimg.com/736x/00/eb/c7/00ebc7ed5034e9f18acae56a19966099--flat-illustration-stock-illustrations.jpg') }}">

  @vite('resources/js/app.js')
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-5">
            <div class="login-wrap p-4 p-md-5">
              <div class="logo">
                <img src="/assets/CMULogo.png" alt="CMULogo">
              </div>
              <h5>CMU-STORE-AMS</h5>

              <form action="{{ route('authentication') }}" method="POST" class="login-form">
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
                  {{-- <div class="w-50 text-md-right">
                    <a href="#">Forgot Password</a>
                  </div> --}}
                </div>
                <div class="form-group text-right">
                  <button type="submit" class="btn btn-primary rounded submit">Log In</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </body>
  {{-- <div id="app">
    <login-form> </login-form>
  </div> --}}

</html>
