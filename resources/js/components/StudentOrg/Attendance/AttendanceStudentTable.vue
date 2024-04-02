<template>
    <div class="mt-2">
        <div class="row head-container">
            <div class="col-md-6 col-sm-12">
                <div class="input-container">
                    <i class="fa fa-search"></i>
                    <input type="text" placeholder="Search" v-model="searchTerm" @input="filterItems" />
                </div>
            </div>
            <div class="col-md-6 col-sm-12" style="
                    display: flex;
                    align-items: center;
                    justify-content: flex-end;
                    gap: 20px;
                ">
                <div class="select-dropdown">
                    <!-- Second dropdown -->
                    <select id="sort-select" class="form-control" style="text-align: center" v-model="session"
                        @change="filterItems">
                        <option value="0" disabled selected>
                            Select Attendace Type
                        </option>
                        <option v-for="index in attendance_count" :key="index" :value="index">
                            Attendance Log {{ index }}
                        </option>
                    </select>
                </div>

                <div class="select-dropdown d-flex justify-content-end" v-if="this.college_id == 11">
                    <select id="sort-select" class="form-control" style="text-align: center"
                        v-model="college_data_input" @change="filterItems">
                        <option value="0" disabled selected>
                            Select College
                        </option>
                        <option v-for="college in this.college_list" :value="college.id">
                            {{ college.college }}
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="align-items-center">
            <div class="row d-flex justify-content-between">
                <div class="col-md-8">
                    <h4 class="mb-0">
                        <i class="fas fa-list mt-2 mb-2"></i> Attendance Record
                    </h4>
                </div>
                <div class="student-buttons col-md-4 d-flex justify-content-end">
                    <div class="btn-group" role="group">
                        <button class="btn me-2" data-bs-toggle="modal" data-bs-target="#excuseStudentModal">
                            <i class="fas fa-plus"></i> Excuse Student
                        </button>
                        <button class="btn me-2" @click="printTable">
                            <i class="fas fa-print"></i> Print
                        </button>
                        <button class="btn me-2" @click="downloadTable">
                            <i class="fas fa-download"></i> Download
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="table-container">

        <h5 id="Eventtitle">
            Event: <b>{{ this.event.name }}</b>
        </h5>
        <p>
            Date: <b>{{ this.event.start_date }}</b>
        </p>
        <div class="scroll-pane" id="table-list">
            <table id="accountabilities-table">
                <thead>
                    <tr>
                        <th class="sortable-header" style="width: 10%">
                            Student ID
                        </th>
                        <th class="sortable-header">Student Name</th>
                        <th class="sortable-header">College</th>
                        <th class="sortable-header">Log</th>
                        <th class="sortable-header" style="width: 20%">Time</th>
                        <th>Remarks</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loading spinner -->
                    <div v-if="loading" class="loading-spinner-container">
                        <span class="loader"></span>
                    </div>
                    <!-- Will show if Table is Empty -->
                    <div class="Container-IfEmpty" v-if="!loading && attendance.length == 0">
                        <div class="Empty-Message text-center">
                            <i class="icon bi bi-table" id="icon-message"></i>
                            <p class="text-muted">
                                <b>Member list is Empty</b>
                                <br />
                                Student members show up here.
                            </p>
                        </div>
                    </div>

                    <div class="Container-IfEmpty"
                        v-if="!loading && filtered_attendance.length == 0 && this.attendance.length != 0">
                        <div class="Empty-Message text-center">
                            <i class="icon bi bi-table" id="icon-message"></i>
                            <p class="text-muted">
                                <b>No records Found</b>
                                <br />
                                Student members show up here.
                            </p>
                        </div>
                    </div>
                    <tr v-for="attendance in paginatedData" :key="attendance.user_id" v-else>
                        <td>{{ attendance.user_id }}</td>
                        <td>
                            {{ attendance.user_profile.first_name }}
                            {{ attendance.user_profile.last_name }}
                        </td>
                        <td>{{ attendance.user_profile.college.college }}</td>
                        <td>{{ attendance.session }}</td>
                        <td>{{ attendance.created_at }}</td>
                        <td v-if="attendance.remarks == 0">N/A</td>
                        <td v-else>{{ attendance.remarks }}</td>
                        <td>
                            <span class="d-flex justify-content-center">
                                <button class="btn btn-danger text-light" data-bs-toggle="modal"
                                    data-bs-target="#deleteConfirmation" @click="
                        (this.id = attendance.user_id),
                        (this.session = attendance.session)
                        ">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <ul class="pagination justify-content-center mt-2" v-if="filtered_attendance != 0">
            <li class="page-item" :class="{ disabled: currentPage === 1 }">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true" @click.prevent="prevPage">Previous</a>
            </li>
            <li v-for="page in pageRange" :key="page" class="page-item" :class="{ active: currentPage === page }">
                <a class="page-link" href="#" @click.prevent="gotoPage(page)">{{
                        page
                    }}</a>
            </li>
            <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                <a class="page-link" href="#" @click.prevent="nextPage">Next</a>
            </li>
        </ul>
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
                    <h4>
                        <i class="fas fa-exclamation-triangle text-warning"></i>
                    </h4>
                    <h4><b>Delete Attendance</b></h4>
                    <p>Are you sure you want to delete this attendance?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-danger" @click="deleteAttendance()" data-bs-dismiss="modal">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Excuse student Modal -->
    <div class="modal fade" id="excuseStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">
                        Excuse Student
                    </h5>
                    <!-- <h5 class="modal-title" id="addStudentModalLabel" v-if="this.submit == this.updateSingleAddStudents">Edit Student</h5> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form @submit.prevent="this.addAttendance">
                        <div class="mb-3">
                            <label for="studentId" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="studentId" v-model="formData.user_id"
                                @change="this.fetchDataDisplayName" required />
                        </div>
                        <div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastname" v-model="formData.lastname"
                                    disabled />
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstname" v-model="formData.firstname"
                                    disabled />
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="firstname" v-model="formData.middlename"
                                    disabled />
                            </div>
                        </div>
                        <div>
                            <!-- Second dropdown -->
                            <label for="session" class="form-label">Attendance Log</label>
                            <div class="select-dropdown border">
                                <select id="sort-select" class="form-control border" style="text-align: center"
                                    v-model="formData.session" required>

                                    <option v-for="index in attendance_count" :key="index" :value="index">
                                        Attendance Log {{ index }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Remarks</label>
                            <input type="text" class="form-control" id="remarks" v-model="formData.remarks" required />
                        </div>
                        <!-- <div class="mb-3">
                                    <label for="reason" class="form-label">College</label>
                                    <select  class="form-select" id="college" v-model="student_data.college_id">
                                            <option value="0" disabled selected >Select College</option>
                                            <option v-for="college in this.college_list" :value="college.id"> {{ college.college }}</option>
                                    </select>
                                </div> -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-success">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { converTime } from "../Functions/TimeConverter.js";
import { convertDate } from "../Functions/DateConverter.js";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

export default {
    props: ["organization_id", "event_id"],
    data() {
        return {
            attendance: [],
            event: [],
            currentPage: 1,
            itemsPerPage: 10,
            attendance_count: 0,
            session: 0,
            searchTerm: "",
            loading: true,
            filtered_attendance: [],
            college_list: [],
            college_data_input: 0,
            college_id: 0, //college id of the organization'
            id: 0, //id for deletion
            session: 0, //session for deletion
            formData: {
                user_id: "",
                org_id: this.organization_id,
                event_id: this.event_id,
                // officer_id: this.officer_id, //id of the user fetch it in the backend
                session: "",
                remarks: "",
                lastname: "",
                firstname: "",
                middlename: "",
            },
        };
    },
    computed: {
        totalPages() {
            return Math.ceil(this.attendance.length / this.itemsPerPage);
        },
        pageRange() {
            const start = Math.max(1, this.currentPage - 5);
            const end = Math.min(this.totalPages, this.currentPage + 5);
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
            return this.filtered_attendance.slice(
                start,
                start + this.itemsPerPage
            );
        },
        hasEllipsisBefore() {
            return this.currentPage > 3 && this.totalPages > 5;
        },

        hasEllipsisAfter() {
            return (
                this.currentPage < this.totalPages - 2 && this.totalPages > 5
            );
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
        this.showCollege();
        this.getOrgCollege();
        this.fetchEventDetails();
        this.fetchData();
    },
    methods: {
        addAttendance() {
            if (this.formData.remarks == 0) {
                this.formData.remarks = "Changed";
            }
            axios
                .post("/attendance", this.formData)
                .then((response) => {
                    if (
                        response.data.result == "failure" &&
                        response.data.message != "Invalid Qr Code"
                    ) {
                        this.showError(response.data.message);
                    } else if (response.data.message == "Invalid Qr Code") {
                        this.showError("Student not Found");
                    } else {
                        this.showSucces(response.data.message);

                    }
                    console.log(response.data);
                })
                .catch((error) => {
                    alert(error);
                });
        },
        fetchDataDisplayName() {
            // console.log(this.addExcempted.student_id)
            axios
                .get(`/student_list/show_name/${this.formData.user_id}`)
                .then((response) => {
                    console.log(response.data);
                    if (response.data.length != 0) {
                        // this.formData.user_id = response.data.user_id;
                        this.formData.firstname = response.data.first_name;
                        this.formData.lastname = response.data.last_name;
                        this.formData.middlename = response.data.middle_name;
                    } else {
                        this.formData.firstname = [];
                        this.formData.lastname = [];
                        this.formData.middlename = [];
                    }
                    // this.addExcempted.year_level_id = response.data.user_profile.year_level_id;
                    // this.addExcempted.college_id = response.data.user_profile.college_id;
                })
                .catch((error) => {
                    console.log(error);
                });
            this.formData.firstname = [];
            this.formData.lastname = [];
            this.formData.middlename = [];
        },

        deleteAttendance() {
            axios
                .delete(`/delete_attendance/${this.id}/${this.session}`)
                .then((response) => {
                    console.log(response.data);
                    this.showSucces(response.data.message);
                    // this.fetchData();
                })
                .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                    console.log(error);
                });
        },
        getOrgCollege() {
            axios
                .get(`/get_organization_college/${this.organization_id}`)
                .then((response) => {
                    this.college_id = response.data;
                    this.college_data_input = this.college_id;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        showCollege() {
            axios
                .get(`/view_college`)
                .then((response) => {
                    this.college_list = response.data;
                    // console.log(response.data)
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        filterItems() {
            let filteredBySearch = this.attendance;
            // if (this.searchTerm) {
            //     const searchTermLower = this.searchTerm.toLowerCase();
            //     filteredBySearch = filteredBySearch.filter(item =>
            //         item.user_profile.first_name.toLowerCase().includes(searchTermLower) ||
            //         item.user_id.toString().includes(this.searchTerm)
            //     );
            // }
            if (this.searchTerm) {
                const searchTermLower = this.searchTerm.toLowerCase();
                filteredBySearch = filteredBySearch.filter(
                    (item) =>
                        (
                            item.user_profile.first_name +
                            "" +
                            item.user_profile.last_name
                        )
                            .toLowerCase()
                            .includes(searchTermLower) ||
                        item.user_id.toString().includes(this.searchTerm)
                );
            }

            // Filter based on filterStatus from select option
            let filteredByStatus = this.attendance;
            if (this.session) {
                filteredByStatus = filteredByStatus.filter((item) =>
                    item.session.toString().includes(this.session)
                );
            }

            let filteredByCollege = this.attendance;
            if (
                this.college_data_input !== undefined &&
                this.college_data_input !== null &&
                this.college_data_input != 11
            ) {
                filteredByCollege = filteredByCollege.filter(
                    (item) =>
                        item.user_profile.college.id ===
                        parseInt(this.college_data_input, 10)
                );
            }

            console.log(filteredByCollege);
            // Merge the results of all three filters (independently applied)
            this.filtered_attendance = filteredBySearch.filter(
                (item) =>
                    filteredByStatus.includes(item) &&
                    filteredByCollege.includes(item)
            );
            // console.log(this.filtered_attendance)
            // this.filtered_attendance = filteredBySearch
        },
        fetchEventDetails() {
            axios
                .get(`/get_events/${this.event_id}`)
                .then((response) => {
                    console.log(response.data);
                    response.data.start_date = convertDate(
                        response.data.start_date
                    );
                    this.event = response.data;
                    this.attendance_count = response.data.attendance_count;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        fetchData() {
            axios
                .get(
                    `/attendance/list/${this.organization_id}/${this.event_id}`
                )
                .then((response) => {
                    this.loading = false;
                    this.filtered_attendance = [];
                    const data = response.data;
                    data.forEach((item) => {
                        // console.log(item);
                        item["created_at"] = converTime(item["time"]);
                        item["events"]["start_date"] = convertDate(
                            item["events"]["start_date"]
                        );
                    });
                    this.attendance = response.data;
                    this.filtered_attendance = this.attendance;

                    //   this.attendance.forEach(element => {
                    //     this.attendance_list.push({
                    //       student_id : element.user_id,
                    //       student_name: element.user.name,
                    //       college: element.college.college,
                    //     })
                    //   });
                })
                .catch((error) => {
                    this.loading = false;
                });
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
        printTable() {
            // Clone the table element to avoid modifying the original table
            const tableToPrint = document
                .getElementById("accountabilities-table")
                .cloneNode(true);

            // Create a hidden iframe for printing
            const iframe = document.createElement("iframe");
            iframe.style.display = "none";
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
          <h2>Attendance Record</h2>
          <h5 id="Eventtitle"> Event: <b>${this.event.name}</b></h5>
          <p>Date: <b>${this.event.start_date}</b></p>

          <!-- Add Bootstrap table classes -->
          <table class="table table-bordered table-striped">
            <thead>
                  <tr>
                    <th>Student ID</th>
                        <th>Student Name</th>
                        <th>College</th>
                        <th style="width: 10%;">Time</th>
                  </tr>
              </thead>
              <tbody>
            ${this.generateTableRowsWithoutLastColumn(this.attendance)}
            </tbody>
            </table>
      </body>
      </html>
  `);
            iframeDoc.close();

            // Print the iframe content
            setTimeout(() => {
                iframe.contentWindow.focus();
                iframe.contentWindow.print();
            }, 300);

            // Remove the iframe after printing
            setTimeout(() => {
                document.body.removeChild(iframe);
            }, 1000);
        },

        generateTableRowsWithoutLastColumn(data) {
            let rows = "";
            data.forEach((item) => {
                rows += `
<tr>
    <td>${item.user_id}</td>
    <td>${item.user_profile.first_name} ${item.user_profile.middle_name} ${item.user_profile.last_name}</td>
    <td>${item.user_profile.college.college}</td>
    <td>${item.time}</td>
</tr>
`;
            });
            return rows;
        },
        generateTableRows(data) {
            let rows = "";
            data.forEach((item) => {
                rows += `
          <tr>
              <td>${item.user_id}</td>
              <td>${item.user.name}</td>
              <td>${item.college.college} </td>
              <td>${item.created_at} </td>
          </tr>
      `;
            });
            return rows;
        },
        downloadTable() {
            // Create a temporary download link
            const link = document.createElement("a");
            link.style.display = "none";
            document.body.appendChild(link);

            // Generate CSV content from the attendance array
            const csvContent = [];
            const headers = ["Student ID", "Student Name", "College", "Time"];
            csvContent.push(headers.join(","));

            this.attendance.forEach((item) => {
                const columns = [
                    item.user_id,
                    `${item.user_profile.first_name} ${item.user_profile.middle_name} ${item.user_profile.last_name}`,
                    item.user_profile.college.college,
                    item.created_at,
                ];
                csvContent.push(columns.join(","));
            });

            // Convert CSV content to a Blob
            const csvBlob = new Blob(["\uFEFF" + csvContent.join("\n")], {
                type: "text/csv;charset=utf8;",
            });

            // Set the link's href and download attributes
            link.href = window.URL.createObjectURL(csvBlob);
            link.download = `${this.event.name}_attendance_record.csv`;

            // Trigger the download
            link.click();

            // Clean up
            document.body.removeChild(link);
        },
        showSucces(message) {
            setTimeout(() => {
                window.location.reload();
            }, 1000);
            // this.fetchData();
            toast.success(message),
            {
                autoClose: 100,
            };
        },
        showError(message) {
            toast.error(message),
            {
                autoClose: 100,
            };
        },
    },
};
</script>
