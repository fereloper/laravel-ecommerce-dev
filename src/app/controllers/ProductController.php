<?php

class ProductController extends BaseController {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index() {

    return Product::all();
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create() {


    return array('message' => 'Form show.');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store() {
//    $validator = Validator::make(Input::all(), Product::$rules);
    $data = Input::all();
    $product = new Product;
    foreach ($data as $index => $value) {
      $product[$index] = $value;
    }
    $product = (object) $product;
    $product->save();
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id) {

    return $data;
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id) {
    return $data;
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id) {

    return $data;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id) {
    return $data;
  }

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

    if (Input::file('file')->move(__DIR__ . '/../storage/catalog/product/', Input::file('file')->getClientOriginalName())) {
      return true;
    }
    else {
      return false;
    }
  }

}
