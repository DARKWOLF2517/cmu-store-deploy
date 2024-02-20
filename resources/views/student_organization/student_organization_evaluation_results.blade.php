@extends('layouts.main_layout')

@section('custom-title')
  <title> Evaluation Results</title>
@endsection
@section('custom-style')
<link id="load-css-0" rel="stylesheet" type="text/css" href="https://www.gstatic.com/charts/51/css/core/tooltip.css">
<link id="load-css-1" rel="stylesheet" type="text/css" href="https://www.gstatic.com/charts/51/css/util/util.css">
<link href="/custom_css/evaluation.css" rel="stylesheet">
<title>Student Organization Evaluation Results @yield('title')</title>
@endsection
@section('main-content')

    <div class=" breadcrumbs">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/org_dashboard">Dashboard</a></li>
            <li class="breadcrumb-item">Student Organization</li>
            <li class="breadcrumb-item"><a href="/student_organization_evaluation">Evaluation</a></li>
            <li class="breadcrumb-item active" aria-current="page">Evaluation Results</li>
        </ol>
        </nav>
    </div>
        {{-- <div class="mt-2 student-buttons d-flex justify-content-end">
            <div class="btn-group" role="group">
                <button class="btn me-2" id="print-results-button">
                    <i class="fas fa-print"></i> Print Results
                </button>
                <button class="btn me-2" id="download-results-button">
                    <i class="fas fa-download"></i> Download Results
                </button>

            </div>
        </div> --}}

                <evaluation-chart
                    event_id={{$id}}>
                </evaluation-chart>



@endsection

