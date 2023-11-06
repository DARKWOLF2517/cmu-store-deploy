<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
            background-color: #f0f0f0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .top-nav {
            background-color: #343a40;
            color: #fff;
            padding: 7px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-nav .notification-button {
            display: flex;
            align-items: center;
            color: #fff;
            text-decoration: none;
            margin-right: 10px;
        }
        .nav-name{
          padding-left: 60px;
        }
        .top-nav .profile-dropdown {
            display: flex;
            align-items: center;
            color: #fff;
            text-decoration: none;
        }

        .top-nav .profile-dropdown .profile-name {
            margin-right: 5px;
        }

        .sidebar {
            position: absolute;
            top: 50px;
            left: 0;
            height: 100vh;
            width: 200px;
            background-color: #343a40; /* Dark background color */
            color: #fff; /* Text color */
            overflow-y: auto;
            transition: width 0.3s ease-in-out;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: 72px;
        }

        .content {
            margin-left: 230px;
            padding: 20px;
            transition: margin-left 0.3s ease-in-out;
        }

        .content.collapsed {
            margin-left: 72px;
        }

        .nav-link-text {
            display: inline-block;
            transition: margin-left 0.3s ease-in-out, opacity 0.3s ease-in-out;
        }

        .sidebar.collapsed .nav-link-text {
            margin-left: -999px;
            opacity: 0;
        }

        .sidebar.collapsed .nav-link-text span {
            display: none;
        }

        .sidebar-title .bi {
            color: #fff; /* Sidebar title icon color */
        }

        .nav-link i.bi {
            color: #fff; /* Nav link icons color */
        }

        .toggle-button {
            position: absolute;
            top: 7px;
            left: 19px;
            border: 1px;
            background-color: #2a2e33;

        }

        /* Updated styles for smaller devices */
        @media (max-width: 768px) {
            .sidebar {
                width: 230px;
            }

            .sidebar.collapsed {
                width: 60px;
            }

            .content {
                margin-left: 72px;
            }

            .content.collapsed {
                margin-left: 0;
            }

            .toggle-button {
                top: 20px;
                left: 20px;
            }

            .dropdown-menu {
                position: static;
                float: none;
            }
        }

    /* New styles for the timeline pane */
    .timeline-container {
      position: absolute;
      top: 70px;
      right: 20px;
      width: 350px;
      height: 210px;
      padding: 20px;
      padding-bottom: 50px;
      border-radius: 10px;
      background-color: #ffffff;
      box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }
    .timeline-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .timeline-content {
      margin-top: 20px;
      overflow-y: auto; /* Add scrollbar for vertical overflow */
      max-height: 100px;
    }

    .timeline-event {
      margin-bottom: 10px;

    }
    .timeline-event-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .event-date {
      font-weight: bold;
      color: #007bff;
    }

    .event-description {
      margin-left: 10px;
    }
    .calendar-container {
      border-radius: 10px;
      position: absolute;
      bottom: 30px;
      right: 20px;
      width: 350px;
      height: 300px;
      margin: 0 auto;
      background-color: white;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Added box shadow */
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      text-align: center;
      padding: 8px;
      font-size: 14px; /* Adjusted font size */
    }

    th {
      background-color: #f2f2f2;
    }

    td {
      border: 1px solid #dddddd;
    }

    .today {
      background-color: #007bff;
      color: white;
    }

    .dashboard {
            display: flex;
            margin-top: 20px;
        }

        .dashboard-card {
    width: 200px; /* Set a fixed width for the cards */
    height: 150px; /* Set a fixed height for the cards */
    background-color: #fff;
    padding: 10px;
    text-align: center;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
    margin-right: 15px; /* Adjust the distance between each card */
}

.dashboard-card:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.dashboard-card h6 {
    margin: 0;
    font-size: 18px; /* Change the font size to a bit smaller */
    color: #333;
    display: flex; /* Add display flex */
    align-items: center; /* Center the icon vertically */
    justify-content: center; /* Center the icon horizontally */
}

.dashboard-card i {
    margin-right: 5px; /* Add some spacing between the icon and text */
    font-size: 48px; /* Increase the icon size */
}

.dashboard-card p {
    font-size: 36px;
    color: #007bff;
    margin: 10px 0;
}
         /* Additional styles for buttons */
         .dashboard-buttons {
            display: flex;

            margin-right: 15px;

        }

        .dashboard-button {
    background-color: #e8e8e8;
    color: #333;
    padding: 10px;
    text-align: center;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
    margin-top: 30px;
    cursor: pointer;
    margin-right: 10px; /* Add right margin for spacing */

}


.dashboard-button:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.dashboard-button.events {
    background-color: #ffbb33;
}

.dashboard-button.accountabilities {
    background-color: #00cc99;
}

.dashboard-button.attendance {
    background-color: #66a3ff;
}

.dashboard-button.evaluation {
    background-color: #ff4d4d;
}

.dashboard-button.student-organization {
    background-color: #9933ff;
}

</style>

    <title>Student Organization Dashboard</title>
