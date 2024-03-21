<template>
    <div class="row head-container">
        <div class="col-md-6 col-sm-12">

            <div class="input-container">
                <i class="fa fa-search"></i>
                <input type="text" placeholder="Search Event" v-model="searchTerm" @input="filterItems">
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="select-dropdown" style="width: 70%;">
                <!-- Second dropdown -->
                <select id="sort-select" class="form-control" style="text-align: center;" v-model="school_year_input"
                    @change="fetchData">
                    <option value="0" disabled selected>Select School Year</option>
                    <option v-for="school_year in this.school_year" :value="school_year['id']">{{
                    school_year['school_year']
                }}
                    </option>
                </select>
            </div>
        </div>
    </div>
    <!-- <div class="alert alert-light mt-2" role="alert" style=" border-left-style: solid; border-left-color: #007bff; border-left-width: 4px;">
        <span style="display: inline-block; width: 30px; height: 30px; border-radius: 50%; background-color: #007bff; text-align: center; line-height: 30px;">
    <i class="fas fa-info text-white"></i>
</span>
 This is where the student organization accountability is set. If you haven't set anything yet, please click the button to set accountabilities.
                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> -->
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mt-3"><i class="fas fa-list"></i> Organization Accountabilities</h4>
            <div class="event-buttons d-flex">
                <div class="btn-group" role="group">
                    <button class="btn me-2" id="btn-accountabilities" data-bs-toggle="modal"
                        data-bs-target="#membershipFeeModal" @click="submit = this.submitData, this.clearData()">
                        <i class="fas fa-clipboard"></i> Add Accountabilities
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- <button class="btn btn-primary" id="btn-accountabilities" data-bs-toggle="modal" data-bs-target="#membershipFeeModal" @click="submit = this.submitData, this.clearData()">Add Accountabilities</button> -->
    <!-- Card 1 -->
    <div class="accountabilities-container" id="set-accountabilities">
        <!-- Loading spinner -->
        <div v-if="loading" class="d-flex gap-4" style="padding: 10px;">
                    <div class="card" aria-hidden="true" style="width: calc(33.33% - 20px); height: 180px; border:none;">
                        <div class="card-body ">

                            <h5 class="card-title placeholder-glow text-center" >
                                <span class="placeholder col-6 rounded bg-secondary" style="height: 40px; width: 40px;"></span>
                            </h5>
                            <p class="card-text placeholder-glow text-center" >
                                <span class="placeholder col-4 bg-secondary"style="height: 20px; "></span>
                            </p>
                            <p class="card-text placeholder-glow mt-2 text-center" >
                                <span class="placeholder col-2 bg-secondary"style="height: 25px; "></span>
                            </p>

                        </div>
                    </div>
                </div>
        <!-- Will show if there are no records -->
        <div class="Container-IfEmpty" v-if="!loading && accountabilityList.length === 0">
            <div class="Empty-Message text-center">
                <i class="icon 	fas fa-wallet" id="icon-message"></i>
                <p class="text-muted"><b>Set up an Accountability</b>
                    <br>
                    Student Organization accountablities show up here.
                </p>
            </div>
        </div>
        <!-- Will show if there are no records found -->
        <div class="Container-IfEmpty"
            v-if="!loading && filtered_accountabilities.length === 0 && this.accountabilityList != 0">
            <div class="Empty-Message text-center">
                <i class="icon 	fas fa-frown" id="icon-message"></i>
                <p class="text-muted fw-bold">No results found</p>
            </div>
        </div>
        <div class="accountabilities-cards">
            <div class="accountability-card border-top border-5 border-success border-bottom-0"
                v-for="accountability in this.filtered_accountabilities">
                <div class="dropdown">
                    <a class="ellipsis-button" href="#" style="color: black;" role="button" id="ellipsisDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                        <!-- option 1 -->
                        <li @click="this.id = accountability.accountability_id, submit = this.updateAccountabilities, this.accountabilitiesFetchUpdate()"
                            data-bs-toggle="modal" data-bs-target="#membershipFeeModal"><a class="dropdown-item">Edit
                                Accountability</a>
                        </li>
                        <!-- option 2 -->
                        <li @click="this.id = accountability.accountability_id" data-bs-toggle="modal"
                            data-bs-target="#deleteConfirmation"><a class="dropdown-item">Delete Accountability</a></li>
                    </ul>
                </div>
                <span class="mt-4">
                    <!-- <div style="text-align: center;">
                    <span style="display: inline-block; border-radius: 10px; width: 50px; height: 50px; background-color: #357960; padding: 5px;"> -->
                    <h2 class="text-center bold"><i class="bi bi-wallet2 text-secondary"></i></h2>
                    <!-- </span>
                </div> -->

                    <h2 class="text-center "> <b>{{ accountability['accountability_name'] }}</b> </h2>
                    <h4 class="text-center" style="color: #357960; font-weight: bold;">&#8369; {{
                    accountability['amount']
                }}</h4>
                </span>

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
    <div class="modal fade" id="membershipFeeModal" tabindex="-1" aria-labelledby="membershipFeeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form @submit.prevent="submit" id="eventsForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="membershipFeeModalLabel" v-if="submit == this.submitData">Add
                            Accountabilities
                        </h5>
                        <h5 class="modal-title" id="membershipFeeModalLabel"
                            v-else-if="submit == this.updateAccountabilities">Edit
                            Accountabilities</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Add form elements for editing membership fee -->
                        <label for="membershipFeeDescriptionInput" class="form-label mt-2">Accountability Name:</label>
                        <input type="text" class="form-control" id="description" v-model="formData.accountability_name"
                            required maxlength="20"
                            :style="{ borderColor: formData.accountability_name.length >= 20 ? 'red' : '' }">
                        <p class="pl-2" v-if="formData.accountability_name.length >= 20" style="color: red;">Maximum
                            length
                            reached</p>
                        <label for="membershipFeeInput" class="form-label">Amount:</label>
                        <input type="number" class="form-control" id="amount" v-model="formData.amount" required
                            maxlength="20" :style="{ borderColor: formData.amount.length >= 20 ? 'red' : '' }">
                        <p class="pl-2" v-if="formData.amount.length >= 20" style="color: red;">Maximum length reached
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="saveMembershipFeeBtn">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add this modal code after your existing modal -->
    <div class="modal fade" id="deleteConfirmation" tabindex="-1" aria-labelledby="deleteConfirmationLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="deleteConfirmationLabel">
         Confirm Delete
          </h5> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h4><i class="fas fa-exclamation-triangle text-warning"></i></h4>
                    <h4><b>Delete accountability</b></h4>
                    <p>Are you sure you want to delete this Accountability?</p>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger px-4" @click="deleteAccountability()"
                        data-bs-dismiss="modal">Delete</button>
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
            old_name: '',
        };
    },
    mounted() {
        this.fetchData();
        this.showSchoolYear();
    },
    methods: {
        updateAccountabilities() {
            if (this.formData.accountability_name.toLowerCase() == 'fines') {
                this.showError('The name fines cannot be used as it is already present in the system.');
            }
            else {
                axios.put(`/update_accountabilities/${this.id}/${this.old_name}`, this.formData)
                    .then(response => {
                        console.log(response.data)
                        if (response.data.status == 1) {
                            this.showError(response.data.message)
                        }
                        else {
                            this.showSuccess(response.data.message);
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }

                    })
                    .catch(error => {
                        console.log(error)
                    });

            }
        },
        accountabilitiesFetchUpdate() {
            axios.get(`accountabilities_fetch_update/${this.id}`)
                .then(response => {
                    console.log(response.data)
                    this.formData = response.data;
                    this.old_name = response.data.accountability_name;
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
        showSuccess(message) {
            this.fetchData();
            toast.success(message, {
                autoClose: 3000,
            });
        },
        showError(message) {
            toast.error(message, {
                autoClose: 3000,
            });
        },


        submitData() {
            if (this.formData.accountability_name.toLowerCase() == 'fines') {
                this.showError('The name fines cannot be used as it is already present in the system.');
            }
            else {
                axios.post('/set_accountabilities', this.formData)
                    .then((response) => {
                        this.showSuccess(response.data.message);
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    })
                    .catch((error) => {
                        alert(error);
                    });
            }

        },
        fetchData() {
            this.accountabilityList = [];
            this.loading = true; // Set loading to true before making the request
            this.filtered_accountabilities = [];
            axios.get(`/get_org_accountability/${this.org_id}/${this.school_year_input}`)
                .then((response) => {
                    this.accountabilityList = response.data;
                    this.filtered_accountabilities = this.accountabilityList;
                    this.loading = false; //
                    // console.log(this.filtered_accountabilities)
                })
                .catch((error) => {
                    alert(error);
                })
        },
        deleteAccountability() {
            axios.delete(`/delete_organization_accountability/${this.id}`)
                .then((response) => {
                    console.log(response.data)
                    if (response.data.status == 1) {
                        this.showError(response.data.message);
                    }
                    else {
                        this.showSuccess(response.data.message);
                    }

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
