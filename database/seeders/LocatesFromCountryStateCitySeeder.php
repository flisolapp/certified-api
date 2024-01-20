<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class LocatesFromCountryStateCitySeeder extends Seeder
{
    private string $zipFile = 'countries+states+cities.zip';
    private string $file = 'countries+states+cities.json';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ini_set('memory_limit', '1024M');

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('cities')->truncate();
        DB::table('states')->truncate();
        DB::table('countries')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $zip = new ZipArchive();
        $res = $zip->open(resource_path($this->zipFile));

        if ($res === true) {
            $zip->extractTo(storage_path('LocatesFromCountryStateCitySeeder'), [$this->file]);
            $zip->close();

            if (file_exists(storage_path('LocatesFromCountryStateCitySeeder') . DIRECTORY_SEPARATOR . $this->file)) {
                $json = File::get(storage_path('LocatesFromCountryStateCitySeeder') . DIRECTORY_SEPARATOR . $this->file);
                $countries = json_decode($json);

                foreach ($countries as $country) {
                    DB::table('countries')->insert([[
                        'id' => $country->id,
                        'name' => $country->name,
                        'iso2' => $country->iso2,
                        'iso3' => $country->iso3,
                        'lat' => $country->latitude,
                        'lon' => $country->longitude,
                        'location' => DB::raw('GeomFromText(\'POINT(' . $country->latitude . ' ' . $country->longitude . ')\')'),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]]);
                    $countryId = DB::getPdo()->lastInsertId();

                    $countriesI18n = [];
                    $countriesI18n[] = [
                        'country_id' => $countryId,
                        'language' => 'en',
                        'name' => $country->name
                    ];

                    foreach ($country->translations as $language => $name) {
                        $countriesI18n[] = [
                            'country_id' => $countryId,
                            'language' => $language,
                            'name' => $name,
                        ];
                    }
                    DB::table('countries_i18n')->insert($countriesI18n);

                    foreach ($country->states as $state) {
                        DB::table('states')->insert([
                            'id' => $state->id,
                            'country_id' => $countryId,
                            'name' => $state->name,
                            'code' => $state->state_code,
                            'lat' => $state->latitude,
                            'lon' => $state->longitude,
                            'location' => DB::raw('GeomFromText(\'POINT(' . $state->latitude . ' ' . $state->longitude . ')\')'),
                            'cities_found' => 0,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                        $stateId = DB::getPdo()->lastInsertId();

                        $cities = [];

                        foreach ($state->cities as $city) {
                            $cities[] = [
                                'id' => $city->id,
                                'country_id' => $countryId,
                                'state_id' => $stateId,
                                'name' => $city->name,
                                'lat' => $city->latitude,
                                'lon' => $city->longitude,
                                'location' => DB::raw('GeomFromText(\'POINT(' . $city->latitude . ' ' . $city->longitude . ')\')'),
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ];
                        }

                        DB::table('cities')->insert($cities);

                        if (count($cities) > 0) //
                            DB::table('states')->where('id', $stateId)->update(['cities_found' => 1]);
                    }
                }
            } else {
                Log::error('Extract couldn\'t completed: ' . resource_path($this->zipFile));
            }

            if (file_exists(storage_path('LocatesFromCountryStateCitySeeder'))) //
                Storage::deleteDirectory(storage_path('LocatesFromCountryStateCitySeeder'));
        } else {
            Log::error('Extract couldn\'t completed: ' . resource_path($this->zipFile));
        }
    }

}
