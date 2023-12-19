<template>
    <div class="col-md-6 col-sm-12">
        <div class="input-container">
            <i class="fa fa-search"></i>
            <input type="text" v-model="searchTerm"   @input="filterItems" placeholder="Search Accountabilities" >
        </div>
    </div>
    <div class="col-md-4 col-sm-12" style="display: flex; align-items: center; justify-content: flex-end; margin-right: 20px;">
        <div class="select-dropdown">
            <!-- First dropdown -->
            <select id="sort-select" class="form-control" style="text-align: center;" v-model="this.select_accountability">
                <option value="" disabled selected><i class="fas fa-filter"></i> Sort by</option>
                <option value="fines">Fines</option>
                <option value="others">Other Accountability</option>
            </select>
        </div>

        <!-- {{-- <button class="btn sort-btn"><i class="fas fa-filter"></i></button> --}} -->

        <div class="select-dropdown" id= "semester-btn" style="margin-left: 20px; width: 270px;">
            <!-- Second dropdown -->
            <select id="sort-select" class="form-control" style="text-align: center; ">
                <option value="">Select Semester</option>
                <option value="option1">1st Semester 2023-2024</option>
                <option value="option2">2nd Semester 2022-2023</option>
                <option value="option3">1st Semester 2022-2023</option>
            </select>
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
        <!-- fines accountabilities -->
        <table  id="accountabilities-table" v-if="this.select_accountability === 'fines' ">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Accountabilities</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody v-for="fines_list in this.filtered_items_for_fines" :id="fines_list.user_id" >
                <tr>
                <td >{{ fines_list.user_id }}</td>
                <td> {{ fines_list.name }}</td>
                <td>{{ fines_list.accountability_type.toUpperCase()}}</td>
                <td>{{ fines_list.total_fines }}</td>
                </tr>
            </tbody>
        </table>
        <!-- other accountabilities -->
        <table  id="accountabilities-table" v-if="this.select_accountability === 'others' ">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Accountabilities</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody v-for="fines_list in this.filtered_items_for_other_accountabilities" :id="fines_list.user_id" >
                <tr>
                <td >{{ fines_list.user_id }}</td>
                <td> {{ fines_list.name }}</td>
                <td>{{ fines_list.accountability_type.toUpperCase()}}</td>
                <td>{{ fines_list.amount }}</td>
                </tr>
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

        <div id="edit-modal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="event-modal-label">Edit Student Membership fee</h5>
                </div>
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



    }
    },

    mounted(){
    this.filtered_items_for_fines = this.fines_list;
    this.filtered_items_for_other_accountabilities = this.other_accountabilities_list;
    },
    created(){
    this.fetchData();

    },

    methods:{




    }


}

</script>
