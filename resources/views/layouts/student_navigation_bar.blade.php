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
    {{-- <link href="/custom_css/tables.css" rel="stylesheet"> --}}

    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
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
                        </side-nav-button>

                        <side-nav-button
                            link_name="Profile"
                            link_route = "{{url('/student_profile')}}"
                            show_icon = "{{false}}"
                        >
                        </side-nav-button>
                        <li><hr class="dropdown-divider"></li> --}}
                        @if(Session::get('many_user') == 'true')
                            <li><hr class="dropdown-divider"></li>
                            <li>

                                <side-nav-button
                                link_name="Switch User"
                                link_route = "{{url('/options')}}"
                                show_icon = "{{false}}"
                                >
                                </side-nav-button>
                            </li>

                        @else
                            <li><hr class="dropdown-divider"></li>
                            <side-nav-button
                                link_name="Sign out"
                                link_route = "{{url('/logout')}}"
                                show_icon = "{{false}}"
                            >
                            </side-nav-button>
                        @endif
                </ul>
                </div>
            </div>
        </div>
        <aside>
                <!-- SIDE NAV BAR -->
                <div class="wrapper">
                    <div class=" p-3  sidebar" id="sidebarCollapse">
                        <div class="d-md-flex flex-shrink-0">
                            <ul class="list-unstyled ps-0">
                            <li class="mb-1">
                                <button class="btn btn-toggle align-items-center rounded dashboard-button">
                                    <i class="fas fa-home"></i>
                                    <a href="/student_dashboard">
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

                            {{-- <li class="mb-1">
                                <button class="btn btn-toggle align-items-center rounded events-button">
                                    <i class="fas fa-clipboard-check"></i>
                                    <a href="/student_attendance">
                                    <span class="link-title">Evaluation</span>
                                    </a>
                                </button>
                            </li> --}}

                            <li class="mb-1">
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
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </aside>
            <section>
                <div class="page-content-wapper">
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
    <footer class="text-center text-muted" style="font-size: 13px; background-color: #4e9d73; padding: 10px; margin-top: 20px;">
        <small class="text-light">&copy; 2024, CMU-STORE-AMS. All Rights Reserved.</small>
      </footer>
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
                const icon = document.querySelector('#sidebar-toggle i'); // Uncomment this line

                // Buttons with chevron icons
                // const rotateButtons = document.querySelectorAll('.rotate-icon');

                // Function to close any open btn-toggle elements
                function closeOpenBtnToggle() {
                    const btnToggle = document.querySelectorAll('.btn-toggle');
                    btnToggle.forEach((button) => {
                        const collapseTarget = button.getAttribute('data-bs-target');
                        const collapseElement = document.querySelector(collapseTarget);
                        if (collapseElement && collapseElement.classList.contains('show')) {
                            collapseElement.classList.remove('show');
                            // rotateChevron(button);
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
                    icon.classList.add('fa-bars');

                    // if (!isCollapsed) {
                    //     rotateButtons.forEach((button) => {
                    //         if (!button.classList.contains('collapsed')) {
                    //             const collapseTarget = button.getAttribute('data-bs-target');
                    //             const collapseElement = document.querySelector(collapseTarget);
                    //             if (collapseElement) {
                    //                 collapseElement.classList.add('show');
                    //             }
                    //         }
                    //     });
                    // }
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
