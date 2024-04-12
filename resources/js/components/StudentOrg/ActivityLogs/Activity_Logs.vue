<template>
    <h4>
        <i class="far fa-copy"> </i> Organization Activity Logs
    </h4>
    <div class="container">
        <div class="col" style="background-color: white; padding: 10px;">
            <div class="row head-container d-flex justify-content-start">
                <div class="col-md-6">
                    <div class="input-container border rounded">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search History" />
                    </div>
                </div>
                <div class="col d-flex gap-2">

                    <div class="select-dropdown border" style="width: 70%;">
                        <select id="sort-select" class="form-control" style="text-align: center">
                            <option value="0" disabled selected>
                                Filter by
                            </option>
                            <option>Event</option>
                            <option>Announcement</option>
                            <option>Accountabilties</option>
                        </select>
                    </div>


                    <div class="select-dropdown border" style="width: 70%;">
                        <select id="sort-select" class="form-control" style="text-align: center">
                            <option value="0" disabled selected>
                                By Actions
                            </option>
                            <option>Created</option>
                            <option>Updated</option>
                            <option>Deleted</option>
                        </select>
                    </div>
                </div>
            </div>
            <div style="height: 80vh; max-height: 80vh; overflow-y: auto;">


            <table>
                <thead>
                    <tr>
                        <th scope="col">Trans #</th>
                        <th scope="col">Timestamp</th>
                        <th scope="col">User</th>
                        <th scope="col">Activities</th>
                        <th scope="col">Data</th>
                    </tr>
                </thead>
                <tbody >
                    <tr v-for="logs in this.log_data">
                        <th scope="row">{{ logs.id }}</th>
                        <td>{{ logs.created_at }}</td>
                        <td>{{ logs.user_profile.first_name }} {{ logs.user_profile.last_name }}</td>
                        <td>{{ logs.model }} {{ logs.action }} </td>
                        <td style="width: 30%;">
                            <small v-for="(value, key) in logs.data" :key="key"> {{ key }}: {{ value }} &nbsp</small>

                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        </div>
    </div>

</template>


<script>

import { convertDate } from "../Functions/DateConverter.js";
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { converTime } from "../Functions/TimeConverter.js";
export default {
    data() {
        return {
            log_data: [],
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios.get(`/get_logs`)
                .then(response => {
                    response.data.forEach(element => {
                        element.data = (JSON.parse(element.data))
                        element.model = element.model.split('\\').pop();

                        const timestamp = element.created_at; // Example timestamp

                        // Convert timestamp to milliseconds (required by JavaScript Date object)
                        const milliseconds = timestamp * 1000;

                        // Create a new Date object
                        const date = new Date(milliseconds);

                        // Get the date and time components
                        const year = date.getFullYear();
                        const month = (date.getMonth() + 1).toString().padStart(2, '0'); // Month is zero-based
                        const day = date.getDate().toString().padStart(2, '0');
                        const hours = date.getHours().toString().padStart(2, '0');
                        const minutes = date.getMinutes().toString().padStart(2, '0');
                        const seconds = date.getSeconds().toString().padStart(2, '0');

                        // Format the date and time
                        const formattedDateTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

                        console.log(formattedDateTime); // Output: "2021-04-14 12:55:36"

                    });

                    this.log_data = response.data;
                    console.log(response.data)

                })
                .catch(error => {
                    console.log(error)
                });

        }
    },

};
</script>
