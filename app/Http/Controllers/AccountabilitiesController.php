<?php

namespace App\Http\Controllers;

use App\Models\Accountability;
use App\Models\Attendance;
use App\Models\Event;
use App\Models\EventExempted;
use App\Models\EventExemptedAttendance;
use App\Models\FreeFinesStudent;
use App\Models\OrganizationDefaultSchoolYear;
use App\Models\PaidAccountability;
use App\Models\User;
use App\Models\UserOrganization;
use App\Models\UserProfile;
use App\Models\WaiveFeeEvent;
use App\Models\YearLevel;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountabilitiesController extends Controller
{
    public function getAccountabilities($org_id, $school_year)
    {
        $student = Auth::id();
        $accountabilities = Event::where([['org_id', $org_id], ['require_attendance', 1], ['event_status', 2], ['school_year', $school_year]])->with(['Attendance'])->get();
        // $paidAccountabilityTotal = PaidAccountability::where([
        //     ['student_org_id', $org_id],
        //     ['school_year', $school_year],
        //     ['student_id', $student]
        // ])->sum('amount');
        $paidAccountabilityTotal = PaidAccountability::where([
            ['student_org_id', $org_id],
            ['school_year', $school_year],
            ['student_id', $student]
        ])->get();
        return response()->json(['accountabilities' => $accountabilities, 'paid_accountabilities' => $paidAccountabilityTotal,]);
    }
    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'org_id' => 'required',
            'accountability_name' => 'required',
            'amount' => 'required',
            'school_year' => 'required',
            'breakdown' => 'required',
        ]);
        $accountability = new Accountability([
            'org_id' => $validatedData['org_id'],
            'accountability_name' => $validatedData['accountability_name'],
            'amount' => $validatedData['amount'],
            'school_year' => $validatedData['school_year'],
            'breakdown' => $validatedData['breakdown'],

        ]);
        $accountability->save();
        return response()->json(['message' => 'Accountability Created Successfully']);
    }
    public function getAccountabilitiesList($org_id, $school_year)
    {
        $accountabilities = Accountability::where([['org_id', $org_id], ['school_year', $school_year]])->get();
        return $accountabilities->toJson();
    }
    public function AccountabilitiesListInAdmin($org_id, $school_year)
    {
        $accountabilities = Event::where([['org_id', $org_id], ['require_attendance', 1], ['event_status', 2], ['school_year', $school_year]])->with(['Attendance'])->get();
        $users = UserProfile::all();
        $userOrgs = UserOrganization::where([['school_year', $school_year], ['role_id', 2], ['student_org_id', $org_id]])->get();
        $paidAccountability = PaidAccountability::where([['student_org_id', $org_id], ['school_year', $school_year]])->get();
        $accountability = Accountability::where([['org_id', $org_id], ['school_year', $school_year]])->get();
        $yearLevel = YearLevel::where([['org_id', $org_id]])->get();
        $exempted = EventExempted::where([['org_id', $org_id], ['school_year', $school_year]])->get();
        $freeFines = FreeFinesStudent::where([['org_id', $org_id], ['school_year', $school_year]])->with('waived_events')->get();
        $cancelledAttendance = EventExemptedAttendance::where([['school_year', $school_year]])->get();
        return response()->json([
            'accountabilities_fines' => $accountabilities,
            'user' => $users,
            'user_orgs' => $userOrgs,
            'paid_accountabilities' => $paidAccountability,
            'accountabilities_other' => $accountability,
            'year_level' => $yearLevel,
            'year_level_exempted' => $exempted,
            'free_fines' => $freeFines,
            'cancelled_attendance' => $cancelledAttendance,
        ]);
    }
    public function updateEventAttendanceStatus($event_id, $status, Request $request)
    {
        // return $status;
        $attendance = Event::find($event_id);
        // if ($request->end_session_scheduled_attendance != null) {
        $attendance->update(['attendance_status' => $status, 'attendance_session_started' => $request->session, 'end_session_scheduled_attendance' => $request->end_session_scheduled_attendance, 'attendance_log_started' => $request->attendance_log_started]);
        return response()->json(['message' => 'Attendance Status Updated']);
        // } else {
        //     $attendance->update(['attendance_status' => $status, 'attendance_session_started' => $request->session]);
        //     return response()->json(['message' => 'Attendance Status Updated']);
        // }
    }

    public function OtherAccountabilityPayment(Request $request)
    {
        $validatedData = $this->validate($request, [
            'accountability_name' => 'required',
            'amount' => 'required',
            'student_id' => 'required',
            'student_name' => 'required',
            'student_org_id' => 'required',
        ]);
        $accountability = new PaidAccountability([
            'student_id' => $validatedData['student_id'],
            'student_org_id' => $validatedData['student_org_id'],
            'accountability_name' => $validatedData['accountability_name'],
            'amount' => $validatedData['amount'],
        ]);
        $accountability->save();
        return response()->json(['message' => 'Accountability Paid Successfully']);
    }
    public function FinesAccountabilityPayment($school_year, $amount, $accountability_type, Request $request)
    {

        $accountability_list = Accountability::where('accountability_name', $accountability_type)->first();
        $paidAccountability = PaidAccountability::Where([['accountability_type', $accountability_type], ['student_id', $request->student_id]])->first();

        if ($accountability_type != 'fines') {
            if ($paidAccountability) {
                if ($accountability_list->amount == $paidAccountability->amount) {
                    return response()->json(['message' => 'Already Paid', 'status' => 0]);
                }
            }
        }

        if ($amount < 0) {
            return response()->json(['message' => 'Cannot Accept Negative Value', 'status' => 0]);
        } else {
            $validatedData = $this->validate($request, [
                'student_id' => 'required',
                'student_org_id' => 'required',
                'remarks' => 'required',
            ]);
            $accountability = new PaidAccountability([
                'student_id' => $validatedData['student_id'],
                'student_org_id' => $validatedData['student_org_id'],
                'amount' => $amount,
                'school_year' => $school_year,
                'accountability_type' => $accountability_type,
                'remarks' => $validatedData['remarks'],
            ]);
            $accountability->save();
            return response()->json(['message' => 'Accountability Paid Successfully', 'status' => 1]);
        }
    }
    public function attendanceFill(Request $request)
    {
        foreach ($request->all() as $data) {
            $attendance = new Attendance([
                'user_id' => $data['0'],
                'org_id' => $data['7'],
                'event_id' => $data['6'],
                'officer_id' => $data['8'],
                'session' => $data['5'],
                'remarks' => 1,

            ]);
            $attendance->save();
        }
        return response()->json(['message' => 'Accountability Paid Successfully']);
    }
    public function DeleteOrganizationAccountability(Accountability $accountability_id, $org_id)
    {
        $isPaymentPresent = PaidAccountability::where([['accountability_type', $accountability_id->accountability_name], ['student_org_id', $org_id]])->get();
        if (!$isPaymentPresent->isEmpty()) {
            return response()->json(['message' => 'Cannot be deleted due to payment record', 'status' => 1]);
        } else {
            $accountability_id->delete();
            return response()->json(['message' => 'Accountability ' . $accountability_id->accountability_name . ' Deleted successfully', 'status' => 0]);
        }
        // return $isPaymentPresent;

    }
    public function PaidAccountabilities($org_id, $school_year)
    {
        $paidAccountabilities = PaidAccountability::where([['student_org_id', $org_id], ['school_year', $school_year]])->with('user_profile')->get();
        return $paidAccountabilities->toJson();
    }

    public function viewFreeFinesStudents($org_id, $school_year)
    {
        $freeFinesStudents = FreeFinesStudent::where([['org_id', $org_id], ['school_year', $school_year]])->with('user_profile', 'waived_events')->get();
        // $freeFinesStudents = FreeFinesStudent::groupBy('accountability_type')->get();

        return $freeFinesStudents->toJson();
    }
    public function addFreeFinesStudents(Request $request)
    {
        $formData = $request->formData;
        $events = $request->events;

        if ($this->addFreeFinesRepetition($formData['student_id'], $formData['school_year'], $formData['accountability_type']) >= 1) {
            return response()->json(array("message" => "Already in the list", "error" => 1));
        }
        $freeFines = new FreeFinesStudent([
            'student_id' => $formData['student_id'],
            'reason' => $formData['reason'],
            'accountability_type' => $formData['accountability_type'],
            'org_id' => $formData['org_id'],
            'school_year' => $formData['school_year'],
        ]);
        $freeFines->save();

        if (count($events) > 0) {
            foreach ($events as $event) {
                $waive_fee_event = new WaiveFeeEvent([
                    'event_id' => $event,
                    'waive_fee_id' => $freeFines->id,
                ]);
                $waive_fee_event->save();
            }
        }
        return response()->json(['message' => 'Free Fines Student Added Successfully']);
    }
    public function addFreeFinesRepetition($student_id, $school_year, $accountability_type)
    {
        $student = FreeFinesStudent::where([['student_id', $student_id], ['school_year', $school_year], ['accountability_type', $accountability_type]])->get();
        $student = $student->count();
        return $student;
    }
    public function getStudentName($student)
    {
        $studentResult = UserOrganization::where('student_id', $student)
            ->orWhereHas('user_profile', function ($query) use ($student) {
                $query->where('first_name', $student)
                    ->orWhere('last_name', $student);
            })
            ->with('user_profile')
            ->first();

        return $studentResult;
    }
    public function deleteStudentFreeFines($id)
    {
        FreeFinesStudent::where('id', $id)->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    }
    public function fetchUpdateStudentData($id)
    {
        $student = FreeFinesStudent::where([['id', $id]])->with('user_profile', 'waived_events')->first();
        return $student;
    }
    public function updateStudentData($id, Request $request)
    {

        $waivefee = FreeFinesStudent::find($id);
        $waivefee->update([
            'reason' => $request->formData['reason'],
            'accountability_type' => $request->formData['accountability_type']
        ]);

        if (count($request->events) > 0) {
            WaiveFeeEvent::where('waive_fee_id', $id)->delete();

            foreach ($request->events as $event) {
                $waive_fee_event = new WaiveFeeEvent([
                    'event_id' => $event,
                    'waive_fee_id' => $id,
                ]);
                $waive_fee_event->save();
            }
        }

        return response()->json(['message' => 'Updated Successfully']);
    }
    public function accountabilitiesFetchUpdate($id)
    {
        $accountability = Accountability::where([['accountability_id', $id]])->first();
        return $accountability;
    }
    public function updateAccountabilities(Request $request, Accountability $id, $old_name, $org_id)
    {

        $isPaymentPresent = PaidAccountability::where([['accountability_type', $old_name], ['student_org_id', $org_id]])->get();
        if (!$isPaymentPresent->isEmpty()) {
            return response()->json(['message' => 'Cannot be deleted due to payment record', 'status' => 1]);
        } else {
            $request->validate([
                'accountability_name' => 'required',
                'amount' => 'required',
            ]);
            $id->update(['accountability_name' => $request['accountability_name'], 'amount' => $request['amount']]);
            return response()->json(['message' => 'Accountability Updated Successfully']);
        }
    }
    public function getUserOrgs($school_year)
    {
        $student = Auth::id();
        $userOrgs = UserOrganization::where([['student_id', $student], ['role_id', 2], ['school_year', $school_year]])->with('organization')->get();
        return $userOrgs->toJson();
    }
    public function getOrgAccountability($org_id, $school_year)
    {
        $accountabilities = Accountability::where([['org_id', $org_id], ['school_year', $school_year]])->get();
        return $accountabilities->toJson();
    }
    public function fetchAccountabilities($org_id)
    {
        $accountabilities = Accountability::where([['org_id', $org_id]])->get();
        return $accountabilities->toJson();
    }
    public function getStudentPayments($student_id)
    {
        $accountabilities = PaidAccountability::where([['student_id', $student_id]])->get();
        return $accountabilities->toJson();
    }
    public function deletePaidAccountabilities(PaidAccountability $accountability_id)
    {

        $accountability_id->delete();
        return response()->json(['message' => 'Payment Deleted successfully', 'status' => 0]);
        // return $isPaymentPresent;

    }
    public function getAccountabilityType($accountability_type, $school_year)
    {
        $accountabilities = Accountability::where([['accountability_name', $accountability_type], ['school_year', $school_year]])->first();
        return $accountabilities->toJson();
    }
    public function getStudentPaymentHistory($user_id, $org_id)
    {
        $accountabilities = PaidAccountability::where([['student_id', $user_id], ['student_org_id', $org_id]])->get();
        return $accountabilities->toJson();
    }
    public function getFreeFinesStudent($user_id, $org_id, $school_year)
    {
        $accountabilities = FreeFinesStudent::where([['student_id', $user_id], ['org_id', $org_id], ['school_year', $school_year]])->first();
        return $accountabilities;
    }
    public function getSessionExemptedAttendance($org_id, $school_year)
    {
        // $accountabilities = EventExemptedAttendance::where([ ['org_id', $org_id], ['school_year', $school_year]])->with('events')->get();
        // return $accountabilities;
        // $accountabilities = EventExemptedAttendance::select('event_id')
        //     // ->distinct('event_id')
        //     ->with('events')
        //     ->where('school_year', $school_year)
        //     ->get();

        // return $accountabilities;

        $accountabilities = EventExemptedAttendance::select('event_id')
            ->selectRaw('COUNT(event_id) as count')
            ->with('events')
            ->where([['school_year', $school_year], ['org_id', $org_id]])
            ->groupBy('event_id')
            ->get();

        return $accountabilities;
    }
}
