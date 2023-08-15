<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use Hash;

use App\Models\Qualification;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use Illuminate\Contracts\Pipeline\Hub;

class ReportResultController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = Qualification::select('*')->orderBy('ID','ASC');
            $data = Transaction::join('detailtransactions', 'transactions.ID', '=', 'detailtransactions.TransID')
                ->join('courses', 'courses.ID', '=', 'detailtransactions.CourseID')
                ->join('instructors', 'instructors.ID', '=', 'detailtransactions.InstructorID');

            if (!empty($_REQUEST['Member'])) {
                $data = $data->where('transactions.Member', $_REQUEST['Member']);
            }
            if (!empty($_REQUEST['CourseID'])) {
                $data = $data->where('detailtransactions.CourseID', $_REQUEST['CourseID']);
            }
            if (!empty($_REQUEST['InstructorID'])) {
                $data = $data->where('detailtransactions.InstructorID', $_REQUEST['InstructorID']);
            }

            $data = $data->orderBy('ID', 'DESC')->groupBy([
                'transactions.ID',
                'transactions.TransCode',
                'transactions.TransDate',
                'transactions.CustName',
                'transactions.Member',
                'transactions.Subtotal',
                'transactions.Discount',
                'transactions.Total',
            ]);
            $data = $data->get(['transactions.*']);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('Member', function ($row) {
                    $_row = strtoupper($row->Member);
                    return $_row;
                })
                ->addColumn('Subtotal', function ($row) {
                    $_price = 'Rp ' . number_format($row->Subtotal, 0, '.', '.');
                    return $_price;
                })
                ->addColumn('Discount', function ($row) {
                    $_price = 'Rp ' . number_format($row->Discount, 0, '.', '.');
                    return $_price;
                })
                ->addColumn('Total', function ($row) {
                    $_price = 'Rp ' . number_format($row->Total, 0, '.', '.');
                    return $_price;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="row"><a href="javascript:void(0)" id="' . $row->ID . '" class="btn btn-primary btn-sm ml-2 btn-edit">Detail</a>';
                    // $btn .= '<a href="javascript:void(0)" id="' . $row->ID . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a></div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $instructors = Instructor::select('*')->orderBy('ID', 'ASC');
        $courses = Course::select('*')->orderBy('ID', 'ASC');

        $Member = $_REQUEST['Member'] ?? "";
        $CourseID = $_REQUEST['CourseID'] ?? "";
        $InstructorID = $_REQUEST['InstructorID'] ?? "";

        return view('admin.reportresult.index', [
            'instructors' => $instructors->get(),
            'courses' => $courses->get(),
            'Member' => $Member,
            'CourseID' => $CourseID,
            'InstructorID' => $InstructorID,
        ]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function edit($ID)
    {
        $transaction = Transaction::select('*')->where('ID', $ID)->first();
        // $detailTransaction = DetailTransaction::select('*')->where('TransID', $ID)->get();
        $detailTransaction = DetailTransaction::join('courses', 'courses.ID', '=', 'detailtransactions.CourseID')
            ->join('instructors', 'instructors.ID', '=', 'detailtransactions.InstructorID')->where('TransID', $ID)->get(['detailtransactions.*', 'courses.CourseName', 'instructors.InstructorName']);
        return response()->json(['transaction' => $transaction, 'details' => $detailTransaction]);
    }

    public function update(Request $request, Qualification $qualification)
    {
    }

    public function destroy(Qualification $qualification)
    {
    }
}
