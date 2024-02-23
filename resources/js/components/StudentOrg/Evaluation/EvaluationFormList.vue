<template>
  <div class="mt-2">
    <div class="row head-container">
      <div class="col-md-6 col-sm-12">
        <div class="input-container">
          <i class="fa fa-search"></i>
          <input type="text" placeholder="Search Form">
        </div>
      </div>
      <div class="col-md-6 col-sm-12" style="display: flex; align-items: center; gap: 20px;">
        <div class="select-dropdown" style="width: 70%;">
          <select id="sort-select" class="form-control" style="text-align: center;">
            <option value="" disabled selected>Select Semester</option>
            <option v-for="school_year in this.school_year" :value="school_year['id']">{{ school_year['school_year'] }}
            </option>
          </select>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">

      <h3><i class="fas fa-list mt-2"></i> Evaluation Forms</h3>
      <div class="event-buttons d-flex">
        <div class="btn-group" role="group">
          <button class="btn me-2" id="add-event-button" data-bs-toggle="modal" data-bs-target="#evaluation-modal"> <i
              class="fas fa-plus"></i>
            Create form</button>
        </div>
      </div>
    </div>
  </div>

  <div id="evaluation-container">
    <div class="evaluation-event-cards">
      <div class="event-card" style="width: 45vh !important; border-left-style: solid; border-left-color: #1b9587;">

        <div class="dropdown">
          <a class="ellipsis-button" href="#" style="color: #3e505d;" role="button" id="ellipsisDropdown"
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-ellipsis-h"></i>
          </a>
          <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
            <!-- option 1 -->

            <li><a class="dropdown-item">Set as Default</a></li>
            <li><a class="dropdown-item">Edit Form</a></li>
            <!-- option 2 -->
            <li><a class="dropdown-item">Delete Form</a></li>
            <!-- Add more dropdown items as needed -->
          </ul>
        </div>

        <div class="evaluation-title mt-4">
          <h5> <b>Evaluation Form</b></h5>
        </div>
        <div class="evaluation-description">Total Questions: <b>16</b></div>
        <div>
          <div class="evaluation-status text-muted">Status: <b>Default</b> </div>
        </div>
        <button class="btn btn-success view-button" data-bs-toggle="modal" data-bs-target="#evaluation-form-modal">
          View</button>
        <!-- <button class="view-button"> <i class="fas fa-chevron-right button-icon"></i></button> -->
      </div>
    </div>
  </div>
  <div class="modal fade" id="evaluation-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Evaluation Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="formTitle" class="form-label">Title of the Evaluation Form</label>
            <input type="text" class="form-control" id="formTitle" v-model="formTitle">
          </div>
          <div class="mb-3">
            <label for="formDescription" class="form-label">Input Description</label>
            <textarea class="form-control" id="formDescription" rows="3" v-model="formDescription"></textarea>
          </div>
          <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-light add-question" @click="addQuestion"> <i class="fas fa-plus"></i> Add
              Question</button>
          </div>
          <div class="question-container">
            <div class="mb-3" v-for="(question, index) in questions" :key="index">
              <label for="question1" class="form-label fw-bold">Question {{ index + 1 }}</label>
              <div class="input-group">
                <input type="text" class="form-control" :id="'question' + (index + 1)" :ref="'question' + (index + 1)"
                  v-model="question.text">
                <button class="btn btn-danger remove-question" type="button" @click="removeQuestion(index)">X</button>
              </div>
              <div class="mb-3 mt-2 form-check">
                <input type="checkbox" class="form-check-input" :id="'multipleChoice' + (index + 1)"
                  v-model="question.multipleChoice">
                <label class="form-check-label" :for="'multipleChoice' + (index + 1)">Multiple Choice</label>
                <br>
                <small class="fw-bold">1 - Needs Improvements | 2 - Satisfactory | 3 - Good | 4 - Very Good | 5 -
                  Excellent</small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="feedback">
            <label for="feedback">Accept Feedback?</label>
          </div>
          <button type="button" class="btn btn-success" @click="saveForm">Save Form</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- View Evaluation Form Modal -->
  <div class="modal fade" id="evaluation-form-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <!-- <h5 class="modal-title" id="exampleModalLabel">View Evaluation Form</h5> -->
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="formTitle" class="form-label">Title of the Evaluation Form</label>
          </div>
          <div class="mb-3">
            <label for="formDescription" class="form-label">Description</label>
            <br>
            <small>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos, libero maiores nostrum explicabo
              tenetur molestiae non impedit quibusdam doloremque repellendus, blanditiis exercitationem ipsum delectus
              iste alias quo. Accusamus, sequi quos.</small>
          </div>
          <div class="mb-3">
            <label for="question1" class="form-label fw-bold">Question 1</label>
            <div class="input-group">
              <input type="text" class="form-control" id="question1" readonly>
            </div>
            <div class="mb-3 form-check">
              <div id="choicesContainer1" class="mt-2">
                <label for="choices1" class="form-label">*Multiple Choice</label>
                <br>
                <small class="fw-bold">1 - Needs Improvements | 2 - Satisfactory | 3 - Good | 4 - Very Good | 5 -
                  Excellent</small>
              </div>
            </div>
          </div>
          <div class="feedback mb-3">
            <label for="feedback">Feedback</label>
            <textarea class="form-control" name="composeContent" id="Textarea1" row="7" placeholder="Type here.."
              readonly></textarea>
          </div>
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';

export default {
  props: ['organization_id', 'school_year_session'],
  data() {
    return {
      questions: [{
        text: '',
        multipleChoice: false
      }],
      formTitle: '',
      formDescription: ''
    }
  },
  methods: {
    addQuestion() {
      this.questions.push({
        text: '',
        multipleChoice: false
      });
    },
    removeQuestion(index) {
      this.questions.splice(index, 1);
    },
    saveForm() {
      //   console.log('Form Title:', this.formTitle);
      //   console.log('Form:', this.formDescription);
      console.log('Questions:', this.questions);

      // Save the form data here
      // You can use the `axios` library to send a POST request to your server
      // with the form data

      //   axios.post('https://myapp.herokuapp.com/api/evaluation-forms', {
      //     title: this.formTitle,
      //     description: this.formDescription,
      //     questions: this.questions
      //   })
      //   .then(response => {
      //     // Handle successful form submission
      //     // You can close the modal or show a success message here
      //   })
      //   .catch(error => {
      //     // Handle error during form submission
      //     // You can show an error message here
      //   });
    }
  }
}

</script>
