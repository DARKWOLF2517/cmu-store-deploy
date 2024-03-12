<template>
    <div class="mt-2">
        <div class="row head-container">
            <div class="col-md-6 col-sm-12">
                <div class="input-container">
                    <i class="fa fa-search"></i>
                    <input type="text" placeholder="Search" v-model="searchTerm" @input="filterItems">
                </div>
            </div>
            <div class="col-md-6 col-sm-12"
                style="display: flex; align-items: center; justify-content: flex-end; gap: 20px;">
                <div class="select-dropdown">
                    <!-- Second dropdown -->
                    <select id="sort-select" class="form-control" style="text-align: center;" v-model="session"
                        @change="filterItems">
                        <option value="0" disabled selected>Select Attendace Type</option>
                        <option :value="1" v-if="attendance_count >= 1">Session 1</option>
                        <option :value="2" v-if="attendance_count >= 2">Session 2</option>
                        <option :value="3" v-if="attendance_count >= 3">Session 3</option>
                        <option :value="4" v-if="attendance_count >= 4">Session 4</option>
                    </select>
                </div>
                <div class="select-dropdown d-flex justify-content-end" v-if="this.college_id == 11">
                    <select id="sort-select" class="form-control" style="text-align: center;"
                        v-model="college_data_input" @change="filterItems">
                        <option value="0" disabled selected>Select College</option>
                        <option v-for="college in this.college_list" :value="college.id"> {{ college.college }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
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
    <div id="table-container" >

        <div class="scroll-pane" id="table-list">
            <h5 id="Eventtitle"> Event: <b>{{ this.event.event_title }}</b></h5>
            <p>Date: <b>{{ this.event.event_date }}</b> </p>
            <table id="accountabilities-table">
                <thead>
                    <tr>
                        <th class="sortable-header" style="width: 10%;">Student ID</th>
                        <th class="sortable-header">Student Name</th>
                        <th class="sortable-header">College</th>
                        <th class="sortable-header" style="width: 20%;"> Time </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="attendance in paginatedData" :key="attendance.user_id">
                        <td>{{ attendance.user_id }}</td>
                        <td>{{ attendance.user_profile.first_name }} {{ attendance.user_profile.last_name }}</td>
                        <td>{{ attendance.user_profile.college.college }}</td>
                        <td>{{ attendance.created_at }}</td>
                        <td>
                            <span class="d-flex justify-content-center">
                                <button class="btn btn-danger text-light" data-bs-toggle="modal"
                                    data-bs-target="#deleteConfirmModal"><i class="fas fa-trash"></i></button>
                            </span>
                        </td>
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
            attendance_count: 0,
            session: 0,
            searchTerm: '',
            filtered_attendance: [],
            college_list: [],
            college_data_input: 0,
            college_id: 0,//college id of the organization
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
            return this.filtered_attendance.slice(start, start + this.itemsPerPage);
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
        this.showCollege();
        this.getOrgCollege();
    },
    methods: {
        getOrgCollege() {
            axios.get(`/get_organization_college/${this.organization_id}`)
                .then(response => {
                    this.college_id = response.data;
                    this.college_data_input = this.college_id;
                })
                .catch(error => {
                    console.log(error)
                });
        },
        showCollege() {
            axios.get(`/view_college`)
                .then(response => {
                    this.college_list = response.data;
                    // console.log(response.data)
                })
                .catch(error => {
                    console.log(error)
                });
        },
        filterItems() {

            let filteredBySearch = this.attendance;
            // if (this.searchTerm) {
            //     const searchTermLower = this.searchTerm.toLowerCase();
            //     filteredBySearch = filteredBySearch.filter(item =>
            //         item.user_profile.first_name.toLowerCase().includes(searchTermLower) ||
            //         item.user_id.toString().includes(this.searchTerm)
            //     );
            // }
            if (this.searchTerm) {
                const searchTermLower = this.searchTerm.toLowerCase();
                filteredBySearch = filteredBySearch.filter(item => (item.user_profile.first_name + '' + item.user_profile.last_name).toLowerCase().includes(searchTermLower) ||
                    item.user_id.toString().includes(this.searchTerm)
                );
            }

            // Filter based on filterStatus from select option
            let filteredByStatus = this.attendance;
            if (this.session) {
                filteredByStatus = filteredByStatus.filter(item =>
                    item.session.toString().includes(this.session)
                );
            }

            let filteredByCollege = this.attendance;
            if (this.college_data_input !== undefined && this.college_data_input !== null && this.college_data_input != 11) {
                filteredByCollege = filteredByCollege.filter(item =>
                    item.user_profile.college.id === parseInt(this.college_data_input, 10)
                );
            }

            console.log(filteredByCollege)
            // Merge the results of all three filters (independently applied)
            this.filtered_attendance = filteredBySearch.filter(item =>
                filteredByStatus.includes(item) && filteredByCollege.includes(item)
            );
            // console.log(this.filtered_attendance)
            // this.filtered_attendance = filteredBySearch

        },
        fetchData() {
            axios.get(`/attendance/list/${this.organization_id}/${this.event_id}`)
                .then(response => {
                    this.filtered_attendance = [];
                    const data = response.data;
                    data.forEach(item => {
                        console.log(item);
                        item['created_at'] = converTime(item['time']);
                        item['events']['start_date'] = convertDate(item['events']['start_date']);
                        this.event.event_title = item['events']['name'];
                        this.event.event_date = item['events']['start_date'];
                        this.attendance_count = item.events.attendance_count;
                    });
                    this.attendance = response.data;
                    this.filtered_attendance = this.attendance;
                    // console.log(this.attendance);
                    //   this.attendance.forEach(element => {
                    //     this.attendance_list.push({
                    //       student_id : element.user_id,
                    //       student_name: element.user.name,
                    //       college: element.college.college,
                    //     })
                    //   });

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
            // Clone the table element to avoid modifying the original table
            const tableToPrint = document.getElementById('accountabilities-table').cloneNode(true);

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
          <h5 id="Eventtitle"> Event: <b>${this.event.event_title}</b></h5>
          <p>Date: <b>${this.event.event_date}</b></p>

          <!-- Add Bootstrap table classes -->
          <table class="table table-bordered table-striped">
            <thead>
                  <tr>
                    <th>Student ID</th>
                        <th>Student Name</th>
                        <th>College</th>
                        <th style="width: 10%;">Time</th>
                  </tr>
              </thead>
              <tbody>
            ${this.generateTableRowsWithoutLastColumn(this.attendance)}
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

generateTableRowsWithoutLastColumn(data) {
let rows = '';
data.forEach(item => {
    rows += `
<tr>
    <td>${item.user_id}</td>
    <td>${item.user_profile.first_name} ${item.user_profile.middle_name} ${item.user_profile.last_name}</td>
    <td>${item.user_profile.college.college}</td>
    <td>${item.time}</td>
</tr>
`;
});
return rows;
},
        generateTableRows(data) {
            let rows = '';
            data.forEach(item => {
                rows += `
          <tr>
              <td>${item.user_id}</td>
              <td>${item.user.name}</td>
              <td>${item.college.college} </td>
              <td>${item.created_at} </td>
          </tr>
      `;
            });
            return rows;
        },
        downloadTable() {
            // Create a temporary download link
            const link = document.createElement('a');
            link.style.display = 'none';
            document.body.appendChild(link);

            // Generate CSV content from the table
            const csvContent = [];
            const headers = [
                ...document.querySelectorAll('#accountabilities-table th')
            ].map(header => header.innerText.replace(/"/g, '""'));
            csvContent.push(headers.join(','));

            // Add rows with all columns
            const rows = document.querySelectorAll('#accountabilities-table tbody tr');
            rows.forEach(row => {
                const columns = [
                    ...row.querySelectorAll('td')
                ].map(column => column.innerText.replace(/"/g, '""'));
                csvContent.push(columns.join(','));
            });

            // Convert CSV content to a Blob
            const csvBlob = new Blob(['\uFEFF' + csvContent.join('\n')], {
                type: 'text/csv;charset=utf8;'
            });

            // Set the link's href and download attributes
            link.href = window.URL.createObjectURL(csvBlob);
            link.download = `${this.event.event_title}_attendance_record.csv`;

            // Trigger the download
            link.click();

            // Clean up
            document.body.removeChild(link);
        },
    }
}

</script>
