<template>
   <div class="container breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/login/student_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student</li>
                <li class="breadcrumb-item active" aria-current="page">Announcement</li>
                </ol>
            </nav>
        </div>
            <div class="mt-2">
                <div class="row head-container">
                    <div class="col-md-6 col-sm-12">
                        <div class="input-container">
                            <i class="fa fa-search"></i>
                            <input type="text" placeholder="Search Announcement">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12" style="display: flex; align-items: center; justify-content: flex-end;">
                        <button class="btn sort-btn"><i class="bi bi-sort-up"></i></button>
                        <div class="select-dropdown">
                            <select id="sort-select" class="form-control" style="text-align: center;">
                                <option value="">Select Semester</option>
                                <option value="option1">1st Semester 2023-2024</option>
                                <option value="option2">2nd Semester 2022-2023</option>
                                <option value="option3">1st Semester 2022-2023</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <h3> <i class="fas fa-list mt-2"></i>  Announcements</h3>
            <div class="announcement-list">
                <div class="col">
                        <div class="announcement-cards-list ">
                                <div class="announcement-card">
                                    <div class="d-flex align-items-center">
                                    <img src="https://pbs.twimg.com/profile_images/1669519370287198209/QVqk0Ho8_400x400.jpg" alt="Profile Image" width="30" height="30" class="circular-image">
                                    <strong class="posted-by-title ml-2">CSCo</strong>
                                    </div>
                                    <div class="card-body">
                                    <h6 class="card-title mt-2">Announcement: <strong>Lulinghayaw</strong> </h6>
                                    <small class="date-upload"> 11/9/2023 - 10:12 AM</small>
                                    <br>
                                    <small class="card-description">
                                    {{ truncatedDescription }}
                                    </small>
                                </div>
                                <button class="btn btn-success view-button" data-bs-toggle="modal" data-bs-target="#fullDetailsModal">Read more</button>
                                </div>
                        </div>
                    </div>
                </div>


    </template>

    <script>
    export default {
      data() {
        return {
          cardDescription: `Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus, aliquam atque fugit voluptatibus dignissimos ipsum tempore ab numquam saepe veritatis possimus aut ipsam delectus assumenda sed autem omnis accusantium corrupti! `
        }
      },

      computed: {
        truncatedDescription() {
          const words = this.cardDescription.split(' ')
          return words.slice(0, 20).join(' ') + '...'
        }
      },
    }

    </script>
