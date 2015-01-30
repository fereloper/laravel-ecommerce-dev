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

      $data = array();

      $product = Product::find($id);


      if (isset($product->title)) {

          $data = array(
              'response'    => "OK",
              'message'     => $product,
              'code'        => 200,
          );

      } else {

          $data = array(
              'response'  => 'ERROR',
              'message'   => 'product not found.',
              'code'      => 400,
          );
      }

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

  public function getProductBySubCategory($category_id, $sub_category_id) {
    $product = Product::where(['category' => $category_id, 'sub_category' => $sub_category_id]);
    return $product;
  }
  public function getProductBySCategory($category_id) {
    $product = Product::where(['category' => $category_id]);
    return $product;
  }
  
  public function upload() {

    if (Input::file('file')->move(__DIR__ . '/../storage/catalog/product/', Input::file('file')->getClientOriginalName())) {
      return true;
    }
    else {
      return false;
    }
  }

  public function getCategory() {
    return Category::all();
  }

}
