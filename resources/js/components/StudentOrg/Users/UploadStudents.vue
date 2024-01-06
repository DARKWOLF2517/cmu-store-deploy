<template>
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
                            <input type="text" placeholder="Search Event" v-model="searchTerm" @input="filterItems">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12" >
                    
                        <div class="select-dropdown d-flex justify-content-end">
                            <select id="sort-select" class="form-control" style="text-align: center;" v-model="school_year_input"  @change="fetchData">
                                <option value="0" disabled selected>Select School Year</option>
                                <option v-for="school_year in this.school_year" :value="school_year['id']" >{{ school_year['school_year'] }}</option>
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
                        <button id="uploadButton" class="btn me-2"> <i class="fas fa-file-upload"></i> Upload List</button>
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

                <div class="scroll-pane">
                    <table id="student-list-table">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                                            <!-- <th>Last Name</th> -->
                            <th>Full Name</th>
                            <th>Year Level</th>
                            <th style="width: 20%;">Actions</th>
                        </tr>
                    </thead>
                        <tbody id="studentTableBody" v-for="students in this.filtered_student_list" :id="students.student_id">
                            <!-- Student data will be added here -->
                                <td>{{ students.student_id }}</td>
                                <td>{{ students.user.name }}</td>
                                <td>{{ students.year_level.year_level }}</td>


                                <td>
                                    <button class="btn edit-button" data-bs-toggle="modal" data-bs-target="#studentmodal" @click="this.fetchID = students.student_id, this.fetchDataEdit()" > <i class="fas fa-edit"></i> Edit</button>
                                    <button class="btn delete-button" data-bs-toggle="modal" data-bs-target="#deleteConfirmation"> <i class="fas fa-trash"></i> Delete</button>
                                </td>
                        </tbody>
                    </table>
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

                <!-- Edit Student -->
                <div class="modal fade" id="studentmodal" tabindex="-1" aria-labelledby="student-modal-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="student-modal-label">Edit Student</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Your form for editing student details goes here -->
                                <form>
                                    <div class="mb-3">
                                        <label for="editStudentID" class="form-label">Student ID</label>
                                        <input type="text" class="form-control" id="editStudentID" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="editFullName" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="editFullName">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editYearLevel" class="form-label">Year Level</label>
                                        <input type="text" class="form-control" id="editYearLevel">
                                    </div>
                                    <!-- Add other fields as needed -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success" >Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteConfirmation" tabindex="-1" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteConfirmationLabel">Confirm Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this student?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" @click="deleteStudent()">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal for displaying Excel data before Uploading -->
                <div class="modal fade" id="excelDataModal" tabindex="-1" aria-labelledby="excelDataModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="excelDataModalLabel">Excel Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table" id="tableModal">
                                    <thead>
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Full Name</th>
                                            <th>Year Level</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modalStudentTableBody">
                                        <!-- Excel data will be displayed here -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="excelDataModal">Close</button>
                                <button type="button" class="btn btn-success" id="uploadToTableButton" @click="this.uploadData()">Upload</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> 


</template>

<script>

