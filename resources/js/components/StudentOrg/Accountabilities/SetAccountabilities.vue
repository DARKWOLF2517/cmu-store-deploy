<template>
    
    <button class="btn btn-primary" id="btn-accountabilities" data-bs-toggle="modal" data-bs-target="#membershipFeeModal">Add Accountabilities</button>
                <div class="row">
                    
                    <!-- Card 1 -->
                    <div class="col-md-6 col-12">
                        <div class="membershipfee-card">
                            <h2>Membership Fee</h2>
                            <h4>Php 0.00</h4>
                            <p class="membershipfee-description">1 semester</p>
                            <button class="btn btn-primary" id="btn-accountabilities" data-bs-toggle="modal" data-bs-target="#membershipFeeModal">Set Membership Fee</button>
                        </div>
                    </div>
                </div>


            <!-- Add Fee Modal -->
            <div class="modal fade" id="membershipFeeModal" tabindex="-1" aria-labelledby="membershipFeeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="membershipFeeModalLabel">Add Accountabilities</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add form elements for editing membership fee -->
                            <label for="membershipFeeDescriptionInput" class="form-label mt-2">Description:</label>
                            <input type="text" class="form-control" id="membershipFeeDescriptionInput">
                            <label for="membershipFeeInput" class="form-label">Amount:</label>
                            <input type="text" class="form-control" id="membershipFeeInput">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="saveMembershipFeeBtn">Save changes</button>
                        </div>
                    </div>
                </div>
            </div> 
</template>

<script>
export default{

    mounted(){
        console.log('mounted')
    },

}
</script>