<template>
    <div class="col-md-6 col-sm-12">
        <div class="input-container">
            <i class="fa fa-search"></i>
            <input type="text" placeholder="Search Student" v-model="searchTerm" @input="filterItems">
        </div>
    </div>
    <div class="col-md-6 col-sm-12" style="display: flex; align-items: center; justify-content: flex-end; gap: 20px;">


        <!-- {{-- <button class="btn sort-btn"><i class="fas fa-filter"></i></button> --}} -->

        <div class="select-dropdown" id= "semester-btn" style="width: 70%;">
            <!-- First dropdown -->
            <select id="sort-select" class="form-control" style="text-align: center;" v-model="school_year_input"  @change="fetchData">
                <option value="" disabled selected>Select Semester</option>
                <option v-for="school_year in this.school_year" :value="school_year['id']" >{{ school_year['school_year'] }}</option>

            </select>
        </div>
        <!-- <div class="select-dropdown" style="width: 30%;">

            <select id="sort-select" class="form-control" style="text-align: center;">
                <option value="" disabled selected><i class="fas fa-filter"></i> Sort by</option>
                <option value="fines">Fines</option>
                <option value="others">Other Accountability</option>
            </select>
        </div> -->
    </div>


    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center ">
            <h4 class="mb-0"><i class="fas fa-list mt-2"></i> Paid Accountabilities</h4>
            <div class="student-buttons d-flex">
                <div class="btn-group" role="group">
                    <button class="btn me-2"  @click="printTable">
                        <i class="fas fa-print"></i> Print
                    </button>
                    <button class="btn me-2" @click="downloadTable">
                        <i class="fas fa-download"></i> Download
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="table-container">
    <div class="scroll-pane">
        <!-- fines accountabilities -->
        <table id="accountabilities-table"   >
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <!-- <th>Accountabilities</th> -->
                    <th>Date Received</th>
                    <th style="width: 10%;">Amount</th>
                    <th>Remarks</th>

                </tr>
            </thead>
            <tbody>
                <div v-if="this.loading == true" class="loading-spinner-container ">
                    <span class="loader"></span>
                </div>
                <div class="Container-IfEmpty" v-if="!loading && paidList.length === 0">
                    <div class="Empty-Message text-center">
                    <i class="icon 	bi bi-table" id="icon-message"></i>
                    <p class="text-muted"><b>Paid table is empty.</b>
                    <br>
                    Students with cleared accountabilities are listed here</p>
                </div>
                </div>
                <tr v-for="paid in paginatedData" :key="paid.student_id" style="height: 50px;">
                    <td >{{ paid['student_id'] }}</td>
                    <td> {{ paid.user_profile.first_name  + ' '+ paid.user_profile.last_name}}</td>
                    <!-- <td>{{ paid['accountability_name'] }}</td> -->
                    <td> {{ paid['created_at'] }}</td>
                    <td style="text-align: right; font-weight: bold;"> &#8369; {{ paid['amount'] }}.00</td>
                    <td>shshs</td>
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

        <div id="edit-modal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="event-modal-label">Edit Student Membership fee</h5>
                </div>
            </div>
        </div>
<!-- Confirmation Delete Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirm Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to mark this as paid?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#viewAllAccountabilitiesModal" @click="payment()">Yes, Mark as Paid</button>
            </div>
        </div>
    </div>
</div>

</template>

<script>
import { convertDate } from '../Functions/DateConverter';

export default{

    props: ['org_id', 'school_year_session'],
    data(){
        return{
            paidList: [],
            currentPage: 1,
            itemsPerPage: 10,
            loading : false,
            school_year_input: this.school_year_session,
            school_year: [],
            searchTerm: '',
            filtered_paid_accountabilities: [],
        }
    },
    computed: {
    totalPages() {
        return Math.ceil(this.paidList.length / this.itemsPerPage);
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
        return this.filtered_paid_accountabilities.slice(start, start + this.itemsPerPage);
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

    mounted(){
        this.fetchData();
        this.showSchoolYear();
    },
    created(){


    },

    methods:{

    filterItems() {
        let filteredBySearch = this.paidList;
                if (this.searchTerm) {
                    const searchTermLower = this.searchTerm.toLowerCase();
                    filteredBySearch = filteredBySearch.filter(item => (item.user_profile.first_name +''+ item.user_profile.last_name).toLowerCase().includes(searchTermLower) ||
                        item.student_id.toString().includes(this.searchTerm)
                    );
                }
        this.filtered_paid_accountabilities = filteredBySearch;
    },
        showSchoolYear() {
            axios.get(`get_school_year`)
                .then((response) => {
                    this.school_year = response.data;

                })
                .catch((error) => {
                    console.log(error)
                });
        },
        fetchData(){
            this.loading = true;
                    axios.get(`/paid_accountabilities/${this.org_id}/${this.school_year_input}`)
                    .then(response => {
                        const data = response.data;
                        data.forEach(item => {
                            item["created_at"] = convertDate(item["created_at"]);
                        });
                        this.paidList = response.data;
                        console.log(this.paidList)
                        this.loading = false;

                        this.filtered_paid_accountabilities = this.paidList;
                    })
                    .catch(error => {
                        console.log('error')
                    });

                },
                prevPage() {
        if (this.currentPage > 1) {
        this.currentPage--;
        }
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

    const actionsColumnIndex = 5;
    const rows = tableToPrint.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        if (cells.length > actionsColumnIndex) {
            // Remove the cell from the DOM
            cells[actionsColumnIndex].parentNode.removeChild(cells[actionsColumnIndex]);
        }
    }

    // Hide the header cell for the "Actions" column
    const headerRow = tableToPrint.getElementsByTagName('thead')[0].getElementsByTagName('tr')[0];
    if (headerRow) {
        const headerCell = headerRow.getElementsByTagName('th')[actionsColumnIndex];
        if (headerCell) {
            headerCell.style.display = 'none';
        }
    }

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
            <h2>Paid Accountabilities</h2>

            <table class="table table-bordered table-striped">
                ${tableToPrint.innerHTML}
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
              <td>${item.user_profile.first_name } ${item.user_profile.middle_name} ${item.user_profile.last_name}</td>
              <td>${item.created_at}</td>
              <td style = "font-weight: bold;">&#8369; ${item.amount}.00</td>
              <td>sd</td>
          </tr>
      `;
  });
  return rows;
},
downloadTable() {
  // Get the table data specifically from paidList
  const tableData = this.getPaidListTableData();

  // Create a workbook
  const wb = XLSX.utils.book_new();
  const ws = XLSX.utils.aoa_to_sheet(tableData);
  XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

  // Save the workbook as an Excel file
  XLSX.writeFile(wb, 'Paid_Students.xlsx');
},

getPaidListTableData() {
  // Get a reference to the paidList data

  const data = this.paidList;

  // Initialize an array to store the table data
  const tableData = [['Student ID', 'Student Name', 'Date Received', 'Amount']];


  // Iterate through the paidList data
  for (let i = 0; i < data.length; i++) {
    const rowData = [];

    // Add the desired data fields to the rowData array
    rowData.push(data[i].student_id);
    rowData.push(data[i].user_profile.first_name + ' ' + data[i].user_profile.last_name);
    rowData.push(data[i].created_at);
    rowData.push(data[i].amount);

    // Push the row data to the tableData array
    tableData.push(rowData);
  }

  // Return the table data
  return tableData;
},




    }


}

</script>
