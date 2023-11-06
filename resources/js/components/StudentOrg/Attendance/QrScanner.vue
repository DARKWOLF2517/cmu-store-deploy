<template>
<div class="row justify-content-center">
    <div class="col-md-4 qr-scanner-container mx-4 mb-2 border-top border-5 border-success border-bottom-0 py-3">
        <h4><i class="bi bi-camera-video "></i>QR Scanner</h4>
                <div id="reader" ref="reader"></div>
                <div id="result"></div>
                    <form @submit.prevent="submitForm()"  id="eventsForm"  >
                        <div class="mb-3">
                            <label for="event-title" class="form-label">ID number</label>
                            <input type="text" name="id_number" class="form-control" id="event-title" v-model="formData.user_id" required>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> -->
                            <button type="submit" class="btn btn-primary" id="save-event-button">Save</button>
                        </div>
                    </form>
    </div>
    <div class="col-md-4 qr-scanned-container border-top border-5 border-warning border-bottom-0 py-3">
        <h4>Scanned Data</h4>
        <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="table-container">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                            </tr>
                            <tr v-for="attendances in this.attendance" :id="attendances.user_id">
                                <td> {{  attendances["user_id"] }}</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item, index) in this.temporary" :key="index">
                                <td>{{ item.ID }}</td>
                                <td>
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
import {Html5QrcodeScanner} from "html5-qrcode";
import {Html5Qrcode} from "html5-qrcode";
export default {
components: { QrcodeStream },
props: ['event_id', 'org_id', 'officer_id', 'session'],
data() {
    return {
        attendance:[],
        formData:{
            user_id:'',
            org_id: this.org_id,
            event_id: this.event_id,
            officer_id: this.officer_id,
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
    startQrReading(){
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
    success(result){
        this.scanner.pause();
        this.formData.user_id = result;
        console.log(result);
        this.submitForm();
    },
    error(err) {
        // console.error(err);
        // Prints any errors to the console
    },
    fetchData(){
        axios.get(`/attendance/show/${this.event_id}/${this.org_id}`)
            .then(response => {
                this.attendance = response.data
            })
            .catch(error => {

            });
    },
    submitForm(){
        //get the repeating data using id number of the student
        // axios.get(`/show/user/${this.formData.user_id}`)
        //     .then(response => {
        //         if(response.data > 0){

        //         }
        //         else{
        //             alert('adfdsf')
        //         }
        //     })
        //     .catch(error => {

        //     });
        axios.post("/attendance", this.formData)
            .then(response => 
            {
                // if(response.result === "failure")
                // {
                //     alert(response.message);
                // }
                alert(response.data.message)
                this.scanner.resume();
            });
            // axios.get(`/attendance_repetition/${this.formData.user_id}/${this.session}/${this.event_id}`)
            //     .then(response => {
            //         if(response.data > 0){
            //             alert ('Already Repeated')
            //         }
            //         else{
            //             axios.post('/attendance', this.formData)
            //                 .then(response => {
                                
            //                 })
            //                 .catch(error => {
            //                     alert(error);
            //                     // alert(this.formData.id_number);
            //                 });
            //         }
            //         console.log("resuming scanner");
            //         this.scanner.resume();
            //     })
            //     .catch(error => {
            //         alert(error);
                
            //     });
        }
}
// setup(props)
// {
//     const scanner = new Html5QrcodeScanner('reader', {
//     // Scanner will be initialized in DOM inside element with id of 'reader'
//         qrbox: {
//             width: 250,
//             height: 250,
//         },  // Sets dimensions of scanning box (set relative to reader element width)
//         fps: 20, // Frames per second to attempt a scan
//     });

//     onMounted(() => {
//         scanner.render();
//         fetchData();
//     })

//     function success(result){
//         scanner.pause();
//         this.formData.user_id = result;
//         console.log(result);
//         this.submitForm();
//     }
    
//     function error(err) {
//         // console.error(err);
//         // Prints any errors to the console
//     }
    
//     function fetchData() {
//         axios.get(`/attendance/show/${this.event_id}/${this.org_id}`)
//             .then(response => {
//                 this.attendance = response.data
//             })
//             .catch(error => {

//             });
//     }

//     function submitForm(){
//         //get the repeating data using id number of the student
//         // axios.get(`/show/user/${this.formData.user_id}`)
//         //     .then(response => {
//         //         if(response.data > 0){

//         //         }
//         //         else{
//         //             alert('adfdsf')
//         //         }
//         //     })
//         //     .catch(error => {

//         //     });
//         axios.get(`/attendance_repetition/${this.formData.user_id}/${this.session}/${this.event_id}`)
//             .then(response => {
//                 if(response.data > 0){
//                     alert ('Already Repeated')
//                 }
//                 else{
//                     axios.post('/attendance', this.formData)
//                         .then(response => {
                            
//                         })
//                         .catch(error => {
//                             alert(error);
//                             // alert(this.formData.id_number);
//                         });
//                 }
//             })
//             .catch(error => {
//                 alert(error);
            
//             });

//         window.location.reload();
//     }

//     return { scanner, submitForm, error, success, fetchData}
// }

}
</script>

<!-- <style>
    main {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #reader {
        width: 100%;
    }
    #result {
        text-align: center;
        font-size: 1.5rem;
    }

    .table thead th {
        background-color: #007bff;
        color: white;
        margin-top: 20px;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #ffffff;
    }


    .table td, .table th {
        padding: 10px;
        text-align: center;
    }

</style> -->
