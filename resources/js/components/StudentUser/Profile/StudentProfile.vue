<template>
    <div class="student-profile-container mt-2">
        <div class="row w-100">
            <div class="col-md-4 mt-3">
                <div class="qr-code">
                    <h5> <i class="far fa-copy"></i> Student Information</h5>
                    <div class="row">
                        <div class="col">
                            <div class="qr-code-container">
                                <div class="qrcode-img">

                                    <qrcode-vue :value="value" :size="size" level="H" class="img-fluid" />
                                </div>
                                <h4 class="text-center">{{ this.profile.name }}</h4>
                                <h5 class="mb-0 text-center text-muted"> <b></b> {{ this.user_id }}</h5>
                                <!-- <p class="mb-0 mt-2"><b>Year level: </b> <span id="year-level">{{ this.profile.year_level
                                }}</span></p>
                                <p><b>Email: </b> {{ this.profile.email }} <span id="email"></span></p> -->
                            </div>
                        </div>
                    </div>

                    <div class="profile-buttons mt-2">
                        <button class="btn btn-secondary w-100" @click="downloadQRCode">
                            <i class="fas fa-download"></i> Download QR
                        </button>
                        <!-- <button class="btn btn-light w-100 mt-2" data-bs-toggle="modal"
                            data-bs-target="#EditProfileModal">
                            <i class="fas fa-edit"></i> Edit Email
                        </button> -->
                        <!-- <button class="btn btn-light w-100 mt-2"> <i class="fas fa-print"></i> Print QR</button> -->
                        <a class="btn btn-light w-100 mt-2" href="/change_password"> <i class="fas fa-sun"></i> Change
                            Password</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mt-3">
                <div class="organizations" role="tabpanel" aria-labelledby="organization-tab">

                        <div class="row">
                            <div class="col-4">
                                <div class="profile">
                                    <!-- Profile content -->
                                    <img id="profileImage"
                                        src="https://indonesiasatu.co.id/assets/themes/indonesiasatu/img/user.png"
                                        alt="profile photo">
                                </div>
                            </div>
                            <div class="col">

                    <div class="mt-5">
                        <h5><i class="far fa-copy"></i> Student Details </h5>
                        <div v-if="loading" class="loading-spinner">
                            <div class="spinner-border text-success" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                                <p class="mb-2 mt-2"><b>Year level:</b> <span id="year-level">{{ this.profile.year_level
                                        }}</span></p>
                                <p><b>Email:</b> {{ this.profile.email }} <span id="email"></span></p>
                            <h5><i class="far fa-copy"></i> Organizations</h5>
                            <ul>
                                <li v-for="organization in this.organization" :key="organization.student_org_id">
                                    {{ organization.organization.name }}
                                </li>
                                <!-- Add more club items here -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Edit Profile Modal -->
        <div class="modal fade" id="EditProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <h3> <i class="fas fa-envelope text-primary"></i></h3>
                            <h4><b>Edit Email</b></h4>
                            <small id="emailHelp" class="form-text text-muted mt-2"> Receive notifications about your
                                attendance by
                                providing your email. We'll keep you informed about important updates.</small>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" id="editEmail" placeholder="Enter Email" required
                                maxlength="50">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import QrcodeVue from 'qrcode.vue';
import html2canvas from 'html2canvas';
export default {
    props: ['user_id', 'user_org'],
    data() {
        return {
            loading: false, // Added loading property
            profile: {
                name: '',
                email: '',
                year_level: '',
                college: '',
                department: '',
            },
            organization: [],
            size: 150,
            value: this.user_id,
        };
    },
    created() {
        this.FetchUserData();
    },
    methods: {
        downloadQRCode() {
            const qrCodeContainer = document.querySelector('.qr-code-container');

            html2canvas(qrCodeContainer).then(canvas => {
                const imageURL = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.href = imageURL;
                link.download = 'profile-qr-code.png';
                link.click();
            });
        },
        FetchUserData() {
            this.loading = true; // Set loading to true before making the API call

            axios.get(`/organization/${this.user_org}`)
                .then(response => {
                    // console.log(response.data)
                    this.profile.college = response.data['name'];
                })
                .catch(error => { })
                .finally(() => {
                    // Set loading to false after the API call is complete
                    this.loading = false;
                });

            axios.get(`profile/${this.user_id}`)
                .then(response => {
                    console.log(response.data)
                    const data = response.data;
                    data.forEach(item => {
                        this.profile.name = item.user_profile.first_name + ' ' + item.user_profile.last_name;
                        this.profile.email = item.user_profile.email;
                        this.profile.year_level = item.year_level.year_level;
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
                })
                .catch(error => {
                    console.log(error);
                });
        },
    },
    components: {
        QrcodeVue,
    },
};
</script>
