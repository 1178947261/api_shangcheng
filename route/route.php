<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});


Route::group('api/', function () {
    Route::get('hello/', 'api/v1.IndexController/hello');
    Route::post('UpdateBase64/','api/v1.UpdateController/uploadBase64'); //图片上传
    Route::post('Add_address/','api/v1.AddressController/address_data');  //创建收货地址
    Route::post('update_address/','api/v1.AddressController/update_address');//修改收货地址
    Route::post('delete_address/','api/v1.AddressController/delete_address');//删除收货
    Route::get('get_address/','api/v1.AddressController/get_address');//获取收货地址
    Route::get('get_Productcollect/','api/v1.ProductcollectController/get_Productcollect');//获取收藏列表
    Route::post('add_Productcollect/','api/v1.ProductcollectController/add_Productcollect');//获取收藏列表
    Route::post('delete_Productcollect/','api/v1.ProductcollectController/delete_Productcollect');//获取收藏列表
    Route::get('get_Products_list/','api/v1.ProductsController/get_Products_list');//获取商品列表
    Route::get('search_Products/','api/v1.ProductsController/search_Products');//搜索商品
    Route::post('add_Products/','api/v1.ProductsController/add_Products');//添加商品大类
    Route::post('add_Productskus/','api/v1.ProductskusController/add_Productskus');//添加商品小类
    Route::post('Add_Cart/','api/v1.AddCartController/Add_Cart');  //加入购物车
    Route::post('delete_Cart/','api/v1.AddCartController/delete_Cart');//删除购物车
    Route::get('get_Cart/','api/v1.AddCartController/get_Cart');//获取购物车列表
});