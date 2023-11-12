<template>
<div>
    <form @submit.prevent="this.login()" class="login-form">
        
        <div class="form-group">
            <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fas fa-user"></i>
                </span>
            </div>
            <input type="text" class="form-control rounded-left"  placeholder="Username" required name="email" v-model="form.email" >
            </div>
        </div>
        <div class="form-group d-flex">
            <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fas fa-lock"></i>
                </span>
            </div>
            <input type="password" class="form-control rounded-left" placeholder="Password" required name="password" v-model="form.password">
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
        <p class="text-danger error-message" id="error-message" v-if="this.error == '1'">Incorrect username or password. Please try again.</p>
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
        email: '',
        password: ''
    },
    error: '',

    };
},
methods: {
    login() {
    
        axios.post('/authenticate_user', this.form)
            .then(response => {
                if(response.data == 1){
                    window.location.href = '/login/org_dashboard';
                }
                else if(response.data == 2){
                    window.location.href = 'student_attendance';
                }
                else if(response.data == 3){
                    window.location.href = '/login/options';
                }
                else if(response.data == 'error'){
                    this.error = '1';
                }
            })
            .catch(error => {
                console.log(error)
                alert('sadfd')
            });
    }
},
mounted() { 
},
}
</script>
