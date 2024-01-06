<template>
    <div class="col mt-2">
            <div class="qr-code">
                <h4> <i class="far fa-copy"></i> Student Information</h4>
                <div class="row">
                    <div class="col-md-2"> <div class="qrcode-img">
                            <qrcode-vue :value="value" :size="size" level="H" class="img-fluid" />
                        </div>
                    </div>
                    <div class="col-md-6 profile-details">
                        <h4>{{ this.profile.name }}</h4>
                        <p class="mb-0"> <b>Student ID: </b> {{ this.user_id }}</p>
                        <p class="mb-0"><b>Year level: </b> <span id="year-level">{{ this.profile.year_level }}</span></p>
                        <p class="mb-0"><b>College: </b> <span id="college">{{ this.profile.college }}</span></p>
                        <p><b>Department: </b> <span id="department"></span></p>
                    </div>

            </div>
        </div>
    </div>

        <div class="col mt-3">
                <div class="organizations"  role="tabpanel" aria-labelledby="organization-tab">
                    <h4> <b><i class="far fa-copy"></i> Organizations</b> </h4>
                    <div class="org-under-info">
                        <ul v-for="organization in this.organization" :id="organization.student_org_id">
                            <li><b>{{ organization['organization']['name'] }}</b></li>
                            <!-- Add more club items here -->
                        </ul>
                    </div>
                </div>
        </div>

</template>
<!--
<script>
    // Wait for the document to be fully loaded
    document.addEventListener("DOMContentLoaded", function () {
        const downloadButton = document.getElementById("download-qrcode-btn");
        const qrCodeImage = document.getElementById("qr-code-image");

        downloadButton.addEventListener("click", function () {
            // Get the QR code image source
            const qrCodeSrc = qrCodeImage.toDataURL("image/png");

            // Create a temporary anchor element to trigger the download
            const downloadLink = document.createElement("a");
            downloadLink.href = qrCodeSrc;
            downloadLink.download = "qrcode.png";

            // Trigger the download
            downloadLink.click();
        });
    });
</script> -->




<script>
import QrcodeVue from 'qrcode.vue';

export default {
    props:['user_id','user_org'],
    data() {
        return {
            profile: {
                name: '',
                year_level: '',
                college: '',
                department: '',
            },
            organization:[],
            size: 150,
            value: this.user_id,
        }
    },
    created() {
        this.FetchUserData();
    },
    methods: {
        FetchUserData() {
            axios.get(`/organization/${this.user_org}`)
                .then(response => {

                    this.profile.college = response.data['name']

                })
                .catch(error => {

                });

                axios.get(`profile/${this.user_id}`)
                .then(response => {
                    const data = response.data;
                    data.forEach(item => {

                    this.profile.name = item['user']['name'];
                    this.profile.year_level = item['year_level'];

                    });

                    //get the organization list
                    this.organization = response.data;
                    // Create a Map to store unique objects based on student_org_id
                    const uniqueOrganizationMap = new Map();

                    this.organization.forEach(item => {
                    const student_org_id = item.student_org_id;

                    // Check if the student_org_id is not already in the Map
                    if (!uniqueOrganizationMap.has(student_org_id)) {
                        // Add the item to the Map with student_org_id as the key
                        uniqueOrganizationMap.set(student_org_id, item);
                    }
                    });

                    // Convert the Map values back to an array
                    this.organization = Array.from(uniqueOrganizationMap.values());
                    // console.log(this.organization)
                })
                .catch(error => {
                    console.log(error)
                });
        },
    },
    components: {
    QrcodeVue,
    },
}
</script>
