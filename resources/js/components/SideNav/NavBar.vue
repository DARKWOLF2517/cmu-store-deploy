<template>
        <div class="wrapper">
            <div class=" p-3  sidebar" id="sidebarCollapse">
                <div class="d-md-flex flex-shrink-0">
                    <ul class="list-unstyled ">
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded dashboard-button">
                            <i class="fas fa-tachometer-alt"></i>
                            <a href="/login/org_dashboard">
                            <span class="link-title">Dashboard</span>
                            </a>
                        </button>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded rotate-icon" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                            <i class="fas fa-clipboard-check"></i>
                            <span class="link-title">Attendance</span>
                            <span class="link-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="collapse" id="dashboard-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="/student_organization_attendance_schedule" class="link-dark rounded"><i class="fas fa-calendar"></i> Schedule</a></li>
                                <li><a href="/student_organization_attendance" class="link-dark rounded"><i class="fas fa-check-circle"></i> Record</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded events-button">
                            <i class="fas fa-bullhorn"></i>
                            <a href="/student_organization_announcement">
                            <span class="link-title">Announcement</span>
                            </a>
                        </button>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded events-button">
                            <i class="fas fa-calendar"></i>
                            <a href="/student_organization_events">
                            <span class="link-title">Events</span>
                            </a>
                        </button>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center studentlist-button">
                            <i class="	fas fa-list-alt"></i>
                            <a href="/student_organization_member_list">
                            <span class="link-title">Student List</span>
                            </a>
                        </button>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center studentlist-button">
                            <i class="fas fa-chart-line"></i>
                            <a href="/student_organization_evaluation">
                            <span class="link-title">Evaluation</span>
                            </a>
                        </button>
                    </li>

                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded rotate-icon" data-bs-toggle="collapse" data-bs-target="#accountabilities-collapse" aria-expanded="false">
                            <i class="fas fa-clipboard-check"></i>
                            <span class="link-title">Accountabilities</span>
                            <span class="link-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="collapse" id="accountabilities-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="/student_organization_set_accountabilities" class="link-dark rounded"><i class="fas fa-check-circle"></i> Set Accountabilities</a></li>
                                <li><a href="/student_organization_membership_fee" class="link-dark rounded"><i class="fas fa-calendar"></i> Membership fee list</a></li>
                                <li><a href="/student_organization_fines" class="link-dark rounded"><i class="fas fa-check-circle"></i> Fines List</a></li>
                            </ul>
                        </div>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
</template>


<script>

export default{
    mounted(){
        // this.render();
        console.log('mounted');
    },
    methods: {
   
    }
}

</script>