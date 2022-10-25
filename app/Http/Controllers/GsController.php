<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryDetail;
use Illuminate\Http\Request;

class GsController extends Controller
{
    public function index()
    {
        return view('gs.index');
    }

    public function create()
    {
        return view('gs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'type' => 'gs',
            'created_by' => auth()->user()->username,
        ]);

        return redirect()->route('gs.index')->with('success', 'New GS Doc Category created successfully.');
    }

    public function show($category_id)
    {
        // return $category_id;
        $category = Category::find($category_id);
        return view('gs.details.index', compact('category'));
    }

    public function upload(Request $request, $catagory_id)
    {
        $this->validate($request, [
            'month' => 'required',
            'file_upload' => 'required'
        ]);

        $file = $request->file('file_upload');

        $filename = rand() . '_' . $file->getClientOriginalName();

        // move file to server
        $file->move(public_path('document_upload'), $filename);


        $category_detail = new CategoryDetail();
        $category_detail->category_id = $catagory_id;
        $category_detail->month = $request->month . '-01';
        $category_detail->filename = $filename;
        $category_detail->created_by = auth()->user()->username;
        $category_detail->save();

        return redirect()->route('gs.show', $catagory_id)->with('success', 'Document updated successfully');
    }

    public function destroy($id)
    {
        $category_detail = CategoryDetail::find($id);
        $category_detail->delete();

        return redirect()->route('gs.show', $category_detail->category_id)->with('success', 'Document deleted successfully');
    }

    public function data()
    {
        $gs_items = Category::where('type', 'gs')->orderBy('name', 'asc')->get();

        return datatables()->of($gs_items)
            ->addIndexColumn()
            ->addColumn('action', 'gs.action')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function gs_detail_data($category_id)
    {
        $gs_details = CategoryDetail::where('category_id', $category_id)
            ->orderBy('month', 'desc')
            ->get();

        return datatables()->of($gs_details)
            ->editColumn('month', function ($gs_details) {
                return date('M-Y', strtotime($gs_details->month));
            })
            ->addIndexColumn()
            ->addColumn('action', 'gs.details.action')
            ->rawColumns(['action'])
            ->toJson();
    }
}
