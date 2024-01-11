<template>
 <div class="mt-2">
        <div class="row head-container">
            <div class="col-md-6 col-sm-12">
                <div class="input-container">
                    <i class="fa fa-search"></i>
                    <input type="text" placeholder="Search Form">
                </div>
            </div>
            <div class="col-md-6 col-sm-12" style="display: flex; align-items: center; gap: 20px;">
                <div class="select-dropdown" style="width: 70%;">
                    <select id="sort-select" class="form-control" style="text-align: center;" >
                            <option value="" disabled selected>Select Semester</option>
                            <option v-for="school_year in this.school_year" :value="school_year['id']" >{{ school_year['school_year'] }}</option>

                        </select>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <h3><i class="fas fa-list mt-2"></i> Evaluation Forms</h3>
                    <div class="event-buttons d-flex">
                        <div class="btn-group" role="group">
                            <button class="btn me-2" id="add-event-button" data-bs-toggle="modal" data-bs-target="#event-modal"> <i class="fas fa-plus"></i>
                            Add form</button>
                        </div>
                    </div>
                </div>
            </div>

        <div id="evaluation-container">
            <div class="evaluation-event-cards">
                <div class="event-card">
                    <div class="dropdown">
                    <a class="ellipsis-button" href="#" style="color: black;" role="button" id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                        <!-- option 1 -->

                        <li><a class="dropdown-item">Set as Default</a></li>
                        <li><a class="dropdown-item">Assign specific event</a></li>
                        <!-- option 2 -->
                        <li><a class="dropdown-item" >Delete Form</a></li>
                        <!-- Add more dropdown items as needed -->
                    </ul>
            </div>
                <div class="evaluation-title mt-2"><h5>Evaluation Form</h5> </div>
                <div class="event-description">Total Questions: <b>16</b></div>
                <div>
                    <div class="evaluation-status text-muted" >Status: <b>Default</b> </div>
                </div>
                <button class="btn btn-success view-button" data-bs-toggle="modal" data-bs-target="#evaluation-form-modal">View</button>
                <!-- <button class="view-button"> <i class="fas fa-chevron-right button-icon"></i></button> -->
        </div>
                </div>
            </div>

<!-- Modal -->
<div class="modal fade" id="event-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Evaluation Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Evaluation Form Title Label -->
                <div class="mb-3">
                    <label for="evaluationTitle" class="form-label">Evaluation Form Title</label>
                    <!-- Evaluation Form Title Input -->
                    <input type="text" class="form-control" id="evaluationTitle" placeholder="Enter title">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- Submit Button -->
                <button type="button" class="btn btn-success">Add Form</button>
            </div>
        </div>
    </div>
</div>
</template>
