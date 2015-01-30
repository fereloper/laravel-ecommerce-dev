<?php

class ProductController extends BaseController {

  public function getProductByCategory($category_id, $sub_category_id) {
    $products = array(
      '1' => array(
        'title' => "Testing data",
        'price' => 100,
        'special_price' => 90,
        'rating' => 3.3
      ), '2' => array(
        'title' => "Testing data",
        'price' => 100,
        'special_price' => 90,
        'rating' => 3.3
      ),
      '3' => array(
        'title' => "Testing data",
        'price' => 100,
        'special_price' => 90,
        'rating' => 3.3
      ),
      '4' => array(
        'title' => "Testing data",
        'price' => 100,
        'special_price' => 90,
        'rating' => 3.3
      )
    );
    return $products;
  }

  public function getProductById($product_id) {
    return array(
      'id' => 1,
      'name' => "4 stroke bike",
      'price' => 20000,
      'category_id' => 2,
      'sub_category_id' => 1,
      'special_price' => 2000
    );
  }

  public function upload() {
    
    if(Input::file('file')->move(__DIR__ . '/../storage/catalog/product/', Input::file('file')->getClientOriginalName())) {
      return true;
    }else {
      return false;
    }
  }

}
