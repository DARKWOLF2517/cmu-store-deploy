<template>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="fas fa-list mt-2"></i> Attendance Record</h4>
        <div class="student-buttons d-flex">
            <div class="btn-group" role="group">
            <button class="btn me-2" @click="printTable">
                <i class="fas fa-print"></i> Print
            </button>
            <button class="btn me-2" @click="downloadTable">
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
                    <table>
                        <thead>
                            <tr>
                                <th class="sortable-header" style="width: 10%;">Student ID</th>
                                <th class="sortable-header">Student Name</th>
                                <th class="sortable-header">Session</th>
                                <th class="sortable-header">College</th>
                                <!-- <th class="sortable-header" style="width: 5%;"> </th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="attendance in paginatedData" :key="attendance.user_id">
                                <td>{{ attendance.user_id }}</td>
                                <td>{{ attendance.user.name }}</td>
                                <td>In</td>
                                <td>{{ attendance.college.college}}</td>

                            </tr>
                        </tbody>
                    </table>
            </div>
            <ul class="pagination justify-content-center mt-2">
                    <li class="page-item" :class="{ disabled: currentPage === 1 }">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true" @click.prevent="prevPage">Previous</a>
                    </li>
                    <li v-for="page in pageRange" :key="page" class="page-item" :class="{ active: currentPage === page }">
                        <a class="page-link" href="#" @click.prevent="gotoPage(page)">{{ page }}</a>
                    </li>
                    <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                        <a class="page-link" href="#" @click.prevent="nextPage">Next</a>
                    </li>
                </ul>
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
      currentPage: 1,
      itemsPerPage: 10,
    };
  },
  computed: {
    totalPages() {
        return Math.ceil(this.attendance.length / this.itemsPerPage);
    },
    pageRange() {
        const start = Math.max(1, this.currentPage - 5);
        const end = Math.min(this.totalPages, this.currentPage + 5);
        const range = [];

        if (start > 1) {
            range.push(1);
            if (start > 2) {
            range.push("...");
            }
        }

        for (let i = start; i <= end; i++) {
            range.push(i);
        }

        if (end < this.totalPages) {
            if (end < this.totalPages - 1) {
            range.push("...");
            }
            range.push(this.totalPages);
        }

        return range;
    },
    paginatedData() {
        const start = (this.currentPage - 1) * this.itemsPerPage;
        return this.attendance.slice(start, start + this.itemsPerPage);
    },
    hasEllipsisBefore() {
        return this.currentPage > 3 && this.totalPages > 5;
    },

    hasEllipsisAfter() {
        return this.currentPage < this.totalPages - 2 && this.totalPages > 5;
    },
    ellipsisRange() {
        const range = [];
        const start = Math.max(this.currentPage - 2, 1);
        const end = Math.min(start + 4, this.totalPages);

        if (this.hasEllipsisBefore) {
            range.push(this.ellipsisBefore);
        }

        for (let i = start; i <= end; i++) {
            range.push(i);
        }

        if (end < this.totalPages) {
            if (end < this.totalPages - 1) {
            range.push(this.ellipsisAfter);
            }
            range.push(this.totalPages);
        }

        // If there are more than 5 page numbers, remove the ones in the middle
        if (range.length > 5) {
            range.splice(3, range.length - 5);
        }

        return range;
    },
    ellipsisBefore() {
        return Math.max(this.currentPage - 5, 1);
    },
    ellipsisAfter() {
        return Math.min(this.currentPage + 5, this.totalPages);
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
    nextPage() {
        if (this.currentPage < this.totalPages) {
        this.currentPage++;
        }
    },

    gotoPage(page) {
        if (page === "...") {
            if (this.currentPage > this.totalPages / 2) {
            this.currentPage = this.totalPages;
            } else {
            this.currentPage = 1;
            }
        } else {
            this.currentPage = page;
        }
    },
    printTable() {
  // Create a hidden iframe for printing
  const iframe = document.createElement('iframe');
  iframe.style.display = 'none';
  document.body.appendChild(iframe);

  // Generate the printable HTML document in the iframe
  const iframeDoc = iframe.contentWindow.document;
  iframeDoc.open();
  iframeDoc.write(`
      <html>
      <head>
          <title>Print</title>
          <!-- Include Bootstrap stylesheet link -->
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      </head>
      <body>
          <!-- Add a title before the table -->
          <h2>Attendance Record</h2>
          <br>
          <h5 id="Eventtitle"> Event: <b>${this.event.event_title}</b></h5>
          <p>Date: <b>${this.event.event_date}</b></p>

          <!-- Add Bootstrap table classes -->
          <table class="table table-bordered table-striped">
              <thead>
                  <tr>
                      <th style="width: 10%;">Student ID</th>
                      <th style="width: 30%;">Student Name</th>
                      <th style="width: 20%;">Session</th>
                      <th style="width: 10%;">College</th>
                  </tr>
              </thead>
              <tbody>
                  ${this.generateTableRows(this.attendance)}
              </tbody>
          </table>
      </body>
      </html>
  `);
  iframeDoc.close();

  // Print the iframe content
  iframe.contentWindow.focus();
  iframe.contentWindow.print();

  // Remove the iframe after printing
  setTimeout(() => {
      document.body.removeChild(iframe);
  }, 1000);
},

generateTableRows(data) {
  let rows = '';
  data.forEach(item => {
      rows += `
          <tr>
              <td>${item.student_id}</td>
              <td>${item.user.name}</td>
              <td>${item.reason}</td>
              <td>
                  <span class="table-buttons">
                      <button class="btn edit-button" @click="submit = updateData, id = ${item.student_id},fetchUpdateData()" data-bs-toggle="modal" data-bs-target="#addStudentModal"><i class="fas fa-pen"></i></button>
                      <button class="btn delete-button" @click="" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"><i class="fas fa-trash"></i></button>
                  </span>
              </td>
          </tr>
      `;
  });
  return rows;
},
downloadTable() {
  // Get the table data specifically from attendance
  const tableData = this.getAttendanceTableData();

  // Create a workbook
  const wb = XLSX.utils.book_new();
  const ws = XLSX.utils.aoa_to_sheet(tableData);
  XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

  // Save the workbook as an Excel file
  XLSX.writeFile(wb, 'AttendanceRecord.xlsx');
},

getAttendanceTableData() {
  // Get a reference to the attendance data
  const data = this.attendance;

  // Initialize an array to store the table data
  const tableData = [];

  // Iterate through the attendance data
  for (let i = 0; i < data.length; i++) {
    const rowData = [];

    // Add the desired data fields to the rowData array
    rowData.push(data[i].student_id);
    rowData.push(data[i].user.name);
    rowData.push(data[i].user.name);
    rowData.push(data[i].college.college);

    // Push the row data to the tableData array
    tableData.push(rowData);
  }

  // Return the table data
  return tableData;
},
    },
}

</script>
