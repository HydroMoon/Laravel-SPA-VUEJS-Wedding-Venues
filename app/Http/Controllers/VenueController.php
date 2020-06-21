<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Resources\VenueResource;
use App\Http\Resources\StateResource;
use App\Http\Resources\CityResource;
use App\Location;
use App\State;
use App\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VenueResource::collection(Venue::with(['venue_service', 'contact'])->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $request->validate([
        //     'venue_name' => 'required',
        //     'venue_desc' => 'required',
        //     'location_id' => 'required',
        //     'name' => 'required',
        //     'phone1' => 'required',
        //     'email' => 'required',
        //     'photography' => 'required',
        //     'videography' => 'required',
        //     'organize_team' => 'required',
        //     'overnight' => 'required',
        //     'jirtg' => 'required',
        //     'guests' => 'required',
        // ]);



        $location = Location::create($request->location);

        //dd($location);

        $venue = Venue::create($request->venue_info + ['location_id' => $location->id]);

        $venue->contact()->create($request->contact);

        $venue->venue_service()->create($request->venue_service);


        return (new VenueResource($venue))
                ->response()
                ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $v_id = $id;
        $venue = Venue::with(['venue_service', 'contact' => function ($q) use ($v_id) {
            $q->where('venue_id', $v_id);
        }])->where('id', $id)->get();

        return VenueResource::collection($venue);
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
        $venue = Venue::find($id);

        $venue->update($request->venue_info);

        $venue->contact()->update($request->contact);

        $venue->venue_service()->update($request->venue_service);

        return (new VenueResource($venue))
                ->response()
                ->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venue = Venue::findOrFail($id);

        // $venue->contact()->delete();
        // $venue->venue_service()->delete();
        $venue->delete();

        return response()->json('Delete success', 204);
    }




    //Others
    public function getCount()
    {
        $venues_count = Venue::count();

        return response($venues_count);
    }


    //States and location logic
    public function getStates()
    {
        $states = State::with('city')->get();

        return StateResource::collection($states);
    }

    public function getCities($id)
    {
        $cities = City::where('state_id', $id)->get();

        return CityResource::collection($cities);
    }

    public function getAddress()
    {
        $address = State::with(['city.location' => function ($q) {
            $q->where([
                ['locations.id', 2]
            ]);
        }])->get();

        return response($address, 200);
    }
}
