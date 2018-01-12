<?php
/*return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];*/
use think\Route;

/**
 * index模块路由
 */
/*Route::group('index', function () {
    Route::controller('index', 'index/Index');
});*/


/**
 * admin模块路由
 */
//index类
//Route::group('admin', function () {
    /*Route::get('index', 'admin/admin/index');
    Route::get('data', 'admin/admin/data');
    Route::get('create', 'admin/admin/create');
    Route::get('edit/id/:id', 'admin/admin/edit');
    Route::post('add', 'admin/admin/add');
    Route::post('del', 'admin/admin/del');*/
//    Route::controller('admin', 'admin/admin');
//});

//Route::controller('admin', 'admin/admin');
//Route::controller('authGroup', 'admin/authGroup');
//Route::controller('authRule', 'admin/authRule');
//Route::controller('login', 'admin/login');
Route::group('admin', function () {
    Route::get('add', 'admin/admin/add');
    Route::post('add', 'admin/admin/add');
    Route::get('index', 'admin/admin/index');
    Route::get('data', 'admin/admin/data');
    Route::post('del', 'admin/admin/del');
    Route::get('edit', 'admin/admin/edit');
});

Route::group('authGroup', function () {
    Route::get('add', 'admin/authGroup/add');
    Route::post('add', 'admin/authGroup/add');
    Route::get('index', 'admin/authGroup/index');
    Route::get('data', 'admin/authGroup/data');
    Route::post('del', 'admin/authGroup/del');
    Route::get('edit', 'admin/authGroup/edit');
});

Route::group('authRule', function () {
    Route::get('add', 'admin/authRule/add');
    Route::post('add', 'admin/authRule/add');
    Route::get('index', 'admin/authRule/index');
    Route::get('data', 'admin/authRule/data');
    Route::post('del', 'admin/authRule/del');
    Route::get('edit', 'admin/authRule/edit');
});

Route::group('login', function () {
    Route::get('index', 'admin/login/index');
    Route::post('login', 'admin/login/login');
    Route::post('logout', 'admin/login/logout');
});
