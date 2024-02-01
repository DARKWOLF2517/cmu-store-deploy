<template>

     <div class="header">
    <h1> Select Profile</h1>
    <small>Tailor Your Experience with Individual Profiles. Keeping data organized and personalized</small>
  </div>
    <div class="container">
        <div class="user-card"  v-for="userOrg in this.userOrgs" >
            <div @click=" profileClicked(userOrg['id'])">
            <!-- <h6> {{ userOrg['organization']['name'] }}</h6> -->
            <img src="https://indonesiasatu.co.id/assets/themes/indonesiasatu/img/user.png" alt="User 1">
            <!-- <p>
                <span v-if="userOrg['role']['role_id'] == 1">Admin</span>
                <span v-else-if="userOrg['role']['role_id'] == 2">Student</span>
                <span v-else-if="userOrg['role']['role_id'] == 3">Attendance Checker</span>
            </p> -->
            <h6> {{ userOrg['organization']['name'] }}</h6>
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
                // Assuming your data is stored in an array named 'data'
                const filteredData = response.data.filter((item, index, self) => {
                    // Find the index of the matching item with the same student_org_id but different role_id
                    const matchingIndex = self.findIndex((otherItem) =>
                        otherItem.student_org_id === item.student_org_id &&
                        otherItem.role_id !== item.role_id &&
                        (otherItem.role_id === 1 || otherItem.role_id === 3)
                    );

                    // If matchingIndex is -1, it means there is no item with the same student_org_id but different role_id
                    // Or the role_id of the matching item is not 1
                    // In either case, keep the current item
                    return matchingIndex === -1 || item.role_id !== 2;
                });

                console.log(filteredData);

                userOrgs.value = filteredData;
            })
            .catch(error => {
                console.log(error)
            });
        return { userOrgs };
    }
}

</script>
