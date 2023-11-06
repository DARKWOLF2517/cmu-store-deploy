
import './bootstrap';
import { createApp } from 'vue';

// all
    import SideNavbtn from './components/SideNav/SideNavButton.vue';
    import LoginForm from './components/LoginForm/LoginForm.vue';
    import UserOrganization from './components/StudentOrg/Login/UserOptions.vue';

// org module
    import EventsDashboard from './components/StudentOrg/Dashboard/DashboardEvents.vue';
    import EventsCount from './components/StudentOrg/Dashboard/DashboardCard.vue';
    import CalendarCard from './components/StudentOrg/Dashboard/CalendarCard.vue';
    import EventCard from './components/StudentOrg/Events/EventCard.vue';
    import QrScanner from './components/StudentOrg/Attendance/QrScanner.vue';
    import EventAttendanceList from './components/StudentOrg/Attendance/AttendanceEventList.vue';
    import EvaluationChart from './components/StudentOrg/Evaluation/Chart.vue';
    import EvaluationList from './components/StudentOrg/Evaluation/EvaluationList.vue';
    import MemberList from './components/StudentOrg/Users/MemberList.vue';
    import AttendanceRecord from './components/StudentOrg/Attendance/AttendanceRecord.vue';
    import UploadStudents from './components/StudentOrg/Users/UploadStudents.vue'
    import AttendanceStudentList from './components/StudentOrg/Attendance/AttendanceStudentTable.vue';
// student module 
    import StudentAttendance from './components/StudentUser/Attendance/StudentAttendance.vue';
    import StudentEventModal from './components/StudentUser/Events/EventModal.vue';
    import StudentProfile from './components/StudentUser/Profile/StudentProfile.vue';
    import EvaluationForm from './components/StudentUser/Evaluation/EvaluationForm.vue';

const app = createApp({});

// all  
    app.component('side-nav-button',SideNavbtn);
    app.component('login-form',LoginForm);
    app.component('user-organization',UserOrganization);

// org module
    app.component('event-card',EventCard);
    app.component('event-count', EventsCount);
    app.component('event-dashboard', EventsDashboard);
    app.component('dashboard-calendar', CalendarCard);
    app.component('qr-scanner', QrScanner);
    app.component('event-attendance-list', EventAttendanceList);
    app.component('evaluation-chart', EvaluationChart);
    app.component('evaluation-list', EvaluationList);
    app.component('member-list', MemberList);
    app.component('attendance-record', AttendanceRecord);
    app.component('upload-students', UploadStudents);
    app.component('show-student-attendance', AttendanceStudentList);


// student module
    app.component ('student-attendance',StudentAttendance);
    app.component ('student-event-card', StudentEventModal);
    app.component ('student-profile', StudentProfile);
    app.component ('student-evaluation-form', EvaluationForm);
app.mount('#app');
