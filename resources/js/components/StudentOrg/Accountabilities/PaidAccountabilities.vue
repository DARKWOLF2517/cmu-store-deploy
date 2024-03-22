<template>
    <div class="col-md-6 col-sm-12">
        <div class="input-container">
            <i class="fa fa-search"></i>
            <input type="text" placeholder="Search Student" v-model="searchTerm" @input="filterItems">
        </div>
    </div>
    <div class="col-md-6 col-sm-12" style="display: flex; align-items: center; justify-content: flex-end; gap: 20px;">


        <!-- {{-- <button class="btn sort-btn"><i class="fas fa-filter"></i></button> --}} -->

        <div class="select-dropdown" id="semester-btn" style="width: 50%;">
            <!-- First dropdown -->
            <select id="sort-select" class="form-control" style="text-align: center;" v-model="school_year_input"
                @change="fetchData">
                <option value="" disabled selected>Select Semester</option>
                <option v-for="school_year in this.school_year" :value="school_year['id']">{{ school_year['school_year']
                    }}
                </option>

            </select>
        </div>
        <div class="select-dropdown" id="college-btn" style="width: 20%;" v-if="this.college_id == 11">
            <!-- First dropdown -->
            <select id="sort-select" class="form-control" style="text-align: center;" v-model="college_data_input"
                @change="filterItems">
                <option value="" disabled selected><i class="fas fa-filter"></i> College</option>
                <option v-for="college in this.college_list" :value="college.id">{{ college.college }}</option>
            </select>
        </div>
        <div class="select-dropdown" style="width: 30%;">

            <select id="sort-select" class="form-control" style="text-align: center;" v-model="accountability_type"
                @change="filterItems">
                <option value="" disabled selected><i class="fas fa-filter"></i> Sort by</option>
                <option value="fines">Fines</option>
                <option v-for="accountability in this.accountabilities" :value="accountability.accountability_name">{{
                accountability.accountability_name }}</option>
            </select>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row d-flex justify-content-between">
            <div class="col-md-8">
 <h4 class="mb-0"><i class="fas fa-list mt-2"></i> Paid Accountabilities</h4>
            </div>
            <div class="student-buttons d-flex justify-content-end col-md-4 mt-2">
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

    <div id="table-container" style="margin-left: 10px;">
        <div class="scroll-pane" id="table-list">
            <!-- fines accountabilities -->
            <table id="accountabilities-table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <!-- <th>Accountabilities</th> -->
                        <th>Date Received</th>
                        <th style="width: 10%;">Amount</th>
                        <th>Remarks</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    <div v-if="this.loading == true" class="loading-spinner-container ">
                        <span class="loader"></span>
                    </div>
                    <div class="Container-IfEmpty" v-if="!loading && paidList.length === 0">
                        <div class="Empty-Message text-center">
                            <i class="icon 	bi bi-table" id="icon-message"></i>
                            <p class="text-muted"><b>Paid table is empty.</b>
                                <br>
                                Students with cleared accountabilities are listed here
                            </p>
                        </div>
                    </div>
                    <tr v-for="paid in paginatedData" :key="paid.student_id" style="height: 50px;">
                        <td>{{ paid['student_id'] }}</td>
                        <td> {{ paid.user_profile.first_name + ' ' + paid.user_profile.last_name }}</td>
                        <!-- <td>{{ paid['accountability_name'] }}</td> -->
                        <td> {{ paid['created_at'] }}</td>
                        <td style="text-align: right; font-weight: bold;"> &#8369; {{ paid['amount'] }}</td>
                        <td v-if="paid.remarks == 0">N/A</td>
                        <td v-else> {{ paid.remarks }}</td>
                        <td>
                            <span class="d-flex justify-content-center p-2">
                                <button @click="this.id = paid.id" class="btn btn-danger text-light"
                                    data-bs-toggle="modal" data-bs-target="#deleteConfirmation"><i
                                        class="fas fa-trash"></i></button>
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

    <div id="edit-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="event-modal-label">Edit Student Membership fee</h5>
            </div>
        </div>
    </div>
    <!-- Confirmation paid Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to mark this as paid?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" data-bs-toggle="modal"
                        data-bs-target="#viewAllAccountabilitiesModal" @click="payment()">Yes, Mark as Paid</button>
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
                    <h4><b>Delete Payment</b></h4>
                    <p>Are you sure you want to delete this payment?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" @click="deleteAccountabilities()"
                        data-bs-dismiss="modal">Delete</button>
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
                    <h5 class="modal-title" id="addStudentModalLabel">Excuse
                        Student</h5>
                    <!-- <h5 class="modal-title" id="addStudentModalLabel" v-if="this.submit == this.updateSingleAddStudents">Edit Student</h5> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form @submit.prevent="this.submitExempted">
                        <div class="mb-3">
                            <label for="studentId" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="studentId" v-model="paymentDetails.student_id"
                                @change="this.fetchDataDisplayName" required>
                        </div>
                        <div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastname" v-model="paymentDetails.lastname"
                                    disabled>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstname"
                                    v-model="paymentDetails.firstname" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="firstname"
                                    v-model="paymentDetails.middlename" disabled>
                            </div>
                        </div>

                        <label for="AccountabilityName" class="form-label">Accountability Name</label>
                        <select id="sort-select" class="form-control" style="text-align: center;"
                            v-model="paymentDetails.accountability_type" @change="this.getAccountabilityAmount">
                            <option v-for="accountability in this.accountabilities"
                                :value="accountability.accountability_name">{{ accountability.accountability_name }}
                            </option>
                        </select>
                        <div class="d-flex justify-content-end mt-2">
                            <button type="button" class="btn btn-success " @click="this.fullPayment">Full
                                Amount</button>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="remarks" v-model="paymentDetails.amount"
                                required step="any">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Remarks</label>
                            <input type="text" class="form-control" id="remarks" v-model="paymentDetails.remarks"
                                required>
                        </div>
                        <!-- <div class="mb-3">
                                    <label for="reason" class="form-label">College</label>
                                    <select  class="form-select" id="college" v-model="student_data.college_id">
                                            <option value="0" disabled selected >Select College</option>
                                            <option v-for="college in this.college_list" :value="college.id"> {{ college.college }}</option>
                                    </select>
                                </div> -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { convertDate } from '../Functions/DateConverter';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
