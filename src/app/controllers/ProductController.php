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
        //$validator = Validator::make(Input::all(), Product::$rules);

        $post       = Input::all();
        $product    = new Product;
        $data       = array();

        foreach ($post as $index => $value) {
          $product[$index] = $value;
        }

        if ($product->save()) {
            $data = array(
                'response'  => 'OK',
                'message'   => 'Product has been created successfully.',
                'code'      => 200,
            );
        } else {
            $data = array(
                'response'  => 'ERROR',
                'message'   => 'Error message.',
                'code'      => 400,
            );
        }

        $product = (object) $product;

        return $data;
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

        if ( isset($product->title) ) {

            $data               = $product;
            $data['response']   = "OK";
            $data['code']       = 200;

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

        $data = array();

        $product = Product::find($id);

        if ($product->price != "") {

            $data               = $product;
            $data['response']   = "OK";
            $data['code']       = 200;

        } else {

            $data = array(
                'response'  => 'ERROR',
                'message'   => 'product not found.',
                'code'      => 400,
            );
        }
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id) {

        $product = Product::first($id);

        if ( isset($product->title) ) {

            $product->title         = Input::get('title');
            $product->description   = Input::get('description');
            $product->price         = Input::get('price');
            $product->category      = Input::get('category');
            $product->subcategory   = Input::get('subcategory');

            $product->save(true);

            $data = array(
                'response'  => 'OK',
                'message'   => 'product successfully updated.',
                'code'      => 200,
            );

        } else {

            $data = array(
                'response'  => 'ERROR',
                'message'   => 'product not found',
                'code'      => 400,
            );
        }

        return $data;
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id) {

        $product = Product::first($id);

        if (isset($product)) {

            $product->delete();

            $data = array(
                'response'  => 'OK',
                'message'   => 'product successfully deleted.',
                'code'      => 200,
            );

        } else {

            $data = array(
                'response'  => 'ERROR',
                'message'   => 'user not found',
                'code'      => 400,
            );
        }

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

    /**
     *
     * Add revew from
     */
    public function productReview(){

        $data = array();

        $product_review = ProductReview::first(['product_id' => Input::get('product_id')]);

        if ( isset($product_review->product_title) ) {

            $review    = array(
                'comment'   => Input::get('comment'),
                'rating'    => Input::get('rating'),
                'user_id'   => Input::get('user_id'),
            );

            $product_review->embed( 'review', $review );

            $product_review->save(true);

            $data = array(
                'response'  => 'OK',
                'message'   => 'review successfully added in product.',
                'code'      => 200,
            );

        } else {

            $product_review = new ProductReview;
            $product_review->product_id     = Input::get('product_id');
            $product_review->product_title  = Input::get('product_title');

            $review    = array(
                'comment'   => Input::get('comment'),
                'rating'    => Input::get('rating'),
                'user_id'   => Input::get('user_id'),
            );

            $product_review->embed( 'review', $review );

            $product_review->save();

            $data = array(
                'response'  => 'OK',
                'message'   => 'new review successfully added.',
                'code'      => 200,
            );

        }

        return $data;
    }


    /**
     *
     * Add revew from
     */
    public function userReview(){

        $data = array();

        $user_review = UserReview::first(['user_id' => Input::get('user_id')]);

        if ( isset($user_review->user_name) ) {

            $review    = array(
                'comment'   => Input::get('user_comment'),
                'rating'    => Input::get('user_rating'),
            );

            $user_review->embed( 'review', $review );

            $user_review->save(true);

            $data = array(
                'response'  => 'OK',
                'message'   => 'review successfully added in user.',
                'code'      => 200,
            );

        } else {

            $user_review = new UserReview;
            $user_review->user_id   = Input::get('user_id');
            $user_review->user_name = Input::get('user_name');

            $review    = array(
                'comment'   => Input::get('user_comment'),
                'rating'    => Input::get('user_rating'),
            );

            $user_review->embed( 'review', $review );

            $user_review->save();

            $data = array(
                'response'  => 'OK',
                'message'   => 'new review successfully added.',
                'code'      => 200,
            );

        }

        return $data;
    }

}
