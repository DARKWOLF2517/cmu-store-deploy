<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OSA</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Add Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- CUSTOM STYLE SHEETS FOUND IN PUBLIC DIRECTORY --}}
    <link href="{{ asset('custom_css/osastylesheet.css') }}" rel="stylesheet">
    @vite('resources/js/app.js', 'build')
</head>
<body>
    <div id="app">
        <div class="wrapper">
            <div class="top-nav">
                <a href="#" class="nav-link link-light">
                    <span class="nav-link-text"> CMU-STORE-AMS</span>
                </a>
                <div>
                    <a href="#" class="d-flex align-items-center link-light text-decoration-none dropdown-toggle"
                        id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        @if (Session::get('profile_picture'))
                            <img src="{{ Session::get('profile_picture') }}" alt="user-image" width="32"
                                height="32"class="rounded-circle me-2">
                        @else
                            <img src="https://indonesiasatu.co.id/assets/themes/indonesiasatu/img/user.png"
                                alt="user-image" width="32" height="32"class="rounded-circle me-2">
                        @endif
                        <span class="profile-name"><strong>{{ Session::get('user_name') }} - Admin</strong></span>
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                        {{-- <side-nav-button
                            link_name="Settings"
                            link_route = "#"
                            show_icon = "{{false}}"
                            >
                        </side-nav-button> --}}
                        <side-nav-button link_name="Sign out" link_route = "{{ url('/logout') }}"
                            show_icon = "{{ false }}">
                        </side-nav-button>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-content-wapper">
            <div class="content">
                <div class="page-container">
                    <div>
                        <osa-page>
                        </osa-page>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
