<template>
    <div class="container breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/login/org_dashboard">Dashboard</a></li>
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
                    <div class="col-md-6 col-sm-12" style="display: flex; align-items: center; justify-content: flex-end;">
                        <!-- <button class="btn sort-btn"><i class="bi bi-sort-up"></i></button> -->
                        <div class="select-dropdown">
                            <select id="sort-select" class="form-control" style="text-align: center;" v-model="school_year_input"  @change="filterItems">
                                <option value="" disabled selected>Select Semester</option>
                                <option v-for="school_year in this.school_year" :value="school_year['id']" >{{ school_year['school_year'] }}</option>

                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="event-buttons d-flex justify-content-end">
                <div class="btn-group" role="group">
                <button class="btn me-2" id="add-event-button" data-bs-toggle="modal" data-bs-target="#event-modal" @click="this.initialData(), this.submit = this.sendData ">
                    <i class="fas fa-calendar-plus"></i> Add Event
                </button>
                </div>
            </div>
            <h3> <i class="fas fa-list mt-2"></i>  Events</h3>
            <div class="event-list">
                <div class="col">

                    <div class="event-container" id="event-container">

                            <div class="event-cards-list " >
                                  <!-- Loading spinner -->
                            <div v-if="loading" class="loading-spinner-container">
                                    <div class="spinner-border text-success" id="event-spinner" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                            </div>
                                <!-- Message if the container is empty -->
                                <div class="Container-IfEmpty" v-if="!loading && events.length === 0">
                                        <div class="Empty-Message">
                                        <i class="icon 	bi bi-calendar-event" id="icon-message"></i>
                                        <p class="text-muted"><b>Create Events when you're ready</b>
                                        <br>
                                        No events yet.</p>
                                        <a class="btn btn-success" id="add-event-button" data-bs-toggle="modal" data-bs-target="#event-modal" @click="this.initialData(), this.submit = this.sendData ">Add Event</a>
                                    </div>
                            </div>
                                <div class="event-card" v-for="event in this.filtered_events" :id="event.event_id" >
                                    <div class="dropdown">
                                        <a class="ellipsis-button" href="#" style="color: black;" role="button" id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-h" ></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                                            <!-- option 1 -->
                                            <li><a class="dropdown-item" @click=" FetchUpdateData(event.event_id)" data-bs-toggle="modal" data-bs-target="#event-modal">Edit Event</a></li>
                                            <!-- option 2 -->
                                            <li><a class="dropdown-item" @click="this.id =(event.event_id)"  data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Delete Event</a></li>
                                            <!-- option 3 -->
                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exemptModal">Select exempted attendees</a></li>
                                            <div v-if="event.attendance_status === 0 || event.attendance_status === 2">
                                                <li><a class="dropdown-item"  @click="this.id =(event.event_id), this.status = 1"  data-bs-toggle="modal" data-bs-target="#startAttendanceConfirmation">Start Attendance</a></li>
                                            </div>
                                            <div v-else-if="event.attendance_status === 1">
                                                <li><a class="dropdown-item"  @click="this.id =(event.event_id) , this.status = 2"  data-bs-toggle="modal" data-bs-target="#startAttendanceConfirmation">Stop Attendance</a></li>
                                            </div>

                                        </ul>
                                    </div>
                                            <h5 class="card-title mt-4 mb-2"><strong>{{ event["name"] }}</strong></h5>
                                            <p class="card-subtitle text-muted">Scheduled Date: {{ event["start_date"] }}</p>
                                            <p class="card-subtitle text-muted">Scheduled Time: {{ event["start_attendance"] }} </p>
                                            <h6 class="card-text">Location: {{ event["location"] }} </h6>
                                            <!-- <h6 class="card-text">Description: {{ event["description"] }} </h6> -->
                                            <!-- <div class="card-actions">
                                                <button class="ellipsis-button" @click=" FetchUpdateData(event.event_id) "   type="button"  data-bs-toggle="modal" data-bs-target="#event-modal" > <i class="bi bi-pencil-square"></i></button> -->
                                                <!-- <button class="ellipsis-button"  @click="deleteEvent(event.event_id)"  type="button"> <i class="bi bi-trash"></i></button> -->
                                                <!-- <button class="ellipsis-button" @click="this.id = event.event_id"  data-bs-toggle="modal" data-bs-target="#deleteConfirmation" type="button"> <i class="bi bi-trash"></i></button>
                                            </div> -->
                                                <!-- Add View button to show event details -->
                                                <button class="btn btn-success view-button" @click="showEventDetails(event.event_id)" data-bs-toggle="modal" data-bs-target="#event-details-modal">View</button>
                                    </div>
                                </div>
                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteConfirmation" tabindex="-1" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteConfirmationLabel">Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this Event?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-danger" @click="deleteEvent()" data-bs-dismiss="modal">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                        <!-- Start Attendance confirmation -->
                        <div class="modal fade " id="startAttendanceConfirmation" tabindex="-1" aria-labelledby="startAttendanceConfirmationLabel" aria-hidden="true" role="dialog">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p >
                                        <b v-if="this.status === 1">Are you sure you want to Start Attendance to this Event?</b>
                                        <b v-if="this.status === 2">Are you sure you want to Stop Attendance to this Event?</b>
                                    </p>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                    <button type="button" class="btn btn-primary" @click="startAttendance()" data-bs-dismiss="modal">
                                        <div v-if="this.status === 1 ">Start Attendance</div>
                                        <div v-else-if="this.status === 2 ">Stop Attendance</div>
                                    </button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- Exempted Modal -->
                        <div class="modal fade" id="exemptModal" tabindex="-1" role="dialog" aria-labelledby="exemptModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exemptModalLabel">Exempted Year levels</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-check">
                                                <h5>Select year level/s that is NOT required to attend the event.</h5>
                                                <input type="checkbox" class="form-check-input" id="1stYearCheckbox">
                                                <label class="form-check-label" for="1stYearCheckbox">1st Year</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="2ndYearCheckbox">
                                                <label class="form-check-label" for="2ndYearCheckbox">2nd Year</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="3rdYearCheckbox">
                                                <label class="form-check-label" for="3rdYearCheckbox">3rd Year</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="4thYearCheckbox">
                                                <label class="form-check-label" for="4thYearCheckbox">4th Year</label>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- View modal -->
                        <div class="modal fade" id="event-details-modal" tabindex="-1" role="dialog" aria-labelledby="event-details-modal-label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="event-details-modal-label">Event Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" :id="this.showEvent.event_id">
                                        <h5 class="card-title"><strong>{{ this.showEvent["name"] }}</strong></h5>
                                        <div class="mt-2 mb-3">
                                        <h6 class="card-text text-muted">Scheduled Date: {{this.showEvent["start_date"]  }}</h6>
                                        <h6 class="card-text text-muted">Scheduled Time: {{ this.showEvent["start_attendance"] }}</h6>
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
                        <div class="modal fade" id="event-modal" tabindex="-1" aria-labelledby="event-modal-label" aria-hidden="true" >
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <h5 v-if="this.submit == this.sendData" class="modal-title" id="event-modal-label">Create Event</h5>
                                        <h5 v-else-if="this.submit == this.UpdateData" class="modal-title" id="event-modal-label">Edit Event</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form @submit.prevent="this.submit"  id="eventsForm"  >
                                            <div class="mb-3">
                                                <label for="event-title" class="form-label">Event Name</label>
                                                <input type="text" name="name" class="form-control" id="event-title" v-model="formData.name" required>
                                            </div>
                                            <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="event-start-date" class="form-label">Start Date</label>
                                                <input type="date" name="start_date" class="form-control" id="event-start-date" v-model="formData.start_date" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="event-end-date" class="form-label">End Date</label>
                                                <input type="date" name="end_date" class="form-control" id="event-end-date" v-model="formData.end_date" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="event-start-time" class="form-label">Start Event Time</label>
                                                <input type="time" name="start_attendance" class="form-control" id="event-start-time" v-model="formData.start_attendance" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="event-end-time" class="form-label">End Event Time</label>
                                                <input type="time" name="end_attendance" class="form-control" id="event-end-time" v-model="formData.end_attendance" required>
                                            </div>
                                        </div>

                                            <div class="mb-3">
                                                <label for="event-location" class="form-label">Location</label>
                                                <input type="text" name="location" class="form-control" id="event-location" v-model="formData.location" required>
                                            </div>
                                            <div class="mb-3">
                                                    <label for="event-description" class="form-label">Description</label>
                                                    <textarea class="form-control" name="description" id="event-description" rows="3" v-model="formData.description" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <input class="form-check-input" type="checkbox" name="require_attendance" id="require-attendance" v-model="formData.require_attendance" true-value="1" false-value="0" @click="checkboxClick()">
                                                <label for="require-attendance" class="form-label">Require Attendance</label>
                                            </div>
                                            <div id="attendance-container" style="display: none;">
                                            <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="event-attendance" class="form-label">Number of Attendance</label>
                                                <select name="attendance_count" class="form-select" id="event-attendance" v-model="formData.attendance_count">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="fines" class="form-label">Fines Per Attendance</label>
                                                <input type="number" name="fines" class="form-control" id="fines" v-model="formData.fines">
                                            </div>
                                        </div>


                                                <br>
                                                <!-- CONTAINER OF THE CHECKBOX TO POPULATE -->
                                                <b><p>Select the year level/s that is NOT required to attend<br> (leave it blank if not applicable)</p></b>

                                                <div id="checkboxes-container">

                                                </div>

                                            </div>
                                            <!-- <input type="hidden" name="org_id"  v-model="formData.org_id"> -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success" id="save-event-button" data-bs-dismiss="modal">Save</button>
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

    import {convertDate} from "../Functions/DateConverter.js";
    import { toast } from 'vue3-toastify';
    import 'vue3-toastify/dist/index.css';

    export default {
        props: ['organization_id'] ,
        data() {
            return {
                submit : this.sendData,
                events: [],
                showEvent: [],
                id: 0,
                status:0,
                loading: true,
                formData:{
                        name:'',
                        start_date:'',
                        end_date:'',
                        start_attendance:'',
                        end_attendance:'',
                        location:'',
                        description:'',
                        require_attendance: '',
                        attendance_count: '',
                        fines: '',
                        org_id: '',
                        school_year_input: this.school_year_input,

                    },
                    errors: {},
                    school_year:[],
                    school_year_input: 1,
                    searchTerm:'',
                    searchSchoolYear:0,
                    filtered_events:[],

            }
        },
        created() {
            this.fetchData();
            this.showSchoolYear();
        },
        methods: {
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
                let filteredBySchoolYear = this.events;
                if (this.school_year_input) {
                    filteredBySchoolYear = filteredBySchoolYear.filter(item =>
                        item.school_year.toString().includes(this.school_year_input)
                    );
                }

                // // Merge the results of both filters (independently applied)
                this.filtered_events = filteredBySearch.filter(item =>
                    filteredBySchoolYear.includes(item)
                );
            },
            showSchoolYear(){
                axios.get(`get_school_year/${this.organization_id}`)
                    .then(response => {
                        console.log(response.data)
                        this.school_year = response.data;
                    })
                    .catch(error => {

                    });
            },
            showEventDetails(event) {
                console.log(event)
                axios.get(`edit/events/${event}`)
                    .then(response => {
                        this.showEvent = response.data
                        console.log(response.data)
                    })
                    .catch(error => {

                    });
            },

            checkboxClick(){
                document.getElementById('require-attendance').addEventListener('change', function() {
                    const attendanceContainer = document.getElementById('attendance-container');
                    if (this.checked) {
                        attendanceContainer.style.display = 'block';
                    } else {
                        attendanceContainer.style.display = 'none';
                    }
                });

                const user_orgs = [
                    { id: 1, label: '1st Year', value: '1' },
                    { id: 2, label: '2nd Year', value: '2' },
                    { id: 3, label: '3rd Year', value: '3' },
                    { id: 4, label: '4th Year', value: '4' },
                    // Other checkbox data objects...
                    ];

                    // Assuming you have a container element where checkboxes will be added
                    const checkboxesContainer = document.getElementById('checkboxes-container');
                    checkboxesContainer.innerHTML = '';
                    // Loop through the user_orgs array to create checkboxes
                    user_orgs.forEach(item => {
                    // Create a checkbox element
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.id = 'checkbox_' + item.id; // Unique ID for each checkbox
                    checkbox.name = 'checkboxes'; // Set the same name for checkboxes if part of a group
                    checkbox.value = item.value; // Value associated with the checkbox

                    // Create a label for the checkbox
                    const label = document.createElement('label');
                    label.htmlFor = 'checkbox_' + item.id;
                    label.appendChild(document.createTextNode(item.label));

                    // Append checkbox and label to the container
                    checkboxesContainer.appendChild(checkbox);
                    checkboxesContainer.appendChild(label);
                    checkboxesContainer.appendChild(document.createElement('br')); // Line break between checkboxes
                    });
            },

            sendData() {
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

                // alert(this.formData.org_id);
                axios.post('/events', this.formData)
                    .then(response => {
                        this.showSucces(response.data.message);
                        // console.log(response.data)
                    })
                    .catch(error => {
                        alert(error)

                });
            },


            fetchData(){
                this.loading = true;
                axios.get(`/events/show/${this.organization_id}`)
                    .then(response => {
                    this.loading = false;
                    document.getElementById("event-spinner").classList.add("hidden");
                    console.log(response.data);
                    this.events = response.data;
                    this.filtered_events = this.events;
                    })
                    .catch(error => {
                    this.loading = false;
                    console.log('error');
                    });
                },

            FetchUpdateData(id){
                axios.get(`edit/events/${id}`)
                    .then(response => {
                        this.formData = response.data
                        this.id = id
                        this.submit = this.UpdateData

                    })
                    .catch(error => {

                    });
            },
            UpdateData() {
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
                console.log(this.id);
                axios.delete(`/events/${this.id}`)
                        .then(response => {
                            // const closeButton = $('.modal button[data-bs-dismiss="modal"]');
                            // closeButton.trigger('click');
                            this.showSucces(response.data.message);


                        })
                        .catch(error => {
                            if (error.response && error.response.status === 422) {
                                this.errors = error.response.data.errors;
                            }
                            alert(error)

                });

            },

            startAttendance() {
                axios.put(`/update_event_attendance_status/${this.id}/${this.status}`)
                        .then(response => {
                            this.showSucces(response.data.message);
                            this.fetchData();
                        })
                        .catch(error => {
                            alert('Error', error)
                        });
            },
            showSucces(message){
                this.fetchData();
                toast.success(message),{
                    autoClose: 100,
                }
            },
            initialData(){
                this.formData = {
                        name:'',
                        start_date:'',
                        end_date:'',
                        start_attendance:'',
                        end_attendance:'',
                        location:'',
                        description:'',
                        require_attendance: '',
                        org_id: this.organization_id,
                        school_year_input: this.school_year_input,

                    }
            },
        }
    }
    </script>
