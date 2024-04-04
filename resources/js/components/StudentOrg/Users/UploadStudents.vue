<template>
    <div class="col breadcrumbs">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/org_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student Organization</li>
                <li class="breadcrumb-item active" aria-current="page">Student List</li>
            </ol>
        </nav>
    </div>
    <div class="mt-2">
        <div class="row head-container">
            <div class="col-md-6 col-sm-12">
                <div class="input-container">
                    <i class="fa fa-search"></i>
                    <input type="text" placeholder="Search Student" v-model="searchTerm" @input="filterItems">
                </div>
            </div>
            <div class="col-md-6 col-sm-12"
                style="display: flex; align-items: center; justify-content: flex-end; gap: 20px;">

                <div class="select-dropdown d-flex justify-content-end">
                    <select id="sort-select" class="form-control" style="text-align: center;"
                        v-model="school_year_input" @change="fetchData">
                        <option value="0" disabled selected>Select School Year</option>
                        <option v-for="school_year in this.school_year" :value="school_year['id']">{{
                        school_year['semester'] }} {{
                        school_year['school_year'] }}</option>
                    </select>
                </div>
                <div class="select-dropdown d-flex justify-content-end" v-if="college_id == 11">
                    <select id="sort-select" class="form-control" style="text-align: center;"
                        v-model="college_data_input" @change="filterItems">
                        <option value="0" disabled selected>Select College</option>
                        <option v-for="college in this.college_list" :value="college.id"> {{ college.college }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div>
            <div class="row d-flex justify-content-between ">
                <div class="col-md-6">
                    <h3 class="mb-0"><i class="fas fa-list mt-2"></i> Student List</h3>
                </div>
                <div class="col-md-4 ">
                    <div class="student-buttons d-flex justify-content-end">
                        <div class="btn-group" role="group">
                            <button class="btn " @click="this.submit = this.addSingleStudent, this.clearData()"
                                data-bs-toggle="modal" data-bs-target="#addStudentModal">
                                <i class="fas fa-plus"></i> Tag Student
                            </button>
                            <button id="uploadButton" class="btn ">
                                <!-- <button id="uploadButton" class="btn me-2" data-bs-toggle="modal" data-bs-target="#excelDataModal"></button> -->
                                <i class="fas fa-file-upload"></i> Upload List
                            </button>
                            <button class="btn " @click="printTable">
                                <i class="fas fa-print"></i> Print
                            </button>
                            <input type="file" id="fileInput" accept=".xls, .xlsx" style="display: none;">

                            <a class="ellipsis-button btn btn-light" href="#" role="button" id="ellipsisDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false" style="color: black">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                                <!-- option 1 -->
                                <li><a class="dropdown-item" id="downloadButton"
                                        href="https://github.com/DARKWOLF2517/cmu-store-deploy/raw/main/template.xlsx">Download
                                        Template</a></li>
                                <li>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- <div id="table-container"> -->
    <!-- <div v-if="this.loading == true" class="loading-spinner-container">
                    <div class="spinner-border text-success" id="event-spinner" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="scroll-pane" id="table-list" v-if="this.loading == false"> -->
    <div id="table-container">

        <div class="scroll-pane" id="table-list">

            <table id="student-list-table">
                <thead>
                    <tr>
                        <th style="width: 10%;">Student ID</th>
                        <!-- <th>Last Name</th> -->
                        <th>Full Name</th>
                        <th>Year Level</th>
                        <th>College</th>
                        <th style="width: 10%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loading spinner -->
                    <div v-if="this.loading == true" class="loading-spinner-container ">
                        <span class="loader"></span>
                    </div>
                    <!-- Will show if Table is Empty -->
                    <div class="Container-IfEmpty" v-if="!loading && studentList.length == 0">
                        <div class="Empty-Message text-center">
                            <i class="icon 	bi bi-table" id="icon-message"></i>
                            <p class="text-muted"><b>Member list is Empty</b>
                                <br>
                                Student members show up here.
                            </p>
                        </div>
                    </div>
                    <!-- Will show if no results found in searching -->
                    <div class="Container-IfEmpty"
                        v-if="!loading && this.filtered_student_list.length == 0 && this.studentList.length != 0">
                        <div class="Empty-Message text-center">
                            <i class="icon 	fas fa-frown" id="icon-message"></i>
                            <p class="text-muted fw-bold">No results found</p>
                        </div>
                    </div>
                    <!-- Table rows -->
                    <tr v-for="student in paginatedData" :key="student.student_id">
                        <!-- <tr v-for="student in paginatedData" :key="student.student_id"> -->
                        <!-- Student data will be added here -->
                        <td>{{ student.student_id }}</td>
                        <td>{{ student.user_profile.first_name }} {{ student.user_profile.last_name }}</td>
                        <td>{{ student.user_profile.year_level ? student.user_profile.year_level : '' }}</td>
                        <td>{{ student.user_profile.college.college }}</td>
                        <td>
                            <span class="table-buttons">
                                <!-- <button class="btn edit-button" data-bs-toggle="modal" data-bs-target="#addStudentModal" @click="this.fetchID = student.student_id,this.submit = this.updateSingleAddStudents, this.fetchDataDisplayName()" > <i class="fas fa-pen"></i></button> -->
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteConfirmation" @click="this.fetchID = student.id"> <i
                                            class="fas fa-trash"></i></button>
                                </div>

                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <ul class="pagination justify-content-center mt-2">
            <li class="page-item" :class="{ disabled: currentPage === 1 }">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true" @click.prevent="prevPage">Previous</a>
            </li>
            <li v-for="page in pageRange" :key="page" class="page-item" :class="{ active: currentPage === page }">
                <a class="page-link" href="#" @click.prevent="gotoPage(page)">{{ page }}</a>
            </li>
            <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                <a class="page-link" href="#" @click.prevent="nextPage">Next</a>
            </li>
        </ul>

    </div>
    <!-- Add student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel" v-if="this.submit == this.addSingleStudent">Add
                        Student</h5>
                    <!-- <h5 class="modal-title" id="addStudentModalLabel" v-if="this.submit == this.updateSingleAddStudents">Edit Student</h5> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form @submit.prevent="this.submit">
                        <div class="mb-3" v-if="this.submit == this.addSingleStudent">
                            <label for="studentId" class="form-label">Student ID</label>
                            <!-- <input type="text" class="form-control" id="studentId" v-model="student_data.student_id"
                                @change="this.fetchDataDisplayName" required maxlength="30"
                                :style="{ borderColor: student_data.student_id.length >= 30 ? 'red' : '' }"
                                > -->
                            <input type="text" class="form-control" id="studentId" v-model="student_data.student_id"
                                @change="this.fetchDataDisplayName" required>
                        </div>
                        <!-- <div v-if="student_data.lastname.length == 0"> -->
                        <!-- <div v-if="this.student_data.length == 0" class="text-center">
                                <p class="text-muted">No student found with the given ID.</p>
                            </div> -->
                        <!-- </div> -->
                        <!-- <div v-if="this.submit == this.addSingleStudent"> -->
                        <div class="mb-3">
                            <label for="name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname" v-model="student_data.firstname"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="firstname" v-model="student_data.middlename"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname" v-model="student_data.lastname"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" v-model="student_data.email" required>
                        </div>

                        <!-- </div> -->

                        <div class="mb-3">
                            <label for="reason" class="form-label">Year-level</label>
                            <input type="text" class="form-control" id="yearlevel" v-model="student_data.year_level_id"
                                required>
                            <!-- <select class="form-select" id="yr-level" v-model="student_data.year_level_id" required>
                                <option v-for="year_level in this.year_level_data" :value="year_level.id">{{
                        year_level.year_level }}</option>
                            </select> -->
                        </div>
                        <div class="mb-3">
                            <label for="reason" class="form-label">College</label>
                            <select class="form-select" id="college" v-model="student_data.college_id">
                                <option value="0" disabled selected>Select College</option>
                                <option v-for="college in this.college_list" :value="college.id"> {{ college.college }}
                                </option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmation" tabindex="-1" aria-labelledby="deleteConfirmationLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="deleteConfirmationLabel">Confirm Delete</h5> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h4><i class="fas fa-exclamation-triangle text-warning"></i></h4>
                    <h4><b>Remove Student</b></h4>
                    <p>Are you sure you want to remove this student in this list?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" @click="deleteSingleStudents()"
                        data-bs-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for displaying Excel data before Uploading -->
    <div class="modal fade" id="excelDataModal" tabindex="-1" aria-labelledby="excelDataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="excelDataModalLabel">Excel Student List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form @submit.prevent="this.uploadData()">
                    <div class="modal-body"
                        style="height: 50vh !important; max-height: 50vh !important; overflow-y: auto;">
                        <div class="text-center">
                            <h5 class="fw-bold"> Enter Student ID</h5>
                            <small>Submit an Excel file containing only student ID numbers.</small>
                        </div>
                        <!-- <div class="d-flex justify-content-end">
                            <div class="select-dropdown border">

                                <select id="sort-select" class="form-control" style="text-align: center; height: 100%;"
                                    v-model="year_level_data_input" required>
                                    <option v-for="year_level in this.year_level_data" :value="year_level.id">{{
                        year_level.year_level }}</option>
                                </select>

                            </div>
                        </div> -->

                        <div class="select-dropdown">
                            <select id="sort-select" class="form-control" style="text-align: center;"
                                v-model="college_data_input_for_insert">
                                <option value="0" disabled selected>Select College</option>
                                <option v-for="college in this.college_list" :value="college.id"> {{ college.college }}
                                </option>
                            </select>
                        </div>


                        <br>
                        <table class="table" id="tableModal">
                            <thead>
                                <tr>
                                    <th>Student ID Number</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Year Level or Classification</th>
                                </tr>
                            </thead>
                            <tbody id="modalStudentTableBody">
                                <!-- Excel data will be displayed here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="uploadToTableButton"
                            :disabled="isSubmitting">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default {
    props: ['org_id', 'school_year_session'],
    data() {
        return {
            fetchID: 0,
            studentList: [],
            // editData: {
            // student_id: '',
            // name: '',
            // email: '',
            // year_level: '',
            // },
            school_year: [],
            school_year_input: this.school_year_session,
            searchTerm: '',
            filtered_student_list: [],
            loading: false,
            currentPage: 1,
            itemsPerPage: 10,
            year_level_data: [],
            college_list: [],
            college_data_input: 0,
            college_data_input_for_insert: 0,
            college_id: 0,//colege data of the organization
            year_level_data_input: 0,
            student_data: {
                student_id: '',
                firstname: '',
                middlename: '',
                lastname: '',
                email: '',
                year_level_id: '',
                college_id: 0,



            },
            isSubmitting: false,
            submit: this.addSingleStudent,
            // studentFound: false,

        };
    },
    computed: {
        totalPages() {
            return Math.ceil(this.filtered_student_list.length / this.itemsPerPage);
        },
        pageRange() {
            const start = Math.max(1, this.currentPage - 2);
            const end = Math.min(this.totalPages, this.currentPage + 2);
            const range = [];

            if (start > 1) {
                range.push(1);
                if (start > 2) {
                    range.push("...");
                }
            }

            for (let i = start; i <= end; i++) {
                range.push(i);
            }

            if (end < this.totalPages) {
                if (end < this.totalPages - 1) {
                    range.push("...");
                }
                range.push(this.totalPages);
            }

            return range;
        },
        paginatedData() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            return this.filtered_student_list.slice(start, start + this.itemsPerPage);
        },
        hasEllipsisBefore() {
            return this.currentPage > 3 && this.totalPages > 5;
        },

        hasEllipsisAfter() {
            return this.currentPage < this.totalPages - 2 && this.totalPages > 5;
        },
        ellipsisRange() {
            const range = [];
            const start = Math.max(this.currentPage - 2, 1);
            const end = Math.min(start + 4, this.totalPages);

            if (this.hasEllipsisBefore) {
                range.push(this.ellipsisBefore);
            }

            for (let i = start; i <= end; i++) {
                range.push(i);
            }

            if (end < this.totalPages) {
                if (end < this.totalPages - 1) {
                    range.push(this.ellipsisAfter);
                }
                range.push(this.totalPages);
            }

            // If there are more than 5 page numbers, remove the ones in the middle
            if (range.length > 5) {
                range.splice(3, range.length - 5);
            }

            return range;
        },
        ellipsisBefore() {
            return Math.max(this.currentPage - 5, 1);
        },
        ellipsisAfter() {
            return Math.min(this.currentPage + 5, this.totalPages);
        },
    },

    mounted() {
        this.getOrgCollege();
        this.upload();
        this.fetchData();
        this.showSchoolYear();
        this.showYearLevel();
        this.showCollege();

    },
    methods: {
        getOrgCollege() {
            axios.get(`/get_organization_college/${this.org_id}`)
                .then(response => {
                    this.college_id = response.data;
                    this.college_data_input = this.college_id;
                })
                .catch(error => {
                    console.log(error)
                });
        },
        deleteSingleStudents() {
            axios.delete(`/delete_single_student/${this.fetchID}`)
                .then(response => {
                    console.log(response.data)
                    this.showSucces(response.data.message);
                    // this.fetchData();
                })
                .catch(error => {
                    console.log(error)
                });
        },
        // updateSingleAddStudents(){
        //     axios.put(`/update_single_student`, this.student_data)
        //         .then(response => {
        //             console.log(response.data)
        //             if (response.data.type == 0) {
        //                 this.showError('Error');
        //             }
        //             else{
        //                 this.showSucces(response.data.message);
        //                 this.fetchData();
        //             }
        //         })
        //         .catch(error => {
        //             console.log(error)
        //         });
        // },
        addSingleStudent() {
            axios.post(`/upload_single_student/${this.school_year_input}`, this.student_data)
                .then(response => {
                    console.log(response.data)
                    if (response.data.type == 0) {
                        this.showError(response.data.message);
                    }
                    else if (response.data.type == 2) {
                        this.showError(response.data.message);
                    }
                    else {
                        this.showSucces(response.data.message);
                        // this.fetchData();
                    }

                })
                .catch(error => {
                    console.log(error)
                });
        },
        showCollege() {
            axios.get(`/view_college`)
                .then(response => {
                    this.college_list = response.data;
                    // console.log(response.data)
                })
                .catch(error => {
                    console.log(error)
                });
        },
        showYearLevel() {
            axios.get(`/view_year_level/${this.org_id}`)
                .then(response => {
                    this.year_level_data = response.data;
                })
                .catch(error => {
                    console.log(error)
                });
        },
        filterItems() {
            // Filter based on searchTerm from textbox
            let filteredBySearch = this.studentList;
            if (this.searchTerm) {
                const searchTermLower = this.searchTerm.toLowerCase();
                filteredBySearch = filteredBySearch.filter(item => (item.user_profile.first_name + '' + item.user_profile.last_name).toLowerCase().includes(searchTermLower) ||
                    item.student_id.toString().includes(this.searchTerm)
                );
            }
            // Filter based on filterStatus from select option
            let filteredByCollege = this.studentList;
            if (this.college_data_input && this.college_data_input != 11) {
                filteredByCollege = filteredByCollege.filter(item =>
                    item.user_profile.college.id.toString().includes(this.college_data_input)
                );
            }

            // this.filtered_student_list = filteredBySearch;

            this.filtered_student_list = filteredBySearch.filter(item =>
                filteredByCollege.includes(item)
            );
        },
        fetchData() {
            this.studentList = [];
            this.filtered_student_list = [];
            this.loading = true;
            console.log(this.org_id)
            axios.get(`/student_list/show/${this.org_id}/${this.school_year_input}`)
                .then(response => {
                    console.log(response.data)
                    this.studentList = response.data;
                    this.filtered_student_list = this.studentList;
                    this.loading = false;

                })
                .catch(error => {

                });
        },
        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },

        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },

        gotoPage(page) {
            if (page === "...") {
                if (this.currentPage > this.totalPages / 2) {
                    this.currentPage = this.totalPages;
                } else {
                    this.currentPage = 1;
                }
            } else {
                this.currentPage = page;
            }
        },
        showSchoolYear() {
            axios.get(`get_school_year`)
                .then(response => {
                    // console.log(response.data)
                    this.school_year = response.data;
                    console.log(response.data)
                })
                .catch(error => {
                    console.log(error)
                });
        },
        fetchDataDisplayName() {
            // console.log(this.student_data.student_id)
            axios.get(`/student_list/show_name/${this.student_data.student_id}`)
                .then(response => {
                    console.log(response.data)
                    if (response.data.length != 0) {
                        this.student_data.student_id = response.data.user_id;
                        this.student_data.firstname = response.data.first_name;
                        this.student_data.lastname = response.data.last_name;
                        this.student_data.middlename = response.data.middle_name;
                    }
                    else {
                        this.student_data.firstname = [];
                        this.student_data.lastname = [];
                        this.student_data.middlename = [];
                    }
                    // this.student_data.year_level_id = response.data.user_profile.year_level_id;
                    // this.student_data.college_id = response.data.user_profile.college_id;
                })
                .catch(error => {
                    console.log(error)
                });
            this.student_data.firstname = [];
            this.student_data.lastname = [];
            this.student_data.middlename = [];
        },
        updateData() {
            axios.put(`/student_list/edit/commit/${this.fetchID}`, this.editData)
                .then(response => {
                    console.log(response.data)
                    alert('adf')

                })
                .catch(error => {
                    alert(error)
                });
        },
        uploadData() {

            // if (this.college_data_input == 0 || this.year_level_data_input == 0){
            //     alert('Please Choose Year Level and  College')
            // }
            // else{
            this.isSubmitting = true;
            const excelDataModal = new bootstrap.Modal(document.getElementById("excelDataModal"));
            // excelDataModal.show();
            excelDataModal.hide();

            // Get a reference to the table
            var table = document.getElementById("tableModal");
            // Initialize an empty array to store the data
            var data = [];

            // Iterate through the table rows and cells
            for (var i = 1; i < table.rows.length; i++) {
                var row = table.rows[i];
                var rowData = [];

                for (var j = 0; j < row.cells.length; j++) {
                    var cell = row.cells[j];
                    var cellContent = cell.textContent.trim(); // Trim to remove leading/trailing whitespaces

                    // Check if the cell is not empty before pushing it into the rowData array
                    if (cellContent !== "") {
                        rowData.push(cellContent);
                    }
                }

                // Check if the rowData array is not empty before pushing it into the data array
                if (rowData.length > 0) {
                    data.push(rowData);
                }
            }


            // if (data[0].length == 1) {
            this.collectedData = data;

            // Display the extracted data in the console
            this.loading = true;
            axios.post(`/upload_students/${this.school_year_input}/${this.college_data_input_for_insert}`, { data: this.collectedData })
                .then(response => {
                    console.log(response.data)
                    this.loading = false;
                    this.isSubmitting = false;
                    if (response.data.type == 0) {
                        this.showError('Error File');
                    }
                    else {
                        this.showSucces(response.data.message);
                        // this.fetchData();
                    }

                })
                .catch(error => {
                    console.log(error)
                });
            // }
            // else {
            //     this.showError('excel incorrect format');
            // }
            // }



        },
        upload() {
            document.getElementById("uploadButton").addEventListener("click", function () {
                document.getElementById("fileInput").click();
            });

            document.getElementById("fileInput").addEventListener("change", function (e) {
                const file = e.target.files[0];
                if (file) {
                    parseExcelData(file);
                }
            });

            // Function to parse the uploaded Excel file and display it in the modal
            async function parseExcelData(file) {
                const workbook = new ExcelJS.Workbook();
                const reader = new FileReader();

                reader.onload = async function (e) {
                    const buffer = e.target.result;
                    await workbook.xlsx.load(buffer);
                    const worksheet = workbook.getWorksheet(1); // Assuming data is in the first worksheet

                    // Clear the existing table content
                    const tableBody = document.getElementById("modalStudentTableBody");
                    tableBody.innerHTML = "";

                    // Populate the table with student data, excluding the first row
                    let isHeaderRow = true;
                    worksheet.eachRow({ includeEmpty: true }, function (row) {
                        if (isHeaderRow) {
                            isHeaderRow = false; // Skip the first row (header row)
                            return;
                        }

                        const newRow = document.createElement("tr");

                        row.eachCell({ includeEmpty: true }, function (cell) {
                            let cellValue = cell.text;
                            if (cell.hyperlink && cell.hyperlink.address) {
                                // If the cell contains a hyperlink, use the hyperlink's address as the cell value
                                cellValue = cell.hyperlink.address;
                            }

                            const newCell = document.createElement("td");
                            newCell.textContent = cellValue || ""; // Use an empty string if cellValue is falsy
                            newRow.appendChild(newCell);
                        });

                        tableBody.appendChild(newRow);
                    });

                    // Show the modal
                    const excelDataModal = new bootstrap.Modal(document.getElementById("excelDataModal"), { keyboard: false });
                    excelDataModal.show();


                    // var myModal = new bootstrap.Modal(document.getElementById('excelDataModal'));
                    // myModal.show();

                };

                reader.readAsArrayBuffer(file);
            }



            // // Function to handle the "Delete" button click
            // document.getElementById("modalStudentTableBody").addEventListener("click", function (e) {
            //     if (e.target && e.target.classList.contains("delete-button")) {
            //         const row = e.target.closest("tr");
            //         if (confirm("Are you sure you want to delete this student?")) {
            //             // If the user confirms the deletion, remove the row from the table
            //             row.remove();
            //         }
            //     }
            // });

            // // Function to handle the "Edit" button click
            // document.getElementById("modalStudentTableBody").addEventListener("click", function (e) {
            //     if (e.target && e.target.classList.contains("edit-button")) {
            //         const row = e.target.closest("tr");
            //         const cells = row.querySelectorAll("td");

            //         // Disable the Edit button
            //         e.target.disabled = true;

            //         // Enable editing of the student details
            //         for (let i = 0; i < cells.length - 1; i++) {
            //             const cellContent = cells[i].textContent;
            //             const input = document.createElement("input");
            //             input.value = cellContent;
            //             cells[i].textContent = "";
            //             cells[i].appendChild(input);
            //         }

            //         // Create a Save button
            //         const saveButton = document.createElement("button");
            //         saveButton.textContent = "Save";
            //         saveButton.classList.add("btn", "btn-success");
            //         row.querySelector(".edit-button").insertAdjacentElement("beforebegin", saveButton);

            //         // Handle saving changes
            //         saveButton.addEventListener("click", function () {
            //             // Update the table with the edited details
            //             for (let i = 0; i < cells.length - 1; i++) {
            //                 const input = cells[i].querySelector("input");
            //                 cells[i].textContent = input.value;
            //             }

            //             // Remove the Save button and re-enable the Edit button
            //             saveButton.remove();
            //             e.target.disabled = false;
            //         });
            //     }
            // });
        },
        showSucces(message) {
            setTimeout(() => {
                location.reload();
            }, 1000);
            toast.success(message), {
                autoClose: 100,
            }
        },
        showError(message) {
            toast.error(message), {
                autoClose: 100,
            }
        },
        clearData() {
            this.student_data = {
                student_id: '',
                firstname: '',
                middlename: '',
                lastname: '',
                email: '',
                year_level_id: '',
                college_id: 0,
            };
        },
        printTable() {
            // Create a hidden iframe for printing
            const iframe = document.createElement('iframe');
            iframe.style.display = 'none';
            document.body.appendChild(iframe);

            // Generate the printable HTML document in the iframe
            const iframeDoc = iframe.contentWindow.document;
            iframeDoc.open();
            iframeDoc.write(`
      <html>
      <head>
          <title>Print</title>
          <!-- Include Bootstrap stylesheet link -->
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      </head>
      <body>
          <!-- Add a title before the table -->
          <h2>Student Organization Members</h2>

          <!-- Add Bootstrap table classes -->
          <table class="table table-bordered table-striped">
              <thead>
                  <tr>
                    <th>Student ID</th>
                        <th>Student Name</th>
                        <!-- <th>Accountabilities</th> -->
                        <th>Year Level</th>
                        <th style="width: 10%;">College</th>
                  </tr>
              </thead>
              <tbody>
                  ${this.generateTableRowsWithoutLastColumn(this.filtered_student_list)}
              </tbody>
          </table>
      </body>
      </html>
  `);
            iframeDoc.close();

            // Print the iframe content
            iframe.contentWindow.focus();
            iframe.contentWindow.print();

            // Remove the iframe after printing
            setTimeout(() => {
                document.body.removeChild(iframe);
            }, 1000);
        },

        generateTableRowsWithoutLastColumn(data) {
            let rows = '';
            data.forEach(item => {
                rows += `
            <tr>
                <td>${item.student_id}</td>
                <td>${item.user_profile.first_name} ${item.user_profile.middle_name} ${item.user_profile.last_name}</td>
                <td>${item.year_level.year_level}</td>
                <td>${item.user_profile.college.college}</td>
            </tr>
        `;
            });
            return rows;
        },
    }
}
</script>

<style>
button.page-link {
    display: inline-block;
}

button.page-link {
    font-size: 20px;
    color: #29b3ed;
    font-weight: 500;
}

.offset {
    width: 500px !important;
    margin: 20px auto;
}
</style>
