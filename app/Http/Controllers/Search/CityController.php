<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\City;

class CityController extends Controller
{

    /**
     * Retrieve city for the given `city_id`
     * 
     * @param int $city_id
     * @return Response
     */
    public function show(Request $request)
    {
        // Start validation
        $this->validate($request, [
            'city_id' => 'required'
        ]);

        // Retrieve query param
        $city_id = $request->input('city_id');
        
        // Then send response
        return City::where('city_id', $city_id)->firstOrFail();
    }

}