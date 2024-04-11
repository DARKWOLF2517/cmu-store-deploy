<template>
<h4>
    <i class="far fa-copy"> </i> Organization Activity Logs
</h4>
<div class="container">
    <div class="col" style="background-color: white; padding: 10px;">
        <div class="row head-container justify-content-start">
                            <div class="col-md-6">
                                <div class="input-container border rounded">
                                    <i class="fas fa-search"></i>
                                    <input type="text" placeholder="Search History" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="select-dropdown border" style="width: 70%;">
                                    <select id="sort-select" class="form-control" style="text-align: center"
                                        >
                                        <option value="0" disabled selected>
                                            Filter by
                                        </option>
                                        <option>Event</option>
                                        <option>Announcement</option>
                                        <option>Accountabilties</option>
                                    </select>
                                </div>
                            </div>
                        </div>
        <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Trans #</th>
      <th scope="col">Timestamp</th>
      <th scope="col">User</th>
      <th scope="col">Activities</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>04/11/2024 11:47 am</td>
      <td>Mark  Zuckerberg</td>
      <td>Created an Event</td>
    </tr>

  </tbody>
</table>
</div>
</div>

</template>
