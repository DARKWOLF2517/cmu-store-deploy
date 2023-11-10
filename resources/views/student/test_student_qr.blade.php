<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Add Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
<!-- Add Font Awesome CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link href="/custom_css/stylesheet.css" rel="stylesheet">
<link href="/custom_css/qrscanner.css" rel="stylesheet">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
@vite('resources/js/app.js')
<title>Student's Profile</title>
<link href="/custom_css/studentProfile.css" rel="stylesheet">
</head>
<body>
<div id="app" >
            <!-- Bootstrap Top Navigation Bar -->
            <div class="top-nav">
            
                <a href="#" class="nav-link link-light">

                    <span class="nav-link-text"> CMU-STORE-AMS</span>
                </a>

                    <a href="#" class="d-flex align-items-center link-light text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                        <span class="profile-name"><strong>{{Auth::user()->name}}</strong></span>
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                        <side-nav-button
                            link_name="Settings"
                            link_route = "#"
                            show_icon = "{{false}}"
                            >
                            </side-nav-button>

                            <side-nav-button
                            link_name="Profile"
                            link_route = "{{url('/student_profile')}}"
                            show_icon = "{{false}}"
                            >
                            </side-nav-button>

                            <li><hr class="dropdown-divider"></li>

                            <side-nav-button
                            link_name="Sign out"
                            link_route = "{{url('/logout')}}"
                            show_icon = "{{false}}"
                            >
                            </side-nav-button>
                    </ul>
                </div>

    <div class="content">
        <div class="container mt-4">
            <student-profile
            user_id = {{Auth::id()}}
            user_org = {{Session::get('org_id')}}
            ></student-profile>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  
</body>
</html>
