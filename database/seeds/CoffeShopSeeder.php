<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use Illuminate\Support\Facades\File;

class CoffeShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = public_path() . '/csv/location_data.csv';
        if(!File::exists($file)) throw new League\Csv\Exception('File not exited');
        $csv = Reader::createFromPath($file);
        $csv->setHeaderOffset(0);
        foreach ($csv as $row) {
            DB::table('location')->insert([
                [
                    'postcode' => $row['postcode'],
                    'openMonday' => $row['open_Monday'],
                    'openTuesday' => $row['open_Tuesday'],
                    'openWednesday' => $row['open_Wednesday'],
                    'openThursday' => $row['open_Thursday'],
                    'openFriday' => $row['open_Friday'],
                    'openSaturday' => $row['open_Saturday'],
                    'openSunday' => $row['open_Sunday'],
                    'closeMonday' => $row['closed_Monday'],
                    'closeTuesday' => $row['closed_Tuesday'],
                    'closeWednesday' => $row['closed_Wednesday'],
                    'closeThursday' => $row['closed_Thursday'],
                    'closeFriday' => $row['closed_Friday'],
                    'closeSaturday' => $row['closed_Saturday'],
                    'closeSunday' => $row['closed_Sunday']

                ]
            ]);
        }
    }
}
