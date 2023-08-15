<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use Hash;

use App\Models\Course;


class CourseController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = Course::select('*')->orderBy('ID','DESC');
			$data = Course::select('*')->orderBy('ID','ASC');
            return DataTables::of($data)
                    ->addIndexColumn()
					->addColumn('Price', function($row){
						$_price = 'Rp '.number_format($row->Price, 0, '.', '.');
						return $_price;
				 	})
					->addColumn('IsCertificate', function($row){
						$_row = $row->IsActive == 1 ? 'Yes' : 'No';
						return $_row;
				 	})
					 ->addColumn('IsActive', function($row){
						$_row = $row->IsActive == 1 ? 'Active' : 'Disable';
						return $_row;
				 	})
                    ->addColumn('action', function($row){
                           $btn = '<div class="row"><a href="javascript:void(0)" id="'.$row->ID.'" class="btn btn-primary btn-sm ml-2 btn-edit">Edit</a>';
                           $btn .= '<a href="javascript:void(0)" id="'.$row->ID.'" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a></div>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('admin.course.index');
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {   
        Course::create($request->all());
    }

    public function show($id)
    {
        
    }

    public function edit(Course $course)
    {
        return response()->json($course);
    }

    public function update(Request $request, Course $course)
    {
        $course->update($request->all());
    }

    public function destroy(Course $course)
    {
        $course->delete();
    }
}
