
@extends('layouts.student_organization_navigation_bar')

@section('main-content')

<div class="page-content-wapper">
    <div class="content">
        <div class="page-container">
        <div class="col breadcrumbs">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/login/org_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student Organization</li>
                <li class="breadcrumb-item active" aria-current="page">Student List</li>
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
                <div class="col-md-6 col-sm-12" >
                    {{-- <button class="btn sort-btn"><i class="bi bi-sort-up"></i></button> --}}
                    <div class="select-dropdown d-flex justify-content-end">
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

        <h4><i class="fas fa-list mt-2"></i> Student List</h4>
        <div class="container" id="table-container">

                <div class="student-buttons d-flex justify-content-end">
                    <div class="btn-group" role="group">
                        <button  class="btn me-2" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                            <i class="fas fa-plus"></i> Tag Student
                        </button>


                        {{-- <input type="file" id="fileInput" accept=".xlsx" style="display: none;">
                        <button class="btn me-2" id="add-student-button"  onclick="document.getElementById('fileInput').click()">
                        <i class="fas fa-file-excel"></i> Add student list
                        </button> --}}
                        <button id="uploadButton" class="btn me-2" data-bs-toggle="modal" > <i class="fas fa-file-upload"></i> Upload List</button>
                        <input type="file" id="fileInput" accept=".xls, .xlsx" style="display: none;">

                        <a class="ellipsis-button btn btn-light" href="#" role="button" id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color: black">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                            <!-- option 1 -->
                            <li><a class="dropdown-item"  id="downloadButton">Download Template</a></li>

                        </ul>
                    </div>
                    </div>

                    <!-- Add student Modal -->
                    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form>
                                    <div class="mb-3">
                                        <label for="studentId" class="form-label">Student ID</label>
                                        <input type="text" class="form-control" id="studentId">
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Student Name</label>
                                        <input type="text" class="form-control" id="name">
                                    </div>

                                    <div class="mb-3">
                                    <label for="reason" class="form-label">Year-level</label>
                                    <select class="form-select" id="yr-level">
                                        <option value="1st">1st year level</option>
                                        <option value="2nd">2nd year level</option>
                                        <option value="3rd">3rd year level</option>
                                        <option value="4th">4th year level</option>
                                        <option value="4th">5th year level</option>
                                        <option value="4th">6th year level</option>
                                    </select>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

            <upload-students
            org_id = {{Session::get('org_id')}}
            >
            </upload-students>
        </div>

    </div>
</div>

</div>


