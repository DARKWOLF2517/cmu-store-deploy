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
                        }}</option>
                </select>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mt-3"><i class="fas fa-list"></i> Organization Accountability Report</h4>
        </div>
    </div>
    <div class="accountabilities-cards">
        <div class="accountability-card border-top border-5 border-success border-bottom-0">
            <span class="mt-4">
                <h2 class="text-center bold"><i class="bi bi-wallet2 text-secondary"></i></h2>
                <h2 class="text-center "> <b>Fines</b></h2>
                <h4 class="text-center" style="color: #357960; font-weight: bold;">&#8369; 10.00</h4>
            </span>

        </div>
    </div>
</template>

<script>

export default {
    props: ['org_id', 'school_year_session'],
    data() {
        return {
            searchTerm: '',
            school_year_input: this.school_year_session,
            school_year: [],
        }
    },
    mounted() {
        this.fetchData();
        this.showSchoolYear();
    },
    methods: {
        filterItems() {

        },
        fetchData() {
            axios.get(`fetch_accountabilities/${this.org_id}`)
                .then(response => {
                    console.log(response.data)

                })
                .catch(error => {
                    console.log(error)
                });
        },
        showSchoolYear() {
            axios.get(`get_school_year`)
                .then(response => {
                    // console.log(response.data)
                    this.school_year = response.data;
                })
                .catch(error => {
                    console.log(error)
                });
        },

    },

}

</script>