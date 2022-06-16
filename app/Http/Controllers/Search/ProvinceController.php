<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Province;

class ProvinceController extends Controller
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
        
        // Then send response
        return Province::where('province_id', $province_id)->firstOrFail();
    }

}