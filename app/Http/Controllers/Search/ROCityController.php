<?php

namespace App\Http\Controllers\Search;

use \WpOrg\Requests\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\City;

class ROCityController extends Controller
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
            'city_id' => 'required|int'
        ]);

        // Retrieve query param
        $city_id = $request->input('city_id');

        // Requests headers
        $headers = array('key' => env('WANOKEY'));

        // Then send response
        $fetchCities = Requests::get('https://api.rajaongkir.com/starter/city?id=' . $city_id, $headers);

        if ($fetchCities->status_code == 400) {
            return "Fetching cities failed!";
        }

        $body = json_decode($fetchCities->body);
        $results = $body->rajaongkir->results;

        return response()->json($results);
    }

}