<?php
 
namespace App\Console\Commands;
 
use App\Models\User;
use App\Models\Province;
use App\Models\City;
use Illuminate\Console\Command;
use \WpOrg\Requests\Requests;
 
class FetchProvinces extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:provinces';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a marketing email to a user';
 
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $headers = array('key' => env('WANOKEY'));
        $fetchProvinces = Requests::get('https://api.rajaongkir.com/starter/province', $headers);

        if ($fetchProvinces->status_code == 400) {
            echo 'Fetching provinces failed!';
            return;
        }

        echo "Fetching provinces...\r\n\r\n";

        $body = json_decode($fetchProvinces->body);
        $results = $body->rajaongkir->results;
        $provincesData = array();

        foreach ($results as $result) {
            $provincesData[] = array(
                'province_id' => $result->province_id,
                'province' => $result->province,
            );
        }
        
        // Bulk insert or update if province exist
        Province::upsert(
            $provincesData,
            ['province_id'],
            ['province']
        );

        echo sprintf("Success! Inserted %s provinces\r\n\r\n", Province::all()->count());
        echo "Fetching cities...\r\n\r\n";

        $fetchCities = Requests::get('https://api.rajaongkir.com/starter/city', $headers);

        if ($fetchCities->status_code == 400) {
            echo "Fetching cities failed!";
            return;
        }

        $body = json_decode($fetchCities->body);
        $results = $body->rajaongkir->results;
        $citiesData = array();

        foreach ($results as $result) {
            $citiesData[] = array(
                'province_id' => $result->province_id,
                'province' => $result->province,
                'city_id' => $result->city_id,
                'city_name' => $result->city_name,
                'postal_code' => $result->postal_code,
                'type' => $result->type,
            );
        }
        
        // Bulk insert or update if city exist
        City::upsert(
            $citiesData,
            ['city_id'],
            ['city_name', 'province_id', 'postal_code']
        );

        echo sprintf("Success! Inserted %s cities", City::all()->count());
    }
}