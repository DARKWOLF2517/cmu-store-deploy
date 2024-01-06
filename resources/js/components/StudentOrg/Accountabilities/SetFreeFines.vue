<template>
    <div class="row head-container">
      <div class="col-md-6 col-sm-12">

          <div class="input-container">
              <i class="fa fa-search"></i>
              <input type="text" placeholder="Search Student" v-model="searchTerm" @input="filterItems">
          </div>
      </div>

      <div class="select-dropdown" id= "semester-btn" style="margin-left: 20px; width: 270px;">
          <!-- Second dropdown -->
          <select id="sort-select" class="form-control" style="text-align: center;" v-model="school_year_input"  @change="fetchData">
            <option value="0" disabled selected>Select Semester</option>
            <option v-for="school_year in this.school_year" :value="school_year['id']" >{{ school_year['school_year'] }}</option>
          </select>
      </div>
    </div>

    <h4> <i class="fas fa-list mt-2"></i>  Student with Free Fines</h4>


    <div class="student-buttons d-flex justify-content-end">
      <div class="btn-group" role="group">
          <button  class="btn me-2" data-bs-toggle="modal" @click="this.clearData()" data-bs-target="#addStudentModal">
              <i class="fas fa-plus"></i> Add Student
          </button>
          <button class="btn me-2" id="add-student-list-button" onclick="printTableData()">
              <i class="fas fa-print"></i> Print
          </button>
          <button class="btn me-2" id="add-student-button" onclick="  downloadTableData()">
              <i class="fas fa-download"></i> Download
          </button>
      </div>
    </div>
    <div class="scroll-pane">
        <table  id="accountabilities-table">
            <thead>
                <tr>
                    <th style="width: 15%;">Student ID</th>
                    <th>Student Name</th>
                    <th>Reason</th>
                    <th style="width: 20%;">Actions</th>
                </tr>
            </thead>
            <tbody >
                <tr v-for="free_fines in this.filtered_free_fines">
                    <td>{{ free_fines.student_id }}</td>
                    <td>{{ free_fines.user.name }}</td>
                    <td>{{ free_fines.reason }}</td>
                    <td>
                        <button type="button" class="btn" @click="this.submit = this.updateData, this.id = free_fines.student_id,fetchUpdateData()" data-bs-toggle="modal" data-bs-target="#addStudentModal"><i class="fas fa-edit"></i> Edit</button>
                        <button type="button" class="btn" @click="this.id = free_fines.student_id" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"><i class="fas fa-trash"></i> Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

      <div class="pagination-container mt-3">
        <ul class="pagination justify-content-center">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
          </li>
          <li class="page-item active" aria-current="page">
            <a class="page-link" href="#">1 <span class="visually-hidden">(current)</span></a>
          </li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Next</a>
          </li>
        </ul>
      </div>

      <!-- Delete Confirmation Modal -->
      <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Are you sure you want to delete this record?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-danger" @click="this.deleteStudentData()" data-bs-dismiss="modal">Confirm Delete</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Edit Student Modal -->
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
      </div>

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
                  <input type="text" class="form-control" id="studentId" v-model="free_fines_input.student_id" @change="this.fetchNameStudent">
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
    }
  },
  mounted() {
    this.fetchData();
    this.showSchoolYear();
  },
  methods: {
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
      axios.get(`get_school_year/${this.org_id}`)
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
          this.nameFilterStudent = response.data.user.name;
          this.free_fines_input = response.data;
          // this.loading = false; //
        })
        .catch((error) => {
          alert(error);
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
          console.log(response.data.user.name)
          this.nameFilterStudent = response.data.user.name;
          // this.free_fines_students = response.data;
          // this.loading = false; //
        })
        .catch((error) => {
          alert(error);
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