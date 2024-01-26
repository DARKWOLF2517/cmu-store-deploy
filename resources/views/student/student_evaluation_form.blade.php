@extends('layouts.student_navigation_bar')
<title>Student Evaluation Form @yield('title')</title>
@section('main-content')
<link href="/custom_css/studentEvaluation.css" rel="stylesheet">
    <div class="container" id="evaluation-form">
        <student-evaluation-form
            user_id = {{ Auth::id()}}
            event_id = {{$event_id}}
            org_id = {{Session::get('org_id')}}
        >

        </student-evaluation-form>
        {{-- <form>
            <div class="evaluation-header">
                <h5>CSCo</h5>
                <h2> Evaluation Form</h2>
                <h5> Name of Activity:</h5>
                <h5>Date and Time:</h5>
                <h5>Venue:</h5>
                <hr>
                <small> Dear Students,
                    This assessment of the program/activity you have just attended. Please rate the activity/program in terms of the following criteria listed below. Your
                    honest answer will help improve future activity. Indicate your response with a check mark (✓) to the following indicators of this form.</small>
                <div class="form-group">
                    <h6 for="name">VARIABLES</H6>
                    <small> 1 - Needs Improvement | 2 – Satisfactory  | 3 - Good | 4 - Very Good | 5 - Excellent</small>
                </div>
            </div>
            <hr>
            <div class="evaluation-body">
                <h6 class="text-center">PROGRAM/ACTIVITY</h6>
                <div class="mt-2">
                    <label for="PA-1">Stimulates the interest of the students.</label>
                    <select class="form-control" id="PA-1">
                        <option>Select choice</option>
                        <option>1 – Needs Improvement</option>
                        <option>2 – Satisfactory</option>
                        <option>3 – Good</option>
                        <option>4 – Very Good</option>
                        <option>5 – Excellent</option>
                    </select>
                </div>
                <div class="mt-4">
                <label for="PA-2">Provide equal opportunities to all students or
                    participants.</label>
                <select class="form-control" id="PA-2">
                    <option>Select choice</option>
                    <option>1 – Needs Improvement</option>
                    <option>2 – Satisfactory</option>
                    <option>3 – Good</option>
                    <option>4 – Very Good</option>
                    <option>5 – Excellent</option>
                </select>
                </div>
                <div class="mt-4">
                    <label for="PA-2">Enhance the learning experience of the students</label>
                    <select class="form-control" id="PA-3">
                        <option>Select choice</option>
                        <option>1 – Needs Improvement</option>
                        <option>2 – Satisfactory</option>
                        <option>3 – Good</option>
                        <option>4 – Very Good</option>
                        <option>5 – Excellent</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label for="PA-2">Help in recognizing and developing students’ inner
                        skills such as leadership qualities, creative and
                        innovative skills, etc.</label>
                    <select class="form-control" id="PA-4">
                        <option>Select choice</option>
                        <option>1 – Needs Improvement</option>
                        <option>2 – Satisfactory</option>
                        <option>3 – Good</option>
                        <option>4 – Very Good</option>
                        <option>5 – Excellent</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label for="PA-2">Help in developing richer learning experiences by
                        giving the students chance to think in new ways to
                        solve a problem or answer a question.</label>
                    <select class="form-control" id="PA-5">
                        <option>Select choice</option>
                        <option>1 – Needs Improvement</option>
                        <option>2 – Satisfactory</option>
                        <option>3 – Good</option>
                        <option>4 – Very Good</option>
                        <option>5 – Excellent</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label for="PA-2">Satisfy students’ need to take time outs to do more
                        than just studying.</label>
                    <select class="form-control" id="PA-6">
                        <option>Select choice</option>
                        <option>1 – Needs Improvement</option>
                        <option>2 – Satisfactory</option>
                        <option>3 – Good</option>
                        <option>4 – Very Good</option>
                        <option>5 – Excellent</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label for="PA-2">Give students a chance to relax, refresh and
                        mingle easily with others.</label>
                    <select class="form-control" id="PA-7">
                        <option>Select choice</option>
                        <option>1 – Needs Improvement</option>
                        <option>2 – Satisfactory</option>
                        <option>3 – Good</option>
                        <option>4 – Very Good</option>
                        <option>5 – Excellent</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label for="PA-2">Provide opportunity for students to apply learning
                        in their practical life.</label>
                    <select class="form-control" id="PA-8">
                        <option>Select choice</option>
                        <option>1 – Needs Improvement</option>
                        <option>2 – Satisfactory</option>
                        <option>3 – Good</option>
                        <option>4 – Very Good</option>
                        <option>5 – Excellent</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label for="PA-2">Provide opportunity for student to work in team.</label>
                    <select class="form-control" id="PA-9">
                        <option>Select choice</option>
                        <option>1 – Needs Improvement</option>
                        <option>2 – Satisfactory</option>
                        <option>3 – Good</option>
                        <option>4 – Very Good</option>
                        <option>5 – Excellent</option>
                    </select>
                </div>
                <h6 class="text-center mt-4">VENUE</h6>
                <div class="mt-2">
                    <label for="V-1">The venue was accessible and comfortable</label>
                    <select class="form-control" id="V-1">
                        <option>Select choice</option>
                        <option>1 – Needs Improvement</option>
                        <option>2 – Satisfactory</option>
                        <option>3 – Good</option>
                        <option>4 – Very Good</option>
                        <option>5 – Excellent</option>
                    </select>
                </div>
                <h6 class="text-center mt-4">PARTICIPATION</h6>
                <div class="mt-2">
                    <label for="P-1">Attendance</label>
                    <select class="form-control" id="P-1">
                        <option>Select choice</option>
                        <option>1 – Needs Improvement</option>
                        <option>2 – Satisfactory</option>
                        <option>3 – Good</option>
                        <option>4 – Very Good</option>
                        <option>5 – Excellent</option>
                    </select>
                </div>
                <div class="mt-2">
                    <label for="P-2">Cooperation</label>
                    <select class="form-control" id="P-2">
                        <option>Select choice</option>
                        <option>1 – Needs Improvement</option>
                        <option>2 – Satisfactory</option>
                        <option>3 – Good</option>
                        <option>4 – Very Good</option>
                        <option>5 – Excellent</option>
                    </select>
                </div>
                <div class="mt-2">
                    <label for="P-3">Punctuality</label>
                    <select class="form-control" id="P-3">
                        <option>Select choice</option>
                        <option>1 – Needs Improvement</option>
                        <option>2 – Satisfactory</option>
                        <option>3 – Good</option>
                        <option>4 – Very Good</option>
                        <option>5 – Excellent</option>
                    </select>
                </div>
                <h6 class="text-center mt-4">FOOD/HOSPITALITY</h6>
                <div class="mt-2">
                    <select class="form-control" id="FH-1">
                        <option>Select choice</option>
                        <option>1 – Needs Improvement</option>
                        <option>2 – Satisfactory</option>
                        <option>3 – Good</option>
                        <option>4 – Very Good</option>
                        <option>5 – Excellent</option>
                    </select>
                </div>
                <h6 class="text-center mt-4">TEAMWORK/COORDINATION OF ORGANIZATION</h6>
                <div class="mt-2">
                    <select class="form-control" id="TCO-1">
                        <option>Select choice</option>
                        <option>1 – Needs Improvement</option>
                        <option>2 – Satisfactory</option>
                        <option>3 – Good</option>
                        <option>4 – Very Good</option>
                        <option>5 – Excellent</option>
                    </select>
                </div>
                <div class="form-group mt-4">
                <label for="feedback">Please write below any suggestions/recommendations on how we can improve the Activity:</label>
                <textarea class="form-control" id="feedback" rows="3" placeholder="Enter your feedback" required></textarea>
            </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form> --}}

@endsection

@section('custom-script')

@endsection