</head>
<body>
    <!-- TOP NAV BAR -->
    <div class="wrapper">
        <div class="top-nav">
          <div class="nav-item toggle-button">
            <button class="btn btn-light" id="sidebar-toggle"><i class="bi bi-list"></i></button>
          </div>
            <a href="#" class="nav-link link-light">
                <span class="nav-name">CMU-STORE-AMS</span>
            </a>

            <div class="profile-dropdown dropdown">
                <button class="notification-button btn btn-link">
                    <i class="bi bi-bell"></i>
                </button>
                <a href="#" class="d-flex align-items-center link-light text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <span class="profile-name"><strong>mdo</strong></span>
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>
        <!-- SIDE NAV BAR -->
    <div class="wrapper">
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-dark sidebar" id="sidebarCollapse">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link link-light" aria-current="page">
                        <i class="bi bi-speedometer2"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link link-light">
                        <i class="bi bi-people"></i>
                        <span class="nav-link-text">Organizations</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link link-light">
                        <i class="bi bi-calendar-check"></i>
                        <span class="nav-link-text">Events</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link link-light">
                        <i class="bi bi-currency-dollar"></i>
                        <span class="nav-link-text">Accountabilities</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link link-light">
                        <i class="bi bi-clipboard-check"></i>
                        <span class="nav-link-text">Evaluation</span>
                    </a>
                </li>

            </ul>

        </div>
        <div class="content">

        <!-- Dashboard  -->
        <h2>Student Organization Dashboard</h2>
        <div class="dashboard">
            <div class="dashboard-card">
              <i class="fas fa-users"></i>
                <h6> Number of Members</h6>
                <p id="memberCount">Loading...</p>
            </div>

            <div class="dashboard-card">
              <i class="far fa-calendar-alt"></i>
                <h6>Number of Events</h6>
                <p id="eventCount">Loading...</p>
            </div>

            <div class="dashboard-card">
              <i class="fas fa-check-circle"></i>
                <h6>Number of Completed Events</h6>
                <p id="completedEventCount">Loading...</p>
            </div>
        </div>
        <div class="dashboard-buttons">
          <div class="dashboard-button events">
              <i class="fas fa-calendar"></i>
              <h6>Events</h6>
          </div>

          <div class="dashboard-button accountabilities">
              <i class="fas fa-tasks"></i>
              <h6>Accountabilities</h6>
          </div>

          <div class="dashboard-button attendance">
              <i class="fas fa-clipboard-list"></i>
              <h6>Attendance</h6>
          </div>

          <div class="dashboard-button evaluation">
              <i class="fas fa-chart-bar"></i>
              <h6>Evaluation</h6>
          </div>

          <div class="dashboard-button student-organization">
              <i class="fas fa-users"></i>
              <h6>Student Organization</h6>
          </div>
      </div>
<!-- Timeline container -->
<div class="timeline-container">
  <div class="timeline-header">
    <h3>Timeline</h3>
  </div>
  <hr>
  <div class="timeline-content">
    <ul class="timeline-event-list">
      <li class="timeline-event">
        <div class="event-date">June 10, 2023</div>
        <div class="event-description">Event 1</div>
      </li>
      <li class="timeline-event">
        <div class="event-date">June 15, 2023</div>
        <div class="event-description">Event 2</div>
      </li>
      <li class="timeline-event">
        <div class="event-date">June 20, 2023</div>
        <div class="event-description">Event 3</div>
      </li>
    </ul>
  </div>
</div>

<div class="calendar-container">
  <div>
    <button id="prev-month" class="btn btn-link"><i class="bi bi-caret-left-fill"></i></button>
    <span id="month-year"></span>
    <button id="next-month" class="btn btn-link"><i class="bi bi-caret-right-fill"></i></button>
  </div>
  <table>
    <tr>
      <th>Sun</th>
      <th>Mon</th>
      <th>Tue</th>
      <th>Wed</th>
      <th>Thu</th>
      <th>Fri</th>
      <th>Sat</th>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </table>
</div>
    </div>

  <!-- Content class end -->
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebarCollapse');
            const content = document.querySelector('.content');
            const icon = document.querySelector('#sidebar-toggle i');
            const dropdown = document.getElementById('sidebar-dropdown');

            sidebar.classList.toggle('collapsed');
            content.classList.toggle('collapsed');
            icon.classList.toggle('bi-list');
            icon.classList.toggle('bi-x');
            dropdown.classList.toggle('dropdown');
            dropdown.classList.toggle('dropup');
            this.classList.toggle('collapsed');
        });
    </script>
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
          const today = new Date();
          let currentMonth = today.getMonth();
          let currentYear = today.getFullYear();
          const cells = document.getElementsByTagName('td');

          function updateCalendar() {
            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            const firstDay = new Date(currentYear, currentMonth, 1);
            const lastDay = new Date(currentYear, currentMonth + 1, 0);
            const numDays = lastDay.getDate();
            const startDay = firstDay.getDay();

            for (let i = 0; i < cells.length; i++) {
              cells[i].innerHTML = '';
              cells[i].classList.remove('today');
            }

            document.getElementById('month-year').textContent = `${monthNames[currentMonth]} ${currentYear}`;

            let date = 1;
            for (let i = startDay; i < startDay + numDays; i++) {
              cells[i].innerHTML = date;
              if (date === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear()) {
                cells[i].classList.add('today');
              }
              date++;
            }
          }

          updateCalendar();

          document.getElementById('prev-month').addEventListener('click', () => {
            currentMonth--;
            if (currentMonth < 0) {
              currentMonth = 11;
              currentYear--;
            }
            updateCalendar();
          });

          document.getElementById('next-month').addEventListener('click', () => {
            currentMonth++;
            if (currentMonth > 11) {
              currentMonth = 0;
              currentYear++;
            }
            updateCalendar();
          });
        });
      </script>

<script>
  // Simulating data retrieval from an API or database
  setTimeout(() => {
      const memberCount = 100; // Replace with actual member count
      const eventCount = 10; // Replace with actual event count
      const completedEventCount = 5; // Replace with actual completed event count

      document.getElementById('memberCount').textContent = memberCount;
      document.getElementById('eventCount').textContent = eventCount;
      document.getElementById('completedEventCount').textContent = completedEventCount;
  }, 1000); // Simulating a delay of 1 second for data retrieval
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>
