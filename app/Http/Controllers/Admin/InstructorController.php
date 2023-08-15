<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use Hash;

use App\Models\Instructor;


class InstructorController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = Course::select('*')->orderBy('ID','DESC');
            $data = Instructor::select('*')->orderBy('ID', 'ASC');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="row"><a href="javascript:void(0)" id="' . $row->ID . '" class="btn btn-primary btn-sm ml-2 btn-edit">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->ID . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a></div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.instructor.index');
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        Instructor::create($request->all());
    }

    public function show($id)
    {
    }

    public function edit(Instructor $instructor)
    {
        return response()->json($instructor);
    }

    public function update(Request $request, Instructor $instructor)
    {
        $instructor->update($request->all());
    }

    public function destroy(Instructor $instructor)
    {
        $instructor->delete();
    }
}
