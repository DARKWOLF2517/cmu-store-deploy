<template>
    <div class="row head-container">
      <div class="col-md-6 col-sm-12">

          <div class="input-container">
              <i class="fa fa-search"></i>
              <input type="text" placeholder="Search Event" >
          </div>
      </div>
      <div class="col-md-6 col-sm-12">
<div class="select-dropdown" style="width: 70%;">
          <!-- Second dropdown -->
          <select id="sort-select" class="form-control" style="text-align: center;">
              <option value="0" disabled selected>Select School Year</option>
              <option></option>
          </select>
      </div>
    </div>
    </div>

            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mt-3"><i class="fas fa-list"></i> Organization Accountability Report</h4>
                </div>
            </div>


    <!-- <div class="accountabilities-container" id="set-accountabilities">
      <div class="loading-spinner-container">
        <div class="spinner-border text-success" id="event-spinner" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="Container-IfEmpty">
            <div class="Empty-Message text-center">
            <i class="icon 	fas fa-wallet" id="icon-message"></i>
            <p class="text-muted"><b>Set up an Accountability</b>
            <br>
            Student Organization accountablities show up here.</p>
        </div>
    </div> -->

    <div class="accountabilities-cards">
        <div class="accountability-card border-top border-5 border-success border-bottom-0" >
            <span class="mt-4">
                <h2 class="text-center bold"><i class="bi bi-wallet2 text-secondary"></i></h2>
                <h2 class="text-center "> <b>Fines</b></h2>
                <h4 class="text-center" style="color: #357960; font-weight: bold;">&#8369; 10.00</h4>
            </span>

        </div>
    </div>


</template>
