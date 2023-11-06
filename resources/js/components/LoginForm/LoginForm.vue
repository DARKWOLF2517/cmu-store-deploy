<template>
<div>
    <form @submit.prevent="login">
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="form.email" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" v-model="form.password" required>
    </div>
    <div>
        <button type="submit">Login</button>
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
    }
    };
},
methods: {
    login() {
    axios.post('/authenticate_user', this.form)
        .then(response => {
        // Handle successful login (e.g., redirect to dashboard)
            console.log('SUccess')
            window.location = '/org_dashboard';
        })
        .catch(error => {
        // Handle login error (e.g., display error message)
        console.log(error)
        });
    }
},
mounted() {
    console.log('Mounted')
},
}
</script>
