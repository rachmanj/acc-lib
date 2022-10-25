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

    public function update(Request $request, $categoryDetail_id)
    {
        $this->validate($request, [
            'month' => 'required',
        ]);

        $category_detail = CategoryDetail::find($categoryDetail_id);
        $category_detail->month = $request->month . '-01';
        $category_detail->save();

        $category = Category::find($category_detail->category_id);

        return redirect()->route('general.show', $category->id)->with('success', 'General Doc Upload updated successfully.');
    }

    public function show($category_id)
    {
        $category = Category::find($category_id);
        return view('general.details.index', compact('category'));
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
            ->addColumn('doc_count', function ($gs_item) {
                $doc_count = CategoryDetail::where('category_id', $gs_item->id)->count();
                if ($doc_count > 0) {
                    return $doc_count;
                } else {
                    return '0';
                }
            })
            ->addColumn('action', 'general.action')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function general_detail_data($category_id)
    {
        $general_details = CategoryDetail::where('category_id', $category_id)
            ->orderBy('month', 'desc')
            ->get();

        return datatables()->of($general_details)
            ->editColumn('month', function ($gs_details) {
                if ($gs_details->month) {
                    return date('M-Y', strtotime($gs_details->month));
                } else {
                    return '-';
                }
            })
            ->addIndexColumn()
            ->addColumn('action', 'general.details.action')
            ->rawColumns(['action'])
            ->toJson();
    }
}
