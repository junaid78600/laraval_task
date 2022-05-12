<?php

namespace App\Http\Controllers;
use DataTables;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 


    public function index(Request $request)
    {
        $data = [
            'menu'       => 'menu.v_menu_admin',
            'content'    => 'content.view_student',
            'title'    => 'Student Management',
            'jb'    => Course::all()
        ];

        if ($request->ajax()) {
            $q_user = Student::select('*')->orderByDesc('created_at');
            return Datatables::of($q_user)
                    ->addIndexColumn()
                     ->addColumn('action', function($row){
     
                        $btn = '<div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2 edit editStudent"><i class=" fi-rr-edit"></i></div>';
                        $btn = $btn.' <div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-sm btn-icon btn-outline-danger btn-circle mr-2 deleteStudent"><i class="fi-rr-trash"></i></div>';
 
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Student::updateOrCreate(['id' => $request->student_id],
                [
                 'name' => $request->name,
                 'email' => $request->email,
                 'course' => $request->course,
                
                ]);        

        return response()->json(['success'=>'Student saved successfully!']);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    public function edit($id)
    {
        $Student = Student::find($id);
        return response()->json($Student);
    }

    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Student::find($id)->delete();

        return response()->json(['success'=>'Student deleted!']);
    }
}
