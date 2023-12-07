<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('adm.content.province.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adm.content.province.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:'.(new \App\Models\Province())->getTable().',name']
        ]);

        try {
            DB::transaction(function() use ($request){
                $data = new \App\Models\Province();
                $data->name = $request->name;
                $data->save();
            });
        } catch (Exception $e){
            throw $e;
        }

        return redirect()->route('adm.province.index')->with([
            'status' => 'success',
            'message' => 'Successfully store new data!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = \App\Models\Province::findOrFail($id);
        return view('adm.content.province.show', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = \App\Models\Province::findOrFail($id);
        return view('adm.content.province.edit', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:'.(new \App\Models\Province())->getTable().',name,'.$id]
        ]);

        try {
            DB::transaction(function() use ($request, $id){
                $data = \App\Models\Province::findOrFail($id);
                $data->name = $request->name;
                $data->save();
            });
        } catch (Exception $e){
            throw $e;
        }

        return redirect()->route('adm.province.index')->with([
            'status' => 'success',
            'message' => 'Successfully update related data!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {
            DB::transaction(function() use ($id){
                $data = \App\Models\Province::findOrFail($id);
                $data->delete();
            });
        } catch (Exception $e){
            throw $e;
        }

        if($request->ajax()){
            // Handle if request is ajax
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully delete related data!'
            ]);
        }

        return redirect()->route('adm.province.index')->with([
            'status' => 'success',
            'message' => 'Successfully delete related data!'
        ]);
    }

    /**
     * Datatable List
     * 
     */
    public function datatableAll(Request $request)
    {
        $data = \App\Models\Province::query();

        return datatables()
            ->of($data->withCount('regency'))
            ->toJson();
    }

    /**
     * Select2 List
     */
    public function select2(Request $request)
    {
        $data = \App\Models\Province::query();
        $last_page = null;

        // Apply filter (if exists)
        if($request->has('search') && $request->search != ''){
            // Apply search param
            $data->where('name', 'like', '%'.$request->search.'%');
        }

        // Ordering
        $data->orderBy('name', 'asc');

        // Handle pagination
        if($request->has('page')){
            // If request has page parameter, add paginate to eloquent
            $data->paginate(10);
            // Get last page
            $last_page = $data->paginate(10)->lastPage();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data Fetched',
            'last_page' => $last_page,
            'data' => $data->get(),
        ]);
    }
}
