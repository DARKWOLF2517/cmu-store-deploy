@extends('layouts.student_navigation_bar')
@section('main-content')
<link href="/custom_css/studentAnnouncement.css" rel="stylesheet">
<div class="content">
    <div class="container mt-4">
        <div class="container breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/login/student_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student</li>
                <li class="breadcrumb-item">CSCo</li>
                <li class="breadcrumb-item active" aria-current="page">Announcement</li>
                </ol>
            </nav>
        </div>
        <h4> <i class="fas fa-list mt-2"></i> Announcements</h4>
        <div id="announcement-cards">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card ">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center">
                                <img src="https://pbs.twimg.com/profile_images/1669519370287198209/QVqk0Ho8_400x400.jpg" alt="Profile Image" width="30" height="30" class="circular-image">
                                <h5 class="posted-by-title ml-2">CSCo</h5>
                            </div>
                            <p class="card-text flex-fill" data-full-text="We are now accepting college fee starting August 28, 2023. Please ensure you make your payments on time to avoid any inconveniences. If you have any questions, feel free to reach out to our office.">
                                We are now accepting college fee starting August 28, 2023. Please ensure you make your payments on time to avoid any inconveniences. If you have any questions, feel free to reach out to our office.
                            </p>
                            <a href="#" class="btn btn-success mt-auto" data-bs-toggle="modal" data-bs-target="#announcementModal">Read More</a>
                        </div>
                    </div>
                </div>

                <!-- Add more cards here with similar structure -->
            </div>
        </div>
    </div>
</div>

    <!-- Announcement Modal -->
    <div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>CSCo</h5>
                    <p id="modalText"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
 <!-- Link to Bootstrap JS and jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

 <script>
     document.onreadystatechange = function () {
         if (document.readyState === "complete") {
             var cardTextElements = document.querySelectorAll(".card-text");

             cardTextElements.forEach(function (cardText) {
                 var text = cardText.textContent.trim();
                 var words = text.split(" ");
                 if (words.length > 20) {
                     var truncatedText = words.slice(0, 20).join(" ") + " ...";
                     cardText.textContent = truncatedText;
                 }
             });

             // Show the full text in the modal when "Read More" is clicked
             var modalText = document.getElementById("modalText");
             var readMoreButtons = document.querySelectorAll(".btn-success");

             readMoreButtons.forEach(function (button, index) {
                 button.addEventListener("click", function () {
                     var fullText = cardTextElements[index].getAttribute("data-full-text");
                     modalText.textContent = fullText;
                 });
             });
         }
     };
 </script>


