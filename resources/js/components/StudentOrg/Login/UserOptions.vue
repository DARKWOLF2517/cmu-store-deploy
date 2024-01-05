<template>

     <div class="header">
    <h1> Select Profile</h1>
    <small>Tailor Your Experience with Individual Profiles. Keeping data organized and personalized</small>
  </div>
    <div class="container">
        <div class="user-card"  v-for="userOrg in this.userOrgs" >
            <div @click=" profileClicked(userOrg['id'])">
            <h3> {{ userOrg['organization']['name'] }}</h3>
            <img src="https://indonesiasatu.co.id/assets/themes/indonesiasatu/img/user.png" alt="User 1">
            <p>
                <span v-if="userOrg['role']['role_id'] == 1">Admin</span>
                <span v-else-if="userOrg['role']['role_id'] == 2">Student</span>
                <span v-else-if="userOrg['role']['role_id'] == 3">Attendance Checker</span>
            </p>
            </div>
        </div>
    </div>

</template>

<script>

import { ref } from 'vue';

export default {

    props: ['id'],
    // data() {
    //     return {
    //         userOrganizations: [],
    //     }
    // },
    methods: {

        // fetchData(){
        //     axios.get(`GetOrgList/${this.id}`)
        //         .then(response => {
        //         })
        //         .catch(error => {

        //         });
        // },

        /**
         *
         * @param {*} org_id organization Id to identify which dashboard to render
         * @param {*} role_id Role id of the user on that organization
         */
        profileClicked( id){
            axios.get(`/profile_clicked/${id}`)
            .then(response => {
                // console.log(response.data);
                // userOrgs.value = response.data;
                if (response.data == 1){

                window.location.href = '/org_dashboard';
                }
                else if (response.data == 2){
                    window.location.href = '/student_dashboard';
                }
                else if (response.data == 3){
                    window.location.href = '/attendance_checker_dashboard';
                }
                else if (response.data == 'not_tagged_error'){
                    alert ('User is not tagged in current School Year')
                }


            })
            .catch(error => {

            });


        }
    },
    // mounted() {
    //     this.fetchData()
    // },
    //COMPOSITION API

    setup(props) {

        let userOrgs = ref();

        axios.get(`/GetOrgList/${props.id}`)
            .then(response => {
                console.log(response.data);
                userOrgs.value = response.data;
            })
            .catch(error => {

            });

        // id.value = axios.get(`GetOrgList/${props.id}`)
        //         .then(response => {
        //             // // console.log(response.data)
        //             // // console.log(this.userOrganizations)
        //             // this.userOrganizations.forEach(userOrg => {
        //             //     // console.log(response)
        //             // console.log(userOrg['role_id'])
        //             // });
        //         })
        //         .catch(error => {

        //         });

        return { userOrgs };
    }
}

</script>
