<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@ 5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <link href="/custom_css/stylesheet.css" rel="stylesheet">
    <link href="/custom_css/allmedia.css" rel="stylesheet">
    <link href="/custom_css/Login.css" rel="stylesheet">
    <link href="/custom_css/Navbars.css" rel="stylesheet">

    <link href="/custom_css/SOEvents.css" rel="stylesheet">
    <link href="/custom_css/SOListofMembers.css" rel="stylesheet">
    <link href="/custom_css/SOAccountabilities.css" rel="stylesheet">
    @vite('resources/js/app.js')
    @yield('custom-style')


</head>
    <body>

        <div id="app">

            <!-- TOP NAV BAR -->
            <div class="wrapper">
                <div class="top-nav">
                <div class="nav-item toggle-button">
                    <button class="btn " id="sidebar-toggle"><i class="bi bi-list"></i></button>
                </div>
                    <a href="#" class="nav-link link-dark">
                        <span class="nav-name">CMU-STORE-AMS</span>
                    </a>

                    <div class="profile-dropdown dropdown">
                        <button class="notification-button btn btn-link">
                            <i class="bi bi-bell"></i>
                        </button>
                        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://cdn.imgbin.com/0/4/19/imgbin-network-administrator-system-administrator-computer-icons-computer-network-database-others-k0X6MX9NfNjeUyBaXUweXTcMw.jpg" alt="" width="32" height="32" class="rounded-circle me-2">
                            <span class="profile-name"><strong>Admin</strong></span>
                        </a>

                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{url('/logout')}}">Sign out</a></li>

                        </form>
                        </ul>
                    </div>
                </div>
            </div>
                <!-- SIDE NAV BAR -->
            <div class="wrapper">
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-light sidebar" id="sidebarCollapse">
                    <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                            <a href="{{ url('/studenthome') }}" class="nav-link link-dark">
                                <i class="bi bi-people"></i>
                                <span class="nav-link-text">Home</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/student_organization_attendance') }}" class="nav-link link-dark">
                                <i class="bi bi-people"></i>
                                <span class="nav-link-text">Attendance</span>
                            </a>
                        </li>
                        <li class="nav-item">

                            <a href="{{ url('/student_organization_member_list') }}" class="nav-link link-dark">
                                <i class="bi bi-person"></i>
                                <span class="nav-link-text">Student</span>
                            </a>
                        </li>
                        <li class="nav-item">

                            <a href="{{ url('/student_organization_events') }}" class="nav-link link-dark">
                                <i class="bi bi-calendar-check"></i>
                                <span class="nav-link-text">Events</span>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/student_organization_accountabilities') }}" class="nav-link link-dark">
                                <i class="bi bi-currency-dollar"></i>
                                <span class="nav-link-text">Accountabilities</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/student_organization_evaluation') }}" class="nav-link link-dark">
                                <i class="bi bi-clipboard-check"></i>
                                <span class="nav-link-text">Evaluation</span>
                            </a>
                        </li>

                    </ul>

                </div>
            </div>

            @yield('main-content')
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebarCollapse');
            const content = document.querySelector('.content');
            const icon = document.querySelector('#sidebar-toggle i');
            const dropdown = document.getElementById('sidebar-dropdown');

            sidebar.classList.toggle('collapsed');
            content.classList.toggle('collapsed');
            icon.classList.toggle('bi-list');
            icon.classList.toggle('bi-x');
            dropdown.classList.toggle('dropdown');
            dropdown.classList.toggle('dropup');
            this.classList.toggle('collapsed');
        });
    </script>
    @yield('custom-script')
</html>


