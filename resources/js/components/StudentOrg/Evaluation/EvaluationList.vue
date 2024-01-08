<template>

    <div class="mt-2">
        <div class="row head-container">
            <div class="col-md-6 col-sm-12">
                <div class="input-container">
                    <i class="fa fa-search"></i>
                    <input type="text" placeholder="Search Event" v-model="searchTerm" @input="filterItems">
                </div>
            </div>
            <div class="col-md-6 col-sm-12" style="display: flex; align-items: center; justify-content: flex-end; gap: 20px;">
                <div class="select-dropdown" style="width: 70%;">
                    <select id="sort-select" class="form-control" style="text-align: center;" v-model="school_year_input"  @change="fetchData">
                            <option value="" disabled selected>Select Semester</option>
                            <option v-for="school_year in this.school_year" :value="school_year['id']" >{{ school_year['school_year'] }}</option>

                        </select>
                </div>
                <div class="select-dropdown" style="width: 30%;">
                    <!-- First dropdown -->
                    <select id="sort-select" class="form-control" style="text-align: center;">
                        <option value="" disabled selected><i class="fas fa-filter"></i> All</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="completed">Other Accountability</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
        <h3><i class="fas fa-list mt-2"></i> Evaluation</h3>
    <div id="evaluation-container">
        <div class="evaluation-event-cards">


      <!-- Loading spinner -->
      <div v-if="loading" class="loading-spinner-container">
        <div class="spinner-border text-success" id="event-spinner" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>


            <!-- Message if the container is empty -->
            <div class="Container-IfEmpty" v-if="this.evaluation.length == 0">
                <div class="Empty-Message">
                <i class="icon 	far fa-file-alt" id="icon-message"></i>
                <p class="text-muted">Evaluation cards show up here.</p>
            </div>
            </div>

            <!-- Status EVALUATION CARD -->
            <!-- <div class="event-card border-top border-5 border-success border-bottom-0 py-3" v-for="evaluation in this.filtered_events" :id="evaluation.event_id"> -->
                <div v-for="evaluation in filtered_events" :id="evaluation.event_id"
                    :class="[
                        'event-card',
                        'border-top',
                        'border-5',
                        {'border-success': evaluation.evaluation_status === 0, 'border-warning': evaluation.evaluation_status === 1},
                        'py-3'
                    ]">


                    <!-- <h5> {{ evaluation['event_id'] }}</h5> -->
                <div class="dropdown">
                    <a class="ellipsis-button" href="#" style="color: black;" role="button" id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                        <!-- option 1 -->

                        <li><a class="dropdown-item" @click="UpdateAttendanceStatus(evaluation.event_id,'1')">Start Evaluation</a></li>
                        <!-- option 2 -->
                        <li><a class="dropdown-item" @click="UpdateAttendanceStatus(evaluation.event_id,'0')">Stop Evaluation</a></li>
                        <!-- Add more dropdown items as needed -->
                    </ul>
                </div>
                <div class="event-date-container"><span class="event-date">{{evaluation['start_date']}}</span></div>
                <div class="event-title">{{ evaluation['name'] }}</div>
                <div class="event-description">Total Response: <b>{{evaluation['evaluation_form_answer']}}</b></div>
                <div>
                    <div class="event-status text-muted" v-if="evaluation['evaluation_status'] == 0">Status: <b>Closed</b> </div>
                    <div class="event-status" v-else="evaluation['evaluation_status'] == 1">Status: <b>Ongoing</b></div>
                </div>

                <button v-if="evaluation['evaluation_form_answer'] !== 0"  class="view-button" @click="evaluation_result(evaluation.event_id)"> <i class="fas fa-chevron-right button-icon"></i></button>
            </div>

        </div>
    </div>
</template>
<script>
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default {
  props: ['organization_id','school_year_session'],
  data() {
    return {
      loading: true,
      evaluation: [],
      school_year: [],
      searchSchoolYear: 0,
      school_year_input: this.school_year_session,
      searchTerm: '',
      filtered_events: [],
    };
  },

  mounted() {
    this.fetchData();
    this.showSchoolYear();
  },

  methods: {
    fetchData() {
      this.filtered_events = [];
      this.evaluation = [];
      this.loading = true; // Set loading to true before making the API call
        axios.get(`/events/evaluation/${this.organization_id}/${this.school_year_input}`)
        .then((response) => {
          this.loading = false;
          const data = response.data;

            if (data) {
              data.forEach((item) => {
              item['evaluation_form_answer'] = item['evaluation_form_answer'].length;
              this.evaluation = response.data;
              this.filtered_events = this.evaluation;
            });
            }
            else{
              this.filtered_events = [];
            }
            console.log(this.evaluation)
        })
        .catch((error) => {
          // Handle error
          console.log(error)
        });
    },

    filterItems() {
      let filteredBySearch = this.evaluation;
              if (this.searchTerm) {
                  const searchTermLower = this.searchTerm.toLowerCase();
                  filteredBySearch = filteredBySearch.filter(item =>
                      item.name.toLowerCase().includes(searchTermLower)
                  );
              }
                  this.filtered_events = filteredBySearch;
    },

    showSchoolYear() {
      axios.get(`get_school_year/${this.organization_id}`)
        .then((response) => {
          this.school_year = response.data;
        })
        .catch((error) => {
          // Handle error
        });
    },

    evaluation_result(event_id) {
      window.location.href = `evaluation_form_summary/${event_id}`;
    },

    UpdateAttendanceStatus(event_id, status) {
      axios
        .put(`/attendance/${event_id}/${status}`)
        .then((response) => {
          this.showSuccess(response.data.message);
          this.fetchData();
        })
        .catch((error) => {
          console.error('Error', error);
        });
    },

    showSuccess(message) {
      this.fetchData();
      toast.success(message, {
        autoClose: 100,
      });
    },
  },
};
</script>
