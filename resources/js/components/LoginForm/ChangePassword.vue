<template>
    <form class="login-form">

        <div class="form-group mt-3">
            <b>Enter your Current Password</b>
            <div class="input-group">
            <input type="password" class="form-control rounded-left"  placeholder="Current Password" required name="password"   v-model="change_password_data.current_password">
            </div>
        </div>
        <div class="form-group">
            <b>Enter new Password</b>
            <div class="input-group">
                <input type="password" id="newPassword" class="form-control rounded-left" placeholder="New Password" required name="password" v-model="change_password_data.new_password"  >
            </div>

        </div>

        <b>Retype new Password</b>
        <div class="input-group">
            <input type="password" class="form-control rounded-left" placeholder="Retype New Password" required name="password" v-model="change_password_data.confirm_new_password">
        </div>
        <!-- <div class="form-group d-md-flex"> -->
             <!-- {{-- <small>When you change your password, you gain full control of your account.</small>
                <small>If you have forgotten your password, please contact the organization that created your account for assistance.</small> --}} -->

        <!-- </div> -->

        <div class="form-group text-right mt-4">
            <a class="btn btn-secondary rounded mr-2 text-light" href="/student_profile">Cancel</a>
            <button class="btn btn-primary rounded submit"  @click="checkNewPassword()">Save Changes</button>
        </div>
    </form>

        <!-- Change Password Confirmation Modal -->
        <div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">

                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                        </div>
                        <div class="modal-body text-center">
                            <h4><i class="fas fa-exclamation-triangle text-warning"></i></h4>
                            <h4><b>Change Password</b></h4>
                            <p>Are you sure you want to Change Password?</p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button class="btn btn-danger" @click="submitData()" data-bs-dismiss="modal">Yes</button>
                        </div>
                    </div>
                </div>
            </div>

</template>

<script>
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default{
    mounted(){

    },

    data(){
        return{
            change_password_data: {
                current_password:'',
                new_password:'',
                confirm_new_password: '',
            },

        }
    },

    methods:{
        checkNewPassword(){
            let newPassword = document.getElementById('newPassword');
            if (this.change_password_data.new_password != this.change_password_data.confirm_new_password){
                alert('New Passwords do not match.')
                newPassword.focus();
            }
            else if(newPassword.value.length < 8){
                alert('Password must be at least 8 characters long.');
            }
            else{
                const changepasswordmodal = new bootstrap.Modal(document.getElementById("changePassword"));
                changepasswordmodal.show();
            }
        },
        submitData(){
            axios.post('/change_password_data', this.change_password_data)
                .then(response => {

                    console.log(response.data)
                    if (response.data.status == 0){
                        this.showError(response.data.message);
                    }
                    else if(response.data.status == 1){
                        window.location.href = '/student_profile';
                        console.log('hello ')
                    }
                })
                .catch(error => {
                    alert(error)

            });
        },
        showError(message){
        toast.error(message),{
            autoClose: 100,
        }
    },
    },
}
</script>
