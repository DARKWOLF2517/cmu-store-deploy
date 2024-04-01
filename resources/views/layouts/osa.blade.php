<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OSA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Add Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Use either Bootstrap Icons or Font Awesome -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
    /* padding: 10px; */
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
    max-height: 250px;
    height: 250px;
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
