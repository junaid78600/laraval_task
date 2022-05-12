<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Article;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 


    public function index(Request $request)
    {
        $data = [
            'menu'       => 'menu.v_menu_admin',
            'content'    => 'content.view_article',
            'title'    => 'Article Management'
        ];

        if ($request->ajax()) {
            $q_user = Article::select('*')->orderByDesc('created_at');
            return Datatables::of($q_user)
                    ->addIndexColumn()
                     ->addColumn('action', function($row){
     
                        $btn = '<div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2 edit editArticle"><i class=" fi-rr-edit"></i></div>';
                        $btn = $btn.' <div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-sm btn-icon btn-outline-danger btn-circle mr-2 deleteArticle"><i class="fi-rr-trash"></i></div>';
 
                         return $btn;
                    })
                    ->addColumn('video',function($row){
                        $link='<button class="play" data-play="'.$row->link.'">Play</button>';
                        return $link;
                    })->rawColumns(array("video","action"))
                  
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
      Article::updateOrCreate(['id' => $request->article_id],
                [
                 'title' => $request->title,
                 'link' => $request->link,
                
                ]);        

        return response()->json(['success'=>'Article saved successfully!']);
    }

    
    public function show(Article $article)
    {
        //
    }

    
    public function edit($id)
    {
        $Article = Article::find($id);
        return response()->json($Article);
    }

    
    public function update(Request $request, Article $article)
    {
        //
    }

   
     public function destroy($id)
    {
       Article::find($id)->delete();

        return response()->json(['success'=>'Article deleted!']);
    }
}
