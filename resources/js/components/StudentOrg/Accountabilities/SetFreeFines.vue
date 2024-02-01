<template>
    <div class="row head-container">
      <div class="col-md-6 col-sm-12">

          <div class="input-container">
              <i class="fa fa-search"></i>
              <input type="text" placeholder="Search Student" v-model="searchTerm" @input="filterItems">
          </div>
      </div>
      <div class="col-md-6 col-sm-12">
        <div class="select-dropdown" id= "semester-btn" >
            <!-- Second dropdown -->
            <select id="sort-select" class="form-control" style="text-align: center;" v-model="school_year_input"  @change="fetchData">
                <option value="0" disabled selected>Select Semester</option>
                <option v-for="school_year in this.school_year" :value="school_year['id']" >{{ school_year['school_year'] }}</option>
            </select>
        </div>
    </div>
    </div>


    <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4 class="mb-0"><i class="fas fa-list mt-2"></i> Student with Free Fines</h4>
        <div class="student-buttons d-flex">
            <div class="btn-group" role="group">
                <button class="btn me-2" data-bs-toggle="modal" @click="this.clearData()" data-bs-target="#addStudentModal">
                    <i class="fas fa-plus"></i> Add Student
                </button>

                <button class="btn me-2" id="add-student-list-button" @click="printTable">
                    <i class="fas fa-print"></i> Print
                </button>
                <button class="btn me-2" id="add-student-button" @click="downloadTable">
                    <i class="fas fa-download"></i> Download
                </button>
            </div>
        </div>
    </div>
</div>
    <!-- <tbody >
                <div v-if="this.loading == true" class="loading-spinner-container">
                    <div class="spinner-border text-success" id="event-spinner" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <tr v-for="free_fines in this.filtered_free_fines">
                    <td>{{ free_fines.student_id }}</td>
                    <td>{{ free_fines.user.name }}</td>
                    <td>{{ free_fines.reason }}</td>
                    <td>
                        <span class="table-buttons">
                                    <button class="btn edit-button" @click="this.submit = this.updateData, this.id = free_fines.student_id,fetchUpdateData()" data-bs-toggle="modal" data-bs-target="#addStudentModal"><i class="fas fa-pen"></i></button> -->
                                    <!-- <button class="btn delete-button" @click="this.submit = this.updateData, this.id = free_fines.student_id,fetchUpdateData()" data-bs-toggle="modal" data-bs-target="#addStudentModal"><i class="fas fa-edit"></i></button> -->
                                    <!-- <button class="btn delete-button" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"><i class="fas fa-trash"></i></button> -->
                        <!-- </span>
                    </td>
                </tr>
            </tbody> -->
<div id="table-container">

    <div class="scroll-pane">
        <table  id="accountabilities-table">
            <thead>
                <tr>
                    <th style="width: 10%;">Student ID</th>
                    <th style="width: 30%;">Student Name</th>
                    <th style="width: 20%;">Reason</th>
                    <th style="width: 10%;"></th>
                </tr>
            </thead>

            <tbody>
                <!-- <tr v-if="loading" class="loading-spinner-container">
                    <td colspan="4">
                        <div class="spinner-border text-success" id="event-spinner" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </td>
                </tr> -->
                 <!-- Loading spinner -->
            <div v-if="this.loading == true" class="loading-spinner-container ">
                <span class="loader"></span>
            </div>
                <div class="Container-IfEmpty" v-if="!loading && free_fines_students.length === 0">
                        <div class="Empty-Message text-center">
                        <i class="icon 	bi bi-table" id="icon-message"></i>
                        <p class="text-muted"><b>Students with free fines.</b>
                        <br>
                        Students with free fines are listed here</p>
                    </div>
                </div>
                <!-- <tr v-if="!loading && filtered_free_fines.length === 0">
                    <td colspan="4">
                        <div class="Container-IfEmpty mb-6">
                            <div class="Empty-Message">
                                <i class="icon fas fa-table" id="icon-message"></i>
                                <p class="mb-0"> <b> Table is Empty</b></p>
                                <small class="text-muted">Add a student to this list.</small>
                            </div>
                        </div>
                    </td>
                </tr> -->
                <!-- <tr v-for="free_fines in filtered_free_fines" :key="free_fines.student_id"> -->
                    <tr v-for="free_fines in paginatedData" :key="free_fines.student_id">
                    <td>{{ free_fines.student_id }}</td>
                    <td>{{ free_fines.user_profile.first_name }} {{ free_fines.user_profile.last_name }}</td>
                    <td>{{ free_fines.reason }}</td>
                    <td>
                        <span class="table-buttons">
                            <button class="btn edit-button" @click="submit = updateData, id = free_fines.student_id, fetchUpdateData()" data-bs-toggle="modal" data-bs-target="#addStudentModal"><i class="fas fa-pen"></i></button>
                            <button class="btn delete-button" @click="id = free_fines.student_id" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"><i class="fas fa-trash"></i></button>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="pagination-container mt-2">
      <ul class="pagination justify-content-center">
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

