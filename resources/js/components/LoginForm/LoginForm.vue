<template>
    <div>
        <form @submit.prevent="this.login()" class="login-form">

            <div class="form-group mt-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control rounded-left" placeholder="Username" required name="email"
                        v-model="form.username" :class="{ 'border-danger': error }">
                </div>
            </div>
            <div class="form-group d-flex">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                    </div>
                    <input type="password" class="form-control rounded-left" placeholder="Password" required name="password"
                        v-model="form.password" :class="{ 'border-danger': error }">
                </div>

            </div>
            <!-- <div class="form-group d-md-flex">
            <div class="w-50">
            <label>
                <input type="checkbox" checked="">
                Remember Me
            </label>
            </div>
        </div> -->
            <!-- <div class="form-group d-md-flex">
                <a href="#" class="text-primary">Forgot Password</a>
        </div> -->
            <p class="text-danger error-message" id="error-message" v-if="this.error == 'user_creadential_error'">Incorrect
                username or password. Please try again.</p>
            <p class="text-danger error-message" id="error-message" v-else-if="this.error == 'not_tagged_error'">You are not
                tagged in any organization.</p>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary rounded submit">Log In</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {

            form: {
                username: '',
                password: ''
            },
            error: '',

        };
    },
    watch: {
        'form.username': function(newVal, oldVal) {
            if (newVal === '') {
                this.error = '';
            }
        },
        'form.password': function(newVal, oldVal) {
            if (newVal === '') {
                this.error = '';
            }
        }
    },
    methods: {
        login() {

            axios.post('/authenticate_user', this.form)
                .then(response => {
                    console.log(response.data)
                    if (response.data == 1) {
                        window.location.href = '/org_dashboard';
                    }
                    else if (response.data == 2) {
                        window.location.href = '/student_dashboard';
                    }
                    else if (response.data == 3) {
                        window.location.href = '/attendance_checker_dashboard';
                    }

                    else if (response.data == 4) {
                        window.location.href = '/options';
                    }
                    else if (response.data == 5) {
                        window.location.href = 'OSA';
                    }
                    else if (response.data == 'user_creadential_error') {
                        this.error = 'user_creadential_error';
                    }
                    else if (response.data == 'not_tagged_error') {
                        this.error = 'not_tagged_error';
                    }
                })
                .catch(error => {
                    console.log(error)
                    alert(error)
                });
        }
    },
    mounted() {
    },
}
</script>
<style>
.border-danger {
  border-color: #dc3545;
}
</style>