{{-- <script>
    export default {
        methods: {
        downloadFile() {
            // Define the file name
            var fileName = 'template.xlsx';

            // Create a Blob containing the Excel file data
            var blob = new Blob([], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });

            // Create a virtual link element
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = fileName;

            // Trigger a click on the link element to initiate the download
            document.body.appendChild(link);
            link.click();

            // Remove the link element from the DOM
            document.body.removeChild(link);
        },
        },
    };
</script> --}}
{{-- <script>


            // Function to handle the file upload
            document.getElementById("uploadButton").addEventListener("click", function () {
                document.getElementById("fileInput").click();
            });

            document.getElementById("fileInput").addEventListener("change", function (e) {
                const file = e.target.files[0];
                if (file) {
                    parseExcelData(file);
                }
            });

            // Function to parse the uploaded Excel file and display it in the modal
            async function parseExcelData(file) {
            const workbook = new ExcelJS.Workbook();
            const reader = new FileReader();

            reader.onload = async function (e) {
            const buffer = e.target.result;
            await workbook.xlsx.load(buffer);
            const worksheet = workbook.getWorksheet(1); // Assuming data is in the first worksheet

            // Clear the existing table content
            const tableBody = document.getElementById("modalStudentTableBody");
            tableBody.innerHTML = "";

            // Populate the table with student data
            worksheet.eachRow({ includeEmpty: false }, function (row, rowNumber) {
                if (rowNumber === 1) return; // Skip the header row
                const studentArray = [];

                row.eachCell({ includeEmpty: false }, function (cell, colNumber) {
                    let cellValue = cell.text;
                    if (cell.hyperlink && cell.hyperlink.address) {
                        // If the cell contains a hyperlink, use the hyperlink's address as the cell value
                        cellValue = cell.hyperlink.address;
                    }
                    studentArray.push(cellValue);
                });

                const newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td>${studentArray[0] || ""}</td>
                    <td>${studentArray[1] || ""}</td>
                    <td>${studentArray[2] || ""}</td>
                    <td>${studentArray[3] || ""}</td>
                    <td>
                        <button class="btn btn-danger delete-button">Delete</button>
                        <button class="btn btn-primary edit-button">Edit</button>
                    </td>
                `;

                tableBody.appendChild(newRow);
            });
        };

    reader.readAsArrayBuffer(file);
    }

        // Function to upload data from the modal to the main table
        document.getElementById("uploadToTableButton").addEventListener("click", function () {
        const modalTableBody = document.getElementById("modalStudentTableBody");
        const tableBody = document.getElementById("studentTableBody");

        // Clone the rows from the modal and append them to the main table with "Edit" and "Delete" buttons in the last cell
        const modalRows = modalTableBody.querySelectorAll("tr");
        modalRows.forEach(function (row) {
            const newRow = row.cloneNode(true);

            // Create a cell for "Edit" and "Delete" buttons in the last column
            const actionsCell = document.createElement("td");

            // Add "Edit" button
            const editButton = document.createElement("button");
            editButton.textContent = "Edit";
            editButton.classList.add("btn", "btn-primary", "edit-button");
            actionsCell.appendChild(editButton);

            // Add "Delete" button
            const deleteButton = document.createElement("button");
            deleteButton.textContent = "Delete";
            deleteButton.classList.add("btn", "btn-danger", "delete-button");
            actionsCell.appendChild(deleteButton);

            // Append the actions cell to the new row
            newRow.appendChild(actionsCell);

            // Append the new row to the main table
            tableBody.appendChild(newRow);
        });

        // Hide the modal
        const excelDataModal = new bootstrap.Modal(document.getElementById("excelDataModal"));
        excelDataModal.hide();
    });

            // Function to handle the "Delete" button click
            document.getElementById("studentTableBody").addEventListener("click", function (e) {
                if (e.target && e.target.classList.contains("delete-button")) {
                    const row = e.target.closest("tr");
                    if (confirm("Are you sure you want to delete this student?")) {
                        // If the user confirms the deletion, remove the row from the table
                        row.remove();
                    }
                }
            });

            // Function to handle the "Edit" button click
            document.getElementById("studentTableBody").addEventListener("click", function (e) {
                if (e.target && e.target.classList.contains("edit-button")) {
                    const row = e.target.closest("tr");
                    const cells = row.querySelectorAll("td");

                    // Disable the Edit button
                    e.target.disabled = true;

                    // Enable editing of the student details
                    for (let i = 0; i < cells.length - 1; i++) {
                        const cellContent = cells[i].textContent;
                        const input = document.createElement("input");
                        input.value = cellContent;
                        cells[i].textContent = "";
                        cells[i].appendChild(input);
                    }

                    // Create a Save button
                    const saveButton = document.createElement("button");
                    saveButton.textContent = "Save";
                    saveButton.classList.add("btn", "btn-success");
                    row.querySelector(".edit-button").insertAdjacentElement("beforebegin", saveButton);

                    // Handle saving changes
                    saveButton.addEventListener("click", function () {
                        // Update the table with the edited details
                        for (let i = 0; i < cells.length - 1; i++) {
                            const input = cells[i].querySelector("input");
                            cells[i].textContent = input.value;
                        }

                        // Remove the Save button and re-enable the Edit button
                        saveButton.remove();
                        e.target.disabled = false;
                    });
                }
            });
</script> --}}

{{-- WALA NI LABOT ANG SA UBOS NA --}}

    <!-- Include Bootstrap and jQuery JavaScript -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.min.js"></script> --}}

    <!-- Include exceljs for parsing Excel files -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.4.0/exceljs.min.js"></script> --}}

@endsection

@section('custom-script')
    <!-- Include Bootstrap and jQuery JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>



    <!-- Include exceljs for parsing Excel files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.4.0/exceljs.min.js"></script>

@endsection
