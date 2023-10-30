<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(BookRequest $request)
    {
        try{
            DB::beginTransaction();
            $book = new Book();
            $book->title = $request->title ?? '';
            $book->author_name = $request->author_name ?? '';
            $book->genre = $request->genre ?? '';
            $book->description = $request->description ?? '';
            $book->isbn = $request->isbn ?? '';
            $book->publisher_name = $request->publisher_name ?? '';
            $book->published = date("Y-m-d");
            if($request->image){
                $imageName="";
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('book_images'), $imageName);
                $book->image = $imageName;
            }
            $book->save();
            DB::commit();
            return redirect('/admin/dashboard')->with("success","Book Added Successfully.");
        }catch(\Exception $e){
            DB::rollBack();
            $errorMessage = $e->getMessage();
            return redirect()->back()->with("error",$errorMessage);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        return view('books.edit',compact('id','book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, $id)
    {
        try{
            DB::beginTransaction();
            $book = Book::find(($id));
            $book->title = $request->title ?? '';
            $book->author_name = $request->author_name ?? '';
            $book->genre = $request->genre ?? '';
            $book->description = $request->description ?? '';
            $book->isbn = $request->isbn ?? '';
            $book->publisher_name = $request->publisher_name ?? '';
            $book->published = date("Y-m-d");
            if($request->image){
                unlink("book_images/".$book->image);
                $imageName="";
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('book_images'), $imageName);
                $book->image = $imageName;
            }
            $book->save();
            DB::commit();
            return redirect('/admin/dashboard')->with("success","Book Updated Successfully.");
        }catch(\Exception $e){
            DB::rollBack();
            $errorMessage = $e->getMessage();
            return redirect()->back()->with("error",$errorMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book_id = $id ?? '';
        if(!empty($book_id)){
                $book = Book::find($book_id);
                $book->delete();
            return response()->json(["success"=>true,"message" => "Books deleted successfully."]);
        }else{
            return response()->json(["error"=>true,"message" => "Server Error."]);
        }
    }

    public function anyData(Request $request){
        if ($request->ajax()) {
            $data = Book::select("*");
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('image', function($data){
                return '<img src="' . asset("book_images/" . $data->image) . '" width="100" height="100" />';
            })
            ->editColumn('action', function($data) {
                return '<a href="'.route('book.edit',$data->id).'" class="btn btn-primary">Edit</a>
                        <a class="btn btn-danger delete_book" data-url="'.route('book.destroy',$data->id).'">Delete</a>';
            })
            ->rawColumns(['action','image'])
            ->make(true);
        }
    }
}
