<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $states = State::with('country')->latest()->get();
        if($request->has('search')) {
            $states = State::where('name', 'like', "%{$request->search}%")->with('country')->latest()->get();
        }
        return view('states.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('states.create', [
            'countries' => Country::all()
        ]);
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
            'name' => 'required|string|max:50',
            'country_id' => 'required|exists:countries,id'
        ]);

        State::create($request->all());

        return to_route('states.index')->with('message', 'State created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        return view('states.edit', [
            'state' => $state,
            'countries' => Country::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'country_id' => 'required|exists:countries,id',
        ]);

        $state->update($request->all());

        return to_route('states.index')->with('message', 'State updated successfully');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        $state->delete();
        return to_route('states.index')->with('message', 'State deleted successfully');
    }
}
