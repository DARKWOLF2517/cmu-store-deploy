<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Add Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.css" rel="stylesheet">


    {{-- CUSTOM STYLE SHEETS FOUND IN PUBLIC DIRECTORY --}}
    <link href="/custom_css/stylesheet.css" rel="stylesheet">
    <link href="/custom_css/Navbars.css" rel="stylesheet">
    {{-- <link href="/custom_css/tables.css" rel="stylesheet"> --}}



    @yield('custom-style')
    <title>Student Organization Dashboard</title>
    @vite('resources/js/app.js')
</head>
<body>
    <div id="app">

        <!-- TOP NAV BAR -->
        <div class="wrapper">

            <div class="top-nav">
                {{-- Toggle button for side navigation Bar --}}

                <a href="#" class="nav-link link-light">
                    <button class="btn toggle-button" id="ssidebar-toggle"><i class="fas fa-bars"></i></button>
                    <span class="nav-link-text"> CMU-STORE-AMS</span>
                </a>
                <div class="profile-dropdown dropdown">
                    <button class="notification-button btn btn-link">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge"></span>
                    </button>
                    <div class="popover">
                        <div class="popover-header">
                            <b>Notifications</b>
                            <a href="/student_announcement">See All</a>
                        </div>
                        <div class="notifications">
                            <ul>
                                <li>
                                    <a class="btn text-start" href="">
                                        <p><strong>SSC</strong> posted an announcement.</p>
                                        <small class="time-posted">9:46 AM</small>
                                    </a>
                                </li>
                                <li>
                                    <a class="btn text-start" href="">
                                    <p><strong>CSCo</strong> posted an announcement.</p>
                                    <small class="time-posted">9:46 AM</small>
                                    </a>
                                </li>
                                <li>
                                    <a class="btn text-start" href="">
                                    <p><strong>CSCo</strong> posted an announcement.</p>
                                    <small class="time-posted">9:46 AM</small>
                                    </a>
                                </li>
                            </ul>
                    </div>

                    </div>


                    <a href="#" class="d-flex align-items-center link-light text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://icons-for-free.com/iconfiles/png/512/avatar+circle+male+profile+user+icon-1320196710301016992.png" alt="" width="32" height="32" class="rounded-circle me-2">
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
            </div>
        </div>
                <!-- SIDE NAV BAR -->
        <div class="wrapper">
            <div class=" p-3  sidebar" id="sidebarCollapse">
                <div class="d-md-flex flex-shrink-0">
                    <ul class="list-unstyled ps-0">
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded dashboard-button">
                            <i class="fas fa-home"></i>
                            <a href="/login/student_dashboard">
                            <span class="link-title">Home</span>
                            </a>
                        </button>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded events-button">
                            <i class="fas fa-bullhorn"></i>
                            <a href="/student_announcement">
                            <span class="link-title">Announcements</span>
                            </a>
                        </button>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded events-button">
                            <i class="fas fa-user"></i>
                            <a href="/student_profile">
                            <span class="link-title">Profile</span>
                            </a>
                        </button>
                    </li>

                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded events-button">
                            <i class="fas fa-list"></i>
                            <a href="/student_attendance">
                            <span class="link-title">Attendance</span>
                            </a>
                        </button>
                    </li>

                    {{-- <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded events-button">
                            <i class="fas fa-calendar"></i>
                            <a href="/student_evaluationform">
                            <span class="link-title">Evaluation</span>
                            </a>
                        </button>
                    </li> --}}

                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center studentlist-button">
                            <i class="fas fa-money-check"></i>
                            <a href="/student_accountabilities">
                            <span class="link-title">Accountabilities</span>
                            </a>
                        </button>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
        <div>
            @yield('main-content')
        </div>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <!-- FullCalendar JS -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.js"></script> --}}
    <script>
        document.onreadystatechange = () => {
            if(document.readyState === "complete")
            {
                const notificationButton = document.querySelector('.notification-button');
                const popover = document.querySelector('.popover');

                notificationButton.addEventListener('click', () => {
                    popover.style.display = popover.style.display === 'block' ? 'none' : 'block';
                });
                // Toggle the sidebar when the burger button is clicked
                const toggleSidebarButton = document.getElementById('ssidebar-toggle');
                const sidebar = document.getElementById('sidebarCollapse');
                const content = document.querySelector('.content');
                const icon = document.querySelector('#sidebar-toggle i');
                const rotateButtons = document.querySelectorAll('.rotate-icon');

                // Function to close any open btn-toggle elements
                function closeOpenBtnToggle() {
                    console.log("jsdkfjskdjfsfjskjfd");
                    const btnToggle = document.querySelectorAll('.btn-toggle');
                    btnToggle.forEach((button) => {
                        const collapseTarget = button.getAttribute('data-bs-target');
                        const collapseElement = document.querySelector(collapseTarget);
                        if (collapseElement && collapseElement.classList.contains('show')) {
                            // Close the open collapse element
                            collapseElement.classList.remove('show');
                        }
                    });
                }

                toggleSidebarButton.addEventListener('click', function () {
                    // Check if the sidebar is currently collapsed
                    const isCollapsed = sidebar.classList.contains('collapsed');

                    // Close any open btn-toggle elements before toggling the sidebar
                    closeOpenBtnToggle();
                    // Toggle the sidebar and content
                    sidebar.classList.toggle('collapsed');
                    content.classList.toggle('collapsed');
                    icon.classList.toggle('fa-bars');
                    icon.classList.toggle('fa-times');

                    // If the sidebar was previously collapsed, reopen any open btn-toggle elements
                    if (!isCollapsed) {
                        rotateButtons.forEach((button) => {
                            if (!button.classList.contains('collapsed')) {
                                const collapseTarget = button.getAttribute('data-bs-target');
                                const collapseElement = document.querySelector(collapseTarget);
                                if (collapseElement) {
                                    collapseElement.classList.add('show');
                                }
                            }
                        });
                    }
                });

                rotateButtons.forEach((button) => {
                    button.addEventListener('click', function () {
                        // Toggle the 'collapsed' class on the button
                        this.classList.toggle('collapsed');

                        // Check if the sidebar is collapsed, and if so, expand it
                        if (sidebar.classList.contains('collapsed')) {
                            sidebar.classList.remove('collapsed');
                            content.classList.remove('collapsed');
                            icon.classList.remove('fa-bars');
                            icon.classList.add('fa-times');
                        } else {
                            // Close any open btn-toggle elements when a new one is clicked
                            closeOpenBtnToggle();
                        }
                    });
                });
            }
        }

    </script>
    @yield('custom-script')
</body>
</html>
