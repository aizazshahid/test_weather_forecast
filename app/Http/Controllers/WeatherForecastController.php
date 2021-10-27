<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WeatherForecast;
use Carbon\Carbon;

class WeatherForecastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// dd(Auth::user()->id);
		return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

		// Checking for Authentication
		$user = Auth::user();

		if(!$user)
			return \response()->json(['message' => 'Unauthorized'], 401);

		$user_id = $user->id;
			
		$fetched_data = $request->data;

		$weather_forecast = new WeatherForecast();
		
		
		$data = $weather_forecast->data;
		$data['forecast_data'] = $fetched_data;
		
		$weather_forecast->user_id = $user_id;
		$weather_forecast->data = $data;
		
		try {
			$weather_forecast->saveOrFail();
			// return $this->checkAndSave($fetched_data, $user_id);

			return \response()->json(['message' => 'User weather forecast data is saved successfully'], 200);
		} catch (\Throwable $th) {
			return \response()->json(['message' => 'Unable to save the data'], 500);
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    }

	// Private methods
	private function checkAndSave($data, $user_id)
        { 
			$user_data = WeatherForecast::where('user_id', $user_id)->first();
			$time = Carbon::create($user_data->created_at)->getMinutesPerHour();
			
			return \response()->json(['message' => "LImit exceededs" ], 500);    
            
                
            
        }
}
