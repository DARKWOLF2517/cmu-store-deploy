<!-- <template>

            <table id="student-list-table">
                <thead>
                    <tr>
                        <th>Student ID number</th>
                        <th>Name</th>
                        <th>Year Level</th>
                        <th>College</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <tr v-for="memberLists in this.memberList">
                        <td>{{ memberLists['student_id'] }}</td>
                        <td>{{ memberLists['user']['name']}}</td>
                        <td>{{ memberLists['year_level'] }}</td>
                        <td>{{ memberLists['organization']['name']}}</td>
                        <td>
                            <button class="edit-button ellipsis-button mb-2"> <i class="bi bi-pencil-square"></i></button>
                            <button class="delete-button ellipsis-button"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="pagination-container mt-3">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">1 <span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </div>
</template>

<script>

export default{
    props:['organization_id'],
    data() {
        return {
            memberList:[],
        }
    },
    created() {
        this.fetchData();
        console.log(this.organization_id);
    },
    methods: {
        fetchData(){
            axios.get(`getMemberRoute/${this.organization_id}`)
            .then(response => {
                console.log(response.data)
                this.memberList = response.data;
            })
            .catch(error => {
                console.log('error')
            });
        },
    },
}
</script> -->
<template></template>
