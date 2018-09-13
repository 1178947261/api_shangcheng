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
    Route::post('add_Productcollect/','api/v1.ProductcollectController/add_Productcollect');//收藏
    Route::post('delete_Productcollect/','api/v1.ProductcollectController/delete_Productcollect');//删除关注
    Route::get('get_Products_list/','api/v1.ProductsController/get_Products_list');//获取商品列表
    Route::get('search_Products/','api/v1.ProductsController/search_Products');//搜索商品
    Route::post('add_Products/','api/v1.ProductsController/add_Products')->middleware(app\http\middleware\Auth::class);//添加商品大类
    Route::post('add_Productskus/','api/v1.ProductskusController/add_Productskus')->middleware(app\http\middleware\Auth::class);//添加商品小类
    Route::post('Add_Cart/','api/v1.AddCartController/Add_Cart');  //加入购物车
    Route::post('delete_Cart/','api/v1.AddCartController/delete_Cart');//删除购物车
    Route::get('get_Cart/','api/v1.AddCartController/get_Cart');//获取购物车列表
    Route::post('add_Orders/','api/v1.OrdersController/add_Orders');  //添加订单
    Route::get('get_Orders_list/','api/v1.OrdersController/get_Orders_list');//获取订单列表
    Route::get('get_Orders_list_one/','api/v1.OrdersController/get_Orders_list_one');//获取单个订单
    Route::post('delete_Orders/','api/v1.OrdersController/delete_Orders');//取消订单
    Route::get('classification_Products/','api/v1.ProductsController/classification_Products');//获取商品分类列表
    Route::post('add_comment/','api/v1.OrderitemsController/add_comment');//填写评论
    Route::get('get_comment_list/','api/v1.OrderitemsController/get_comment_list');//填写评论
    Route::get('get_GoodsCollect/','api/v1.GoodsCollectController/get_GoodsCollect');//获取关注列表
    Route::post('add_GoodsCollect/','api/v1.GoodsCollectController/add_GoodsCollect');//关注
    Route::post('delete_GoodsCollect/','api/v1.GoodsCollectController/delete_GoodsCollect');//删除关注


    Route::get('bill/', 'api/v1.MoneyLogController/bill')->middleware(app\http\middleware\Auth::class); //我的账单
    Route::post('add_data/', 'api/v1.UserGoodsController/addData')->middleware(app\http\middleware\Auth::class); //设置商家资料
    Route::post('cancel_Products/', 'api/v1.ProductsController/xiajiashangpin')->middleware(app\http\middleware\Auth::class); //下架商品
    Route::get('get_Products_num/', 'api/v1.ProductsController/shangpin_nums'); //获取商品数量
    Route::post('Ship/', 'api/v1.OrdersController/dingdanfahuo')->middleware(app\http\middleware\Auth::class); //订单管理 发货
    Route::get('orders_Nums/', 'api/v1.OrdersController/ordersNums'); //获取订单数量
    Route::get('number_Amount/', 'api/v1.UserGoodsController/numberAmount'); //获取销售额
    Route::get('number_attention/', 'api/v1.UserGoodsController/number_attention'); //获取店铺的关注量

});