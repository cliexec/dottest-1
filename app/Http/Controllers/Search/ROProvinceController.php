<?php

namespace App\Http\Controllers\Search;

use \WpOrg\Requests\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Province;

class ROProvinceController extends Controller
{

    /**
     * Retrieve province for the given `province_id`
     * 
     * @param int $province_id
     * @return Response
     */
    public function show(Request $request)
    {
        // Start validation
        $this->validate($request, [
            'province_id' => 'required|int'
        ]);

        // Retrieve query param
        $province_id = $request->input('province_id');

        // Requests headers
        $headers = array('key' => env('WANOKEY'));

        // Then send response
        $fetchProvinces = Requests::get('https://api.rajaongkir.com/starter/province?id=' . $province_id, $headers);

        if ($fetchProvinces->status_code == 400) {
            return "Fetching provinces failed!";
        }

        $body = json_decode($fetchProvinces->body);
        $results = $body->rajaongkir->results;

        return response()->json($results);
    }

}