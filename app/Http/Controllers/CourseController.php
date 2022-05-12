<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function index(Request $request)
    {
        $data = [
            'menu'       => 'menu.v_menu_admin',
            'content'    => 'content.view_course',
            'title'    => 'Courses Management'
        ];

        if ($request->ajax()) {
            $q_user = Course::select('*')->orderByDesc('created_at');
            return Datatables::of($q_user)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        $btn = '<div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2 edit editCourse"><i class=" fi-rr-edit"></i></div>';
                        $btn = $btn.' <div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-sm btn-icon btn-outline-danger btn-circle mr-2 deleteCourse"><i class="fi-rr-trash"></i></div>';
 
                         return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('layouts.v_template',$data);
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
      Course::updateOrCreate(['id' => $request->course_id],
                [
                 'name' => $request->name,
                
                ]);        

        return response()->json(['success'=>'Course saved successfully!']);
    }

    
    public function show(Course $course)
    {
        //
    }

    
    public function edit($id)
    {
        $Course = Course::find($id);
        return response()->json($Course);

    }

   
    public function update(Request $request,  $id)
    {
        //
    }

    
    public function destroy($id)
    {
       Course::find($id)->delete();

        return response()->json(['success'=>'Course deleted!']);
    }
}
