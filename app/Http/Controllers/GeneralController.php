<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryDetail;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function index()
    {
        return view('general.index');
    }

    public function create()
    {
        return view('general.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'type' => 'general',
            'created_by' => auth()->user()->username,
        ]);

        return redirect()->route('general.index')->with('success', 'New General Doc Category created successfully.');
    }

    public function show($category_id)
    {
        $category = Category::find($category_id);
        return view('general.details.index', compact('category'));
    }

    public function upload(Request $request, $catagory_id)
    {
        $this->validate($request, [
            'file_upload' => 'required'
        ]);

        $file = $request->file('file_upload');

        $filename = rand() . '_' . $file->getClientOriginalName();

        // move file to server
        $file->move(public_path('document_upload'), $filename);


        $category_detail = new CategoryDetail();
        $category_detail->category_id = $catagory_id;
        $category_detail->filename = $filename;
        $category_detail->created_by = auth()->user()->username;
        $category_detail->save();

        return redirect()->route('general.show', $catagory_id)->with('success', 'Document uploaded successfully');
    }

    public function destroy($id)
    {
        $category_detail = CategoryDetail::find($id);
        $category_detail->delete();

        return redirect()->route('general.show', $category_detail->category_id)->with('success', 'Document deleted successfully');
    }

    public function data()
    {
        $general_items = Category::where('type', 'general')->orderBy('name', 'asc')->get();

        return datatables()->of($general_items)
            ->addIndexColumn()
            ->addColumn('action', 'general.action')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function general_detail_data($category_id)
    {
        $general_details = CategoryDetail::where('category_id', $category_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return datatables()->of($general_details)
            ->editColumn('created_at', function ($general_details) {
                return date('d-m-Y H:i:s', strtotime('+8 hours', strtotime($general_details->created_at)));
            })
            ->addIndexColumn()
            ->addColumn('action', 'general.details.action')
            ->rawColumns(['action'])
            ->toJson();
    }
}
