<template>
    <div class="header">
        <h1> Select Profile </h1>
        <small>Tailor Your Experience with Individual Profiles. Keeping data organized and personalized</small>
    </div>
    <div class="container">

        <div v-for="userOrg in this.userOrgs">
            <div class="user-card">
                <div @click=" profileClicked(userOrg['id'])">
                    <!-- <h6> {{ userOrg['organization']['name'] }}</h6> -->
                    <h6>Central Mindanao University</h6>
                    <hr>
                    <img v-if="userOrg.organization.image" :src="userOrg.organization.image" alt="user-image" width="32"
                        height="32" class="rounded-circle me-2">
                    <img v-else src="https://indonesiasatu.co.id/assets/themes/indonesiasatu/img/user.png"
                        alt="user-image" width="32" height="32" class="rounded-circle me-2">
                    <!-- <img src="https://indonesiasatu.co.id/assets/themes/indonesiasatu/img/user.png" alt="User 1"> -->
                    <!-- <p>
                        <span v-if="userOrg['role']['role_id'] == 1">Admin</span>
                        <span v-else-if="userOrg['role']['role_id'] == 2">Student</span>
                        <span v-else-if="userOrg['role']['role_id'] == 3">Attendance Checker</span>
                    </p> -->
                    <h6> {{ userOrg['organization']['name'] }}</h6>
                </div>
            </div>

        </div>

    </div>
</template>

<script>

import { ref } from 'vue';

export default {

    props: ['id', 'school_year_session'],
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
        profileClicked(id) {
            axios.get(`/profile_clicked/${id}`)
                .then(response => {
                    console.log(response.data);
                    // userOrgs.value = response.data;
                    if (response.data == 1) {

                        window.location.href = '/org_dashboard';
                    }
                    else if (response.data == 2) {
                        window.location.href = '/student_dashboard';
                    }
                    else if (response.data == 3) {
                        window.location.href = '/attendance_checker_dashboard';
                    }
                    else if (response.data == 'not_tagged_error') {
                        alert('User is not tagged in current School Year')
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
                // console.log(response.data);

                // Assuming response.data is your array of objects containing the user organization data
                let groupedData = [];

                response.data.forEach(item => {
                    if (item.role_id === 1 || item.role_id === 3) {
                        let existingItemIndex = groupedData.findIndex(existingItem => existingItem.organization.name === item.organization.name && existingItem.student_org_id === item.student_org_id);
                        if (existingItemIndex === -1 || groupedData[existingItemIndex].id < item.id) {
                            if (existingItemIndex !== -1) {
                                groupedData.splice(existingItemIndex, 1);
                            }
                            groupedData.push(item);
                        }
                    }
                });

                console.log(groupedData);

                userOrgs.value = groupedData;



                // if (groupedData.length == 1) {
                //     console.log()
                //     if (groupedData[0].role_id == 1) {

                //         window.location.href = '/org_dashboard';
                //     }
                //     else if (groupedData[0].role_id == 2) {
                //         window.location.href = '/student_dashboard';
                //     }
                //     else if (groupedData[0].role_id == 3) {
                //         window.location.href = '/attendance_checker_dashboard';
                //     }
                // }
                // const filteredData = response.data.filter(item => item.role.role_id === 1 || item.role.role_id == 3);

            })
            .catch(error => {
                console.log(error)
            });
        return { userOrgs };
    }
}

</script>
