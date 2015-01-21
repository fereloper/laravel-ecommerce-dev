<?php

class CountryController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getCountry() {

        return Country::all();
    }
    
    public function getCity() {
        $country = (int)Input::get('country_id');
        return $citys = City::where(['country_id' => $country]);
    }
}

