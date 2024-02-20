<template>

    <div v-if="loading" class="loading-spinner">
        <div class="load-center">
        <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        </div>
    </div>
    <div v-else>
    <div class="announcement-list">
        <div class="Message-IfEmpty"  v-if="announcement.length === 0">
            <i class="icon 	fas fa-bullhorn" id="icon-message"></i>
            <p class="empty-schedule">Announcements show up here</p>
        </div>
        <div class="announcement-card-list">
            <div class="announcement-card" v-for="announcement in this.announcement">
                <span class="Organization"> <b>{{ announcement.title }}</b></span>
                <div class="date-time-posted">
                    <span class="date-time-uploaded"><i><small>{{ announcement.date }}</small></i></span>
            </div>
        </div>
    </div>
</div>
</div>

</template>

<script>

export default{
    props: ['org_id', 'school_year_session'],
    data(){
        return{
            announcement:[],
            loading: true,
        }
    },
    mounted(){
        this.fetchData();
    },
    methods:{
        fetchData(){
            axios.get(`/get_announcement/${this.org_id}/${this.school_year_session}`)
                .then(response => {
                    this.announcement = response.data
                    console.log(response.data)
                    this.loading = false;
                })
                .catch(error => {

                });

        },

    }


}

</script>
