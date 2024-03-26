<template>
    <div class=" ">
        <div class="row d-flex justify-content-between">
            <div class="col-md-8">
                <h3 class="mt-4">
                    <i class="fas fa-list"></i> Accountabilities
                </h3>
            </div>
            <div class="col-md-4 mb-2">
                <div class="select-dropdown" style="width: 100%; height: auto">
                    <select id="sort-select" class="form-control" style="text-align: center" v-model="school_year_input"
                        @change="getUserOrgs">
                        <option value="" disabled selected>
                            Select Semester
                        </option>
                        <option v-for="school_year in this.school_year" :value="school_year.id">
                            {{ school_year.school_year }}
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading spinner -->
    <div v-if="loading">
        <div class="d-flex flex-column flex-md-row gap-4 p-2">
            <div class="card loading-card col-lg-4 col-md-6" aria-hidden="true"
                style="width: calc(33.33% - 30px); height: 200px; border: none">
                <div class="card-body">
                    <h5 class="card-title placeholder-glow text-center mt-2">
                        <span class="placeholder col-6 bg-secondary" style="height: 40px; width: 40px"></span>
                    </h5>
                    <p class="card-text placeholder-glow mt-2 text-center">
                        <span class="placeholder col-4 bg-secondary"></span>
                    </p>
                    <p class="card-text placeholder-glow placeholder-xs mt-2 text-center">
                        <span class="placeholder col-8 bg-secondary"></span>
                    </p>
                    <div class="d-flex justify-content-center">
                        <button type="button" tabindex="-1" class="btn btn-success mt-2 disabled placeholder col-6"
                            style="height: 35px; width: 120px"></button>
                    </div>
                </div>
            </div>
            <div class="card loading-card col-lg-4 col-md-6" aria-hidden="true"
                style="width: calc(33.33% - 30px); height: 200px; border: none">
                <div class="card-body">
                    <h5 class="card-title placeholder-glow text-center mt-2">
                        <span class="placeholder col-6 bg-secondary" style="height: 40px; width: 40px"></span>
                    </h5>
                    <p class="card-text placeholder-glow mt-2 text-center">
                        <span class="placeholder col-4 bg-secondary"></span>
                    </p>
                    <p class="card-text placeholder-glow placeholder-xs mt-2 text-center">
                        <span class="placeholder col-8 bg-secondary"></span>
                    </p>
                    <div class="d-flex justify-content-center">
                        <button type="button" tabindex="-1" class="btn btn-success mt-2 disabled placeholder col-6"
                            style="height: 35px; width: 120px"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="accountability-container" id="set-accountabilities">
        <div class="col">
            <div>
                <div class="accountability-cards-list">
                    <!-- Message if the container is empty -->
                    <div class="Container-IfEmpty text-center" v-if="!loading && this.user_organization.length === 0">
                        <div class="Empty-Message">
                            <i class="far fa-smile mb-0" id="icon-message"></i>
                            <p class="text-muted mt-0">
                                <b>No fees yet.</b>
                                <br />
                                Your student organization fees will show up
                                here.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-md-row gap-2">
                        <div class="stud-accountability-card border-top border-5 border-success border-bottom-0"
                            v-for="user_orgs in this.user_organization">
                            <div class="p-2 text-center">
                                <h2 class="text-center bold mt-2">
                                    <i class="bi bi-wallet2 text-secondary"></i>
                                </h2>
                                <h5 class="card-title mt-2">
                                    <strong>{{ user_orgs.organization.name }}
                                    </strong>
                                </h5>
                                <p>{{ user_orgs.organization.description }}</p>
                                <!-- <h2 class="total-payment bold">&#8369; 10,000</h2> -->
                                <!-- Use "&#8369;" for the peso sign -->
                            </div>
                            <div class="text-center">
                                <button class="btn button-secondary" style="
                                        background-color: #4fb98e;
                                        color: #fefffe;
                                    " data-bs-toggle="modal" data-bs-target="#seeMoreAccountability" @click="
                    (this.org_id =
                        user_orgs.student_org_id),
                        (this.org_name =
                            user_orgs.organization.name),
                        this.getFreeFines(),
                        this.getSessionExemptedAttendance(),
                        this.fetchData()
                        ">
                                    <i class="fas fa-eye"></i> See more
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="seeMoreAccountability" tabindex="-1" aria-labelledby="seeMoreAccountabilityLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h6 class="modal-title" id="seeMoreAccountabilityLabel">
                        {{ this.org_name }}
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Detailed Information -->
                    <div class="mb-3">
                        <label for="totalPayment" class="form-label">Total Accountabilities</label>
                        <h3 id="totalPayment">
                            &#8369; {{ this.total_accountability }}
                        </h3>
                        <!-- Use "&#8369;" for the peso sign -->
                    </div>
                    <!-- Button to trigger the modal -->
                    <div class="d-flex justify-content-end">
                        <!-- Adding data-bs-toggle and data-bs-target to trigger the modal -->
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#paymentHistoryModal"
                            @click="this.getPaymentHistory()">
                            Payment History
                        </button>
                    </div>
                    <br />
                    <table class="student-accountabilities" id="accountabilities-table">
                        <thead style="background-color: #84c0b4; color: #fefffe">
                            <th>
                                <h6><b>Accountabilities</b></h6>
                            </th>
                            <th>
                                <h6><b>Amount</b></h6>
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Fines</th>
                                <td>
                                    &#8369;
                                    {{
                        getTotalAccountabilitiesIndividual(
                            "fines",
                            fines
                        )
                    }}
                                    <!-- <i class="fas fa-eye ml-6">see more</i> -->
                                </td>
                            </tr>
                            <tr v-for="accountability in this
                            .accountabilityList">
                                <th>
                                    {{ accountability["accountability_name"] }}
                                </th>
                                <td>
                                    &#8369;
                                    {{
                        getTotalAccountabilitiesIndividual(
                            accountability[
                            "accountability_name"
                            ],
                            accountability["amount"]
                        )
                    }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="paymentHistoryModal" tabindex="-1" aria-labelledby="paymentHistoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentHistoryModalLabel">
                        Payment History
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5> <b> {{ this.org_name }}</b> </h5>
                    <div v-if="payment_history.length === 0" class="text-center">
                        <h3><i class="fas fa-frown text-warning"></i></h3>
                        <h4><b>Oops!</b></h4>
                        <p>No Payments found</p>
                    </div>
                    <table id="accountabilities-table" v-else>
                        <thead>
                            <tr>
                                <!-- <th>Accountabilities</th> -->
                                <th>Date Paid</th>
                                <th style="width: 10%;">Amount</th>
                                <th>Accountability Type</th>
                                <th>Remarks</th>

                            </tr>
                        </thead>
                        <tbody>


                            <tr v-for="payment in this.payment_history">
                                <!-- <td>{{ paid['accountability_name'] }}</td> -->
                                <td> {{ payment.created_at }}</td>
                                <td style="text-align: right; font-weight: bold;"> &#8369; {{ payment.amount }}</td>
                                <td>{{ payment.accountability_type }}</td>
                                <td v-if="payment.remarks != 0">{{ payment.remarks }}</td>
                                <td v-else>N/A</td>

                            </tr>



                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { convertDate } from "../../StudentOrg/Functions/DateConverter.js";
export default {
    props: ["user_id", "name", "school_year_session"],
    data() {
        return {
            attendanceCount: [],
            fines: 0,
            total_accountability: 0,
            accountabilityList: [],
            school_year: [],
            school_year_input: this.school_year_session,
            accountabilityList: [],
            searchTerm: "",
            filtered_accountabilities: [],
            org_id: 0,
            org_name: "",
            user_organization: [],
            paid_accountabilities: [],
            loading: true,
            payment_history: [],
            freeFines: [],
            sessionExemptedAttendance: 0,


        };
    },
    mounted() {
        // this.fetchData();

        this.showSchoolYear();
        // console.log(this.name)
        this.getUserOrgs();
    },
    methods: {
        getPaymentHistory() {
            console.log(this.org_id)
            axios
                .get(`get_student_payment_history/${this.user_id}/${this.org_id}`)
                .then((response) => {
                    console.log(response.data)
                    const data = response.data;
                    data.forEach(item => {
                        item["created_at"] = convertDate(item["created_at"]);
                        if (Number.isInteger(item.amount)) {
                            // If it is a whole number, convert it to a string with two decimal places
                            item.amount = item.amount.toFixed(2);
                        }
                    });
                    this.payment_history = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        showSchoolYear() {
            axios
                .get(`get_school_year`)
                .then((response) => {
                    // console.log(response.data)
                    this.school_year = response.data;
                    // console.log(response.data)
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getUserOrgs() {
            this.loading = true;
            this.user_organization = [];
            axios
                .get(`/get_user_orgs/${this.school_year_input}`)
                .then((response) => {
                    this.user_organization = response.data;
                    console.log(response.data);
                    this.loading = false;
                })
                .catch((error) => {
                    alert(error);
                    this.loading = false;
                });
        },
        fetchData() {
            (this.attendanceCount = []),
                (this.fines = 0),
                (this.accountabilityList = []),
                (this.total_accountability = 0),
                axios
                    .get(
                        `/get_accountabilities/${this.org_id}/${this.school_year_input}`
                    )
                    .then((response) => {
                        this.accountabilityList = response.data;
                        console.log(this.accountabilityList)
                    })
                    .catch((error) => {
                        alert(error);
                    });

            this.fetchEventsWithAttendance();
        },
        getTotalAccountabilitiesIndividual(accountability_type, amount) {
            // Sum the amount property of objects where accountability_type is "fines"
            const totalAmountFines = this.paid_accountabilities
                .filter(
                    (item) => item.accountability_type == accountability_type
                )
                .reduce((total, item) => total + item.amount, 0);

            let total_amount = amount - totalAmountFines;
            if (Number.isInteger(total_amount)) {
                // If it is a whole number, convert it to a string with two decimal places
                total_amount = total_amount.toFixed(2);
            }
            return total_amount;
        },
        fetchEventsWithAttendance() {
            axios
                .get(
                    `/accountabilities_students/${this.org_id}/${this.school_year_input}`
                )
                .then((response) => {
                    // console.log(response.data.paid_accountabilities)
                    const data = response.data.accountabilities;
                    this.paid_accountabilities =
                        response.data.paid_accountabilities;
                    // Calculate the total amount
                    const totalAmount = this.paid_accountabilities.reduce(
                        (total, item) => total + item.amount,
                        0
                    );

                    // console.log(totalAmount);
                    data.forEach((events) => {
                        //get the data of the student attendance and compile it to the array
                        const attendanceRecord = {
                            // student_id: events,
                            event_id: events.event_id,
                            fines: events.fines,
                            session_count: events.attendance_count,
                        };
                        const attendance = events.attendance;
                        let attendanceCount = 0;
                        let student_id = "";
                        attendance.forEach((id) => {
                            if (id.user_id == this.user_id) {
                                attendanceCount++;
                                student_id = this.user_id;
                            }
                        });
                        // Update the events.attendance_count with the total attendance count for the user
                        attendanceRecord.attendance_count = attendanceCount;
                        attendanceRecord.student_id = student_id;

                        console.log(attendanceRecord);
                        if (attendanceRecord.session_count > attendanceRecord.attendance_count) {
                            // console.log(attendanceRecord.event_id + " has fines " + attendanceRecord.fines)
                            attendanceRecord.finalSession =
                                attendanceRecord.session_count -
                                attendanceRecord.attendance_count;
                            if (this.freeFines == true) {
                                this.fines = 0
                            }
                            else {
                                this.fines +=
                                    attendanceRecord.fines *
                                    attendanceRecord.finalSession;


                            }


                        }

                        this.attendanceCount.push(attendanceRecord);
                    });
                    //to minus the session cancelled attendance
                    this.fines = this.fines - this.sessionExemptedAttendance;

                    this.accountabilityList.forEach((element) => {
                        this.total_accountability += element.amount;
                    });

                    this.total_accountability =
                        this.total_accountability + this.fines;
                    this.total_accountability =
                        this.total_accountability - totalAmount;

                    if (Number.isInteger(this.total_accountability)) {
                        // If it is a whole number, convert it to a string with two decimal places
                        this.total_accountability =
                            this.total_accountability.toFixed(2);
                    }

                    

                })
                .catch((error) => {
                    // alert(error)
                    console.log(error);
                });
        },
        getFreeFines() {
            axios
                .get(`get_free_fines_student/${this.user_id}/${this.org_id}/${this.school_year_input}`)
                .then((response) => {
                    console.log(response.data)
                    if (response.data) {
                        this.freeFines = true;
                    }
                    else {
                        this.freeFines = false;
                    }
                    console.log(this.freeFines)
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getSessionExemptedAttendance() {

            axios
                .get(`get_session_exempted_attendance/${this.org_id}/${this.school_year_input}`)
                .then((response) => {
                    let total = 0;
                    this.sessionExemptedAttendance = 0;
                    console.log(response.data)
                    if (response.data.length > 0) {
                        response.data.forEach(element => {
                            // console.log(element.events.attendance_count)
                            total += element.count * element.events.fines
                        });
                        console.log('total'+total)
                        this.sessionExemptedAttendance = total;
                    }

                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
