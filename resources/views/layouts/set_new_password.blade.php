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
        <form class="login-form">

            <div class="form-group mt-3">

                <b>Enter your Username</b>
                <div class="input-group">
                <input type="text" class="form-control rounded-left"  placeholder="Username" required name="email"  >
                </div>
            </div>
            <div class="form-group">

                    <b>Enter new Password</b>
            <div class="input-group">
                <input type="new-password" class="form-control rounded-left" placeholder="New Password" required name="password" >
            </div>

            </div>

            <b>Retype new Password</b>
            <div class="input-group">
                <input type="retype-new-password" class="form-control rounded-left" placeholder="Retype New Password" required name="password" >
            </div>
                <div class="form-group d-md-flex mt-2">
                    <div>
                        {{-- <small>When you change your password, you gain full control of your account.</small>
                        <small>If you have forgotten your password, please contact the organization that created your account for assistance.</small> --}}
                        <label>
                            <input type="checkbox" checked="">
                            By pressing this, you have agreed to our conditions.
                        </label>
                    </div>
                </div>

            <div class="form-group text-right">
                <button  class="btn btn-secondary rounded submit">Cancel</button>
                <button type="submit" class="btn btn-primary rounded submit">Save Changes</button>
            </div>
        </form>
    </div>
</div>

</body>


</html>
