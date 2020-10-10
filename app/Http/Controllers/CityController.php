<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Region;
use App\Http\Requests\CityRequest;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::with(['region', 'schools'])->get();

        return view('cities.index', [
            'cities' => $cities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::all();

        return view('cities.create', [
            'regions' => $regions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        $validated = $request->validated();
        $city = City::create($validated);

        return redirect('/cities')->with('msg_success', "Успешно добавихте населено място $city->name!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $regions = Region::all();

        return view('cities.edit', [
            'city' => $city,
            'regions' => $regions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CityRequest  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, City $city)
    {
        $validated = $request->validated();
        $city->update($validated);

        return redirect('/cities')->with('msg_update', "Успешно променихте населено място $city->name!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $cityName = $city->name;
        if($city->schools->count() == 0){
            $city->delete();
        } else {
            return redirect('/cities')->with('msg_success', "Грешка! Населено място $city->name има училища, трябва първо да изтриете училищата към това населено място");
        }

        return redirect('/cities')->with('msg_delete', "Успешно изтрихте населено място $cityName!");
    }
}