@section('custom-script')
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> --}}
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" charset="UTF-8" src="https://www.gstatic.com/charts/51/loader.js"></script>
  <script type="text/javascript" charset="UTF-8" src="https://www.gstatic.com/charts/51/js/jsapi_compiled_default_module.js"></script>
  <script type="text/javascript" charset="UTF-8" src="https://www.gstatic.com/charts/51/js/jsapi_compiled_graphics_module.js"></script>
  <script type="text/javascript" charset="UTF-8" src="https://www.gstatic.com/charts/51/js/jsapi_compiled_ui_module.js"></script>
  <script type="text/javascript" charset="UTF-8" src="https://www.gstatic.com/charts/51/js/jsapi_compiled_corechart_module.js"></script>


    <!-- Add jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Add your custom script with inline CSS -->
    {{-- <script>
        $(document).ready(function() {
            // Create a style element and append it to the head
            var customStyles = '<style>' +
                '.col { padding: 15px;  margin-bottom: 20px;}' +
                '.no-stack { display: flex; flex-wrap: nowrap; }' +
                '.col { display: flex; flex-direction: column; }' +
                '</style>';
            $('head').append(customStyles);

            $("#print-results-button").click(function() {
                printEvaluationSummary();
            });

            function printEvaluationSummary() {
                // Get the content of the evaluation summary
                var evaluationSummaryContent = $("#evaluation-summary").html();

                // Create a new window to print the content
                var printWindow = window.open('', '_blank');
                printWindow.document.open();
                printWindow.document.write('<html><head><title>Evaluation Summary</title>');
                printWindow.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">');
                printWindow.document.write(customStyles); // Include custom styles in the new window
                printWindow.document.write('</head><body>');
                printWindow.document.write(evaluationSummaryContent);
                printWindow.document.write('</body></html>');
                printWindow.document.close();

                // Trigger the print dialog
                printWindow.print();
            }
        });
    </script> --}}

  @endsection

























  {{--
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script type="text/javascript" charset="UTF-8" src="https://www.gstatic.com/charts/51/loader.js"></script>
  <link id="load-css-0" rel="stylesheet" type="text/css" href="https://www.gstatic.com/charts/51/css/core/tooltip.css">
  <link id="load-css-1" rel="stylesheet" type="text/css" href="https://www.gstatic.com/charts/51/css/util/util.css">
  <script type="text/javascript" charset="UTF-8" src="https://www.gstatic.com/charts/51/js/jsapi_compiled_default_module.js"></script>
  <script type="text/javascript" charset="UTF-8" src="https://www.gstatic.com/charts/51/js/jsapi_compiled_graphics_module.js"></script>
  <script type="text/javascript" charset="UTF-8" src="https://www.gstatic.com/charts/51/js/jsapi_compiled_ui_module.js"></script>
  <script type="text/javascript" charset="UTF-8" src="https://www.gstatic.com/charts/51/js/jsapi_compiled_corechart_module.js"></script>
  <div class="content">
      <div class="container">
          <div class="container breadcrumbs">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/homepage">Dashboard</a></li>
                  <li class="breadcrumb-item">Student Organization</li>
                  <li class="breadcrumb-item"><a href="/student_organization_evaluation">Evaluation</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Evaluation Results</li>
                </ol>
              </nav>
          </div>
          <div class="container student-buttons d-flex justify-content-end" id="containers">
              <div class="btn-group" role="group">
                  <button class="btn me-2" id="add-student-list-button">
                      <i class="fas fa-print"></i> Print Results
                  </button>
                  <button class="btn me-2" id="add-student-button">
                      <i class="fas fa-download"></i> Download Results
                  </button>
              </div>
          </div>
            <div class="container" id="containers">
              <h3>STUDENT ORGANIZATIONS & ACTIVITIES EVALUATION FORM</h3>
              <hr>
              <h6 for="Activity">Name of Activity:</h6>
              <h6 for="StudentOrganization">Name of Organization:</h6>
              <h6 for="DateTime">Date & Time:</h6>
              <h6 for="Venue">Venue:</h6>
              <hr>

              <h6>1. PROGRAM/ACTIVITY</h6>
              <div class="row">
                <div class="col">
                  <div class="piechart" id="piechart3d"></div>
                </div>
                <div class="col">
                  <div class="piechart" id="piechart3d_2"></div>
                </div>
                <div class="col">
                  <div class="piechart" id="piechart3d_3"></div>
                </div>
                <div class="col">
                  <div class="piechart" id="piechart3d_4"></div>
                </div>
                <div class="col">
                  <div class="piechart" id="piechart3d_5"></div>
                </div>
                <div class="col">
                  <div class="piechart" id="piechart3d_6"></div>
                </div>
                <div class="col">
                  <div class="piechart" id="piechart3d_7"></div>
                </div>
                <div class="col">
                  <div class="piechart" id="piechart3d_8"></div>
                </div>
                <div class="col">
                  <div class="piechart" id="piechart3d_9"></div>
                </div>
              </div>
              <h6>2. SPEAKER (IF APPLICABLE)</h6>
              <div class="row">
                <div class="col">
                  <div class="piechart" id="piechart3d_10"></div>
                </div>
                <div class="col">
                  <div class="piechart" id="piechart3d_11"></div>
                </div>
                <div class="col">
                  <div class="piechart" id="piechart3d_12"></div>
                </div>
                <div class="col">
                  <div class="piechart" id="piechart3d_13"></div>
                </div>
              </div>
              <h6>3. Venue</h6>
              <div class="row">
                <div class="col">
                  <div class="piechart" id="piechart3d_14"></div>
                </div>
                <div class="col">
                  <div class="piechart" id="piechart3d_15"></div>
                </div>
                <div class="col">
                  <div class="piechart" id="piechart3d_16"></div>
                </div>
              </div>
              <h6>4.  PARTICIPATION</h6>
              <div class="row">
                <div class="col">
                  <div class="piechart" id="piechart3d_17"></div>
                </div>
                <div class="col">
                  <div class="piechart" id="piechart3d_18"></div>
                </div>
                <div class="col">
                  <div class="piechart" id="piechart3d_19"></div>
                </div>
              </div>
              <h6>5.  FOOD/HOSPITALITY</h6>
              <div class="row">
                <div class="col">
                  <div class="piechart" id="piechart3d_20"></div>
                </div>
              </div>
              <h6>6.  TEAMWORK/COORDINATION OF ORGANIZATION</h6>
              <div class="row">
                <div class="col">
                  <div class="piechart" id="piechart3d_21"></div>
                </div>
              </div>
            </div>
      </div>
      </div>

    <script>
      $(document).ready(function(){

        google.charts.load('current', {'packages':['corechart']});

        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Registration', 'Percentage'],
            ['Outstanding', 18.75],
            ['Very Satisfactory', 31.25],
            ['Satisfactory', 10],
            ['Moderately Satisfactory', 10],
            ['Needs Improvement', 17.5],
          ]);

          var options = {
            title: 'a.	Stimulates the interest of the students.',
            pieSliceText: 'value',
            is3D: true
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart3d'));
          chart.draw(data, options);
        }

        // SECOND PIE
        google.charts.setOnLoadCallback(drawChart2);
        function drawChart2() {
          var data2 = google.visualization.arrayToDataTable([
            ['Registration', 'Percentage'],
            ['Outstanding', 18.75],
            ['Very Satisfactory', 31.25],
            ['Satisfactory', 10],
            ['Moderately Satisfactory', 10],
            ['Needs Improvement', 17.5],
          ]);

          var options2 = {
            title: 'b.	Provide equal opportunities to all students or participants.',
            pieSliceText: 'value',
            is3D: true
          };

          var chart2 = new google.visualization.PieChart(document.getElementById('piechart3d_2'));
          chart2.draw(data2, options2);
        }

        // THIRD PIE
        google.charts.setOnLoadCallback(drawChart3);

        function drawChart3() {
          var data3 = google.visualization.arrayToDataTable([
            ['Registration', 'Percentage'],
            ['Outstanding', 18.75],
            ['Very Satisfactory', 31.25],
            ['Satisfactory', 10],
            ['Moderately Satisfactory', 10],
            ['Needs Improvement', 17.5],
          ]);

          var options3 = {
            title: 'c.	Enhance the learning experience of the students.',
            pieSliceText: 'value',
            is3D: true
          };

          var chart3 = new google.visualization.PieChart(document.getElementById('piechart3d_3'));
          chart3.draw(data3, options3);
        }
        //Fourth pie
        google.charts.setOnLoadCallback(drawChart4);
        function drawChart4() {
          var data4 = google.visualization.arrayToDataTable([
            ['Registration', 'Percentage'],
          ['Outstanding', 18.75],
            ['Very Satisfactory', 31.25],
            ['Satisfactory', 10],
            ['Moderately Satisfactory', 10],
            ['Needs Improvement', 17.5],
          ]);

          var options4 = {
            title: 'd.	Help in recognizing and developing students’ inner skills such as leadership qualities, creative and innovative skills, etc.',
            pieSliceText: 'value',
            is3D: true
          };

          var chart4 = new google.visualization.PieChart(document.getElementById('piechart3d_4'));
          chart4.draw(data4, options4);
        }
          //Fifth pie
          google.charts.setOnLoadCallback(drawChart5);

          function drawChart5() {
            var data5 = google.visualization.arrayToDataTable([
              ['Registration', 'Percentage'],
              ['Outstanding', 18.75],
              ['Very Satisfactory', 31.25],
              ['Satisfactory', 10],
              ['Moderately Satisfactory', 10],
              ['Needs Improvement', 17.5],
            ]);

            var options5 = {
              title: 'e.	Help in developing richer learning experiences by giving the students chance to think in new ways to solve a problem or answer a question.',
              pieSliceText: 'value',
              is3D: true
            };

            var chart5 = new google.visualization.PieChart(document.getElementById('piechart3d_5'));
            chart5.draw(data5, options5);
          }
          //Sixth pie
          google.charts.setOnLoadCallback(drawChart6);

    function drawChart6() {
      var data6 = google.visualization.arrayToDataTable([
        ['Registration', 'Percentage'],
        ['Outstanding', 18.75],
              ['Very Satisfactory', 31.25],
              ['Satisfactory', 10],
              ['Moderately Satisfactory', 10],
              ['Needs Improvement', 17.5],
      ]);

      var options6 = {
        title: 'f.	Satisfy students’ need to take time outs to do more than just studying.',
        pieSliceText: 'value',
        is3D: true
      };

      var chart6 = new google.visualization.PieChart(document.getElementById('piechart3d_6'));
      chart6.draw(data6, options6);
    }
    //Seventh pie
    google.charts.setOnLoadCallback(drawChart7);

    function drawChart7() {
      var data7 = google.visualization.arrayToDataTable([
        ['Registration', 'Percentage'],
        ['Outstanding', 18.75],
              ['Very Satisfactory', 31.25],
              ['Satisfactory', 10],
              ['Moderately Satisfactory', 10],
              ['Needs Improvement', 17.5],
      ]);

      var options7 = {
        title: 'g.	Give students a chance to relax, refresh and mingle easily with others.',
        pieSliceText: 'value',
        is3D: true
      };

      var chart7 = new google.visualization.PieChart(document.getElementById('piechart3d_7'));
      chart7.draw(data7, options7);
    }

    //Eighth pie
    google.charts.setOnLoadCallback(drawChart8);

    function drawChart8() {
      var data8 = google.visualization.arrayToDataTable([
              ['Registration', 'Percentage'],
              ['Outstanding', 18.75],
              ['Very Satisfactory', 31.25],
              ['Satisfactory', 10],
              ['Moderately Satisfactory', 10],
              ['Needs Improvement', 17.5],
      ]);

      var options8 = {
        title: 'h.	Provide opportunity for students to apply learning in their practical life.',
        pieSliceText: 'value',
        is3D: true
      };

      var chart8 = new google.visualization.PieChart(document.getElementById('piechart3d_8'));
      chart8.draw(data8, options8);
    }


    //Ninth pie
    google.charts.setOnLoadCallback(drawChart9);

    function drawChart9() {
      var data9 = google.visualization.arrayToDataTable([
              ['Registration', 'Percentage'],
              ['Outstanding', 18.75],
              ['Very Satisfactory', 31.25],
              ['Satisfactory', 10],
              ['Moderately Satisfactory', 10],
              ['Needs Improvement', 17.5],
      ]);

      var options9 = {
        title: 'i.	Provide opportunity for student to work in team.',
        pieSliceText: 'value',
        is3D: true
      };

      var chart9 = new google.visualization.PieChart(document.getElementById('piechart3d_9'));
      chart9.draw(data9, options9);
    }

  //Tenth pie
  google.charts.setOnLoadCallback(drawChart10);

  function drawChart10() {
    var data10 = google.visualization.arrayToDataTable([
            ['Registration', 'Percentage'],
            ['Outstanding', 18.75],
            ['Very Satisfactory', 31.25],
            ['Satisfactory', 10],
            ['Moderately Satisfactory', 10],
            ['Needs Improvement', 17.5],
    ]);

    var options10 = {
      title: 'a.	Provides relevant and up to date information about the program/activity',
      pieSliceText: 'value',
      is3D: true
    };

    var chart10 = new google.visualization.PieChart(document.getElementById('piechart3d_10'));
    chart10.draw(data10, options10);
  }

  //Eleventh pie
  google.charts.setOnLoadCallback(drawChart11);

  function drawChart11() {
    var data11 = google.visualization.arrayToDataTable([
            ['Registration', 'Percentage'],
            ['Outstanding', 18.75],
            ['Very Satisfactory', 31.25],
            ['Satisfactory', 10],
            ['Moderately Satisfactory', 10],
            ['Needs Improvement', 17.5],
    ]);

    var options11 = {
      title: 'b.	Built rapport with the participants',
      pieSliceText: 'value',
      is3D: true
    };

    var chart11 = new google.visualization.PieChart(document.getElementById('piechart3d_11'));
    chart11.draw(data11, options11);
  }

  //twelve pie
  google.charts.setOnLoadCallback(drawChart12);

  function drawChart12() {
    var data12 = google.visualization.arrayToDataTable([
      ['Registration', 'Percentage'],
      ['Outstanding', 18.75],
      ['Very Satisfactory', 31.25],
      ['Satisfactory', 10],
      ['Moderately Satisfactory', 10],
      ['Needs Improvement', 17.5],
    ]);

    var options12 = {
      title: 'c.	has good balance between theory & practice',
      pieSliceText: 'value',
      is3D: true
    };

    var chart12 = new google.visualization.PieChart(document.getElementById('piechart3d_12'));
    chart12.draw(data12, options12);
  }
  //thirteen pie
  google.charts.setOnLoadCallback(drawChart13);

  function drawChart13() {
    var data13 = google.visualization.arrayToDataTable([
      ['Registration', 'Percentage'],
      ['Outstanding', 18.75],
      ['Very Satisfactory', 31.25],
      ['Satisfactory', 10],
      ['Moderately Satisfactory', 10],
      ['Needs Improvement', 17.5],
    ]);

    var options13 = {
      title: 'd.	Has good mastery of the content/ subject matter',
      pieSliceText: 'value',
      is3D: true
    };

    var chart13 = new google.visualization.PieChart(document.getElementById('piechart3d_13'));
    chart13.draw(data13, options13);
  }

  //14 pie
  google.charts.setOnLoadCallback(drawChart14);

  function drawChart14() {
    var data14 = google.visualization.arrayToDataTable([
      ['Registration', 'Percentage'],
      ['Outstanding', 18.75],
      ['Very Satisfactory', 31.25],
      ['Satisfactory', 10],
      ['Moderately Satisfactory', 10],
      ['Needs Improvement', 17.5],
    ]);

    var options14 = {
      title: 'a.	Ventilation',
      pieSliceText: 'value',
      is3D: true
    };

    var chart14 = new google.visualization.PieChart(document.getElementById('piechart3d_14'));
    chart14.draw(data14, options14);
  }

  //15
  google.charts.setOnLoadCallback(drawChart15);

  function drawChart15() {
    var data15 = google.visualization.arrayToDataTable([
      ['Registration', 'Percentage'],
      ['Outstanding', 18.75],
      ['Very Satisfactory', 31.25],
      ['Satisfactory', 10],
      ['Moderately Satisfactory', 10],
      ['Needs Improvement', 17.5],
    ]);

    var options15 = {
      title: 'b.	Space',
      pieSliceText: 'value',
      is3D: true
    };

    var chart15 = new google.visualization.PieChart(document.getElementById('piechart3d_15'));
    chart15.draw(data15, options15);
  }

  //16
  google.charts.setOnLoadCallback(drawChart16);

  function drawChart16() {
    var data16 = google.visualization.arrayToDataTable([
      ['Registration', 'Percentage'],
      ['Outstanding', 18.75],
      ['Very Satisfactory', 31.25],
      ['Satisfactory', 10],
      ['Moderately Satisfactory', 10],
      ['Needs Improvement', 17.5],
    ]);

    var options16 = {
      title: 'c.	Ambiance (light & Sounds)',
      pieSliceText: 'value',
      is3D: true
    };

    var chart16 = new google.visualization.PieChart(document.getElementById('piechart3d_16'));
    chart16.draw(data16, options16);
  }

  //17
  google.charts.setOnLoadCallback(drawChart17);
  function drawChart17() {
    var data17 = google.visualization.arrayToDataTable([
      ['Registration', 'Percentage'],
      ['Outstanding', 18.75],
      ['Very Satisfactory', 31.25],
      ['Satisfactory', 10],
      ['Moderately Satisfactory', 10],
      ['Needs Improvement', 17.5],
    ]);

    var options17 = {
      title: 'a.	Attendance',
      pieSliceText: 'value',
      is3D: true
    };

    var chart17 = new google.visualization.PieChart(document.getElementById('piechart3d_17'));
    chart17.draw(data17, options17);
  }

  //18
  google.charts.setOnLoadCallback(drawChart18);

  function drawChart18() {
    var data18 = google.visualization.arrayToDataTable([
      ['Registration', 'Percentage'],
      ['Outstanding', 18.75],
      ['Very Satisfactory', 31.25],
      ['Satisfactory', 10],
      ['Moderately Satisfactory', 10],
      ['Needs Improvement', 17.5],
    ]);

    var options18 = {
      title: 'b.	Cooperation',
      pieSliceText: 'value',
      is3D: true
    };

    var chart18 = new google.visualization.PieChart(document.getElementById('piechart3d_18'));
    chart18.draw(data18, options18);
  }

  //19
  google.charts.setOnLoadCallback(drawChart19);

  function drawChart19() {
    var data19 = google.visualization.arrayToDataTable([
      ['Registration', 'Percentage'],
      ['Outstanding', 18.75],
      ['Very Satisfactory', 31.25],
      ['Satisfactory', 10],
      ['Moderately Satisfactory', 10],
      ['Needs Improvement', 17.5],
    ]);

    var options19 = {
      title: 'c.	Punctuality',
      pieSliceText: 'value',
      is3D: true
    };

    var chart19 = new google.visualization.PieChart(document.getElementById('piechart3d_19'));
    chart19.draw(data19, options19);
  }
  //20
  google.charts.setOnLoadCallback(drawChart20);

  function drawChart20() {
    var data20 = google.visualization.arrayToDataTable([
      ['Registration', 'Percentage'],
      ['Outstanding', 18.75],
      ['Very Satisfactory', 31.25],
      ['Satisfactory', 10],
      ['Moderately Satisfactory', 10],
      ['Needs Improvement', 17.5],
    ]);

    var options20 = {
      pieSliceText: 'value',
      is3D: true
    };

    var chart20 = new google.visualization.PieChart(document.getElementById('piechart3d_20'));
    chart20.draw(data20, options20);
  }
    //20
  google.charts.setOnLoadCallback(drawChart21);

  function drawChart21() {
    var data21 = google.visualization.arrayToDataTable([
      ['Registration', 'Percentage'],
      ['Outstanding', 18.75],
      ['Very Satisfactory', 31.25],
      ['Satisfactory', 10],
      ['Moderately Satisfactory', 10],
      ['Needs Improvement', 17.5],
    ]);

    var options21 = {
      pieSliceText: 'value',
      is3D: true
    };

    var chart21 = new google.visualization.PieChart(document.getElementById('piechart3d_21'));
    chart21.draw(data21, options21);
  }
      });
    </script> --}}
</body>
</html>
