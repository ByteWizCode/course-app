<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use Hash;

use App\Models\Qualification;
use App\Models\Instructor;
use App\Models\Course;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = Qualification::select('*')->orderBy('ID','ASC');
            $data = Qualification::join('instructors', 'instructors.ID', '=', 'qualifications.InstructorID')
                ->join('courses', 'courses.ID', '=', 'qualifications.TopicID')
                ->get(['qualifications.*', 'courses.CourseName', 'instructors.InstructorName']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('TopicID', function ($row) {
                    $_row = $row->CourseName;
                    return $_row;
                })
                ->addColumn('InstructorID', function ($row) {
                    $_row = $row->InstructorName;
                    return $_row;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="row"><a href="javascript:void(0)" id="' . $row->ID . '" class="btn btn-primary btn-sm ml-2 btn-edit">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->ID . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a></div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $instructors = Instructor::select('*')->orderBy('ID', 'ASC');
        $courses = Course::select('*')->orderBy('ID', 'ASC');

        return view('admin.report.index', ['instructors' => $instructors->get(), 'courses' => $courses->get()]);
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

    public function edit(Qualification $qualification)
    {
    }

    public function update(Request $request, Qualification $qualification)
    {
    }

    public function destroy(Qualification $qualification)
    {
    }
}
