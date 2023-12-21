<template>
    <div class="event-buttons d-flex justify-content-end">
            <div class="btn-group" role="group">
            <button class="btn me-2" id="btn-accountabilities" data-bs-toggle="modal" data-bs-target="#membershipFeeModal" @click="submit = this.submitData, this.clearData()">
                <i class="fas fa-clipboard"></i> Add Accountabilities
            </button>
            </div>
        </div>
    <!-- <button class="btn btn-primary" id="btn-accountabilities" data-bs-toggle="modal" data-bs-target="#membershipFeeModal" @click="submit = this.submitData, this.clearData()">Add Accountabilities</button> -->
                    <!-- Card 1 -->
<div class="accountabilities-container">
    <div class="accountabilities-cards">
        <div class="accountability-card" v-for="accountability in this.accountabilityList">
            <div class="dropdown">
                <a class="ellipsis-button" href="#" role="button" id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                    <!-- option 1 -->
                    <li data-bs-toggle="modal" data-bs-target="#editModal" ><a class="dropdown-item">Edit Accountability</a></li>
                    <!-- option 2 -->
                    <li @click="this.deleteId = accountability.accountability_id"  data-bs-toggle="modal" data-bs-target="#deleteConfirmation" ><a class="dropdown-item">Delete Accountability</a></li>
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
                        <form @submit.prevent="this.submit"  id="eventsForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="membershipFeeModalLabel">Add Accountabilities</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add form elements for editing membership fee -->
                            <label for="membershipFeeDescriptionInput" class="form-label mt-2">Description:</label>
                            <input type="text" class="form-control" id="description" v-model="formData.description">
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
<!-- Edit Accountability -->

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Accountability</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add form elements for editing accountability -->
                <!-- Modify the form elements based on your requirements -->
                <label for="editDescriptionInput" class="form-label mt-2">Description:</label>
                <input type="text" class="form-control" id="editDescription">
                <label for="editAmountInput" class="form-label">Amount:</label>
                <input type="number" class="form-control" id="editAmount">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
            </div>
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
export default{
    props: ['org_id'],
    data(){
        return{
            deleteId: 0,
            formData: {
                description: '',
                amount: '',
                org_id: '',
            },
            submit: null,
            accountabilityList:[],
        }
    },
    mounted(){
        console.log('mounted')
        this.fetchData();
    },

    methods:{
        showSucces(message){
            this.fetchData();
            toast.success(message),{
                autoClose: 100,
            }
        },
        clearData(){
            this.formData = {
                description: '',
                amount: '',
                org_id: this.org_id,

                }
        },
        submitData(){
            axios.post('/set_accountabilities', this.formData)
                    .then(response => {
                        this.showSucces(response.data.message);
                    })
                    .catch(error => {
                        alert(error)

                });
        },
        fetchData(){
            axios.get(`/get_accountabilities/${this.org_id}`)
                    .then(response => {
                        this.accountabilityList = response.data;

                    })
                    .catch(error => {
                        alert(error)

                });
        },
        deleteAccountability(){
            axios.delete(`/delete_organization_accountability/${this.deleteId}`)
                    .then(response => {
                        this.showSucces(response.data.message);
                        this.fetchData();
                    })
                    .catch(error => {
                        if (error.response && error.response.status === 422) {
                            this.errors = error.response.data.errors;
                        }
                        alert(error)

            });
        },

    }

}
</script>
