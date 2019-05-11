<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;
use\App;
use RFHaversini\Distance;

class Location extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('location')->get();

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            DB::table('location')->insert([
                'postcode' => ($request->postcode != '') ? $request->postcode : ' ',
                'openMonday' => isset($request->opening_times['monday']) ? $request->opening_times['monday'] : ' ',
                'openTuesday' => isset($request->opening_times['tuesday']) ? $request->opening_times['tuesday'] : '',
                'openWednesday' => isset($request->opening_times['wednesday']) ? $request->opening_times['wednesday'] : ' ',
                'openThursday' => isset($request->opening_times['thursday']) ? $request->opening_times['thursday'] : ' ',
                'openFriday' => isset($request->opening_times['friday']) ? $request->opening_times['friday'] : ' ',
                'openSaturday' => isset($request->opening_times['saturday']) ? $request->opening_times['saturday'] : ' ',
                'openSunday' => isset($request->opening_times['sunday']) ? $request->opening_times['sunday'] : ' ',
                'closeMonday' => isset($request->closing_times['monday']) ? $request->opening_times['monday'] : '',
                'closeTuesday' => isset($request->closing_times['tuesday']) ? $request->opening_times['tuesday'] : ' ',
                'closeWednesday' => isset($request->closing_times['wednesday']) ? $request->opening_times['wednesday'] : ' ',
                'closeThursday' => isset($request->closing_times['thursday']) ? $request->opening_times['thursday'] : ' ',
                'closeFriday' => isset($request->closing_times['friday']) ? $request->opening_times['friday'] : ' ',
                'closeSaturday' => isset($request->closing_times['saturday']) ? $request->opening_times['saturday'] : '',
                'closeSunday' => isset($request->closing_times['sunday']) ? $request->opening_times['sunday'] : ' ',
            ]);
            return response()->json(['error' => false]);
        } catch (\Exception $err) {
            return response()->json(['error' => true]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $d = $this->getResponseBack($code);
        $code = trim($code);
        $json = \GuzzleHttp\json_decode($d);
        $lat = $json->result->latitude;
        $long = $json->result->longitude;
        $postcodes = DB::table('location')->select()->get();
        $collect= collect();
        foreach ($postcodes as $key=> $postcode) {
            $d2 = $this->getResponseBack(trim($postcode->postcode));
            $json2 = \GuzzleHttp\json_decode($d2);
            $lat2 = $json2->result->latitude;
            $long2 = $json2->result->longitude;
            $distance  = Distance::toMiles($lat, $long, $lat2, $long2);
            if($distance <= 50) {
                $collect->add($postcode) ;
            }
        }
        return $collect;
    }

    public function getResponseBack($postcode)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://api.postcodes.io/postcodes/'.$postcode);
        return $response->getBody();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getcup()
    {
        $cups = DB::table('capbrand')->get();
        return $cups;
    }

    public function getcash(Request $request)
    {

        $brand1 = $request->input('Ristretto');
        $brand2 = $request->input('Espresso');
        $brand3 = $request->input('Lungo');
        $price1 = $this->getTotalbyBrand($brand1, 1);
        $price2 = $this->getTotalbyBrand($brand2, 2);
        $price3 = $this->getTotalbyBrand($brand3, 3);
        $data = [
            'Ristretto' => number_format($price1, 2),
            'Espresso' => number_format($price2, 2),
            'Lungo' => number_format($price3, 2)
        ];
        DB::table('capbrand')->insert([
            'Ristretto' => $brand1,
            'Espresso' => $brand2,
            'Lungo' => $brand3,
            'Ristretto_price' => $data['Ristretto'],
            'Espresso_price' => $data['Espresso'],
            'Lungo_price' => $data['Lungo'],
            'location_id' => $request->input('loc_id'),
            'user_id' => 1,

        ]);
        return $data;
    }

    /**
     * @param $tot total cup
     * @param $brand
     * @return sum float|int
     *
     */
    private function getTotalbyBrand($tot, $brand)
    {
        $sum = 0;
        if ($tot < 50) {
            for ($i = 1; $i <= $tot; $i++) {

                if ($brand == 1) {
                    $sum += 2.00;
                }
                if ($brand == 2) {
                    $sum += 4.00;
                }
                if ($brand == 3) {
                    $sum += 6.00;
                }
            }
            return $sum;
        } elseif ($tot > 50 || $tot <= 500) {
            for ($i = 1; $i <= $tot; $i++) {
                if ($brand == 1) {
                    $sum += 3.00;
                }
                if ($brand == 2) {
                    $sum += 6.00;
                }
                if ($brand == 3) {
                    $sum += 9.00;
                }
            }
            return $sum;

        } elseif ($tot > 501) {
            for ($i = 1; $i <= $tot; $i++) {
                if ($brand == 1) {
                    $sum += 5.00;
                }
                if ($brand == 2) {
                    $sum += 10.00;
                }
                if ($brand == 3) {
                    $sum += 15.00;
                }
            }
            return $sum;

        }
    }
}
