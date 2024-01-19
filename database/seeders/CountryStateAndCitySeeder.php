<?php

namespace Database\Seeders;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CountryStateAndCitySeeder extends Seeder
{
    // Reference: https://documenter.getpostman.com/view/1134062/T1LJjU52
    private string $countriesAndStatesUrl = 'https://countriesnow.space/api/v0.1/countries/states';
    private string $citiesUrl = 'https://countriesnow.space/api/v0.1/countries/state/cities';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('cities')->truncate();
        DB::table('states')->truncate();
        DB::table('countries')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $client = new Client(['curl' => [CURLOPT_SSL_VERIFYPEER => false]]);

        try {
            $this->fetchCountriesAnsItsStates($client);
            $this->fetchCities($client);
        } catch (GuzzleException|Exception $exception) {
            Log::error($exception->getFile() . ' [' . $exception->getLine() . ']: ' . $exception->getMessage());
        }
    }

    /**
     * @throws GuzzleException
     */
    private function fetchCountriesAnsItsStates(Client $client): void
    {
        $response = $client->request('GET', $this->countriesAndStatesUrl, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-type' => 'application/json'
            ]]);
        $result = json_decode($response->getBody()->getContents());

        if ($result->error === false) {
            $data = $result->data;

            // Save countries
            foreach ($data as $country) {
                DB::table('countries')->insert([[
                    'name' => $country->name,
                    'iso2' => $country->iso2,
                    'iso3' => $country->iso3,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]]);

                // Save states
                $countryId = DB::getPdo()->lastInsertId();
                $states = [];

                foreach ($country->states as $state) //
                    $states[] = [
                        'country_id' => $countryId,
                        'name' => $state->name,
                        'code' => $state->state_code,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];

                DB::table('states')->insert($states);
            }
        }
    }

    /**
     * @throws GuzzleException
     */
    private function fetchCities(Client $client): void
    {
        $countriesAndItsStates = DB::table('countries')
            ->join('states', 'countries.id', '=', 'states.country_id')
            ->select('countries.id AS country_id', 'countries.name AS country_name', //
                'states.id AS state_id', 'states.name AS state_name')
            ->get();
        foreach ($countriesAndItsStates as $countryAndState) {
            $response = $client->request('POST', $this->citiesUrl, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json'
                ],
                'body' => json_encode([
                    'country' => $countryAndState->country_name,
                    'state' => $countryAndState->state_name,
                ])]);
            $result = json_decode($response->getBody()->getContents());

            // Save cities
            $cities = [];

            if ($result->error === false) {
                $data = $result->data;

                foreach ($data as $city) //
                    $cities = [
                        'country_id' => $countryAndState->country_id,
                        'state_id' => $countryAndState->state_id,
                        'name' => $city,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
            }

            DB::table('cities')->insert($cities);
        }
    }

}
