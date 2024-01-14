<template>
    <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4 class="mb-0"><i class="fas fa-list mt-2"></i> Attendance Record</h4>
        <div class="student-buttons d-flex mt-2">
            <div class="btn-group" role="group">
                <button class="btn me-2" id="add-student-list-button">
                    <i class="fas fa-print"></i> Print
                </button>
                <button class="btn me-2" id="add-student-button">
                    <i class="fas fa-download"></i> Download
                </button>
            </div>
        </div>
    </div>
</div>

        <div id="table-container" style="height: 800vh !important; max-height: 80vh;">

                <div class="scroll-pane" id="table-list" style="height: 70vh !important; max-height: 70vh;" >
                    <h5 id="Eventtitle"> Event: <b>{{ this.event.event_title }}</b></h5>
                    <p>Date: <b>{{ this.event.event_date }}</b> </p>
                    <table  id="accountabilities-table">
                        <thead>
                            <tr>
                                <th class="sortable-header" style="width: 10%;">Student ID</th>
                                <th class="sortable-header">Student Name</th>
                                <th class="sortable-header">Session</th>
                                <th class="sortable-header">College</th>
                                <!-- <th class="sortable-header" style="width: 5%;"> </th> -->
                            </tr>
                        </thead>
                        <tbody v-for="attendance in this.attendance" :id="attendance.user_id">
                            <tr>
                                <td>{{ attendance.user_id }}</td>
                                <td>{{ attendance.user.name }}</td>
                                <td>In</td>
                                <td>{{ attendance.college.college}}</td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <div class="pagination-container mt-2">
      <ul class="pagination justify-content-center">
        <li class="page-item" :class="{ disabled: currentPage === 1 }">
          <a class="page-link" href="#" tabindex="-1" aria-disabled="true" @click="changePage(currentPage - 1)">Previous</a>
        </li>
        <li v-for="page in totalPages" :key="page" class="page-item" :class="{ active: currentPage === page }">
          <a class="page-link" href="#" @click="changePage(page)">{{ page }}</a>
        </li>
        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
          <a class="page-link" href="#" @click="changePage(currentPage + 1)">Next</a>
        </li>
      </ul>
    </div>
        </div>

</template>


<script>
import { converTime } from "../Functions/TimeConverter.js";
import { convertDate } from "../Functions/DateConverter.js";

export default {
  props: ['organization_id', 'event_id'],
  data() {
    return {
      attendance: [],
      event: {
        event_title: '',
        event_date: '',
      },
      rowsPerPage: 7,
      currentPage: 1,
    };
  },
  computed: {
    paginatedAttendance() {
      const startIndex = (this.currentPage - 1) * this.rowsPerPage;
      const endIndex = startIndex + this.rowsPerPage;
      return this.attendance.slice(startIndex, endIndex);
    },
    totalPages() {
      return Math.ceil(this.attendance.length / this.rowsPerPage);
    },
  },
  mounted() {
    this.fetchData();
  },
    methods:{
        fetchData(){
        axios.get(`/attendance/list/${this.organization_id}/${this.event_id}`)
            .then(response => {
                console.log(response.data)

                const data = response.data;
                    data.forEach(item => {
                        // console.log(item);
                        item['events']['start_date'] = convertDate(item['events']['start_date']);
                        this.event.event_title = item['events']['name'];
                        this.event.event_date = item['events']['start_date'];
                    });
                    this.attendance = response.data;
            })
            .catch(error => {

            });
    },
    changePage(page) {
      if (page >= 1 && page <= this.totalPages) {
        this.currentPage = page;
      }
    },
    },
}

</script>
