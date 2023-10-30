<?php

namespace App\Http\Controllers;

use App\Models\Book;
use DataTables;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function anyData(Request $request){
        if ($request->ajax()) {
            $data = Book::select("*");
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('image', function($data){
                return '<img src="' . asset("book_images/" . $data->image) . '" width="100" height="100" />';
            })
            ->rawColumns(['action','image'])
            ->make(true);
        }
    }

}
