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
    <style>
        .top-nav {
        position: absolute;
        width: 100%;
        top: 0;
        background-color: #42b385;
        color: #ffffff;
        padding: 0.875rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 3.125rem;

        }
        .top-nav {
            align-items: center;
            color: #ffffff;
            text-decoration: none;
            margin-right: 0.625rem;

        }
        body{
            background-color: #f3f7fb;
        }
        .page-container{
    margin-top: 30px;

}
.fa-search{
    color: #42b385;
}
.select-dropdown{
    border-radius: 10px;
    margin-top: 10px;
    position: relative;
    box-shadow: rgba(0, 0, 0, 0.05) 0px 1px 2px 0px;

}
.select-dropdown select {
    width: 100%;
    height: 80%;
    padding: 10px;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    cursor: pointer;
    text-align: center;
    border: none;
    background-color: white;
}

.page-content-wrapper{
    float: left;
    width: 80%;
    transition: margin 0.3s;
    padding: 10px 20px 10px 10px !important;
}
.content{
    margin-top: 30px;
    padding: 15px;
}
.table-container {
    max-height: 350px;
    height: 350px;
    overflow-y: auto;
}
.btn{
    border: none;
}
.btn-danger{
    background-color: #f1625f !important;
    color: #ffff;
}
.btn-success{
    background-color: #347961 !important;
    color: #ffff;
}

.btn-secondary{
    background-color: #e0e0e1 !important;
    color: #4a5864;
    transition: background-color 0.3s, color 0.3s;
}
.btn-secondary:hover {
    background-color: #a8a8a9 !important;
}
.button-secondary{
    background-color: #e9eef3;
}

.input-container input {
    padding-left: 30px;
    width: 70%;
    height: 90%;
    border-radius: 10px;
    border: none;
    background-color: white;
    box-shadow: rgba(0, 0, 0, 0.05) 0px 1px 2px 0px;
  }
  .select-dropdown {
    width: 50%;
    margin-bottom: 10px;
}
.input-container {
    position: relative;
  }

  .input-container i {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
  }
  .head-container {
    display: flex;
    width: 100%;
    justify-content: space-between;
    align-items: center;
  }
  .input-container input {
    width: 100%;
    height: 50px;
}
/* Arrow icon */
.select-dropdown::after {
    content: '\25BC';
    font-size: 12px;
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    pointer-events: none;
}


      </style>
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
