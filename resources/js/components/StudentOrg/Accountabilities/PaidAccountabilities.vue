<template>
    <div class="col-md-6 col-sm-12">
        <div class="input-container">
            <i class="fa fa-search"></i>
            <input type="text" >
        </div>
    </div>
    <div class="col-md-6 col-sm-12" style="display: flex; align-items: center; justify-content: flex-end; gap: 20px;">


        <!-- {{-- <button class="btn sort-btn"><i class="fas fa-filter"></i></button> --}} -->

        <div class="select-dropdown" id= "semester-btn" style="width: 70%;">
            <!-- First dropdown -->
            <select id="sort-select" class="form-control" style="text-align: center; ">
                <option value="">Select Semester</option>
                <option value="option1">1st Semester 2023-2024</option>
                <option value="option2">2nd Semester 2022-2023</option>
                <option value="option3">1st Semester 2022-2023</option>
            </select>
        </div>
        <div class="select-dropdown" style="width: 30%;">
            <!-- Second dropdown -->
            <select id="sort-select" class="form-control" style="text-align: center;">
                <option value="" disabled selected><i class="fas fa-filter"></i> Sort by</option>
                <option value="fines">Fines</option>
                <option value="others">Other Accountability</option>
            </select>
        </div>
    </div>


    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center ">
            <h4 class="mb-0"><i class="fas fa-list mt-2"></i> Paid Accountabilities</h4>
            <div class="student-buttons d-flex">
                <div class="btn-group" role="group">
                    <button class="btn me-2" id="add-student-list-button" @click="printTable">
                        <i class="fas fa-print"></i> Print
                    </button>
                    <button class="btn me-2" id="add-student-button" @click="downloadTable">
                        <i class="fas fa-download"></i> Download
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="table-container" style="margin-left: 10px;">
    <div class="scroll-pane">
        <!-- fines accountabilities -->
        <table  id="accountabilities-table"  >
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Accountabilities</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody v-for="paid in this.paidList">
                <tr>
                <td >{{ paid['student_id'] }}</td>
                <td> {{ paid.user['name'] }}</td>
                <td>{{ paid['accountability_name'] }}</td>
                <td>{{ paid['amount'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
    <div class="pagination-container mt-3">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item active" aria-current="page">
            <a class="page-link" href="#">1 <span class="visually-hidden">(current)</span></a>
            </li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
            <a class="page-link" href="#">Next</a>
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

    props: ['org_id'],
    data(){
        return{
            paidList: [],


        }
    },

    mounted(){
        this.fetchData();
    },
    created(){


    },

    methods:{
        fetchData(){
                    axios.get(`/paid_accountabilities/${this.org_id}`)
                    .then(response => {
                        this.paidList = response.data;
                        console.log(this.paidList)
                    })
                    .catch(error => {
                        console.log('error')
                    });

                },



                printTable() {
    // Clone the table element to avoid modifying the original table
    const tableToPrint = document.getElementById('accountabilities-table').cloneNode(true);

    // Remove or hide the "Actions" column in each row
    const actionsColumnIndex = 4; // Assuming "Actions" is the fifth column (index 4)
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
            <!-- Add a title before the table -->
            <h2>Paid Accountabilities</h2>

            <!-- Add Bootstrap table classes -->
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

    downloadTable() {
        // Get the table data
        const tableData = this.getTableData();

        // Create a worksheet
        const ws = XLSX.utils.aoa_to_sheet(tableData);

        // Create a workbook
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'Sheet 1');

        // Save the workbook as an Excel file
        XLSX.writeFile(wb, 'PaidAccountabilitiesList.xlsx');
    },

    getTableData() {
        // Get a reference to the table
        const table = document.getElementById('accountabilities-table');

        // Initialize an array to store the table data
        const tableData = [];

        // Iterate through the rows of the table
        for (let i = 0; i < table.rows.length; i++) {
            const rowData = [];

            // Iterate through the cells of the current row, excluding the last one
            for (let j = 0; j < table.rows[i].cells.length; j++) {
            // Push the cell value to the rowData array
            rowData.push(table.rows[i].cells[j].textContent);
            }

            // Push the row data to the tableData array
            tableData.push(rowData);
        }

        // Return the table data
        return tableData;
},




    }


}

</script>
