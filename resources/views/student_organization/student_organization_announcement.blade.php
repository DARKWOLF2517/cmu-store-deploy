@extends('layouts.student_organization_navigation_bar')
@section('main-content')
<link href="/custom_css/announcement.css" rel="stylesheet">

<div class="content">
    <div class="container">
        <div class="container breadcrumbs">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/login/org_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student Organization</li>
                <li class="breadcrumb-item"><a href="/student_organization_evaluation">Evaluation</a></li>
                <li class="breadcrumb-item active" aria-current="page">Evaluation Results</li>
              </ol>
            </nav>
        </div>
        <div class="student-buttons d-flex justify-content-end mt-2">
            <!-- Button to trigger the modal -->
            <div class="btn-group" role="group">
                <button type="button" class="btn me-2" data-bs-toggle="modal" data-bs-target="#announcementModal">
                    <i class="fas fa-bullhorn"></i>  Make Announcement
                </button>
            </div>
        </div>

    <div>
        <h4><i class="fas fa-bars"></i> Announcements</h4>
        <div class="modal fade" id="announcementModal" tabindex="-1" role="dialog" aria-labelledby="announcementModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="announcementModalLabel">Create Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="announcementTitle">Announcement Title</label>
                            <input type="text" class="form-control" id="announcementTitle">
                        </div>
                        <div class="form-group">
                            <label for="announcementDescription">Description</label>
                            <textarea class="form-control" id="announcementDescription" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveAnnouncement">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Announcement Card Container -->
    <div id="announcementContainer">
        <div class="row" id="announcementRow">
            <!-- Existing or saved announcement cards will be added here dynamically -->
        </div>
    </div>
</div>
</div>
<!-- Add/Edit Announcement Modal -->
<div class="modal fade" id="editAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="editAnnouncementModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAnnouncementModalLabel">Edit Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="editAnnouncementTitle">Announcement Title</label>
                    <input type="text" class="form-control" id="editAnnouncementTitle">
                </div>
                <div class="form-group">
                    <label for="editAnnouncementDescription">Description</label>
                    <textarea class="form-control" id="editAnnouncementDescription" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateAnnouncement">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Add your custom JavaScript code -->
<script>
    var announcements = []; // Store announcements

    document.getElementById('saveAnnouncement').addEventListener('click', function () {
        // Get input values
        var title = document.getElementById('announcementTitle').value;
        var description = document.getElementById('announcementDescription').value;

        if (title && description) {
            // Create a new announcement card with a "Read More" button
            var card = document.createElement('div');
            card.classList.add('col-md-4');
            var announcement = {
                title: title,
                description: description
            };
            announcements.push(announcement); // Store announcement
            card.innerHTML = `
                <div class="card mb-4" style="width: 330px; height: 220px; border:none;">
                    <div class="card-body">
                        <div class="dropdown">
                            <a class="ellipsis-button" href="#" role="button" id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                                <!-- option 1 -->
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editAnnouncementModal" data-announcement-index="${announcements.length - 1}">Edit Announcement</a></li>
                                <!-- option 2 -->
                                <li><a class="dropdown-item">Delete Announcement</a></li>

                            </ul>
                        </div>
                        <h5 class="card-title">${title}</h5>
                        <p class="card-text">${truncateText(description, 20)}</p>
                        <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#announcementDetailsModal" data-announcement-index="${announcements.length - 1}">Read More</button>
                    </div>
                </div>
            `;

            // Add the card to the container
            document.getElementById('announcementRow').appendChild(card);

            // Clear the input fields
            document.getElementById('announcementTitle').value = '';
            document.getElementById('announcementDescription').value = '';

            // Close the modal
            var modal = new bootstrap.Modal(document.getElementById('announcementModal'));
            modal.hide();
        }
    });

    // Function to truncate text to a specified number of words
    function truncateText(text, wordCount) {
        var words = text.split(' ');
        if (words.length > wordCount) {
            return words.slice(0, wordCount).join(' ') + '...';
        } else {
            return text;
        }
    }

    // Show announcement details modal
    document.getElementById('announcementContainer').addEventListener('click', function (event) {
        if (event.target.getAttribute('data-bs-toggle') === 'modal') {
            var announcementIndex = event.target.getAttribute('data-announcement-index');
            if (announcementIndex !== null) {
                var announcement = announcements[parseInt(announcementIndex)];
                var modalTitle = document.getElementById('announcementDetailsModalLabel');
                var modalBody = document.getElementById('announcementDetailsModalBody');
                modalTitle.textContent = announcement.title;
                modalBody.textContent = announcement.description;
            }
        }
    });
</script>
<!-- JavaScript to Edit Announcement -->
<script>
    var editingIndex = -1; // Initialize to an invalid index

    // Function to open the edit modal with the announcement data
    document.getElementById('announcementContainer').addEventListener('click', function (event) {
        if (event.target.getAttribute('data-bs-target') === '#editAnnouncementModal') {
            editingIndex = parseInt(event.target.getAttribute('data-announcement-index'));
            var announcement = announcements[editingIndex];
            document.getElementById('editAnnouncementTitle').value = announcement.title;
            document.getElementById('editAnnouncementDescription').value = announcement.description;
        }
    });

    // Function to update the announcement
    document.getElementById('updateAnnouncement').addEventListener('click', function () {
        var title = document.getElementById('editAnnouncementTitle').value;
        var description = document.getElementById('editAnnouncementDescription').value;

        if (title && description && editingIndex !== -1) {
            announcements[editingIndex].title = title;
            announcements[editingIndex].description = description;

            // Update the card content
            var card = document.getElementById('announcementRow').children[editingIndex];
            card.querySelector('.card-title').textContent = title;
            card.querySelector('.card-text').textContent = truncateText(description, 20);

            // Clear the input fields
            document.getElementById('editAnnouncementTitle').value = '';
            document.getElementById('editAnnouncementDescription').value = '';

            // Close the modal
            var modal = new bootstrap.Modal(document.getElementById('editAnnouncementModal'));
            modal.hide();
        }
    });
</script>
<!-- Add your announcement details modal -->
<div class="modal fade" id="announcementDetailsModal" tabindex="-1" role="dialog" aria-labelledby="announcementDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="announcementDetailsModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="announcementDetailsModalBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Bootstrap JavaScript and jQuery link (required for the modal) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