</div>


      <!-- Delete Confirmation Modal -->
      <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <!-- <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5> -->
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
        <h4><i class="fas fa-exclamation-triangle text-warning"></i></h4>
        <h4><b>Remove Student</b></h4>
          <p>Are you sure you want to remove this student in this list?</p>
      </div>
            <div class="modal-footer ">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-danger" @click="this.deleteStudentData()" data-bs-dismiss="modal">Confirm Delete</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Edit Student Modal
      <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form>
                <input type="hidden" id="edit-id">

                <div class="mb-3">
                  <label for="edit-name" class="form-label">Student Name</label>
                  <input type="text" class="form-control" id="edit-name">
                </div>
                <div class="mb-3">
                  <label for="edit-reason" class="form-label">Reason</label>
                  <select class="form-select" id="edit-reason">
                    <option value="officer">Officer</option>
                    <option value="player">Player</option>
                    <option value="student_volunteer">Student Volunteer</option>
                    <option value="others">Others</option>
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
      </div> -->

      <!-- Add student Modal -->
      <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addStudentModalLabel" v-if="this.submit == sendData">Add Student</h5>
              <h5 class="modal-title" id="addStudentModalLabel" v-else-if="this.submit == updateData">Update Student</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form @submit.prevent="this.submit">
                <div class="mb-3" v-if="this.submit == sendData">
                  <label for="studentId" class="form-label"><b>Student ID</b></label>
                  <input type="number" class="form-control" id="studentId" v-model="free_fines_input.student_id" @change="this.fetchNameStudent">
                </div>
                <div class="mb-3" v-else-if="this.submit == updateData">
                  <label for="studentId" class="form-label"><b>Student ID</b></label>
                  <input type="text" class="form-control" id="studentId" v-model="free_fines_input.student_id" disabled>
                </div>
              <div class="mb-3">
                <label for="IDnumber"><b>Name</b></label>
                <input type="text" class="form-control" id="IDnumber" disabled v-model="this.nameFilterStudent">
              </div>
              <div class="mb-3">
                  <label for="reason" class="form-label"><b>Reason</b></label>
                  <input type="text" class="form-control" id="reason" v-model="free_fines_input.reason">
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Save</button>
              </div>
              </form>
          </div>
          </div>
        </div>
      </div>

</template>

