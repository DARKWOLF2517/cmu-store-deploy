<template>
    <div class="col-md-8 mt-2">
        <h3 class="mt-2"><i class="fas fa-list"></i> Student Profile</h3>
    </div>
    <div v-if="loading" class="row d-flex gap-4 mb-4" style="padding: 10px">
        <div class="card col-md-4" aria-hidden="true" style="height: 100%; border: none; padding: 20px">
            <h3 class="card-title placeholder-glow">
                <span class="placeholder col-6 bg-secondary"
                    style="height: 250px; width: 250px; border-radius: 10px"></span>
            </h3>
            <p class="card-text placeholder-wave mt-2 text-center">
                <span class="placeholder col-4 bg-secondary"></span>
                <span class="placeholder col-4 bg-secondary"></span>
                <br />
                <span class="placeholder col-8 bg-secondary mt-2"></span>
                <br />
                <span class="placeholder col-6 bg-secondary"></span>
                <br />
                <span class="placeholder col-4 bg-secondary"></span>
            </p>
        </div>
        <div class="card col-md-6" aria-hidden="true" style="height: 100%; border: none; padding: 20px">
            <div class="row d-flex gap-4">
                <div class="col-md-4">
                    <h3 class="card-title placeholder-glow">
                        <span class="placeholder col-6 bg-secondary" style="
                                height: 250px;
                                width: 250px;
                                border-radius: 50%;
                            "></span>
                    </h3>
                </div>
                <div class="col-md-6 details-load">
                    <p class="card-text placeholder-wave mt-2 text-start">
                        <br />
                        <span class="placeholder col-12 bg-secondary"></span>
                        <br />
                        <span class="placeholder mt-4 col-12 bg-secondary"></span>
                        <br />
                        <span class="placeholder col-8 bg-secondary mt-2"></span>
                        <br />
                        <span class="placeholder col-6 bg-secondary"></span>
                        <br />
                        <span class="placeholder col-4 bg-secondary"></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div v-else class="student-profile-container">
        <div class="row w-100">
            <div class="col-md-4 ">
                <div class="qr-code">
                    <h5><i class="far fa-copy"></i> Student Information</h5>
                    <div class="row">
                        <div class="col">
                            <div class="qr-code-container">
                                <div class="qrcode-img">
                                    <qrcode-vue :value="value" :size="size" level="H" class="img-fluid" />
                                </div>
                                <h4 class="text-center">
                                    {{ this.profile.name }}
                                </h4>
                                <h5 class="mb-0 text-center text-muted">
                                    <b></b> {{ this.user_id }}
                                </h5>
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
                        <button class="btn btn-light w-100 mt-2" data-bs-toggle="modal"
                            data-bs-target="#EditProfileModal">
                            <i class="fas fa-edit"></i> Edit Email
                        </button>
                        <!-- <button class="btn btn-light w-100 mt-2"> <i class="fas fa-print"></i> Print QR</button> -->
                        <a class="btn btn-light w-100 mt-2" href="/change_password">
                            <i class="fas fa-sun"></i> Change Password</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="organizations" role="tabpanel" aria-labelledby="organization-tab">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="profile">
                                <!-- Profile content -->
                                <div class="profile-content">
                                    <div class="image-container">
                                        <div class="hover-label">
                                            <i class="fas fa-edit"></i> Change
                                            Image
                                        </div>
                                        <input id="fileInput" type="file" name="picture" accept="image/*"
                                            @change="handleFileUpload" class="d-none" />
                                        <img v-if="this.profile.profile_picture" @click="openFileInput"
                                            id="profileImage" :src="this.tempImage
        ? this.tempImage
        : this.profile
            .profile_picture
        " alt="profile photo" />
                                        <img v-else id="profileImage" @click="openFileInput" :src="this.tempImage
        ? this.tempImage
        : 'https://indonesiasatu.co.id/assets/themes/indonesiasatu/img/user.png'
        " alt="user-image" />
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <button @click="this.uploadProfileImage" type="button" class="btn btn-success"
                                    v-if="this.tempImage">
                                    <i class="fas fa-save"></i> Save Profile
                                    Image
                                </button>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mt-5">
                                <h5>
                                    <i class="far fa-copy"></i> Student Details
                                </h5>
                                <div v-if="loading" class="loading-spinner">
                                    <div class="spinner-border text-success" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <p class="mb-2 mt-2">
                                    <b>Year level:</b>
                                    <span id="year-level">{{
        this.profile.year_level
    }}</span>
                                </p>
                                <p>
                                    <b>Email:</b> {{ this.profile.email }}
                                    <span id="email"></span>
                                </p>
                                <h5>
                                    <i class="far fa-copy"></i> Organizations
                                </h5>
                                <ul>
                                    <li v-for="organization in this
        .organization" :key="organization.student_org_id">
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
            <form @submit.prevent="this.submitEmail">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <h3>
                                    <i class="fas fa-envelope text-primary"></i>
                                </h3>
                                <h4><b>Edit Email</b></h4>
                                <small id="emailHelp" class="form-text text-muted mt-2">
                                    Receive notifications about your attendance
                                    by providing your email. We'll keep you
                                    informed about important updates.</small>
                            </div>
                            <div class="mb-3">
                                <label for="editEmail" class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control" id="editEmail" placeholder="Enter Email"
                                    required maxlength="50" v-model="this.profile.email" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-success">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import QrcodeVue from "qrcode.vue";
