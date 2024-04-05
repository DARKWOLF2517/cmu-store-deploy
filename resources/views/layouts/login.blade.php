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
    <link rel="icon" href="{{ asset('assets/CSA_logo.png') }}">

  {{-- @vite('resources/js/app.js''vendor/courier/build') --}}
  @vite('resources/js/app.js', 'build')

</head>

<body>
<div id="app">
<div class="container-fluid px-0">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
      <a class="navbar-title" href="#">CMU-STORE-AMS</a>
    </div>
  </nav>

  <!-- Flex Container for the two nested containers -->
  <div class="flex-container">
    <!-- First Container with Login Content -->
    <div class="col-lg-6 col-md-12 mb-4">
      <div class="container" id="login-content">
        <div class="login-content">
            <div class="logo text-center">
                {{-- <link href="{{ asset('custom_css/tables.css') }}" rel="stylesheet"> --}}
                <img src="{{ ('assets/CSA_logo.png') }}" rel="image">
                <h5 class="mt-2">CMU-STORE-AMS</h5>
            </div>
            <div class="text-center mt-4">
                <p class="text-muted">
                    "Welcome to CMU-STORE-AMS, track and manage easily."
                </p>
            </div>
            <div class="mt-4">
                <login-form></login-form>
            </div>
        </div>
      </div>
    </div>

    <!-- Second Container with Image -->
    <div class="col-lg-6 col-md-12 d-none d-md-block">
      <img src="{{ ('assets/login-image.png') }}" class="img-fluid full-screen-img" rel="image">
    </div>
  </div>
</div>
</div>

</body>
</html>
