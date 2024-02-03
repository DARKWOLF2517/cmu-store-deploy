<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Users</title>
  <link href="/custom_css/usercard.css" rel="stylesheet">
  {{-- <link href="/custom_css/Navbars.css" rel="stylesheet"> --}}
  {{-- <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/"> --}}
  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@ 5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet"> --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  @vite('resources/js/app.js')
</head>
<body>
  <div id="app">
    <div class="wrapper">
      <div class="top-nav">
          <a href="#" class="nav-link link-light">
              <span class="nav-name">CMU-STORE-AMS</span>
          </a>

          <div class="profile-dropdown dropdown">
              <a href="#" class="d-flex align-items-center link-light text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="https://indonesiasatu.co.id/assets/themes/indonesiasatu/img/user.png" alt="user-image" width="32" height="32" class="rounded-circle me-2">
                        <span class="profile-name"><strong>{{Session::get('user_name')}}</strong></span>
              </a>
              <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                  {{-- <side-nav-button
                  link_name="Settings"
                  link_route = "#"
                  show_icon = "{{false}}"
                  >
                  </side-nav-button>

                  <side-nav-button
                  link_name="Profile"
                  link_route = "#"
                  show_icon = "{{false}}"
                  >
                  </side-nav-button>

                  <li><hr class="dropdown-divider"></li> --}}

                  <side-nav-button
                  link_name="Sign out"
                  link_route = "{{url('/logout')}}"
                  show_icon = "{{false}}"
                  >
                  </side-nav-button>

              </ul>
          </div>
      </div>
  </div>
      <user-organization
        id={{Auth::id()}}
        school_year_session={{Session::get('school_year')}}
      ></user-organization>
  </div>
  {{-- <div class="container" id = "usercards">
    <div class="user-card" onclick="handleCardClick('User 1')">
      <a href="#">
        <h3>CSCo</h3>
        <hr>
        <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="User 1">
        <p>College of Information Technology Sciences and Computing Student Council</p>
      </a>
    </div>
    <div class="user-card" onclick="handleCardClick('User 2')">
      <a href="#">
        <h3>CSCo</h3>
        <hr>
        <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="User 2">
        <p>College of Information Technology Sciences and Computing Student Council</p>
      </a>
    </div>
    <div class="user-card" onclick="handleCardClick('User 3')">
      <a href="#">
        <h3>CSCo</h3>
        <hr>
        <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="User 3">
        <p>College of Information Technology Sciences and Computing Student Council</p>
      </a>
    </div>
  </div>

  <script>
    function handleCardClick(userName) {
      console.log(`Clicked on ${userName} user card.`);
      // You can add more actions or interactivity here, such as opening a modal, navigating to a new page, etc.
    }
  </script> --}}

</body>
</html>