import html2canvas from "html2canvas";
import { toast } from "vue3-toastify";
export default {
    props: ["user_id", "user_org"],
    data() {
        return {
            loading: false, // Added loading property
            profile: {
                name: "",
                email: "",
                year_level: "",
                college: "",
                department: "",
                profile_picture: null,
            },
            picture: null,
            tempImage: null,
            organization: [],
            size: 150,
            value: this.user_id,
        };
    },
    created() {
        this.FetchUserData();
    },
    methods: {
        submitEmail() {
            axios
                .put(`/updateEmail/${this.profile.email}`)
                .then((response) => {
                    console.log(response.data);
                    this.showSucces(response.data.message);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        uploadProfileImage() {
            const formData = new FormData();
            formData.append("picture", this.picture);
            axios
                .post(
                    `/uploadProfilePictureForStudent/${this.user_id}`,
                    formData,
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }
                )
                .then((response) => {
                    console.log(response.data);
                    // Handle success
                    this.showSucces(response.data.message);
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        handleFileUpload(event) {
            this.picture = event.target.files[0];
            this.tempImage = URL.createObjectURL(this.picture);
            console.log(this.tempImage);
        },
        openFileInput() {
            // Programmatically click on the file input element
            document.getElementById("fileInput").click();
        },
        downloadQRCode() {
            const qrCodeContainer =
                document.querySelector(".qr-code-container");

            html2canvas(qrCodeContainer).then((canvas) => {
                const imageURL = canvas.toDataURL("image/png");
                const link = document.createElement("a");
                link.href = imageURL;
                link.download = "profile-qr-code.png";
                link.click();
            });
        },
        showSucces(message) {
            toast.success(message),
            {
                autoClose: 1000,
            };
        },
        FetchUserData() {
            this.loading = true; // Set loading to true before making the API call

            axios
                .get(`/organization/${this.user_org}`)
                .then((response) => {
                    // console.log(response.data)
                    this.profile.college = response.data["name"];
                })
                .catch((error) => { })
                .finally(() => {
                    // Set loading to false after the API call is complete
                    this.loading = false;
                });

            axios
                .get(`profile/${this.user_id}`)
                .then((response) => {
                    console.log(response.data);
                    const data = response.data;
                    data.forEach((item) => {
                        this.profile.name =
                            item.user_profile.first_name +
                            " " +
                            item.user_profile.last_name;
                        this.profile.email = item.user_profile.email;
                        if (this.profile.year_level) {
                            this.profile.year_level = item.year_level.year_level;
                        }

                        this.profile.profile_picture = item.user_profile.image;
                    });

                    //get the organization list
                    this.organization = response.data;
                    // Create a Map to store unique objects based on student_org_id
                    const uniqueOrganizationMap = new Map();

                    this.organization.forEach((item) => {
                        const student_org_id = item.student_org_id;

                        // Check if the student_org_id is not already in the Map
                        if (!uniqueOrganizationMap.has(student_org_id)) {
                            // Add the item to the Map with student_org_id as the key
                            uniqueOrganizationMap.set(student_org_id, item);
                        }
                    });

                    // Convert the Map values back to an array
                    this.organization = Array.from(
                        uniqueOrganizationMap.values()
                    );
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    components: {
        QrcodeVue,
    },
};
</script>
