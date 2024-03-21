<template>

    <div class="row justify-content-center gap-2 ">
        <div class="col-md-4 qr-scanner-container mx-4 mb-2 border-top border-5 border-success border-bottom-0 py-3">
            <h4><i class="bi bi-camera-video "></i> QR Scanner</h4>
            <div id="reader" ref="reader"></div>
            <div id="result"></div>
            <form @submit.prevent="submitForm()" id="eventsForm">
                <div class="mb-3">
                    <label for="event-title" class="form-label">ID number</label>
                    <input type="text" name="id_number" class="form-control" id="event-title" v-model="formData.user_id"
                        required>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-success" id="save-event-button">Save</button>
                </div>
            </form>
        </div>
        <div class="col-md-4 qr-scanned-container border-top border-5 border-success border-bottom-0 py-3"
            id="record-table">
            <h4><i class="bi bi-files "></i> Scanned Data</h4>
            <div class="row justify-content-center">
                <div class="col">
                    <div class="table-container">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="attendances in this.attendance" :id="attendances.user_id">
                                    <td> {{ attendances.user_profile.first_name }} {{
                attendances.user_profile.last_name }}</td>
                                    <td>
                                        {{ attendances.time }}
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


import { QrcodeStream } from 'vue-qrcode-reader'
import { Html5QrcodeScanner } from "html5-qrcode";
import { Html5Qrcode } from "html5-qrcode";
import { converTime } from "../Functions/TimeConverter.js";
export default {
    components: { QrcodeStream },
    props: ['event_id', 'org_id', 'session'],
    data() {
        return {
            attendance: [],
            formData: {
                user_id: '',
                org_id: this.org_id,
                event_id: this.event_id,
                // officer_id: this.officer_id,
                remarks: 0,
                session: this.session,

            },
            scanner: ""
        }
    },
    mounted() {
        this.startQrReading();
        this.fetchData();
    },
    methods: {
        startQrReading() {
            this.scanner = new Html5QrcodeScanner('reader', {
                // Scanner will be initialized in DOM inside element with id of 'reader'
                qrbox: {
                    width: 250,
                    height: 250,
                },  // Sets dimensions of scanning box (set relative to reader element width)
                fps: 20, // Frames per second to attempt a scan
            });
            this.scanner.render(this.success, this.error);
            // Starts scanner
        },
        success(result) {
            this.formData.user_id = result;
            this.submitForm();
        },
        error(err) {
            // console.error(err);
            // Prints any errors to the console
        },
        // fetchData() {
        //     axios.get(`/attendance/show/${this.event_id}/${this.org_id}/${this.session}`)
        //         .then(response => {
        //             this.attendance = response.data
        //             console.log(this.attendance)
        //         })
        //         .catch(error => {

        //         });
        // },
        fetchData() {
            axios.get(`/attendance/show/${this.event_id}/${this.org_id}/${this.session}`)
                .then(response => {

                    response.data.forEach(element => {
                        element.time = converTime(element.time);
                    });
                    // Sort the attendance array by the newest entry
                    this.attendance = response.data.sort((a, b) => {
                        return new Date(b.created_at) - new Date(a.created_at);
                    });
                    console.log(this.attendance);
                })
                .catch(error => {

                });
        },

        async submitForm() {
            this.scanner.pause();
            axios.post("/attendance", this.formData)
                .then(response => {
                    console.log(response.data)
                    alert(response.data.message)
                    // if (response.data.result != 'failure') {
                    //     axios.post("/send_mail", this.formData)
                    //         .then(response => {
                    //             console.log(response.data)

                    //         })
                    //         .catch(error => {
                    //             alert(error)
                    //         });
                    // }
                    this.scanner.resume();
                    this.fetchData();
                    this.formData.user_id = '';
                })
                .catch(error => {
                    alert(error)
                });


        }

        // async submitForm() {
        //     this.scanner.pause();
        //     try {
        //         const response = axios.post("/attendance", this.formData);
        //         console.log(response.data);
        //         alert(response.data.message);
        //         if (response.data.result !== 'failure') {
        //             const secondResponse = await axios.post("/send_mail", this.formData);
        //             console.log(secondResponse.data);
        //         }
        //         this.scanner.resume();
        //         this.fetchData();
        //         this.formData.user_id = '';
        //     } catch (error) {
        //         alert(error);
        //     }
        // }

    }

}
</script>
