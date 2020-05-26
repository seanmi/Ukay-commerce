<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something  great!
|
*/



Auth::routes();

Route::get('/', function(){
    if(Auth::user()){
        if(Auth::user()->banned ==0){
            if (Auth::user()->role ==='admin') {
                return redirect()->route('adminDashboard');
               
            }else{
                return redirect()->route('landing');
            }
        }else{
            return view('banned');
        }
       
    }else{
        return redirect()->route('login'); 
    }
   
});

Route::group(['prefix' => 'products', 'middleware' => ['auth','user']], function(){
    Route::get('/', 'ProductsController@index')->name('landing');
    Route::get('/cart', 'ProductsController@cart');
    Route::get('/view/{id}', 'ProductsController@view')->name('viewProduct');
    Route::get('/wishlist', 'WishlistsController@index')->name('wishlist');
    Route::get('/wishlist/{id}', 'WishlistsController@store')->name('addWishlist');
    Route::get('/wishlist/remove/{id}', 'WishlistsController@remove')->name('removeWishlist');
    Route::get('/about-us', function(){
        return view('user.buyer.about');
    })->name('aboutUs');


    Route::group(['prefix' => 'cart'], function(){
        Route::post('/add', 'UsersCartController@add')->name('addItem');    
        Route::get('/add_one/{id}', 'UsersCartController@addOne')->name('addOneItem');    
        Route::get('/remove/{id}', 'UsersCartController@remove')->name('removeItem');    
        Route::get('/', 'UsersCartController@indexCart')->name('indexCart');    
        Route::get('/cart/checkout', 'UsersCartController@checkout')->name('checkout');        
    });

    Route::post('report', 'ReportsController@store')->name('report');

}) ;


Route::group(['prefix' => 'user', 'middleware' => ['auth', 'user']], function(){
    Route::get('/dashboard', 'UserProductsController@dashboard')->name('myAccount');
    Route::post('/product', 'UserProductsController@store')->name('storeProduct');
    Route::post('/product/status/update', 'UserProductsController@updateStatus')->name('updateStatusProduct');
    Route::post('/product/update', 'UserProductsController@updateProduct')->name('updateProduct');
    Route::get('/orders', 'UsersCartController@getOrders')->name('orders');
    Route::get('/product/remove/{id}', 'UserProductsController@removeProduct')->name('removeProduct');
    Route::post('/update/password', 'UsersProfileController@updatePassword')->name('updatePassword');
    Route::post('/update/address', 'UsersProfileController@updateAddress')->name('updateAddress');
    Route::post('/update/contact', 'UsersProfileController@updateContact')->name('updateContact');
    Route::get('/orders/item', 'UserOrderController@getAllOrderedItems')->name('getAllOrderedItems');

});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function(){
    Route::get('/', 'AdminProductsController@dashboard')->name('adminDashboard');
    Route::get('/products/active', 'AdminProductsController@active')->name('adminGetAllActiveProducts');
    Route::get('/products/archives', 'AdminProductsController@archive')->name('adminGetAllArchiveProducts');
    Route::get('/product/status/active/{id}', 'AdminProductsController@statusActive')->name('productStatusActive');
    Route::post('/product/status/add/discount/{id}', 'AdminProductsController@addDiscount')->name('productAddDiscount');
    Route::get('/product/status/remove/discount/{id}', 'AdminProductsController@removeDiscount')->name('productRemoveDiscount');
    Route::get('/product/archive/{id}', 'AdminProductsController@archiveOne')->name('archiveOne');

    Route::group(['prefix' => 'user'], function(){
        Route::get('/', 'UsersController@index')->name('userIndex');
        Route::get('/ban/{id}', 'UsersController@banuser')->name('banUser');
        Route::post('/add/admin', 'UsersController@addAdmin')->name('addAdmin');
        Route::post('/update/password', 'UsersController@updatePassword')->name('updateAdminPassword');
    });

    Route::group(['prefix' => 'discount'], function(){
        Route::get('/', 'DiscountsController@index')->name('discountIndex');
        Route::post('/', 'DiscountsController@store')->name('discountPost');
        Route::post('/update/{id}', 'DiscountsController@update')->name('discountUpdate');
        Route::get('/delete/{id}', 'DiscountsController@delete')->name('discountDelete');
    });

    Route::group(['prefix' => 'order'], function(){
        Route::get('/', 'OrderController@index')->name('orderIndex');
        Route::get('/delivered/{id}', 'OrderController@delivered')->name('delivered');
        Route::get('/cancel/{id}', 'OrderController@cancelOrder')->name('cancelOrder');
    });

    Route::group(['prefix' => 'barangay'], function(){
        Route::get('/', 'BarangaysController@index')->name('barangayIndex');
        Route::post('/', 'BarangaysController@store')->name('addBarangay');
        Route::get('/{id}', 'BarangaysController@destroy')->name('deleteBarangay');
        Route::post('/edit/{id}', 'BarangaysController@update')->name('editBarangay');
    });

    Route::group(['prefix' => 'category'], function(){
        Route::get('/', 'CategoriesController@index')->name('categoryIndex');
        Route::post('/', 'CategoriesController@store')->name('addCategory');
        Route::get('/{id}', 'CategoriesController@destroy')->name('deleteCategory');
        Route::post('/edit/{id}', 'CategoriesController@update')->name('editCategory');
    });

    Route::group(['prefix' => 'report'], function(){
        Route::get('/', 'AdminReportController@index')->name('reportIndex');
        Route::get('/deactivate/{id}', 'AdminReportController@deactivate')->name('deactivate');
    });

    Route::group(['prefix' => 'earning'], function(){
        Route::get('/', 'EarningController@index')->name('earningIndex');

    });
});