<script>
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
export default{
  props: ['org_id','school_year_session'],
  data(){
    return{
      submit: this.sendData,
      id: 0,
      loading: false,
      free_fines_students: [],
      school_year_input: this.school_year_session,
      free_fines_input: {
        student_id: '',
        reason: '',
        org_id : this.org_id,
        school_year: this.school_year_input,
      },
      nameFilterStudent: '',
      school_year: [],
      searchTerm: '',
      filtered_free_fines: [],
      currentPage: 1,
      itemsPerPage: 10,
    }
  },
  computed: {
    totalPages() {
      return Math.ceil(this.filtered_free_fines.length / this.itemsPerPage);
    },
    pageRange() {
      return Array.from({ length: this.totalPages }, (_, index) => index + 1);
    },
    paginatedData() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.filtered_free_fines.slice(start, end);
    },
  },
  mounted() {
    this.fetchData();
    this.showSchoolYear();
  },
  methods: {
    prevPage() { if (this.currentPage > 1) { this.currentPage--; this.paginatedData = this.filtered_free_fines.slice((this.currentPage - 1) * this.itemsPerPage, this.currentPage * this.itemsPerPage);
    }
 },
 nextPage() { if (this.currentPage < this.totalPages) { this.currentPage++; this.paginatedData = this.filtered_free_fines.slice((this.currentPage - 1) * this.itemsPerPage, this.currentPage * this.itemsPerPage);
}
},
gotoPage(page) { this.currentPage = page; this.paginatedData = this.filtered_free_fines.slice((this.currentPage - 1) * this.itemsPerPage, this.currentPage * this.itemsPerPage);
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
          <h2>Student With Free Fines</h2>

          <!-- Add Bootstrap table classes -->
          <table class="table table-bordered table-striped">
              <thead>
                  <tr>
                      <th style="width: 10%;">Student ID</th>
                      <th style="width: 30%;">Student Name</th>
                      <th style="width: 20%;">Reason</th>
                      <th style="width: 10%;"></th>
                  </tr>
              </thead>
              <tbody>
                  ${this.generateTableRows(this.free_fines_students)}
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

generateTableRows(data) {
  let rows = '';
  data.forEach(item => {
      rows += `
          <tr>
              <td>${item.student_id}</td>
              <td>${item.user.name}</td>
              <td>${item.reason}</td>
              <td>
                  <span class="table-buttons">
                      <button class="btn edit-button" @click="submit = updateData, id = ${item.student_id},fetchUpdateData()" data-bs-toggle="modal" data-bs-target="#addStudentModal"><i class="fas fa-pen"></i></button>
                      <button class="btn delete-button" @click="" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"><i class="fas fa-trash"></i></button>
                  </span>
              </td>
          </tr>
      `;
  });
  return rows;
},
downloadTable() {
  // Get the table data specifically from free_fines_students
  const tableData = this.getFreeFinesTableData();

  // Create a workbook
  const wb = XLSX.utils.book_new();
  const ws = XLSX.utils.aoa_to_sheet(tableData);
  XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

  // Save the workbook as an Excel file
  XLSX.writeFile(wb, 'StudentWithFreeFines.xlsx');
},

getFreeFinesTableData() {
  // Get a reference to the free_fines_students data
  const data = this.free_fines_students;

  // Initialize an array to store the table data
  const tableData = [];

  // Iterate through the free_fines_students data
  for (let i = 0; i < data.length; i++) {
    const rowData = [];

    // Add the desired data fields to the rowData array
    rowData.push(data[i].student_id);
    rowData.push(data[i].user.name);
    rowData.push(data[i].reason);

    // Push the row data to the tableData array
    tableData.push(rowData);
  }

  // Return the table data
  return tableData;
},
    filterItems() {
      // Filter based on searchTerm from textbox
      let filteredBySearch = this.free_fines_students;
      if (this.searchTerm) {
          const searchTermLower = this.searchTerm.toLowerCase();
          filteredBySearch = filteredBySearch.filter(item =>
              item.user.name.toLowerCase().includes(searchTermLower)
          );
      }
          this.filtered_free_fines = filteredBySearch;
    },

    showSchoolYear(){
      axios.get(`get_school_year`)
          .then(response => {
              // console.log(response.data)
              this.school_year = response.data;
          })
          .catch(error => {
              console.log(error)
          });
    },
    fetchUpdateData(){
      axios.get(`/fetch_update_student_data/${this.id}`)
        .then((response) => {
          console.log(response.data)
            this.nameFilterStudent = response.data.user_profile.first_name + ' ' + response.data.user_profile.last_name;
            this.free_fines_input = response.data;
        
          
          // this.loading = false; //
        })
        .catch((error) => {
          console.log(error)
        })
    },
    updateData(){
      axios.put(`/update_student_data/${this.id}/${this.free_fines_input.reason}`)
        .then(response => {
          // console.log(response.data)
            this.showSucces(response.data.message);
            this.fetchData();
        })
        .catch(error => {
            alert('Error', error)
        });
    },
    deleteStudentData(){
      console.log(this.id)
      axios.delete(`/delete_student_free_fines/${this.id}`)
        .then(response => {
          // console.log(response.data)
            this.showSucces(response.data.message);
            this.fetchData();
        })
        .catch(error => {
            alert(error)
      });
    },
    fetchNameStudent(){
      axios.get(`/get_student_name/${this.free_fines_input.student_id}`)
        .then((response) => {
          console.log(response.data)
          if (response.data != 0){
            this.nameFilterStudent = response.data.user_profile.first_name + ' '+ response.data.user_profile.last_name;
          }
          else{
            this.nameFilterStudent  = '';
          }
          
          // this.free_fines_students = response.data;
          // this.loading = false; //
        })
        .catch((error) => {
          console.log(error)
        })
    },
    sendData(){
      // console.log(this.free_fines_input)
      axios.post('/add_free_fines_students', this.free_fines_input)
        .then(response => {
          if(response.data.error == 1){
            this.showError(response.data.message);
          }
          else{
            this.showSucces(response.data.message);
            this.fetchData();
            // console.log(response.data)
          }

        })
        .catch(error => {
            alert(error)

      });
    },
    fetchData(){
      this.loading = true; // Set loading to true before making the request
      axios.get(`/get_free_fines_students/${this.org_id}/${this.school_year_input}`)
        .then((response) => {
          console.log(response.data)
          this.free_fines_students = response.data;
          this.filtered_free_fines = this.free_fines_students;
          this.loading = false; //
        })
        .catch((error) => {
          alert(error);
        })
    },
    clearData(){
      this.submit = this.sendData;
      this.free_fines_input = {
        student_id: '',
        reason: '',
        org_id : this.org_id,
        school_year: this.school_year_input,
      }
      this.nameFilterStudent = '';
    },
    showSucces(message){
        toast.success(message),{
            autoClose: 100,
        }
    },
    showError(message){
        toast.error(message),{
            autoClose: 100,
        }
    },
  }
}

</script>
