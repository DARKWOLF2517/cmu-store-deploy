<template>
        <div class="scroll-pane">
            <table id="student-list-table">
            <thead>
                <tr>
                    <th>Student ID</th>
                                    <th>Last Name</th>
                                    <th>Full Name</th>
                                    <th>Year Level</th>
                </tr>
            </thead>
                <tbody id="studentTableBody" v-for="students in this.studentList" :id="students.student_id">
                    <!-- Student data will be added here -->
                        <td>{{ students['student_id'] }}</td>
                        <td>{{ students['user']['name'] }}</td>
                        <td>{{ students['year_level'] }}</td>


                        <td>
                            <button class="btn btn-danger delete-button">Delete</button>
                            <button class="btn btn-primary edit-button" data-bs-toggle="modal" data-bs-target="#event-modal" @click="this.fetchID = students.student_id, this.fetchDataEdit()" >Edit</button>
                        </td>
                
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


        
        <!-- Modal for displaying Excel data -->
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
                                    <th>Last Name</th>
                                    <th>Middle Name</th>
                                    <th>First Name</th>
                                    <th>Suffix Name</th>
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
                        <button type="button" class="btn btn-primary" id="uploadToTableButton" @click="this.uploadData()">Upload</button>
                    </div>
                </div>
            </div>
        </div>

    <!-- Modal for editing student data
    <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit="this.submit">
                        <div class="form-group">
                            <label for="studentId">Student ID</label>
                            <input type="text" class="form-control" id="studentId" v-model="this.editData['student_id']" disabled>
                        </div>
                        <div class="form-group">
                            <label for="studentName">Name</label>
                            <input type="text" class="form-control" id="studentName"  v-model="this.editData['name']">
                        </div>
                        <div class="form-group">
                            <label for="studentEmail">Institutional Email</label>
                            <input type="text" class="form-control" id="studentEmail" v-model="this.editData['email']">
                        </div>
                        <div class="form-group">
                            <label for="yearLevel">Year Level</label>
                            <input type="text" class="form-control" id="yearLevel" v-model="this.editData['year_level']">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveStudentChanges" @click="this.updateData()">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
 -->


                <!--Modal for editing student data -->
                <div class="modal fade" id="event-modal" tabindex="-1" aria-labelledby="event-modal-label" aria-hidden="true" >
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="event-modal-label">Create Event</h5>
                                </div>
                                <div class="modal-body">
                                    <form @submit="this.updateData"  id="eventsForm"  >
                                        <div class="form-group">
                                        <label for="studentId">Student ID</label>
                                        <input type="text" class="form-control" id="studentId" v-model="this.editData['student_id']" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="studentName">Name</label>
                                            <input type="text" class="form-control" id="studentName"  v-model="this.editData['name']">
                                        </div>
                                        <div class="form-group">
                                            <label for="studentEmail">Institutional Email</label>
                                            <input type="text" class="form-control" id="studentEmail" v-model="this.editData['email']">
                                        </div>
                                        <div class="form-group">
                                            <label for="yearLevel">Year Level</label>
                                            <input type="text" class="form-control" id="yearLevel" v-model="this.editData['year_level']">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" id="save-event-button">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>




</template>

<script>

export default{
props: ['org_id'],
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
    }

},
mounted(){
    this.upload();
    this.fetchData();

},
methods:{
    fetchData(){
        axios.get(`/student_list/show/${this.org_id}`)
            .then(response => {
                
                this.studentList = response.data;
            })
            .catch(error => {

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
