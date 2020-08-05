<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyNote;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $companies = Company::withCount('notes')->get();
        
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $storeData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $company = Company::create($storeData);

        return redirect('/companies')->with('completed', 'Company has been saved!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeNote($uuid, Request $request)
    {

        //
        $storeData = $request->validate([
            'message' => 'required|max:255',
            'company_id' => 'required|integer'
        ]);
        $note = CompanyNote::create($storeData);

        return redirect('/companies/'.$uuid)->with('completed', 'Note has been saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        //
        $company = Company::with('notes')->where('companies.uuid', '=', $uuid)->get()[0];
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $company = Company::findOrFail($id);
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $updateData = $request->validate([
            'name' => 'required|max:255',
        ]);
        Company::whereId($id)->update($updateData);
        return redirect('/companies')->with('completed', 'Company has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect('/companies')->with('completed', 'Company has been deleted');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyNote($uuid, $noteid)
    {
        //
        $companyNote = CompanyNote::findOrFail($noteid);
        $companyNote->delete();

        return redirect('/companies/'.$uuid)->with('completed', 'Note has been deleted');
    }
}
