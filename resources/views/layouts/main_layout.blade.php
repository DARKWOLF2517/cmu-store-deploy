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

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    {{-- CUSTOM STYLE SHEETS FOUND IN PUBLIC DIRECTORY --}}
    <link href="{{ asset('custom_css/stylesheet.css') }}" rel="stylesheet">
    <link href="{{ asset('custom_css/Navbars.css') }}" rel="stylesheet">
    <link href="{{ asset('custom_css/tables.css') }}" rel="stylesheet">
    @yield('custom-title')
    @yield('custom-style')



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
                        <span class="profile-name"><strong>{{ Session::get('user_name') }}</strong></span>
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                        {{-- <side-nav-button
                            link_name="Settings"
                            link_route = "#"
                            show_icon = "{{false}}"
                            >
                        </side-nav-button> --}}
                        <li>
                            <side-nav-button link_name="Profile" link_route = "{{ url('/student_profile') }}"
                                show_icon = "{{ false }}">
                            </side-nav-button>
                        </li>

                        @if (Session::get('many_user') == 'true')
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>

                                <side-nav-button link_name="Switch Organization" link_route = "{{ url('/options') }}"
                                    show_icon = "{{ false }}">
                                </side-nav-button>
                            </li>
                        {{-- @else --}}
                        @endif
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <side-nav-button link_name="Sign out" link_route = "{{ url('/logout') }}"
                            show_icon = "{{ false }}">
                        </side-nav-button>
                    </ul>
                </div>
            </div>
        </div>
        <!-- SIDE NAV BAR -->
        <aside>
            <div class="wrapper">
                <div class=" p-3  sidebar" id="sidebarCollapse">
                    <div class="d-md-flex flex-shrink-0">
                        <ul class="list-unstyled ">
                            @if (Session::get('role') == 1)
                                <li class="mb-1">
                                    <button
                                        class="btn btn-toggle  btn-outline-light align-items-center rounded dashboard-button">
                                        <i class="fas fa-tachometer-alt"></i>
                                        <a href="/org_dashboard">
                                            <span class="link-title">Dashboard</span>
                                        </a>
                                    </button>
                                </li>
                                <li class="mb-1">
                                    <button
                                        class="btn btn-toggle  btn-outline-light align-items-center rounded events-button">
                                        <i class="fas fa-bullhorn"></i>
                                        <a href="/student_organization_announcement">
                                            <span class="link-title"> Announcement</span>
                                        </a>
                                    </button>
                                </li>
                                <li class="mb-1">
                                    <button
                                        class="btn btn-toggle  btn-outline-light align-items-center rounded events-button">
                                        <i class="fas fa-user"></i>
                                        <a href="/student_organization_profile">
                                            <span class="link-title">Organization Profile</span>
                                        </a>
                                    </button>
                                </li>
                                {{-- <li class="mb-1">
                                <button class="btn btn-toggle align-items-center rounded rotate-icon" data-bs-toggle="collapse" data-bs-target="#profile-collapse" aria-expanded="false">
                                    <i class="fas fa-user"></i>
                                        <span class="link-title">Profile</span>
                                    <span class="link-arrow"><i class="fas fa-chevron-down"></i></span>
                                </button>
                                <div class="collapse" id="profile-collapse">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                        <li><a href="/student_organization_profile" class="link-dark rounded"><i class="fas fa-building"></i> Organization</a></li>
                                        <li><a href="/student_profile" class="link-dark rounded"><i class="fas fa-user"></i> My Profile</a></li>
                                    </ul>
                                </div>
                            </li> --}}
                                <li class="mb-1">
                                    <button
                                        class="btn btn-toggle  btn-outline-light align-items-center rounded events-button">
                                        <i class="	fas fa-calendar-alt"></i>
                                        <a href="/student_organization_events">
                                            <span class="link-title">Events</span>
                                        </a>
                                    </button>
                                </li>


                                <li class="mb-1">
                                    <button
                                        class="btn btn-toggle  btn-outline-light align-items-center studentlist-button">
                                        <i class="	fas fa-list-alt"></i>
                                        <a href="/student_organization_member_list">
                                            <span class="link-title">Student List</span>
                                        </a>
                                    </button>
                                </li>
                                {{-- <li class="mb-1">
                                <button class="btn btn-toggle align-items-center studentlist-button">
                                    <i class="fas fa-chart-line"></i>
                                    <a href="/student_organization_evaluation">
                                    <span class="link-title">Evaluation</span>
                                    </a>
                                </button>
                            </li> --}}
                                <li class="mb-1">
                                    <button
                                        class="btn btn-toggle btn-outline-light align-items-center rounded rotate-icon"
                                        data-bs-toggle="collapse" data-bs-target="#evaluation-collapse"
                                        aria-expanded="false">
                                        <i class="fas fa-chart-line"></i>
                                        <span class="link-title">Evaluation</span>
                                        <span class="link-arrow"><i class="fas fa-chevron-down"></i></span>
                                    </button>
                                    <div class="collapse" id="evaluation-collapse">
                                        <ul class="btn-toggle-nav list-unstyled fw-normal text-start small w-100">
                                            <li>
                                                <button class="btn btn-outline-light">
                                                    <a href="/student_organization_evaluation"
                                                        class="link-dark rounded"><i class="fas fa-folder"></i>
                                                        Records</a>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="btn  btn-outline-light">
                                                    <a href="/student_organization_evaluation_forms"
                                                        class="link-dark rounded"><i class="fas fa-file"></i>
                                                        Evaluation
                                                        forms</a>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                {{-- Student Nav bar --}}
                                {{-- <li class="mb-1">
                                <button class="btn btn-toggle align-items-center rounded dashboard-button">
                                    <i class="fas fa-home"></i>
                                    <a href="/student_dashboard">
                                    <span class="link-title">Home</span>
                                    </a>
                                </button>
                            </li> --}}
                                {{-- <li class="mb-1">
                                <button class="btn btn-toggle align-items-center rounded events-button">
                                    <i class="fas fa-bullhorn"></i>
                                    <a href="/student_announcement">
                                    <span class="link-title">Announcements</span>
                                    </a>
                                </button>
                            </li> --}}
                                {{-- <li class="mb-1">
                                <button class="btn btn-toggle align-items-center rounded events-button">
                                    <i class="fas fa-user"></i>
                                    <a href="/student_profile">
                                    <span class="link-title">Profile</span>
                                    </a>
                                </button>
                            </li> --}}
                                <li class="mb-1">
                                    <button
                                        class="btn btn-toggle btn-outline-light align-items-center rounded rotate-icon"
                                        data-bs-toggle="collapse" data-bs-target="#dashboard-collapse"
                                        aria-expanded="false">
                                        <i class="fas fa-clipboard-check"></i>
                                        <span class="link-title fw-normal">Attendance</span>
                                        <span class="link-arrow"><i class="fas fa-chevron-down"></i></span>
                                    </button>
                                    <div class="collapse" id="dashboard-collapse">
                                        <ul class="btn-toggle-nav list-unstyled fw-normal text-start small">
                                            <li>
                                                <button class="btn btn-outline-light">
                                                    <a href="/student_organization_attendance_schedule"
                                                        class="link-dark rounded"><i
                                                            class="fas fa-calendar-check"></i>
                                                        Schedule</a>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="btn btn-outline-light">
                                                    <a href="/student_organization_attendance"
                                                        class="link-dark rounded"><i class="fas fa-check-circle"></i>
                                                        Records</a>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="mb-1">
                                    <button
                                        class="btn btn-toggle btn-outline-light align-items-center rounded rotate-icon"
                                        data-bs-toggle="collapse" data-bs-target="#student-collapse"
                                        aria-expanded="false">
                                        <i class="fas fa-user"></i>
                                        <span class="link-title fw-normal">Student</span>
                                        <span class="link-arrow"><i class="fas fa-chevron-down"></i></span>
                                    </button>
                                    <div class="collapse" id="student-collapse">
                                        <ul class="btn-toggle-nav list-unstyled fw-normal small text-start w-100">
                                            <li>
                                                <button class="btn btn-outline-light">
                                                    <a href="/student_announcement" class="link-dark rounded"><i
                                                            class="fas fa-bullhorn"></i> Announcements</a>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="btn btn-outline-light">
                                                    <a href="/student_profile" class="link-dark rounded"><i
                                                            class="fas fa-user"></i> My Profile</a>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="btn btn-outline-light">
                                                    <a href="/student_evaluation_list" class="link-dark rounded"><i
                                                            class="fas fa-chart-pie"></i> Evaluation</a>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="btn btn-outline-light">
                                                    <a href="/student_accountabilities" class="link-dark rounded"><i
                                                            class="fas fa-calculator"></i> My Fees</a>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </li>


                                <li class="mb-1">
                                    <button
                                        class="btn btn-toggle btn-outline-light align-items-center rounded rotate-icon"
                                        data-bs-toggle="collapse" data-bs-target="#accountabilities-collapse"
                                        aria-expanded="false">
                                        <i class="fas fa-wallet"></i>
                                        <span class="link-title fw-normal">Accountabilities</span>
                                        <span class="link-arrow"><i class="fas fa-chevron-down"></i></span>
                                    </button>
                                    <div class="collapse" id="accountabilities-collapse">
                                        <ul class="btn-toggle-nav list-unstyled  w-100 fw-normal small text-start">
                                            <li>
                                                <button class="btn btn-outline-light">
                                                    <a href="/student_organization_set_accountabilities"
                                                        class="link-dark rounded"><i
                                                            class="fas fa-file-invoice-dollar"></i> Set Fee</a>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="btn btn-outline-light">
                                                    <a href="/student_organization_free_fines"
                                                        class="link-dark rounded"><i class="fas fa-check-square"></i>
                                                        Set
                                                        Free Fines</a>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="btn btn-outline-light">
                                                    <a href="/student_organization_accountabilities_list"
                                                        class="link-dark rounded"><i class="fas fa-book"></i>
                                                        Accountability list</a>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="btn btn-outline-light">
                                                    <a href="/student_organization_accountabilities_records"
                                                        class="link-dark rounded"><i class="fas fa-file-invoice"></i>
                                                        Payment history</a>
                                                </button>
                                            </li>
                                            {{-- <li><a href="/student_organization_accountability_report" class="link-dark rounded"><i class="fas fa-chart-line"></i> Accountability Report</a></li> --}}
                                        </ul>
                                    </div>
                                </li>
                                {{-- <li class="mb-1">
                                <button class="btn btn-toggle align-items-center rounded events-button">
                                    <i class="fas fa-clipboard-check"></i>
                                    <a href="/student_attendance">
                                    <span class="link-title">Evaluation</span>
                                    </a>
                                </button>
                            </li> --}}

                                {{-- <li class="mb-1">
                                <button class="btn btn-toggle align-items-center rounded events-button">
                                    <i class="fas fa-clipboard-check"></i>
                                    <a href="/student_evaluation_list">
                                    <span class="link-title">Evaluation</span>
                                    </a>
                                </button>
                            </li>

                            <li class="mb-1">
                                <button class="btn btn-toggle align-items-center studentlist-button">
                                    <i class="fas fa-money-check"></i>
                                    <a href="/student_accountabilities">
                                    <span class="link-title">Accountabilities</span>
                                    </a>
                                </button>
                            </li> --}}
                            @elseif (Session::get('role') == 3)
                                <li class="mb-1">
                                    <button
                                        class="btn btn-toggle btn-outline-light align-items-center rounded dashboard-button">
                                        <i class="fas fa-tachometer-alt"></i>
                                        <a href="/attendance_checker_dashboard">
                                            <span class="link-title">Dashboard</span>
                                        </a>
                                    </button>
                                </li>
                                <li class="mb-1">
                                    <button
                                        class="btn btn-toggle btn-outline-light align-items-center rounded rotate-icon"
                                        data-bs-toggle="collapse" data-bs-target="#dashboard-collapse"
                                        aria-expanded="false">
                                        <i class="fas fa-clipboard-check"></i>
                                        <span class="link-title">Attendance</span>
                                        <span class="link-arrow"><i class="fas fa-chevron-down"></i></span>
                                    </button>
                                    <div class="collapse" id="dashboard-collapse">
                                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                            <li>
                                                <button class="btn btn-outline-light">
                                                    <a href="/attendance_checker_attendance_schedule"
                                                        class="link-dark rounded"><i
                                                            class="fas fa-calendar-check"></i>
                                                        Schedule</a>
                                                </button>

                                            </li>
                                            <li>
                                                <button class="btn btn-outline-light">
                                                    <a href="/attendance_checker_attendance_records_list"
                                                        class="link-dark rounded"><i class="fas fa-check-circle"></i>
                                                        Records</a>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="mb-1">
                                    <button
                                        class="btn btn-toggle btn-outline-light align-items-center rounded rotate-icon"
                                        data-bs-toggle="collapse" data-bs-target="#student-collapse"
                                        aria-expanded="false">
                                        <i class="fas fa-user"></i>
                                        <span class="link-title">Student</span>
                                        <span class="link-arrow"><i class="fas fa-chevron-down"></i></span>
                                    </button>
                                    <div class="collapse" id="student-collapse">
                                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small text-start">
                                            <li>
                                                <button class="btn btn-outline-light">
                                                    <a href="/student_announcement" class="link-dark rounded"><i
                                                            class="fas fa-bullhorn"></i> Announcements</a>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="btn btn-outline-light">
                                                    <a href="/student_profile" class="link-dark rounded"><i
                                                            class="fas fa-user"></i> My Profile</a>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="btn btn-outline-light">
                                                    <a href="/student_evaluation_list" class="link-dark rounded"><i
                                                            class="fas fa-clipboard-check"></i> Evaluation</a>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="btn btn-outline-light text-start">
                                                    <a href="/student_accountabilities" class="link-dark rounded"><i
                                                            class="fas fa-calculator"></i> My Fees</a>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            @elseif (Session::get('role') == 2)
                                <li class="mb-1">
                                    <button
                                        class="btn btn-toggle btn-outline-light align-items-center rounded dashboard-button">
                                        <i class="fas fa-tachometer-alt"></i>
                                        <a href="/student_dashboard">
                                            <span class="link-title">Dashboard</span>
                                        </a>
                                    </button>
                                </li>
                                <li class="mb-1">
                                    <button
                                        class="btn btn-toggle btn-outline-light align-items-center rounded rotate-icon"
                                        data-bs-toggle="collapse" data-bs-target="#student-collapse"
                                        aria-expanded="false">
                                        <i class="fas fa-user"></i>
                                        <span class="link-title">Student</span>
                                        <span class="link-arrow"><i class="fas fa-chevron-down"></i></span>
                                    </button>
                                    <div class="collapse" id="student-collapse">
                                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small text-start">
                                            <li>
                                                <button class="btn btn-outline-light">
                                                    <a href="/student_announcement" class="link-dark rounded"><i
                                                            class="fas fa-bullhorn"></i> Announcements</a>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="btn btn-outline-line">
                                                    <a href="/student_profile" class="link-dark rounded"><i
                                                            class="fas fa-user"></i> My Profile</a>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="btn btn-outline-light">
                                                    <a href="/student_evaluation_list" class="link-dark rounded"><i
                                                            class="fas fa-clipboard-check"></i> Evaluation</a>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="btn btn-outline-light">
                                                    <a href="/student_accountabilities" class="link-dark rounded"><i
                                                            class="fas fa-calculator"></i> My Fees</a>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <section>
            <div class="page-content-wapper h-screen">
                <div class="content">
                    <div class="page-container">
                        <div>

                            @yield('main-content')
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    {{-- <footer class="text-center text-muted" style="font-size: 13px; background-color: #4e9d73; padding: 10px;">
    <small class="text-light">&copy; 2024, CMU-STORE-AMS. All Rights Reserved.</small>
</footer> --}}


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
                const icon = document.querySelector('#sidebar-toggle i');

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
                toggleSidebarButton.addEventListener('click', function() {
                    const isCollapsed = sidebar.classList.contains('collapsed');
                    closeOpenBtnToggle();
                    sidebar.classList.toggle('collapsed');
                    content.classList.toggle('collapsed');
                    icon.classList.add('fa-bars');
                    if (!isCollapsed) {
                        rotateButtons.forEach((button) => {
                            if (button.classList.contains('collapsed')) {
                                const collapseTarget = button.getAttribute('data-bs-target');
                                const collapseElement = document.querySelector(collapseTarget);
                                if (collapseElement) {
                                    collapseElement.classList.add('show');

                                }
                            }
                        });
                    }
                    if (window.innerWidth <= 768) {
                        icon.classList.add('fa-bars');
                    } else {
                        icon.classList.add('fa-bars');
                    }
                });

                // Event listener for rotating chevron icons on btn-toggle click
                rotateButtons.forEach((button) => {
                    button.addEventListener('click', function() {
                        this.classList.toggle('collapsed');
                        rotateChevron(this);
                        if (sidebar.classList.contains('collapsed')) {
                            sidebar.classList.remove('collapsed');
                            content.classList.remove('collapsed');

                        } else {
                            closeOpenBtnToggle();
                        }
                    });
                });

                // Check screen width and collapse/expand sidebar accordingly
                function checkScreenWidth() {
                    if (window.innerWidth <= 768) { // Adjust the breakpoint as needed
                        sidebar.classList.add('collapsed');
                        content.classList.add('collapsed');
                        icon.classList.add('fa-bars');
                    } else {
                        sidebar.classList.remove('collapsed');
                        content.classList.remove('collapsed');
                        // icon.classList.remove('fa-bars');
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
