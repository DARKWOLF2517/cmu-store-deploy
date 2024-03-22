<template>
    <div class="col-md breadcrumbs">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/org_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student Organization</li>
                <li class="breadcrumb-item active" aria-current="page">Events</li>
            </ol>
        </nav>
    </div>
    <div class="mt-2">
        <div class="row head-container">
            <div class="col-md-6 col-sm-12">
                <div class="input-container">
                    <i class="fa fa-search"></i>
                    <input type="text" placeholder="Search Event" v-model="searchTerm" @input="filterItems">
                </div>
            </div>
            <div class="col-md-6 col-sm-12"
                style="display: flex; align-items: center; justify-content: flex-end; gap: 20px;">
                <!-- <button class="btn sort-btn"><i class="bi bi-sort-up"></i></button> -->
                <div class="select-dropdown" style="width: 70%;">
                    <select id="sort-select" class="form-control" style="text-align: center;"
                        v-model="school_year_input" @change="fetchData">
                        <option value="0" disabled selected>Select Semester</option>
                        <option v-for="school_year in this.school_year" :value="school_year['id']">{{
                        school_year['school_year'] }}</option>
                    </select>
                </div>
                <div class="select-dropdown" style="width: 30%;">
                    <select id="sort-select" class="form-control" style="text-align: center;" v-model="status_filter"
                        @change="filterItems">
                        <option :value="''">All</option>
                        <!-- <option :value=0>Pending</option> -->
                        <option :value=1>Ongoing</option>
                        <option :value=2>Completed</option>
                    </select>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="mt-2"><i class="fas fa-list"></i> Events</h3>
            <div class="event-buttons d-flex">
                <div class="btn-group" role="group">
                    <button class="btn me-2" id="add-event-button" data-bs-toggle="modal" data-bs-target="#event-modal"
                        @click="this.initialData(), this.submit = this.sendData">
                        <i class="fas fa-calendar-plus"></i> Add Event
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div class="event-list">
        <div class="col">
            <div>
                <div class="event-cards-list ">
                    <!-- Loading spinner -->
                    <div v-if="loading">
                        <div class="d-flex flex-column flex-md-row gap-4">
                            <div class="card loading-card col-lg-4 col-md-6" aria-hidden="true"
                                style="width: calc(33.33% - 30px); height: 200px; border:none; padding: 10px;">
                                <div class="">
                                    <p class="card-text placeholder-glow mt-2 ">
                                        <span class="placeholder col-8 bg-secondary"></span>
                                        <br>
                                        <span class="placeholder col-4 bg-secondary"></span>
                                        <br>
                                        <span class="placeholder col-6 bg-secondary"></span>
                                        <br>
                                        <span class="placeholder col-4 bg-secondary"></span>
                                    </p>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" tabindex="-1"
                                            class="btn btn-secondary mt-2 disabled placeholder col-6 "
                                            style="height: 35px; width: 70px;"></button>
                                    </div>
                                </div>
                            </div>
                          <div class="card loading-card col-lg-4 col-md-6" aria-hidden="true"
                            style="width: calc(33.33% - 30px); height: 200px; border:none; padding: 10px;">
                            <div class="">

                                <p class="card-text placeholder-glow mt-2 ">
                                    <span class="placeholder col-8 bg-secondary"></span>
                                    <br>
                                    <span class="placeholder col-4 bg-secondary"></span>
                                    <br>
                                    <span class="placeholder col-6 bg-secondary"></span>
                                    <br>
                                    <span class="placeholder col-4 bg-secondary"></span>
                                </p>
                                <div class="d-flex justify-content-end">
                                    <button type="button" tabindex="-1"
                                        class="btn btn-secondary mt-2 disabled placeholder col-6 "
                                        style="height: 35px; width: 70px;"></button>
                                </div>
                            </div>
                        </div>
                        <div class="card loading-card col-lg-4 col-md-6 " aria-hidden="true"
                            style="width: calc(33.33% - 30px); height: 200px; border:none; padding: 10px;">
                            <div class="">

                                <p class="card-text placeholder-glow mt-2 ">
                                    <span class="placeholder col-8 bg-secondary"></span>
                                    <br>
                                    <span class="placeholder col-4 bg-secondary"></span>
                                    <br>
                                    <span class="placeholder col-6 bg-secondary"></span>
                                    <br>
                                    <span class="placeholder col-4 bg-secondary"></span>
                                </p>
                                <div class="d-flex justify-content-end">
                                    <button type="button" tabindex="-1"
                                        class="btn btn-secondary mt-2 disabled placeholder col-6 "
                                        style="height: 35px; width: 70px;"></button>
                                </div>
                            </div>
                        </div>
                        </div>


                    </div>
                    <!-- Message if the container is empty -->
                    <div class="Container-IfEmpty text-center" v-if="!loading && this.events == 0">
                        <div class="Empty-Message">
                            <i class="icon 	bi bi-calendar-event mb-0" id="icon-message"></i>
                            <p class="text-muted  mt-0"><b>Create Events when you're ready</b>
                                <br>
                                No events yet.
                            </p>
                            <a class="btn btn-success" id="add-event-button" data-bs-toggle="modal"
                                data-bs-target="#event-modal"
                                @click="this.initialData(), this.submit = this.sendData">Add
                                Event</a>
                        </div>
                    </div>
                    <!-- Message No results found -->
                    <div class="Container-IfEmpty text-center"
                        v-if="!loading && this.filtered_events.length === 0 && this.events != 0">
                        <div class="Empty-Message">
                            <i class="icon 	fas fa-frown" id="icon-message"></i>
                            <p class="text-muted fw-bold">No results found</p>
                        </div>
                    </div>
                    <div class="recorded-event-cards">
                        <div v-for="event in filtered_events" :id="event.event_id" class="event-card" :class="[
                        'border-top',
                        'border-5',
                        { 'border-warning': event.event_status == 1, 'border-success': event.event_status == 2 },
                        'border-bottom-0'
                    ]">


                            <div class="dropdown">
                                <a class="ellipsis-button" href="#" style="color: black;" role="button"
                                    id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                                    <!-- option 1 -->
                                    <li><a class="dropdown-item" @click="  FetchUpdateData(event.event_id)"
                                            data-bs-toggle="modal" data-bs-target="#event-modal">Edit Event</a></li>
                                    <!-- option 2 -->
                                    <li><a class="dropdown-item" @click="this.id = (event.event_id)"
                                            data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Delete Event</a>
                                    </li>
                                    <!-- option 3 -->
                                    <li><a class="dropdown-item"
                                            @click="this.id = (event.event_id), this.showYearLevelExempted()"
                                            data-bs-toggle="modal" data-bs-target="#exemptModal">Select exempted
                                            attendees</a>
                                    </li>
                                    <div v-if="event.event_status == 0 || event.event_status == 2">
                                        <li><a class="dropdown-item"
                                                @click="this.id = (event.event_id), this.status = 1"
                                                data-bs-toggle="modal" data-bs-target="#eventStatus">Start Event</a>
                                        </li>
                                    </div>
                                    <div v-else-if="event.event_status == 1">
                                        <li><a class="dropdown-item"
                                                @click="this.id = (event.event_id), this.status = 2"
                                                data-bs-toggle="modal" data-bs-target="#eventStatus">Stop Event</a>
                                        </li>
                                    </div>
                                    <div
                                        v-if="(event.attendance_status == 0 || event.attendance_status == 2) && (event.event_status == 1 && event.event_status != 0)">
                                        <li><a class="dropdown-item"
                                                @click="this.attendance_count_start_attendance = event.attendance_count, this.id = (event.event_id), this.status = 1"
                                                data-bs-toggle="modal" data-bs-target="#startAttendanceModal">Start
                                                Attendance</a></li>
                                    </div>
                                    <div
                                        v-else-if="event.attendance_status == 1 && event.event_status == 1 && event.event_status != 0">
                                        <li><a class="dropdown-item"
                                                @click="this.attendance_count_start_attendance = 0, this.id = (event.event_id), this.status = 2"
                                                data-bs-toggle="modal" data-bs-target="#stopAttendanceConfirmation">Stop
                                                Attendance</a></li>
                                    </div>

                                    <div>
                                        <li><a class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#cancelAttendance"
                                                @click="this.id = (event.event_id), this.fetchCancelAttendanceEvent()">Exclude
                                                Attendance log</a>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                            <h5 class="card-title mt-4 mb-2"><strong>{{ event["name"] }}</strong></h5>
                            <p class="card-subtitle text-muted">Scheduled Date: {{ event["start_date"] }}</p>
                            <p class="card-subtitle text-muted">Start Time: {{ event["start_attendance"] }} </p>
                            <p class="card-subtitle text-muted">End Time: {{ event["end_attendance"] }} </p>
                            <h6 class="card-text mb-0">Location: {{ event["location"] }} </h6>
                            <!-- <h6 class="card-text">Description: {{ event["description"] }} </h6> -->
                            <!-- <div class="card-actions">
                                                <button class="ellipsis-button" @click=" FetchUpdateData(event.event_id) "   type="button"  data-bs-toggle="modal" data-bs-target="#event-modal" > <i class="bi bi-pencil-square"></i></button> -->
                            <!-- <button class="ellipsis-button"  @click="deleteEvent(event.event_id)"  type="button"> <i class="bi bi-trash"></i></button> -->
                            <!-- <button class="ellipsis-button" @click="this.id = event.event_id"  data-bs-toggle="modal" data-bs-target="#deleteConfirmation" type="button"> <i class="bi bi-trash"></i></button>
                                            </div> -->
                            <!-- Add View button to show event details -->
                            <button class="btn btn-success view-button" @click="showEventDetails(event.event_id)"
                                data-bs-toggle="modal" data-bs-target="#event-details-modal">View</button>
                        </div>
                    </div>
                    <!-- EVENT CARD -->
                    <!-- <div class="event-card border-top border-5 border-success border-bottom-0" v-for="event in this.filtered_events" :id="event.event_id" > -->

                </div>
                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteConfirmation" tabindex="-1" aria-labelledby="deleteConfirmationLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <!-- <h5 class="modal-title" id="deleteConfirmationLabel">Confirm Delete</h5> -->
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <h4><i class="fas fa-exclamation-triangle text-warning"></i></h4>
                                <h4><b>Delete Event</b></h4>
                                <p>Are you sure you want to delete this event?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" @click="deleteEvent()"
                                    data-bs-dismiss="modal">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Start event confirmation -->
                <div class="modal fade " id="eventStatus" tabindex="-1" aria-labelledby="eventStatusConfirmationLabel"
                    aria-hidden="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <h4><i v-if="status === 1" class="fas fa-question-circle text-warning"></i>
                                    <i v-if="status === 2" class="fas fa-exclamation-triangle text-danger"></i>
                                </h4>

                                <p v-if="this.status === 1">Are you sure you want to Start Event?</p>
                                <p v-if="this.status === 2">Are you sure you want to Stop Event?</p>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                <button type="button" class="btn btn-success" @click="startEvent()"
                                    :disabled="isSubmitting">
                                    <div v-if="this.status === 1">Start Event</div>
                                    <div v-else-if="this.status === 2">Stop Event</div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start Attendance confirmation -->
                <div class="modal fade " id="stopAttendanceConfirmation" tabindex="-1"
                    aria-labelledby="stopAttendanceConfirmationLabel" aria-hidden="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <h4><i v-if="status === 1" class="fas fa-question-circle text-warning"></i>
                                    <i v-if="status === 2" class="fas fa-exclamation-triangle text-danger"></i>
                                </h4>

                                <p v-if="this.status === 1">Are you sure you want to Start Attendance to this Event?</p>
                                <p v-if="this.status === 2">Are you sure you want to Stop Attendance to this Event?</p>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                <button type="button" class="btn btn-success" @click="startAttendance()"
                                    :disabled="isSubmitting">
                                    <div v-if="this.status === 1">Start Attendance</div>
                                    <div v-else-if="this.status === 2">Stop Attendance</div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- start attendance modal -->
                <div class="modal fade" id="startAttendanceModal" tabindex="-1"
                    aria-labelledby="startAttendanceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center">
                                    <h4> <i class="fas fa-question-circle text-warning"></i> </h4>
                                    <h5 class="fw-bold text-center"> Start an Attendance?</h5>
                                </div>
                                <!-- <p>Are you sure you want to start attendance?</p> -->
                                <label class="mt-2">Select Attendance Type:</label>
                                <div class="select-dropdown" style="width: 100% !important; border: 1px solid #ccc;">

                                    <select id="sort-select" class="form-control" style="text-align: center;"
                                        v-model="session" required>
                                        <option :value="0" disabled selected>Select Attendace Type</option>
                                        <option :value="1" v-if="attendance_count_start_attendance >= 1">Session 1
                                        </option>
                                        <option :value="2" v-if="attendance_count_start_attendance >= 2">Session 2
                                        </option>
                                        <option :value="3" v-if="attendance_count_start_attendance >= 3">Session 3
                                        </option>
                                        <option :value="4" v-if="attendance_count_start_attendance >= 4">Session 4
                                        </option>
                                    </select>
                                </div>
                                <!-- <div class="form-group">
                                                    <label for="attendanceType">Select Attendance Type:</label>
                                                    <select class="form-select " id="attendanceType" v-model="session">
                                                        <option :value="1" v-if="attendance_count >= 1">Morning (Log in)</option>
                                                        <option :value="2" v-if="attendance_count >= 2">Morning (Log out)</option>
                                                        <option :value="3" v-if="attendance_count >= 3">Afternoon (Log in)</option>
                                                        <option :value="4" v-if="attendance_count >= 4">Afternoon (Log out)</option>
                                                    </select>
                                        </div> -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success"
                                    @click="startAttendance(event_id, org_id, session)"
                                    :disabled="isSubmitting">Start</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- cancel attendance modal -->
                <div class="modal fade" id="cancelAttendance" tabindex="-1" aria-labelledby="cancelAttendanceModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center">
                                    <h4> <i class="fas fa-question-circle text-warning"></i> </h4>
                                    <h5 class="fw-bold text-center"> Exclude an Attendance?</h5>
                                </div>
                                <p>Select an attendance log that will not need an Attendance</p>

                                <div v-for="index in this.attendance_count_for_exempting_attendance" :key="index">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input mr-2" :value="index"
                                            v-model="attendanceCancelled">
                                        <label class="form-check-label fw-bold">Attendance Log {{ index }}</label>
                                    </div>
                                </div>

                                <!-- <div class="select-dropdown" style="width: 100% !important; border: 1px solid #ccc;"> -->
                                <!--
                                    <select id="sort-select" class="form-control" style="text-align: center;"
                                        v-model="session" required>
                                        <option :value="0" disabled selected>Select Attendace Type</option>
                                        <option :value="1" v-if="attendance_count_start_attendance >= 1">Morning (Log
                                            in)
                                        </option>
                                        <option :value="2" v-if="attendance_count_start_attendance >= 2">Morning (Log
                                            out)
                                        </option>
                                        <option :value="3" v-if="attendance_count_start_attendance >= 3">Afternoon (Log
                                            in)
                                        </option>
                                        <option :value="4" v-if="attendance_count_start_attendance >= 4">Afternoon (Log
                                            out)
                                        </option>
                                    </select> -->

                                <!-- </div> -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success"
                                    @click="this.submitCancelAttendanceEvent">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Exempted Modal -->
                <div class="modal fade" id="exemptModal" tabindex="-1" role="dialog" aria-labelledby="exemptModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form @submit.prevent="submitYearLevelExempted" ref="exemptForm">
                                <div class="modal-header">
                                    <!-- <h5 class="modal-title" id="exemptModalLabel">Exempted Year levels</h5> -->
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h4 class="text-center fw-bold">
                                        <i class="fas fa-info-circle text-info"></i>
                                    </h4>
                                    <h5 class="text-center fw-bold">You are about to exclude a Year level</h5>
                                    <h6>Check the year level/s excused from required participation in the event</h6>
                                    <!-- <div v-if="!isAtLeastOneChecked" class="text-danger">Please select at least one year
                                        level</div> -->
                                    <div v-for="year_level in year_level_data" :key="year_level.id" class="form-check">
                                        <input type="checkbox" :value="year_level.id" v-model="year_level_exempted"
                                            class="form-check-input mr-2">
                                        <label class="form-check-label fw-bold">{{ year_level.year_level }} </label>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- View modal -->
                <div class="modal fade" id="event-details-modal" tabindex="-1" role="dialog"
                    aria-labelledby="event-details-modal-label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="event-details-modal-label">Event Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" :id="this.showEvent.event_id">
                                <h5 class="card-title"><strong>{{ this.showEvent["name"] }}</strong></h5>
                                <div class="mt-2 mb-3">
                                    <h6 class="card-text text-muted">Scheduled Date: {{ this.showEvent["start_date"] }}
                                    </h6>
                                    <h6 class="card-text text-muted">Start Time: {{ this.showEvent["start_attendance"]
                                        }}
                                    </h6>
                                    <h6 class="card-text text-muted">End Time: {{ this.showEvent["end_attendance"] }}
                                    </h6>
                                </div>
                                <div class="mb-3">
                                    <h6 class="card-text">Location: {{ this.showEvent["location"] }}</h6>
                                    <h6 class="card-text">Description: {{ this.showEvent["description"] }}</h6>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Modal -->
                <div class="modal fade" id="event-modal" tabindex="-1" aria-labelledby="event-modal-label"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5 v-if="this.submit == this.sendData" class="modal-title text-center fw-bold"
                                    id="event-modal-label">Create Event</h5>
                                <h5 v-else-if="this.submit == this.UpdateData" class="modal-title text-center fw-bold"
                                    id="event-modal-label">Edit Event</h5>

                                <form @submit.prevent="this.submit" id="eventsForm">
                                    <div class="mb-3">
                                        <label for="event-title" class="form-label">Event Name</label>
                                        <input type="text" name="name" class="form-control" id="event-title"
                                            v-model="formData.name" required maxlength="50"
                                            :style="{ borderColor: formData.name.length >= 50 ? 'red' : '' }">
                                        <p class="pl-2" v-if="formData.name.length >= 50" style="color: red;">Maximum
                                            length
                                            reached</p>
                                    </div>
                                    <!-- <div class="row g-3">
                                            <div class="col-md-6"> -->
                                    <label for="event-start-date" class="form-label">Schedule Date</label>
                                    <input type="date" name="start_date" class="form-control" id="event-start-date"
                                        v-model="formData.start_date" required>
                                    <!-- </div> -->
                                    <!-- <div class="col-md-6">
                                                <label for="event-end-date" class="form-label">End Date</label>
                                                <input type="date" name="end_date" class="form-control" id="event-end-date" v-model="formData.end_date" required>
                                            </div> -->
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="event-start-time" class="form-label">Start Event Time</label>
                                            <input type="time" name="start_attendance" class="form-control"
                                                id="event-start-time" v-model="formData.start_attendance" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="event-end-time" class="form-label">End Event Time</label>
                                            <input type="time" name="end_attendance" class="form-control"
                                                id="event-end-time" v-model="formData.end_attendance" required>
                                        </div>
                                    </div>
                                    <!-- </div> -->

                                    <div class="mb-3">
                                        <label for="event-location" class="form-label">Location</label>
                                        <input type="text" name="location" class="form-control" id="event-location"
                                            v-model="formData.location" required maxlength="30"
                                            :style="{ borderColor: formData.location.length >= 30 ? 'red' : '' }">
                                        <p class="pl-2" v-if="formData.location.length >= 30" style="color: red;">
                                            Maximum
                                            length reached</p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="event-description" class="form-label">Description</label>
                                        <span v-if="formData.description.length > 200" class="text-danger">You have
                                            exceeded
                                            the word limit</span>
                                        <textarea class="form-control" name="description" id="event-description"
                                            rows="3" v-model="formData.description" required maxlength="200"
                                            :style="{ borderColor: formData.description.length >= 200 ? 'red' : '' }"></textarea>
                                        <p class="pl-2" v-if="formData.description.length >= 200" style="color: red;">
                                            Maximum length reached</p>
                                    </div>
                                    <div class="mb-3 flex justify-end">
                                        <div class="select-dropdown border" style="width: 80%;">
                                            <select id="sort-select" class="form-control" style="text-align: center;"
                                                v-model="this.formData.evaluation_form" required>
                                                <option value="" disabled selected>Select Evaluation form</option>
                                                <option v-for="evaluation in this.evaluation_form"
                                                    :value="evaluation['id']">
                                                    {{ evaluation['evaluation_title'] }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <input class="form-check-input" type="checkbox" name="require_attendance"
                                            id="require-attendance" v-model="formData.require_attendance"
                                            :true-value="1" :false-value="0">
                                        <label for="require-attendance" class="form-label">Require Attendance</label>
                                    </div>
                                    <div id="attendance-container" v-if="this.formData.require_attendance == 1">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="event-attendance" class="form-label">Number of
                                                    Attendance Log</label>
                                                <select name="attendance_count" class="form-select"
                                                    id="event-attendance" v-model="formData.attendance_count" required>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="fines" class="form-label">Fines Per Attendance</label>
                                                <input type="number" name="fines" class="form-control" id="fines"
                                                    v-model="formData.fines" required>
                                            </div>
                                        </div>


                                    </div>
                                    <!-- <input type="hidden" name="org_id"  v-model="formData.org_id"> -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success" id="save-event-button"
                                            :disabled="isSubmitting">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { convertDate } from "../Functions/DateConverter.js";
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { converTime } from "../Functions/TimeConverter.js";

export default {
    props: ['organization_id', 'school_year_session'],
    data() {
        return {
            submit: this.sendData,
            events: [],
            showEvent: [],
            id: 0,
            status: 0,
            loading: false,
            formData: {
                name: '',
                start_date: '',
                start_attendance: '',
                end_attendance: '',
                location: '',
                description: '',
                require_attendance: 0,
                attendance_count: '',
                fines: '',
                org_id: '',
                school_year_input: this.school_year_input,
                evaluation_form: 0,
            },
            errors: {},
            school_year: [],
            school_year_input: this.school_year_session,
            searchTerm: '',
            status_filter: '',
            searchSchoolYear: 0,
            filtered_events: [],
            year_level_data: [],
            year_level_exempted: [],
            year_level_fetch_update: [],
            attendance_count_start_attendance: 0,
            session: 0,
            evaluation_form: [],
            isSubmitting: false,
            attendance_count_for_exempting_attendance: 0,
            attendanceCancelled: [],
        }
    },
    created() {
        this.loading = true;
        this.fetchData();
        this.showSchoolYear();
        this.showYearLevelData();


    },
    mounted() {

    },
    computed: {
        isAtLeastOneChecked() {
            return this.year_level_exempted.length > 0;
        }
    },

    methods: {
        submitCancelAttendanceEvent() {
            // console.log(this.attendanceCancelled)
            axios.post(`/submitCancelAttendanceEvent/${this.id}/${this.school_year_input}`, this.attendanceCancelled)
                .then(response => {
                    this.showSucces(response.data.message);

                    console.log(response.data)
                })
                .catch(error => {
                    alert(error)
                });
        },
        fetchCancelAttendanceEvent() {
            axios.get(`show_event_details/${this.id}`)
                .then(response => {
                    this.attendance_count_for_exempting_attendance = response.data.attendance_count;
                    console.log(this.attendance_count_for_exempting_attendance)
                })
                .catch(error => {
                    console.log(error)
                });

            axios.get(`show_cancelled_attendance/${this.id}`)
                .then(response => {

                    this.attendanceCancelled = [];
                    response.data.forEach(element => {
                        this.attendanceCancelled.push(element.session);
                    });
                    console.log(response.data)
                })
                .catch(error => {
                    console.log(error)
                });
        },
        startEvent() {
            axios.put(`/update_event_status/${this.id}/${this.status}`)
                .then(response => {
                    console.log(response.data)
                    this.showSucces(response.data.message);

                    this.fetchData();
                })
                .catch(error => {
                    alert('Error', error)
                });
        },
        showEvaluationForm() {
            axios.get(`getEvaluationForm/${this.organization_id}/${this.school_year_input}`)
                .then(response => {
                    console.log(response.data)
                    this.evaluation_form = response.data;
                })
                .catch(error => {

                });
        },
        submitYearLevelExempted() {
            axios.post(`/submitYearLevelExempted/${this.organization_id}/${this.school_year_input}/${this.id}`, this.year_level_exempted)
                .then(response => {
                    this.showSucces('Exempted Year Level Updated Successfully');

                    console.log(response.data)
                })
                .catch(error => {
                    alert(error)
                });
        },
        showYearLevelData() {
            axios.get(`get_year_level/${this.organization_id}`)
                .then(response => {
                    // console.log(response.data)
                    this.year_level_data = response.data;
                })
                .catch(error => {

                });
        },
        showYearLevelExempted() {
            axios.get(`/yearLevel/exempted/${this.organization_id}/${this.id}`)
                .then(response => {
                    // console.log(response.data)
                    let data = response.data;
                    this.year_level_exempted = [];
                    data.forEach(element => {
                        // console.log(element)
                        // this.year_level_exempted = element.school_year;
                        this.year_level_exempted.push(element.year_level_id);
                    });
                    // this.year_level_exempted = response.data;
                })
                .catch(error => {
                    console.log(error)
                });
        },
        filterItems() {
            // Filter based on searchTerm from textbox
            let filteredBySearch = this.events;
            if (this.searchTerm) {
                const searchTermLower = this.searchTerm.toLowerCase();
                filteredBySearch = filteredBySearch.filter(item =>
                    item.name.toLowerCase().includes(searchTermLower)
                );
            }
            // Filter based on filterStatus from select option
            console.log(this.status_filter)
            let filteredByStatus = this.events;
            if (this.status_filter) {
                filteredByStatus = filteredByStatus.filter(item =>
                    item.event_status.toString().includes(this.status_filter)
                );
            }

            // this.filtered_student_list = filteredBySearch;

            this.filtered_events = filteredBySearch.filter(item =>
                filteredByStatus.includes(item)
            );
            // this.filtered_events = filteredBySearch;
        },
        showSchoolYear() {
            axios.get(`get_school_year`)
                .then(response => {
                    // console.log(response.data)
                    this.school_year = response.data;
                })
                .catch(error => {
                    console.log(error)
                });
        },
        showEventDetails(event) {
            console.log(event)
            axios.get(`show_event_details/${event}`)
                .then(response => {
                    const data = response.data;
                    // data.forEach(item => {
                    data["start_attendance"] = converTime(data["start_attendance"]);
                    data["end_attendance"] = converTime(data["end_attendance"]);
                    data["start_date"] = convertDate(data["start_date"]);
                    // });
                    console.log(data);
                    this.showEvent = response.data

                })
                .catch(error => {

                });
        },



        sendData() {
            this.isSubmitting = true;
            // Assuming the checkboxes are already created as mentioned in your code snippet

            // Get all the checkboxes by their name
            const checkboxes = document.querySelectorAll('input[name="checkboxes"]');

            // Initialize an array to store the values of checked checkboxes
            const checkedValues = [];

            // Loop through each checkbox and check if it is checked
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    checkedValues.push(checkbox.value); // Add the value to the array if the checkbox is checked
                }
            });

            // Now, the checkedValues array contains the values of the checked checkboxes
            console.log('Checked values:', checkedValues);

            if (this.school_year_input == 0) {
                alert('Please select School Year')
            }
            else {
                axios.post('/events', this.formData)
                    .then(response => {
                        this.showSucces(response.data.message);

                        // console.log(response.data)
                    })
                    .catch(error => {
                        alert(error)

                    });
            }

        },
        fetchData() {
            this.events = [];
            this.filtered_events = [];
            this.loading = true;

            axios.get(`/events/show/${this.organization_id}/${this.school_year_input}`)
                .then(response => {
                    this.loading = false;
                    // document.getElementById("event-spinner").classList.add("hidden");
                    const data = response.data;
                    data.forEach(item => {
                        item["start_attendance"] = converTime(item["start_attendance"]);
                        item["end_attendance"] = converTime(item["end_attendance"]);
                        item["start_date"] = convertDate(item["start_date"]);
                    });

                    this.events = response.data;
                    this.filtered_events = this.events;
                })
                .catch(error => {
                    this.loading = false;
                    // this.loading = false;
                    console.log(error)
                });
            this.showEvaluationForm();
        },

        FetchUpdateData(id) {

            console.log(id)
            axios.get(`show_event_details/${id}`)
                .then(response => {
                    this.formData = response.data
                    this.id = id
                    this.submit = this.UpdateData

                })
                .catch(error => {

                });
        },
        UpdateData() {
            this.isSubmitting = true;
            axios.put(`/events/${this.id}`, this.formData)
                .then(response => {
                    this.submit = this.sendData;
                    this.showSucces(response.data.message);

                })
                .catch(error => {
                    // console.error('Error updating user:', error);
                    alert('Error updating user:', error)
                });
        },
        deleteEvent() {
            axios.delete(`/events/${this.id}`)
                .then(response => {
                    // console.log(response.data)
                    // const closeButton = $('.modal button[data-bs-dismiss="modal"]');
                    // closeButton.trigger('click');
                    if (response.data.status == 1) {
                        this.showSucces(response.data.message);
                        console.log(response.data)

                    }
                    else {
                        this.showError(response.data.message);
                    }

                })
                .catch(error => {
                    if (error.response && error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                    alert(error)

                });

        },

        startAttendance() {

            if (this.session == 0 && this.status == 1) {
                alert('Please input session');
            }
            else {
                axios.put(`/update_event_attendance_status/${this.id}/${this.status}/${this.session}`)
                    .then(response => {
                        this.isSubmitting = true;
                        console.log(response.data)
                        this.showSucces(response.data.message);

                        this.fetchData();
                    })
                    .catch(error => {
                        alert('Error', error)
                    });
            }
        },
        showSucces(message) {
            // this.fetchData();
            setTimeout(() => {
                location.reload();
            }, 500);
            toast.success(message), {
                autoClose: 100,
            }
        },
        showError(message) {
            this.fetchData();
            toast.error(message), {
                autoClose: 100,
            }
        },
        initialData() {
            this.formData = {
                name: '',
                start_date: '',
                end_date: '',
                start_attendance: '',
                end_attendance: '',
                location: '',
                description: '',
                require_attendance: 0,
                org_id: this.organization_id,
                school_year_input: this.school_year_input,
                evaluation_form: '',

            }
        },
    }
}
</script>