export default{
props: ['org_id','school_year_session'],
data(){
    return{
        submit: this.updateData,
        fetchID: '',
        collectedData:[],
        studentList:[],
        editData: {
            student_id: '',
            name: '',
            email: '',
            year_level: '',
        },
        school_year:[],
        school_year_input: this.school_year_session,
        searchTerm: '',
        filtered_student_list: [],
    }

},
mounted(){
    this.upload();
    this.fetchData();
    this.showSchoolYear();
    console.log('mounted')
},
methods:{
    filterItems() {
        // Filter based on searchTerm from textbox
        let filteredBySearch = this.studentList;
        if (this.searchTerm) {
            const searchTermLower = this.searchTerm.toLowerCase();
            filteredBySearch = filteredBySearch.filter(item =>
                item.user.name.toLowerCase().includes(searchTermLower)
            );
        }
            this.filtered_student_list = filteredBySearch;
    },
    fetchData(){
        axios.get(`/student_list/show/${this.org_id}/${this.school_year_input}`)
            .then(response => {
                this.studentList = response.data;
                this.filtered_student_list = this.studentList;
            })
            .catch(error => {

            });
    },
    showSchoolYear(){
        axios.get(`get_school_year/${this.org_id}`)
            .then(response => {
                // console.log(response.data)
                this.school_year = response.data;
                console.log(response.data)
            })
            .catch(error => {
                console.log(error)
            });
    },
    fetchDataEdit(){
        axios.get(`/student_list/edit/${this.fetchID}`)
            .then(response => {
                const data = response.data;
                    data.forEach(item => {
                    this.editData.student_id = item['student_id'];
                    this.editData.name = item['user']['name'];
                    this.editData.email = item['user']['email'];
                    this.editData.year_level = item['year_level']
                    });
            })
            .catch(error => {

            });
    },
    updateData(){
        axios.put(`/student_list/edit/commit/${this.fetchID}`, this.editData)
                .then(response => {
                    console.log(response.data)
                    alert('adf')

                })
                .catch(error => {
                    alert( error)
                });
    },
    uploadData(){
        // Get a reference to the table
        var table = document.getElementById("tableModal");

        // Initialize an empty array to store the data
        var data = [];

        // Iterate through the table rows and cells
        for (var i = 1; i < table.rows.length; i++) {
            var row = table.rows[i];
            var rowData = [];

            for (var j = 0; j < row.cells.length; j++) {
                var cell = row.cells[j];

                rowData.push(cell.textContent);

            }

        data.push(rowData);
        }
        // data.forEach((data=>{
        //
        // }));
        this.collectedData = data;
        // console.log(data)
        // Display the extracted data in the console

            axios.post('/upload_students', { data: this.collectedData })
                .then(response => {
                    console.log(response.data)
                    // location.reload();
                })
                .catch(error => {
                    console.log(error)

                    });


    },
    upload(){
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

            // Populate the table with student data, excluding the first row
            let isHeaderRow = true;
            worksheet.eachRow({ includeEmpty: true }, function (row) {
                if (isHeaderRow) {
                    isHeaderRow = false; // Skip the first row (header row)
                    return;
                }

                const newRow = document.createElement("tr");

                row.eachCell({ includeEmpty: true }, function (cell) {
                    let cellValue = cell.text;
                    if (cell.hyperlink && cell.hyperlink.address) {
                        // If the cell contains a hyperlink, use the hyperlink's address as the cell value
                        cellValue = cell.hyperlink.address;
                    }

                    const newCell = document.createElement("td");
                    newCell.textContent = cellValue || ""; // Use an empty string if cellValue is falsy
                    newRow.appendChild(newCell);
                });

                tableBody.appendChild(newRow);
            });

            // Show the modal
            const excelDataModal = new bootstrap.Modal(document.getElementById("excelDataModal"), { keyboard: false });
            excelDataModal.show();
        };

        reader.readAsArrayBuffer(file);
    }



        // // Function to handle the "Delete" button click
        // document.getElementById("modalStudentTableBody").addEventListener("click", function (e) {
        //     if (e.target && e.target.classList.contains("delete-button")) {
        //         const row = e.target.closest("tr");
        //         if (confirm("Are you sure you want to delete this student?")) {
        //             // If the user confirms the deletion, remove the row from the table
        //             row.remove();
        //         }
        //     }
        // });

        // // Function to handle the "Edit" button click
        // document.getElementById("modalStudentTableBody").addEventListener("click", function (e) {
        //     if (e.target && e.target.classList.contains("edit-button")) {
        //         const row = e.target.closest("tr");
        //         const cells = row.querySelectorAll("td");

        //         // Disable the Edit button
        //         e.target.disabled = true;

        //         // Enable editing of the student details
        //         for (let i = 0; i < cells.length - 1; i++) {
        //             const cellContent = cells[i].textContent;
        //             const input = document.createElement("input");
        //             input.value = cellContent;
        //             cells[i].textContent = "";
        //             cells[i].appendChild(input);
        //         }

        //         // Create a Save button
        //         const saveButton = document.createElement("button");
        //         saveButton.textContent = "Save";
        //         saveButton.classList.add("btn", "btn-success");
        //         row.querySelector(".edit-button").insertAdjacentElement("beforebegin", saveButton);

        //         // Handle saving changes
        //         saveButton.addEventListener("click", function () {
        //             // Update the table with the edited details
        //             for (let i = 0; i < cells.length - 1; i++) {
        //                 const input = cells[i].querySelector("input");
        //                 cells[i].textContent = input.value;
        //             }

        //             // Remove the Save button and re-enable the Edit button
        //             saveButton.remove();
        //             e.target.disabled = false;
        //         });
        //     }
        // });
    }


}
}
</script>
