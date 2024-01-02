<template>

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
</script>
