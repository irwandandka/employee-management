<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $countries = Country::latest()->get();
        if($request->has('search')) {
            $countries = Country::where('name', 'like', "%{$request->search}%")
                ->orWhere('country_code', 'like', "%{$request->search}%")->latest()->get();
        }
        return view('countries.index', [
            'countries' => $countries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:countries',
            'country_code' => 'required|unique:countries',
        ]);

        Country::create($request->all());

        return to_route('countries.index')->with('message', 'Country created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $this->validate($request, [
            'name' => 'required|unique:countries,name,' . $country->id,
            'country_code' => 'required|unique:countries,country_code,' . $country->id,
        ]);


        $country->update($request->all());

        return to_route('countries.index')->with('message', 'Country updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return to_route('countries.index')->with('message', 'Country deleted successfully');
    }
}
