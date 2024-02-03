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

        $connection = config('database.default');
        $driver = config('database.connections.' . $connection . '.driver');

        if ($driver === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            DB::table('cities')->truncate();
            DB::table('states')->truncate();
            DB::table('countries')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }

        $zip = new ZipArchive();
        $res = $zip->open(resource_path($this->zipFile));

        if ($res === true) {
            $zip->extractTo(storage_path('LocatesFromCountryStateCitySeeder'), [$this->file]);
            $zip->close();

            if (file_exists(storage_path('LocatesFromCountryStateCitySeeder') . DIRECTORY_SEPARATOR . $this->file)) {
                $json = File::get(storage_path('LocatesFromCountryStateCitySeeder') . DIRECTORY_SEPARATOR . $this->file);
                $countries = json_decode($json);

                foreach ($countries as $country) {
                    $location = null;

                    if ($driver === 'mysql') {
                        $location = DB::raw('GeomFromText(\'POINT(' . $country->latitude . ' ' . $country->longitude . ')\')');
                    }

                    $phone_code = null;
                    if (!is_null($country->phone_code)) {
                        $phone_code = $country->phone_code;
                        $phone_code = str_replace('+', '', $phone_code);

                        $parts = explode(' ', $phone_code);
                        if (count($parts) > 0) {
                            $phone_code = $parts[0];
                        }

                        $phone_code = '+' . $phone_code;
                    }

                    DB::table('countries')->insert([[
                        'id' => $country->id,
                        'name' => $country->name,
                        'iso2' => $country->iso2,
                        'iso3' => $country->iso3,
                        'phone_code' => $phone_code,
                        'lat' => $country->latitude,
                        'lon' => $country->longitude,
                        'location' => $location,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]]);
                    $countryId = DB::getPdo()->lastInsertId();

                    $countriesI18n = [];
                    $countriesI18n[] = [
                        'parent_id' => $countryId,
                        'language' => 'en',
                        'name' => $country->name
                    ];

                    foreach ($country->translations as $language => $name) {
                        $countriesI18n[] = [
                            'parent_id' => $countryId,
                            'language' => $language,
                            'name' => $name,
                        ];
                    }
                    DB::table('countries_i18n')->insert($countriesI18n);

                    foreach ($country->states as $state) {
                        $location = null;

                        if ($driver === 'mysql') {
                            $location = DB::raw('GeomFromText(\'POINT(' . $state->latitude . ' ' . $state->longitude . ')\')');
                        }

                        DB::table('states')->insert([
                            'id' => $state->id,
                            'country_id' => $countryId,
                            'name' => $state->name,
                            'code' => $state->state_code,
                            'lat' => $state->latitude,
                            'lon' => $state->longitude,
                            'location' => $location,
                            'cities_found' => 0,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                        $stateId = DB::getPdo()->lastInsertId();

                        $cities = [];

                        foreach ($state->cities as $city) {
                            $location = null;

                            if ($driver === 'mysql') {
                                $location = DB::raw('GeomFromText(\'POINT(' . $city->latitude . ' ' . $city->longitude . ')\')');
                            }

                            $cities[] = [
                                'id' => $city->id,
                                'country_id' => $countryId,
                                'state_id' => $stateId,
                                'name' => $city->name,
                                'lat' => $city->latitude,
                                'lon' => $city->longitude,
                                'location' => $location,
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
