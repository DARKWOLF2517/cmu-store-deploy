<template>
    <div class="row head-container">
      <div class="col-md-6 col-sm-12">

          <div class="input-container">
              <i class="fa fa-search"></i>
              <input type="text" placeholder="Search Event" v-model="searchTerm" @input="filterItems">
          </div>
      </div>
      <div class="select-dropdown" id= "semester-btn" style="margin-left: 20px; width: 300px; margin-right: 0px;">
          <!-- Second dropdown -->
          <select id="sort-select" class="form-control" style="text-align: center;" v-model="school_year_input"  @change="fetchData">
              <option value="0" disabled selected>Select School Year</option>
              <option v-for="school_year in this.school_year" :value="school_year['id']" >{{ school_year['school_year'] }}</option>
          </select>
      </div>
    </div>
    <div class="alert alert-info mt-2" role="alert">
                <b><i class="fas fa-info"></i> Note!</b>  This is where the student organization accountability is set. If you haven't set anything yet, please click the button to set accountabilities.
                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mt-3"><i class="fas fa-list"></i> Organization Accountabilities</h4>
                    <div class="event-buttons d-flex">
                        <div class="btn-group" role="group">
                            <button class="btn me-2" id="btn-accountabilities" data-bs-toggle="modal" data-bs-target="#membershipFeeModal" @click="submit = this.submitData, this.clearData()">
                                <i class="fas fa-clipboard"></i> Add Accountabilities
                            </button>
                        </div>
                    </div>
                </div>
            </div>

    <!-- <button class="btn btn-primary" id="btn-accountabilities" data-bs-toggle="modal" data-bs-target="#membershipFeeModal" @click="submit = this.submitData, this.clearData()">Add Accountabilities</button> -->
                    <!-- Card 1 -->
    <div class="accountabilities-container">
      <!-- Loading spinner -->
      <div v-if="loading" class="loading-spinner-container">
        <div class="spinner-border text-success" id="event-spinner" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>

      <!-- Message if the container is empty -->
      <div v-if="!loading && accountabilityList.length === 0" class="Container-IfEmpty">
        <div class="Empty-Message">
          <i class="icon fas fa-money-check" id="icon-message"></i>
          <p class="text-muted">Accountability cards show up here.</p>
        </div>
      </div>
      <div class="accountabilities-cards">
          <div class="accountability-card" v-for="accountability in this.filtered_accountabilities">
              <div class="dropdown">
                  <a class="ellipsis-button" href="#" style="color: black;" role="button" id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                      <!-- option 1 -->
                      <li @click="this.id = accountability.accountability_id, submit = this.updateAccountabilities,  this.accountabilitiesFetchUpdate()"  data-bs-toggle="modal" data-bs-target="#membershipFeeModal" ><a class="dropdown-item">Edit Accountability</a></li>
                      <!-- option 2 -->
                      <li @click="this.id = accountability.accountability_id"  data-bs-toggle="modal" data-bs-target="#deleteConfirmation" ><a class="dropdown-item">Delete Accountability</a></li>
                  </ul>
              </div>
              <h2 class="text-center mt-5">{{ accountability['accountability_name']}}</h2>
              <h4 class="text-center">Php {{ accountability['amount'] }}</h4>
              </div>
      </div>
    </div>
                  <!--
                    <div class="col-md-6 col-12">
                        <div class="membershipfee-card">
                            <h2>{{ accountability['accountability_name']}}</h2>
                            <h4>Php {{ accountability['amount'] }}</h4>
                            <button class="btn btn-primary" id="btn-accountabilities" data-bs-toggle="modal" data-bs-target="#membershipFeeModal">Set Membership Fee</button>
                        </div>
                    </div> -->


    <!-- Add Fee Modal -->
    <div class="modal fade" id="membershipFeeModal" tabindex="-1" aria-labelledby="membershipFeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form @submit.prevent="submit"  id="eventsForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="membershipFeeModalLabel" v-if="submit == this.submitData">Add Accountabilities</h5>
                    <h5 class="modal-title" id="membershipFeeModalLabel" v-else-if="submit == this.updateAccountabilities" >Edit Accountabilities</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add form elements for editing membership fee -->
                    <label for="membershipFeeDescriptionInput" class="form-label mt-2">Description:</label>
                    <input type="text" class="form-control" id="description" v-model="formData.accountability_name">
                    <label for="membershipFeeInput" class="form-label">Amount:</label>
                    <input type="number" class="form-control" id="amount" v-model="formData.amount">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="saveMembershipFeeBtn" data-bs-dismiss="modal">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Add this modal code after your existing modal -->
    <div class="modal fade" id="deleteConfirmation" tabindex="-1" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="deleteConfirmationLabel">Confirm Delete</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <p>Are you sure you want to delete this student?</p>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-danger" @click="deleteAccountability()" data-bs-dismiss="modal">Delete</button>
          </div>
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
      submit: this.submitData,
      loading: false, // Add loading variable
      id: 0,
      formData: {
        accountability_name: '',
        amount: '',
        org_id: '',
        school_year: this.school_year_session,
      },
      school_year: [],
      school_year_input: this.school_year_session,
      accountabilityList: [],
      searchTerm: '',
      filtered_accountabilities: [],
    };
  },
  mounted() {
    this.fetchData();
    this.showSchoolYear();
  },
  methods: {
    updateAccountabilities(){
      axios.put(`/update_accountabilities/${this.id}`, this.formData)
        .then(response => {
          // console.log(response.data.message)
            this.showSuccess(response.data.message);
        })
        .catch(error => {
            console.log(error)
        });
    },
    accountabilitiesFetchUpdate(){
      axios.get(`accountabilities_fetch_update/${this.id}`)
        .then(response => {
            // console.log(response.data)
            this.formData = response.data;
            console.log(response.data)
        })
        .catch(error => {
            console.log(error)
        });
    },
    filterItems() {
        // Filter based on searchTerm from textbox
        let filteredBySearch = this.accountabilityList;
        if (this.searchTerm) {
            const searchTermLower = this.searchTerm.toLowerCase();
            filteredBySearch = filteredBySearch.filter(item =>
                item.accountability_name.toLowerCase().includes(searchTermLower)
            );
        }
            this.filtered_accountabilities = filteredBySearch;
    },
    showSchoolYear(){
      axios.get(`get_school_year/${this.org_id}`)
        .then(response => {
            // console.log(response.data)
            this.school_year = response.data;
            console.log(response.data)
        })
        .catch(error => {
            console.log(error)
        });
    },
    showSuccess(message) {
      this.fetchData();
      toast.success(message, {
        autoClose: 100,
      });
    },

    submitData() {
      axios.post('/set_accountabilities', this.formData)
        .then((response) => {
          this.showSuccess(response.data.message);
        })
        .catch((error) => {
          alert(error);
        });
    },
    fetchData() {
      this.accountabilityList = [];
      this.loading = true; // Set loading to true before making the request
      axios.get(`/get_accountabilities/${this.org_id}/${this.school_year_input}`)
        .then((response) => {
          this.accountabilityList = response.data;
          this.filtered_accountabilities = this.accountabilityList;
          this.loading = false; //
        })
        .catch((error) => {
          alert(error);
        })
    },
    deleteAccountability() {
      axios.delete(`/delete_organization_accountability/${this.id}`)
        .then((response) => {
          this.showSuccess(response.data.message);
        })
        .catch((error) => {
          if (error.response && error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
          alert(error);
        });
    },
    clearData() {
      this.formData = {
        description: '',
        amount: '',
        org_id: this.org_id,
        school_year: this.school_year_session,
      }
    },
  },
};
</script>
