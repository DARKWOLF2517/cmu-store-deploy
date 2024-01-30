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
                            Create form</button>
                        </div>
                    </div>
                </div>
            </div>

        <div id="evaluation-container">
            <div class="evaluation-event-cards">
                <div class="event-card" style="width: 45vh !important; border-left-style: solid; border-left-color: #1b9587;">

                    <div class="dropdown">
                    <a class="ellipsis-button" href="#" style="color: #3e505d;" role="button" id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                        <!-- option 1 -->

                        <li><a class="dropdown-item">Set as Default</a></li>
                        <li><a class="dropdown-item">Assign to specific event</a></li>
                        <!-- option 2 -->
                        <li><a class="dropdown-item" >Delete Form</a></li>
                        <!-- Add more dropdown items as needed -->
                    </ul>
            </div>

                <div class="evaluation-title mt-4"><h5> <b>Evaluation Form</b></h5> </div>
                <div class="evaluation-description">Total Questions: <b>16</b></div>
                <div>
                    <div class="evaluation-status text-muted" >Status: <b>Default</b> </div>
                </div>
                <button class="btn btn-success view-button" data-bs-toggle="modal" data-bs-target="#evaluation-form-modal"> View</button>
                <!-- <button class="view-button"> <i class="fas fa-chevron-right button-icon"></i></button> -->
        </div>
                </div>
            </div>
<!-- Create form Modal -->
<div class="modal fade" id="event-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="formTitle" class="form-label">Title of the Evaluation Form</label>
                    <input type="text" class="form-control" id="formTitle">
                </div>
                <div class="mb-3">
                    <label for="formDescription" class="form-label">Input Description</label>
                    <textarea class="form-control" id="formDescription" rows="3"></textarea>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-light"> <i class="fas fa-plus"></i> Add Question</button>
                </div>
                <div class="mb-3">
                    <label for="question1" class="form-label fw-bold">Question 1</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="question1">
                        <button class="btn btn-danger" type="button">X</button>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="multipleChoice1">
                        <label class="form-check-label" for="multipleChoice1">Multiple Choice</label>
                        <div id="choicesContainer1" class="mt-2">
                            <label for="choices1" class="form-label">Choices</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="choices1">
                                <button class="btn btn-danger" type="button">X</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">


                <!-- Submit Button -->
                <button type="button" class="btn btn-success">Save Form</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- View Evaluation Form Modal -->
<div class="modal fade" id="evaluation-form-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">View Evaluation Form</h5> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="formTitle" class="form-label">Title of the Evaluation Form</label>
                </div>
                <div class="mb-3">
                    <label for="formDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="formDescription" rows="3" ></textarea>
                </div>
                <div class="mb-3">
                    <label for="question1" class="form-label fw-bold">Question 1</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="question1" readonly>
                    </div>
                    <div class="mb-3 form-check">
                        <div id="choicesContainer1" class="mt-2">
                            <label for="choices1" class="form-label">*Choices</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="choices1" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <!-- Edit Button -->
                 <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit-evaluation-form-modal">
                    <i class="fas fa-pen"></i> Edit Form
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Evaluation Form Modal -->
<div class="modal fade" id="edit-evaluation-form-modal" tabindex="-1" aria-labelledby="editFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFormLabel">Edit Evaluation Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="formTitle" class="form-label">Title of the Evaluation Form</label>
                    <input type="text" class="form-control" id="formTitle">
                </div>
                <div class="mb-3">
                    <label for="formDescription" class="form-label">Input Description</label>
                    <textarea class="form-control" id="formDescription" rows="3"></textarea>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-light"> <i class="fas fa-plus"></i> Add Question</button>
                </div>
                <div class="mb-3">
                    <label for="question1" class="form-label fw-bold">Question 1</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="question1">
                        <button class="btn btn-danger" type="button">X</button>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="multipleChoice1">
                        <label class="form-check-label" for="multipleChoice1">Multiple Choice</label>
                        <div id="choicesContainer1" class="mt-2">
                            <label for="choices1" class="form-label">Choices</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="choices1">
                                <button class="btn btn-danger" type="button">X</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Save Form</button>
            </div>
        </div>
    </div>
</div>
</template>
