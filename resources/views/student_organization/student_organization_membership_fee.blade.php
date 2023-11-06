@extends('layouts.student_organization_navigation_bar')
@section('main-content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

<link href="/custom_css/StudentAccountabilities.css" rel="stylesheet">
<div class="content">
    <div class="container">
        <div class="container breadcrumbs">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/login/org_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student Organization</li>
                <li class="breadcrumb-item active" aria-current="page">Accountabilities</li>
                <li class="breadcrumb-item active" aria-current="page">Membership Fee List</li>
            </ol>
            </nav>
        </div>
        <div class="mt-2">
            <div class="row head-container">
                <div class="col-md-6 col-sm-12">
                    <div class="input-container">
                        <i class="fa fa-search"></i>
                        <input type="text" placeholder="Search Event">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12" style="display: flex; align-items: center; justify-content: flex-end;">
                    <button class="btn sort-btn"><i class="bi bi-sort-up"></i></button>
                    <div class="select-dropdown">
                        <select id="sort-select" class="form-control" style="text-align: center;">
                            <option value="">Select Semester</option>
                            <option value="option1">1st Semester 2023-2024</option>
                            <option value="option2">2nd Semester 2022-2023</option>
                            <option value="option3">1st Semester 2022-2023</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

            <h4> <i class="fas fa-list mt-2"></i>  Student Accountabilities</h4>
            <div class="container" id="table-container">
                <div class="student-buttons d-flex justify-content-end">
                    <div class="btn-group" role="group">
                        <button class="btn me-2" id="add-student-list-button" onclick="printTableData()">
                            <i class="fas fa-print"></i> Print
                        </button>
                        <button class="btn me-2" id="add-student-button" onclick="  downloadTableData()">
                            <i class="fas fa-download"></i> Download
                        </button>
                    </div>
                </div>
            <div class="scroll-pane">
            <table  id="accountabilities-table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Membership Fee</th>
                        <th>Membership Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>2023-05-01</td>
                    <td>John Smith</td>
                    <td>$100</td>
                    <td>Unpaid</td>
                    <td>
                        <button class="edit-button ellipsis-button" onclick="editStudent(this)"><i class="bi bi-pencil-square"></i></button>
                        <button class="delete-button ellipsis-button"><i class="bi bi-trash"></i></button>
                    </td>
                    </tr>
                </tbody>
            </table>
            </div>
            <div class="pagination">
                <button id="first-page-button" onclick="goToPage(1)" disabled>&lt;&lt;</button>
                <button id="previous-page-button" onclick="previousPage()" disabled>&lt; Previous</button>
                <span id="pagination-numbers"></span>
                <button id="next-page-button" onclick="nextPage()">Next &gt;</button>
                <button id="last-page-button" onclick="goToPage(pageCount)">&gt;&gt;</button>
            </div>
            <div id="edit-modal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="event-modal-label">Edit Student Membership fee</h5>
                    </div>
                    <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="edit-student-id">Student ID:</label>
                            <input type="text" id="edit-student-id" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="edit-student-name">Student Name:</label>
                            <input type="text" id="edit-student-name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit-membership-fee">Membership Fee:</label>
                            <input type="text" id="edit-membership-fee" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit-membership-status">Membership Status:</label>
                            <select id="edit-membership-status" class="form-control">
                                <option value="Unpaid">Unpaid</option>
                                <option value="Paid">Paid</option>
                            </select>
                        </div>
                    </div>
                        <div class="modal-footer">
                        <button class="btn btn-danger" type="button" onclick="cancelEdit()">Cancel</button>
                        <button class="btn btn-success" type="button" onclick="saveEditedData()">Save</button>
                        </div>
                    </form>
                </div>
            </div>

    </div>
    </div>
</div>

    @endsection
      <!-- Bootstrap JavaScript -->
      {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    @section('custom-script')

    <script>
        const table = document.getElementById('accountabilities-table');
        const rows = table.querySelectorAll('tbody tr');
        const rowsPerPage = 8; // Adjust this to the desired number of rows per page
        let currentPage = 1;
        const pageCount = Math.ceil(rows.length / rowsPerPage);

        function updateTable() {
            const startIndex = (currentPage - 1) * rowsPerPage;
            const endIndex = startIndex + rowsPerPage;

            rows.forEach((row, index) => {
                if (index >= startIndex && index < endIndex) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Display all page numbers
            let paginationNumbers = '';
            for (let i = 1; i <= pageCount; i++) {
                paginationNumbers += `<button onclick="goToPage(${i})" ${i === currentPage ? 'class="active"' : ''}>${i}</button>`;
            }
            document.getElementById('pagination-numbers').innerHTML = paginationNumbers;

            document.getElementById('first-page-button').disabled = currentPage === 1;
            document.getElementById('previous-page-button').disabled = currentPage === 1;
            document.getElementById('next-page-button').disabled = currentPage === pageCount;
            document.getElementById('last-page-button').disabled = currentPage === pageCount;
        }

        function goToPage(page) {
            currentPage = page;
            updateTable();
        }

        function previousPage() {
            if (currentPage > 1) {
                currentPage--;
                updateTable();
            }
        }

        function nextPage() {
            if (currentPage < pageCount) {
                currentPage++;
                updateTable();
            }
        }

        // Initialize the table and pagination
        updateTable();
    </script>

<script>
   // Define a variable to store the currently edited row
let editingRow = null;

// Function to open the edit modal
function editStudent(button) {
    const row = button.closest('tr');
    const cells = row.querySelectorAll('td');
    const editModal = document.getElementById('edit-modal');

    // Populate the form fields with the data from the selected row
    document.getElementById('edit-student-id').value = cells[0].textContent;
    document.getElementById('edit-student-name').value = cells[1].textContent;
    document.getElementById('edit-membership-fee').value = cells[2].textContent;
    document.getElementById('edit-membership-status').value = cells[3].textContent;

    // Display the edit modal
    editModal.style.display = 'block';

    // Set the currently edited row
    editingRow = row;
}

// Function to save the edited data
function saveEditedData() {
    if (editingRow) {
        const cells = editingRow.querySelectorAll('td');

        // Update the table with the edited data from the form
        cells[0].textContent = document.getElementById('edit-student-id').value;
        cells[1].textContent = document.getElementById('edit-student-name').value;
        cells[2].textContent = document.getElementById('edit-membership-fee').value;

        // Get the selected values from the dropdowns
        const membershipStatusDropdown = document.getElementById('edit-membership-status');


        // Close the edit modal
        document.getElementById('edit-modal').style.display = 'none';

        // Clear the currently edited row
        editingRow = null;
    }
}

// Function to cancel the edit and close the modal
function cancelEdit() {
    document.getElementById('edit-modal').style.display = 'none';
    editingRow = null;
}
</script>
<script>
    function printTableData() {
   const table = document.getElementById('accountabilities-table');
   const rows = table.querySelectorAll('tbody tr');

   let tableData = '<table style="border-collapse: collapse;">'; // Add a style to remove the border

   // Add table headers excluding the last column (Actions)
   tableData += '<thead>';
   tableData += '<tr>';
   table.querySelectorAll('thead th').forEach(header => {
       if (header.textContent !== 'Actions') {
           tableData += '<th>' + header.textContent + '</th>';
       }
   });
   tableData += '</tr>';
   tableData += '</thead>';

   // Add table body, excluding the last column (Actions)
   tableData += '<tbody>';
   rows.forEach(row => {
       tableData += '<tr>';
       row.querySelectorAll('td').forEach((cell, index) => {
           if (index !== 6) { // Skip the last column (Actions)
               tableData += '<td>' + cell.textContent + '</td>';
           }
       });
       tableData += '</tr>';
   });
   tableData += '</tbody>';
   tableData += '</table>';

   // Open a new window and print the table data
   const printWindow = window.open('', '', 'width=600,height=600');
   printWindow.document.open();
   printWindow.document.write('<html><head><title>Printed Table</title></head><body>');
   printWindow.document.write('<h3>Student Accountabilities</h3>');
   printWindow.document.write(tableData);
   printWindow.document.write('</body></html>');
   printWindow.document.close();
   printWindow.print();
   printWindow.close();
}

function downloadTableData() {
   const table = document.getElementById('accountabilities-table');
   const clonedTable = table.cloneNode(true);

   // Remove the "Actions" column from the cloned table
   clonedTable.querySelectorAll('tr').forEach(row => {
       const cells = row.querySelectorAll('td, th');
       if (cells.length > 0) {
           cells[cells.length - 1].remove();
       }
   });

   // Create a new XLSX workbook and add the cloned table to it
   const ws = XLSX.utils.table_to_sheet(clonedTable);
   const wb = XLSX.utils.book_new();
   XLSX.utils.book_append_sheet(wb, ws, 'TableData');

   // Save the workbook as an XLSX file and trigger the download
   XLSX.writeFile(wb, 'table_data.xlsx');
}
</script>
@endsection
