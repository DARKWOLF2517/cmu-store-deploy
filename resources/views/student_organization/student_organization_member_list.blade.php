
@extends('layouts.student_organization_navigation_bar')

@section('main-content')

<div class="content">
    <div class="container">
        <div class="container breadcrumbs">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/login/dashboard">Dashboard</a></li>
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
    <h4><i class="fas fa-list mt-2"></i> Student List</h4>
      <div class="container" id="table-container">

            <div class="student-buttons d-flex justify-content-end">
                <div class="btn-group" role="group">
                    <button class="btn me-2" id="add-student-list-button" data-bs-toggle="modal" data-bs-target="#editModal">
                        <i class="fas fa-user-plus"></i>  Add student
                    </button>
                    {{-- <input type="file" id="fileInput" accept=".xlsx" style="display: none;">
                    <button class="btn me-2" id="add-student-button"  onclick="document.getElementById('fileInput').click()">
                    <i class="fas fa-file-excel"></i> Add student list
                    </button> --}}
                    <button id="uploadButton" class="btn me-2">Upload Student List</button>
                    <input type="file" id="fileInput" accept=".xls, .xlsx" style="display: none;">
                </div>
            </div>
            {{-- <div class="scroll-pane"> --}}
                {{-- <member-list
                organization_id = {{Session::get('org_id')}}
                >

                </member-list> --}}
            {{-- </div> --}}
        {{-- <div class="scroll-pane">
            <table id="student-list-table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Institutional Email</th>
                        <th>Year Level</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <!-- Student data will be added here -->
                        <td>1</td>
                        <td>John Doe</td>
                        <td>2</td>
                        <td>Engineering</td>
                        <td>
                            <button class="btn btn-danger delete-button">Delete</button>
                            <button class="btn btn-primary edit-button">Edit</button>
                        </td>
                        </tr> 
                </tbody>
        

        
            </table>
        </div> --}}
        
        <upload-students
        org_id = {{Session::get('org_id')}}
        >

        </upload-students>
    </div>

    </div>
    </div>

        

  <!-- Include Bootstrap and jQuery JavaScript -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


      <!-- Include exceljs for parsing Excel files -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.4.0/exceljs.min.js"></script>

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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.min.js"></script> --}}

    <!-- Include exceljs for parsing Excel files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.4.0/exceljs.min.js"></script>

    @endsection

    @section('custom-script')
    <script>
    // document.onreadystatechange = () => {
    //   if(document.readyState === "complete")
    //   {

    //     const table = document.getElementById('student-list-table');
    //     const rowsPerPage = 10;
    //     const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    //     const pageCount = Math.ceil(rows.length / rowsPerPage);
    //     const firstPageButton = document.getElementById('first-page-button');
    //     const previousPageButton = document.getElementById('previous-page-button');
    //     const nextPageButton = document.getElementById('next-page-button');
    //     const lastPageButton = document.getElementById('last-page-button');
    //     const paginationNumbers = document.getElementById('pagination-numbers');
    //     let currentPage = 1;

    //     function showPage(page) {
    //       const startIndex = (page - 1) * rowsPerPage;
    //       const endIndex = startIndex + rowsPerPage;

    //       for (let i = 0; i < rows.length; i++) {
    //         rows[i].style.display = i >= startIndex && i < endIndex ? 'table-row' : 'none';
    //       }
    //     }

    //     function updatePaginationButtons() {
    //       firstPageButton.disabled = currentPage === 1;
    //       previousPageButton.disabled = currentPage === 1;
    //       nextPageButton.disabled = currentPage === pageCount;
    //       lastPageButton.disabled = currentPage === pageCount;
    //     }

    //     function updatePaginationNumbers() {
    //       let paginationHTML = '';
    //       for (let i = 1; i <= pageCount; i++) {
    //         const buttonClass = i === currentPage ? 'page-number-button current-page' : 'page-number-button';
    //         paginationHTML += `<button class="${buttonClass}" data-page="${i}">${i}</button>`;
    //       }
    //       paginationNumbers.innerHTML = paginationHTML;

    //       const pageButtons = document.getElementsByClassName('page-number-button');
    //       for (let i = 0; i < pageButtons.length; i++) {
    //         const pageButton = pageButtons[i];
    //         pageButton.addEventListener('click', function() {
    //           const page = parseInt(this.getAttribute('data-page'));
    //           currentPage = page;
    //           showPage(currentPage);
    //           updatePaginationButtons();
    //           updatePaginationNumbers();
    //         });
    //       }
    //     }

    //     function updatePagination() {
    //       updatePaginationButtons();
    //       updatePaginationNumbers();
    //     }

    //     firstPageButton.addEventListener('click', function() {
    //       currentPage = 1;
    //       showPage(currentPage);
    //       updatePagination();
    //     });

    //     previousPageButton.addEventListener('click', function() {
    //       if (currentPage > 1) {
    //         currentPage--;
    //         showPage(currentPage);
    //         updatePagination();
    //       }
    //     });

    //     nextPageButton.addEventListener('click', function() {
    //       if (currentPage < pageCount) {
    //         currentPage++;
    //         showPage(currentPage);
    //         updatePagination();
    //       }
    //     });

    //     lastPageButton.addEventListener('click', function() {
    //       currentPage = pageCount;
    //       showPage(currentPage);
    //       updatePagination();
    //     });

    //     showPage(currentPage);
    //     updatePagination();

    //       // Function to handle the file upload
    //     document.getElementById("uploadButton").addEventListener("click", function() {
    //         document.getElementById("fileInput").click();
    //     });

    //     document.getElementById("fileInput").addEventListener("change", function(e) {
    //         const file = e.target.files[0];
    //         if (file) {
    //             parseExcelData(file);
    //         }
    //     });


    //     // Function to parse the uploaded Excel file
    //     async function parseExcelData(file) {
    //         const workbook = new ExcelJS.Workbook();
    //         const reader = new FileReader();

    //         reader.onload = async function(e) {
    //             const buffer = e.target.result;
    //             await workbook.xlsx.load(buffer);
    //             const worksheet = workbook.getWorksheet(1); // Assuming data is in the first worksheet

    //             // Clear the existing table content
    //             const tableBody = document.getElementById("studentTableBody");
    //             tableBody.innerHTML = "";

    //             // Populate the table with student data
    //             worksheet.eachRow({ includeEmpty: false }, function(row, rowNumber) {
    //                 if (rowNumber === 1) return; // Skip the header row
    //                 const student = row.values;
    //                 const studentArray = student.slice(1); // Exclude the first empty cell

    //                 const newRow = document.createElement("tr");
    //                 newRow.innerHTML = `
    //                     <td>${studentArray[0]}</td>
    //                     <td>${studentArray[1]}</td>
    //                     <td>${studentArray[2]}</td>
    //                     <td>${studentArray[3]}</td>
    //                     <td>
    //                         <button class="btn btn-danger delete-button">Delete</button>
    //                         <button class="btn btn-primary edit-button">Edit</button>
    //                     </td>
    //                 `;

    //                 tableBody.appendChild(newRow);
    //             });
    //         };

    //         reader.readAsArrayBuffer(file);
    //     }

    //     // Function to handle the "Edit" button click
    //     document.getElementById("studentTableBody").addEventListener("click", function(e) {
    //         if (e.target && e.target.classList.contains("edit-button")) {
    //             const row = e.target.closest("tr");
    //             const cells = row.querySelectorAll("td");

    //             // Disable the Edit button
    //             e.target.disabled = true;

    //             // Enable editing of the student details
    //             for (let i = 0; i < cells.length - 1; i++) {
    //                 const cellContent = cells[i].textContent;
    //                 const input = document.createElement("input");
    //                 input.value = cellContent;
    //                 cells[i].textContent = "";
    //                 cells[i].appendChild(input);
    //             }

    //             // Create a Save button
    //             const saveButton = document.createElement("button");
    //             saveButton.textContent = "Save";
    //             saveButton.classList.add("btn", "btn-success");
    //             row.querySelector(".edit-button").insertAdjacentElement("beforebegin", saveButton);

    //             // Handle saving changes
    //             saveButton.addEventListener("click", function() {
    //                 // Update the table with the edited details
    //                 for (let i = 0; i < cells.length - 1; i++) {
    //                     const input = cells[i].querySelector("input");
    //                     cells[i].textContent = input.value;
    //                 }

    //                 // Remove the Save button and re-enable the Edit button
    //                 saveButton.remove();
    //                 e.target.disabled = false;
    //             });
    //         }
    //     });
    //   }
    // }
      </script>


@endsection
