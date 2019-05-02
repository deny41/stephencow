<?php
// use Illuminate\Support\Facades\Auth;

// Get the currently authenticated user...
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	//Home
	Route::get('/home', 'HomeController@index')->name('home');

	// <===================== MASTER ===================> //

	//admin

	Route::get('/master/admin', 'master\adminController@index')->name('master_admin');
	Route::get('/master/create_admin', 'master\adminController@create_admin')->name('master_create_admin');
	Route::get('/master/{id}/edit_admin', 'master\adminController@edit_admin')->name('master_edit_admin');
	Route::post('/master/save_admin', 'master\adminController@save_admin')->name('master_save_admin');
	Route::post('/master/update_admin', 'master\adminController@update_admin')->name('master_update_admin');
	Route::get('/master/{id}/delete_admin', 'master\adminController@delete_admin')->name('master_delete_admin');
	Route::get('/master/check_admin', 'master\adminController@check_admin')->name('master_check_admin');
	
	

	//Product
	Route::get('/master/product', 'master\productController@index')->name('master_product');
	Route::get('/master/create_product', 'master\productController@create_product')->name('master_create_product');
	Route::get('/master/{id}/edit_product', 'master\productController@edit_product')->name('master_edit_product');
	Route::post('/master/save_product', 'master\productController@save_product')->name('master_save_product');
	Route::post('/master/update_product', 'master\productController@update_product')->name('master_update_product');
	Route::get('/master/{id}/delete_product', 'master\productController@delete_product')->name('master_delete_product');
	Route::get('/master/check_product', 'master\productController@check_product')->name('master_check_product');


	//Bank
	Route::get('/master/bank', 'master\bankController@index')->name('master_bank');
	Route::get('/master/create_bank', 'master\bankController@create_bank')->name('master_create_bank');
	Route::get('/master/{id}/edit_bank', 'master\bankController@edit_bank')->name('master_edit_bank');
	Route::post('/master/save_bank', 'master\bankController@save_bank')->name('master_save_bank');
	Route::post('/master/update_bank', 'master\bankController@update_bank')->name('master_update_bank');
	Route::get('/master/{id}/delete_bank', 'master\bankController@delete_bank')->name('master_delete_bank');

	//Keterangan Member
	Route::get('/master/keterangan_mem', 'master\keterangan_memController@index')->name('master_keterangan_mem');
	Route::get('/master/create_keterangan_mem', 'master\keterangan_memController@create_keterangan_mem')->name('master_create_keterangan_mem');
	Route::get('/master/{id}/edit_keterangan_mem', 'master\keterangan_memController@edit_keterangan_mem')->name('master_edit_keterangan_mem');
	Route::post('/master/save_keterangan_mem', 'master\keterangan_memController@save_keterangan_mem')->name('master_save_keterangan_mem');
	Route::post('/master/update_keterangan_mem', 'master\keterangan_memController@update_keterangan_mem')->name('master_update_keterangan_mem');
	Route::get('/master/{id}/delete_keterangan_mem', 'master\keterangan_memController@delete_keterangan_mem')->name('master_delete_keterangan_mem');

	//Keterangan Txn
	Route::get('/master/keterangan_txn', 'master\keterangan_txnController@index')->name('master_keterangan_txn');
	Route::get('/master/create_keterangan_txn', 'master\keterangan_txnController@create_keterangan_txn')->name('master_create_keterangan_txn');
	Route::get('/master/{id}/edit_keterangan_txn', 'master\keterangan_txnController@edit_keterangan_txn')->name('master_edit_keterangan_txn');
	Route::post('/master/save_keterangan_txn', 'master\keterangan_txnController@save_keterangan_txn')->name('master_save_keterangan_txn');
	Route::post('/master/update_keterangan_txn', 'master\keterangan_txnController@update_keterangan_txn')->name('master_update_keterangan_txn');
	Route::get('/master/{id}/delete_keterangan_txn', 'master\keterangan_txnController@delete_keterangan_txn')->name('master_delete_keterangan_txn');

	//Web Regist
	Route::get('/master/web_regist', 'master\web_registController@index')->name('master_web_regist');
	Route::get('/master/create_web_regist', 'master\web_registController@create_web_regist')->name('master_create_web_regist');
	Route::get('/master/{id}/edit_web_regist', 'master\web_registController@edit_web_regist')->name('master_edit_web_regist');
	Route::post('/master/save_web_regist', 'master\web_registController@save_web_regist')->name('master_save_web_regist');
	Route::post('/master/update_web_regist', 'master\web_registController@update_web_regist')->name('master_update_web_regist');
	Route::get('/master/{id}/delete_web_regist', 'master\web_registController@delete_web_regist')->name('master_delete_web_regist');


	// <===================== OPERATIONAL ===================> //

	//Member
	Route::get('/operational/member', 'operational\memberController@index')->name('operational_member');
	Route::get('/operational/create_member', 'operational\memberController@create_member')->name('operational_create_member');
	Route::post('/operational/save_member', 'operational\memberController@save_member')->name('operational_save_member');
	// if (Auth::user() == 'master') {
		Route::get('/operational/{id}/edit_member', 'operational\memberController@edit_member')->name('operational_edit_member');
		Route::post('/operational/update_member', 'operational\memberController@update_member')->name('operational_update_member');
		Route::get('/operational/{id}/delete_member', 'operational\memberController@delete_member')->name('operational_delete_member');
		Route::get('/operational/datatable_member', 'operational\memberController@datatable_member')->name('operational_datatable_member');
		Route::get('/operational/detail_member', 'operational\memberController@detail_member')->name('operational_detail_member');
	// }else{
	// }
	

	//Transaction
	Route::get('/operational/transaction', 'operational\transactionController@index')->name('operational_transaction');
	Route::get('/operational/create_transaction', 'operational\transactionController@create_transaction')->name('operational_create_transaction');
	Route::post('/operational/save_transaction', 'operational\transactionController@save_transaction')->name('operational_save_transaction');
	Route::get('/operational/code_transaction', 'operational\transactionController@code_transaction')->name('operational_code_transaction');
	// if (Auth::user() == 'master') {
		Route::get('/operational/{id}/edit_transaction', 'operational\transactionController@edit_transaction')->name('operational_edit_transaction');
		Route::post('/operational/update_transaction', 'operational\transactionController@update_transaction')->name('operational_update_transaction');
		Route::get('/operational/{id}/delete_transaction', 'operational\transactionController@delete_transaction')->name('operational_delete_transaction');
		Route::get('/operational/datatable_transaction', 'operational\transactionController@datatable_transaction')->name('operational_datatable_transaction');
	// }else{
	// }

	// <========================= LOG =======================> //
	Route::get('/additional/log', 'additional\logController@index')->name('additional_log');
	Route::get('/additional/log_detail', 'additional\logController@log_detail')->name('additional_log_detail');


	// <======================== REPORT ======================> //

	//report Member
	Route::get('/report/rep_member', 'report\rep_memberController@rep_member')->name('rep_member');
	Route::get('/report/search_member', 'report\rep_memberController@search_member')->name('rep_search_member');
	Route::get('/report/hasil_datatable_member', 'report\rep_memberController@hasil_datatable_member')->name('hasil_datatable_member');
	Route::post('/report/pdf_member', 'report\rep_memberController@pdf_member')->name('rep_pdf_member');
	Route::get('/report/excel_member', 'report\rep_memberController@excel_member')->name('rep_excel_member');

	//report transaction
	Route::get('/report/rep_transaction', 'report\rep_transactionController@rep_transaction')->name('rep_transaction');
	Route::get('/report/search_transaction', 'report\rep_transactionController@search_transaction')->name('rep_search_transaction');
	Route::get('/report/hasil_datatable_transaction', 'report\rep_transactionController@hasil_datatable_transaction')->name('hasil_datatable_transaction');
	Route::post('/report/pdf_transaction', 'report\rep_transactionController@pdf_transaction')->name('rep_pdf_transaction');
	Route::get('/report/excel_transaction', 'report\rep_transactionController@excel_transaction')->name('rep_excel_transaction');

	//Statistics Member
	Route::get('/stat/stat_member', 'stat\stat_memberController@stat_member')->name('stat_member');
	Route::get('/stat/search_member', 'stat\stat_memberController@search_member')->name('stat_search_member');

	//Statistics transaction
	Route::get('/stat/stat_transaction', 'stat\stat_transactionController@stat_transaction')->name('stat_transaction');
	Route::get('/stat/search_transaction', 'stat\stat_transactionController@search_transaction')->name('stat_search_transaction');
	Route::get('/stat/search_month_transaction', 'stat\stat_transactionController@search_month_transaction')->name('stat_search_month_transaction');

	// <======================== TUTUP BUKU ======================> //
	Route::get('/close/closebook', 'close\close_bookController@close_book')->name('close_book');
	Route::get('/close/closebook/update', 'close\close_bookController@update_book')->name('close_update_book');

});
	