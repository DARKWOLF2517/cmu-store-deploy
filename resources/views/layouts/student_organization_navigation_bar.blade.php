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
    <link href="{{ asset('custom_css/stylesheet.css') }}" rel="stylesheet">
    <link href="{{ asset('custom_css/Navbars.css') }}" rel="stylesheet">
    <link href="{{ asset('custom_css/tables.css') }}" rel="stylesheet">
    @yield('custom-style')
    <title>Student Organization Dashboard</title>
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    @vite('resources/js/app.js', 'build')
</head>
<body>
    <div id="app">
        <!-- TOP NAV BAR -->
        <div class="wrapper">

            <div class="top-nav">
                {{-- Toggle button for side navigation Bar --}}

                <a href="#" class="nav-link link-light">
                    <button class="btn toggle-button" id="sidebar-toggle"><i class="fas fa-bars"></i></button>
                    <span class="nav-link-text"> CMU-STORE-AMS</span>
                </a>
                {{-- <div class="profile-dropdown dropdown dropdown ms-auto">
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
                            <div class="Message-IfEmpty">
                                <i class="icon 	far fa-frown" id="icon-message"></i>
                                <p class="empty-schedule">Nothing posted yet</p>
                            </div>
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
                </div> --}}

                <div>
                    <a href="#" class="d-flex align-items-center link-light text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://indonesiasatu.co.id/assets/themes/indonesiasatu/img/user.png" alt="user-image" width="32" height="32" class="rounded-circle me-2">
                        <span class="profile-name"><strong>{{Auth::user()->name}}</strong></span>
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                        {{-- <side-nav-button
                            link_name="Settings"
                            link_route = "#"
                            show_icon = "{{false}}"
                            >
                        </side-nav-button> --}}
                        <li>
                            <side-nav-button
                                link_name="Profile"
                                link_route = "{{url('/student_organization_profile')}}"
                                show_icon = "{{false}}"
                                >
                            </side-nav-button>
                        </li>

                        <li>
                            <side-nav-button
                            link_name="Switch User"
                            {{-- link_route = "{{url('/student_organization_profile')}}" --}}
                            show_icon = "{{false}}"
                            >
                        </side-nav-button>
                        </li>

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
                    <ul class="list-unstyled ">
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded dashboard-button">
                            <i class="fas fa-tachometer-alt"></i>
                            <a href="/login/org_dashboard">
                            <span class="link-title">Dashboard</span>
                            </a>
                        </button>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded events-button">
                            <i class="fas fa-bullhorn"></i>
                            <a href="/student_organization_announcement">
                            <span class="link-title">Announcement</span>
                            </a>
                        </button>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded events-button">
                            <i class="fas fa-user"></i>
                            <a href="/student_organization_profile">
                            <span class="link-title">Profile</span>
                            </a>
                        </button>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded events-button">
                            <i class="fas fa-calendar"></i>
                            <a href="/student_organization_events">
                            <span class="link-title">Events</span>
                            </a>
                        </button>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded rotate-icon" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                            <i class="fas fa-clipboard-check"></i>
                            <span class="link-title">Attendance</span>
                            <span class="link-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="collapse" id="dashboard-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="/student_organization_attendance_schedule" class="link-dark rounded"><i class="fas fa-calendar"></i> Schedule</a></li>
                                <li><a href="/student_organization_attendance" class="link-dark rounded"><i class="fas fa-check-circle"></i> Record</a></li>
                            </ul>
                        </div>
                    </li>


                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center studentlist-button">
                            <i class="	fas fa-list-alt"></i>
                            <a href="/student_organization_member_list">
                            <span class="link-title">Student List</span>
                            </a>
                        </button>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center studentlist-button">
                            <i class="fas fa-chart-line"></i>
                            <a href="/student_organization_evaluation">
                            <span class="link-title">Evaluation</span>
                            </a>
                        </button>
                    </li>

                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded rotate-icon" data-bs-toggle="collapse" data-bs-target="#accountabilities-collapse" aria-expanded="false">
                            <i class="fas fa-clipboard-check"></i>
                            <span class="link-title">Accountabilities</span>
                            <span class="link-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="collapse" id="accountabilities-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="/student_organization_set_accountabilities" class="link-dark rounded"><i class="fas fa-money-check"></i> Set Accountabilities</a></li>
                                <li><a href="/student_organization_free_fines" class="link-dark rounded"><i class="fas fa-check-square"></i> Set Free Fines</a></li>
                                <li><a href="/student_organization_accountabilities_list" class="link-dark rounded"><i class="fas fa-book"></i> Accountability list</a></li>
                                <li><a href="/student_organization_accountabilities_records" class="link-dark rounded"><i class="fas fa-file-invoice"></i> Accountability records</a></li>
                            </ul>
                        </div>
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
            if (document.readyState === "complete") {
                // Notification button and popover
                // const notificationButton = document.querySelector('.notification-button');
                // const popover = document.querySelector('.popover');

                // Sidebar and toggle button
                const toggleSidebarButton = document.getElementById('sidebar-toggle');
                const sidebar = document.getElementById('sidebarCollapse');
                const content = document.querySelector('.content');
                // const icon = document.querySelector('#sidebar-toggle i');

                // Buttons with chevron icons
                const rotateButtons = document.querySelectorAll('.rotate-icon');

                // Function to close any open btn-toggle elements
                function closeOpenBtnToggle() {
                    const btnToggle = document.querySelectorAll('.btn-toggle');
                    btnToggle.forEach((button) => {
                        const collapseTarget = button.getAttribute('data-bs-target');
                        const collapseElement = document.querySelector(collapseTarget);
                        if (collapseElement && collapseElement.classList.contains('show')) {
                            collapseElement.classList.remove('show');
                            rotateChevron(button);
                            button.classList.remove('collapsed');
                        }
                    });
                }

                // Function to rotate the chevron icon
                function rotateChevron(button) {
                    const chevron = button.querySelector('.link-arrow i');
                    chevron.classList.toggle('fa-chevron-down');
                    chevron.classList.toggle('fa-chevron-up');
                }

                // Event listener for toggling the sidebar
                toggleSidebarButton.addEventListener('click', function () {
                    const isCollapsed = sidebar.classList.contains('collapsed');
                    closeOpenBtnToggle();
                    sidebar.classList.toggle('collapsed');
                    content.classList.toggle('collapsed');
                    icon.classList.toggle('fa-bars');
                    // icon.classList.toggle('fa-times');
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

                    // Event listener for rotating chevron icons on btn-toggle click
                        rotateButtons.forEach((button) => {
                        button.addEventListener('click', function () {
                            this.classList.toggle('collapsed');
                            rotateChevron(this);
                            if (sidebar.classList.contains('collapsed')) {
                                sidebar.classList.remove('collapsed');
                                content.classList.remove('collapsed');
                                //icon.classList.add('fa-bars');
                                // icon.classList.add('fa-times');
                            } else {
                                closeOpenBtnToggle();
                            }
                        });
                    });


                // Event listener for toggling the notification popover
                // notificationButton.addEventListener('click', () => {
                //     popover.style.display = popover.style.display === 'block' ? 'none' : 'block';
                // });

                    // Check screen width and collapse/expand sidebar accordingly
                    function checkScreenWidth() {
                        if (window.innerWidth <= 768) { // Adjust the breakpoint as needed
                            sidebar.classList.add('collapsed');
                            content.classList.add('collapsed');
                            icon.classList.add('fa-bars');
                            // icon.classList.remove('fa-times');
                        } else {
                            sidebar.classList.remove('collapsed');
                            content.classList.remove('collapsed');
                            icon.classList.add('fa-bars');
                            // icon.classList.add('fa-times');
                        }
                    }
                    // Initial check on page load
                    checkScreenWidth();
            }
        }
    </script>
    @yield('custom-script')

</body>
</html>
