<template>
    <div class="d-flex align-items-center">
        <span class="square-span">
            <i :class="icons"></i>
        </span>
        <div class="ml-3">
            <p class="stat-label">{{ this.card_label }}</p>
            <div v-if="isLoading" class="spinner-border text-success" id="stat-cards-loading" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <b v-else>
                <p class="stat-number"> {{ count }}</p>
            </b>
        </div>
    </div>
</template>

<script>
export default {
    props: ['org_id', 'target_route', 'card_label', 'icons', 'school_year_session'],

    data() {
        return {
            count: 0,
            isLoading: true,
        };
    },

    methods: {
        fetchDataCount() {
            axios
                .get(`/${this.target_route}/${this.org_id}/${this.school_year_session}`)
                .then((response) => {
                    this.count = response.data;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.isLoading = false; // Set isLoading to false after data is fetched
                });
        },
    },

    mounted() {
        this.fetchDataCount();
    },
};
</script>


<!-- <template>

                        <div class="d-flex align-items-center">
                            <span class="square-span">
                                <i :class="icons"></i>
                            </span>
                            <div class="ml-3">
                            <p class="stat-label">{{this.card_label }}</p>
                            <b><p class="stat-number">{{count}}</p></b>
                            </div>
                        </div>
</template>

<script>
export default {
    props: ['org_id','target_route', 'card_label', 'icons'],

    mounted() {
        this.fetchDataCount();
    },

    data() {
        return {
            count: 0,
        };
    },
methods: {
    fetchDataCount() {
        // console.log(this.target_route)

        axios.get(`/${this.target_route}/${this.org_id}`)
            .then(response => {
                this.count = response.data;
                // console.log(response.data)
            })
            .catch(error => {
                console.log(error);
            });
        }
    },
    mounted() {
        this.fetchDataCount();
    },
}
</script> -->
