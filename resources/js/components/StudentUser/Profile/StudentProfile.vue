<template>
   <div class="row">
        <div class="col-md-3">
            <div class="qr-code">
                <div class="qrcode-img">
                    <qrcode-vue :value="value" :size="size" level="H" class="img-fluid" />
                </div>
                <h5>{{ this.profile.name }}</h5>
                <small>{{ this.user_id }}</small>
                <br>
                <!-- <button class="btn btn-primary" id="download-qrcode-btn">Download QR Code</button> -->
            </div>
        </div>

        <div class="col-md-9">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true"><b>Profile</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="organization-tab" data-toggle="tab" href="#organization" role="tab" aria-controls="organization" aria-selected="false"><b>Organization</b></a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <!-- Profile Tab Content -->
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="col">
                        <div class="row student-details">
                            <div class="student-info">
                                <h3>Student Information</h3>
                                <p><b>Full name: </b> <span id="full-name">{{ this.profile.name }}</span></p>
                                <p><b>Year level: </b> <span id="year-level">{{ this.profile.year_level }}</span></p>
                                <p><b>College: </b> <span id="college">{{ this.profile.college }}</span></p>
                                <p><b>Department: </b> <span id="department"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Clubs Tab Content -->
                <div class="tab-pane fade" id="organization" role="tabpanel" aria-labelledby="organization-tab">
                    <h3>Organizations</h3>
                    <ul v-for="organization in this.organization" :id="organization.student_org_id">
                        <li><b>{{ organization['organization']['name'] }}</b></li>
                        <!-- Add more club items here -->
                    </ul>
                </div>
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