export default {

    props: ['org_id', 'school_year_session'],
    data() {
        return {
            paidList: [],
            currentPage: 1,
            itemsPerPage: 10,
            loading: false,
            school_year_input: this.school_year_session,
            school_year: [],
            searchTerm: '',
            filtered_paid_accountabilities: [],
            college_list: [],
            college_id: 0,//college id of the organization
            college_data_input: 0,
            accountabilities: [],
            accountability_type: '',
            id: 0,
            paymentDetails: {
                student_id: '',
                student_org_id: this.org_id,
                lastname: '',
                middlename: '',
                lastname: '',
                amount: '',
                accountability_type: '',
                remarks: '',
            },
            accountabilityAmount: [],

        }
    },
    computed: {
        totalPages() {
            return Math.ceil(this.paidList.length / this.itemsPerPage);
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
            return this.filtered_paid_accountabilities.slice(start, start + this.itemsPerPage);
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
        this.fetchData();
        this.showSchoolYear();
        this.getOrgCollege();
        this.showCollege();
    },
    methods: {
        submitExempted() {
            axios.post(`/FinesAccountabilityPayment/${this.school_year_input}/${this.paymentDetails.amount}/${this.paymentDetails.accountability_type}`, this.paymentDetails)
                .then(response => {
                    console.log(response.data)
                    if (response.data.status == 0) {
                        this.showError(response.data.message);
                    }
                    else if (response.data.status == 1) {
                        this.showSucces(response.data.message);
                        this.fetchData();
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    }


                    // this.fetchData();
                })
                .catch(error => {
                    alert(error)

                });

        },
        fullPayment() {
            if (this.paymentDetails.accountability_type) {
                this.paymentDetails.amount = this.accountabilityAmount.amount;
            }
        },
        getAccountabilityAmount() {
            axios.get(`/get_accountability_amount/${this.paymentDetails.accountability_type}/${this.school_year_input}`)
                .then(response => {
                    console.log(response.data)
                    this.accountabilityAmount = response.data;
                })
                .catch(error => {
                    console.log(error)
                });
        },
        fetchDataDisplayName() {
            // console.log(this.addExcempted.student_id)
            axios.get(`/student_list/show_name/${this.paymentDetails.student_id}`)
                .then(response => {
                    console.log(response.data)
                    if (response.data.length != 0) {
                        // this.formData.user_id = response.data.user_id;
                        this.paymentDetails.firstname = response.data.first_name;
                        this.paymentDetails.lastname = response.data.last_name;
                        this.paymentDetails.middlename = response.data.middle_name;
                    }
                    else {
                        this.paymentDetails.firstname = [];
                        this.paymentDetails.lastname = [];
                        this.paymentDetails.middlename = [];
                    }
                    // this.addExcempted.year_level_id = response.data.user_profile.year_level_id;
                    // this.addExcempted.college_id = response.data.user_profile.college_id;
                })
                .catch(error => {
                    console.log(error)
                });
            this.paymentDetails.firstname = [];
            this.paymentDetails.lastname = [];
            this.paymentDetails.middlename = [];
        },
        deleteAccountabilities() {
            console.log(this.id)
            axios.delete(`/delete_paid_accountabilities/${this.id}`)
                .then(response => {
                    this.showSucces(response.data.message);
                    this.fetchData();
                })
                .catch(error => {
                    if (error.response && error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                    console.log(error)

                });
        },
        getAccountabilities() {
            axios.get(`/get_accountabilities/${this.org_id}/${this.school_year_input}`)
                .then(response => {
                    this.accountabilities = response.data;
                    console.log(response.data)
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
        getOrgCollege() {
            axios.get(`/get_organization_college/${this.org_id}`)
                .then(response => {
                    this.college_id = response.data;
                    this.college_data_input = this.college_id;
                    console.log(this.college_id)
                })
                .catch(error => {
                    console.log(error)
                });
        },

        filterItems() {
            let filteredBySearch = this.paidList;
            if (this.searchTerm) {
                const searchTermLower = this.searchTerm.toLowerCase();
                filteredBySearch = filteredBySearch.filter(item => (item.user_profile.first_name + '' + item.user_profile.last_name).toLowerCase().includes(searchTermLower) ||
                    item.student_id.toString().includes(this.searchTerm)
                );
            }

            let filteredByCollege = this.paidList;
            if (this.college_data_input !== undefined && this.college_data_input !== null && this.college_data_input != 11) {
                filteredByCollege = filteredByCollege.filter(item =>
                    item.user_profile.college_id === parseInt(this.college_data_input, 10)
                );
            }

            let filteredByAccountability = this.paidList;
            if (this.accountability_type) {
                filteredByAccountability = filteredByAccountability.filter(item =>
                    item.accountability_type == this.accountability_type
                );
            }
            // this.filtered_paid_accountabilities = filteredBySearch;
            this.filtered_paid_accountabilities = filteredBySearch.filter(item =>
                filteredByCollege.includes(item) && filteredByAccountability.includes(item)
            );
        },
        showSchoolYear() {
            axios.get(`get_school_year`)
                .then((response) => {
                    this.school_year = response.data;

                })
                .catch((error) => {
                    console.log(error)
                });
        },
        fetchData() {
            this.loading = true;
            axios.get(`/paid_accountabilities/${this.org_id}/${this.school_year_input}`)
                .then(response => {
                    const data = response.data;
                    data.forEach(item => {
                        item["created_at"] = convertDate(item["created_at"]);
                        if (Number.isInteger(item.amount)) {
                            // If it is a whole number, convert it to a string with two decimal places
                            item.amount = item.amount.toFixed(2);
                        }
                    });
                    console.log(response.data)
                    this.paidList = response.data;
                    console.log(this.paidList)
                    this.loading = false;

                    this.filtered_paid_accountabilities = this.paidList;

                })
                .catch(error => {
                    console.log('error')
                });

            this.getAccountabilities();
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
          <h2>Paid Accountabilities</h2>

          <!-- Add Bootstrap table classes -->
          <table class="table table-bordered table-striped">
              <thead>
                  <tr>
                    <th>Student ID</th>
                        <th>Student Name</th>
                        <!-- <th>Accountabilities</th> -->
                        <th>Date Received</th>
                        <th style="width: 10%;">Amount</th>
                        <th>Remarks</th>
                  </tr>
              </thead>
              <tbody>
                  ${this.generateTableRowsWithoutLastColumn(this.paidList)}
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
                <td>${item.created_at}</td>
                <td>${item.amount}</td>
                <td>${item.accountability_type}</td>
            </tr>
        `;
            });
            return rows;
        },
        downloadTable() {
            // Get the table data specifically from free_fines_students
            const tableData = this.getPaidAccountabilitiesTableData();

            // Create a workbook
            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.aoa_to_sheet(tableData);
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

            // Save the workbook as an Excel file
            XLSX.writeFile(wb, 'PaidAccountabilities.xlsx');
        },

        getPaidAccountabilitiesTableData() {
            // Initialize an array to store the table data
            const tableData = [];

            // Iterate through the paidList data
            this.paidList.forEach(item => {
                const rowData = [
                    item.student_id,
                    item.user_profile.first_name + ' ' + item.user_profile.last_name,
                    item.created_at,
                    item.amount,
                    item.accountability_type,
                ];

                // Push the row data to the tableData array
                tableData.push(rowData);
            });

            // Return the table data
            return tableData;
        },
        showSucces(message) {
            this.fetchData();
            toast.success(message), {
                autoClose: 100,
            }
        },
        showError(message) {
            toast.error(message), {
                autoClose: 100,
            }
        },

    }


}

</script>
