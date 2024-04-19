@extends('layouts.main_layout')

@section('custom-title')
    <title> Member List</title>
@endsection
@section('main-content')
    <div class="page-content-wapper">
        <upload-students :org_id={{ Session::get('org_id') }} :school_year_session={{ Session::get('school_year') }}
            :user_school_year={{ Session::get('user_school_year') }}>
        </upload-students>
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
