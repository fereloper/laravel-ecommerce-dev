<?php

class LocationController extends \BaseController {

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
    
    public function createDB(){      
      $countries = Country::all();
      
        $finaldata       = array();

        foreach( $countries as $name ) {
          $data = array();
          $data['name'] = $name->country;
          $dat['cities'] = array();
          foreach( $name->cities as $city)
            $data['cities'][] = $city['name'];
          $finaldata[] = $data;
        }

        return $finaldata;
//      foreach ($countries as $key => $country) {
//        $cities = City::where(['country_id' => $country->_id]);
//        $city_array = array();
//        
//        $current_country = Country::find($country->_id);
//        $id = 1;
//        foreach ($cities as $value) {
//          $city_array[] = array(
//            'id' => $id++,
//            'name' => $value->city,
//          );
//          
//        }        
//        $current_country->cities = $city_array;
//        
//        $current_country->save();
//       
//      }
    }
}

