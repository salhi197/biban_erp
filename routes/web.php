<?php


Route::view('/', 'welcome');
Route::view('/expire', 'expire');
Auth::routes();

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('login.admin');
Route::get('/login/writer', 'Auth\LoginController@showWriterLoginForm')->name('login.writer');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm')->name('register.admin');
Route::get('/register/writer', 'Auth\RegisterController@showWriterRegisterForm')->name('register.writer');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/writer', 'Auth\LoginController@writerLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('register.admin');
Route::post('/register/writer', 'Auth\RegisterController@createWriter')->name('register.writer');

Route::view('/home', 'home')->middleware('auth');
Route::group(['middleware' => 'auth:admin'], function () {
    Route::view('/admin', 'admin');
});

Route::group(['middleware' => 'auth:writer'], function () {
    Route::view('/writer', 'writer');
});


Route::group(['prefix' => 'user', 'as' => 'user'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'UserController@index']);
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'UserController@create']);
    Route::post('/create', ['as' => '.create', 'uses' => 'UserController@store']);
    Route::get('/destroy/{id_user}', ['as' => '.destroy', 'uses' => 'UserController@destroy']);    
    Route::get('/remise/{id_user}', ['as' => '.destroy', 'uses' => 'UserController@destroy']);    
    Route::get('/edit/{id_user}', ['as' => '.edit', 'uses' => 'UserController@edit']);
    Route::get('/show/{id_user}', ['as' => '.show', 'uses' => 'UserController@show']);
    Route::post('/update/{id_user}', ['as' => '.update', 'uses' => 'UserController@update']);    
});





Route::group(['prefix' => 'commande', 'as' => 'commande'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'CommandeController@index']);
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'CommandeController@create']);
    Route::post('/create', ['as' => '.create', 'uses' => 'CommandeController@store']);
    Route::get('/destroy/{id_commande}', ['as' => '.destroy', 'uses' => 'CommandeController@destroy']);    
    Route::get('/relancer/{id_commande}', ['as' => '.relancer', 'uses' => 'CommandeController@relancer']);    
    Route::get('/edit/{id_demande}', ['as' => '.edit', 'uses' => 'CommandeController@edit']);
    Route::get('/show/{id_commande}', ['as' => '.show', 'uses' => 'CommandeController@show']);
    Route::post('/update/{id_demande}', ['as' => '.update', 'uses' => 'CommandeController@update']);    
    Route::post('/search', ['as' => '.search', 'uses' => 'CommandeController@search']);    
    Route::post('/change/state', ['as' => '.update.state', 'uses' => 'CommandeController@updateState']);
    
});

Route::group(['prefix' => 'payment', 'as' => 'payment'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'PaymentController@index']);
    Route::get('/facture/{facture}', ['as' => '.facture', 'uses' => 'PaymentController@facture']);
    Route::post('/create', ['as' => '.create', 'uses' => 'PaymentController@store']);
    Route::post('/filter', ['as' => '.filter', 'uses' => 'PaymentController@filter']);
    Route::get('/destroy/{id_payment}', ['as' => '.destroy', 'uses' => 'PaymentController@destroy']);    
    Route::get('/relancer/{id_payment}', ['as' => '.relancer', 'uses' => 'PaymentController@relancer']);    
    Route::get('/edit/{id_demande}', ['as' => '.edit', 'uses' => 'PaymentController@edit']);
    Route::get('/show/{id_payment}', ['as' => '.show', 'uses' => 'PaymentController@show']);
    Route::post('/update/{id_demande}', ['as' => '.update', 'uses' => 'PaymentController@update']);    
    Route::post('/search', ['as' => '.search', 'uses' => 'PaymentController@search']);    
    Route::post('/change/state', ['as' => '.update.state', 'uses' => 'PaymentController@updateState']);
});





Route::group(['prefix' => 'type', 'as' => 'type'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'TypeController@index']);
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'TypeController@create']);
    Route::post('/create', ['as' => '.create', 'uses' => 'TypeController@store']);
    Route::post('/create/ajax', ['as' => '.store.ajax', 'uses' => 'TypeController@storeAjax']);
    Route::get('/destroy/{id_type}', ['as' => '.destroy', 'uses' => 'TypeController@destroy']);    
    Route::get('/edit/{id_type}', ['as' => '.edit', 'uses' => 'TypeController@edit']);
    Route::get('/show/{id_type}', ['as' => '.show', 'uses' => 'TypeController@show']);
    Route::post('/update/{id_type}', ['as' => '.update', 'uses' => 'TypeController@update']);    
});

// Route::group(['prefix' => 'sms', 'as' => 'sms'], function () {
//     Route::get('/', ['as' => '.index', 'uses' => 'SmsController@index']);
//     Route::post('/send', ['as' => '.send', 'uses' => 'SmsController@send']);
//     Route::post('/create/ajax', ['as' => '.store.ajax', 'uses' => 'SmsController@storeAjax']);
//     Route::get('/destroy/{id_type}', ['as' => '.destroy', 'uses' => 'SmsController@destroy']);    
//     Route::get('/edit/{id_type}', ['as' => '.edit', 'uses' => 'SmsController@edit']);
//     Route::get('/show/{id_type}', ['as' => '.show', 'uses' => 'SmsController@show']);
//     Route::post('/update/{id_type}', ['as' => '.update', 'uses' => 'SmsController@update']);    
// });

/**
 * 
 */
Route::group(['prefix' => 'camion', 'as' => 'camion'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'CamionController@index']);
    Route::get('/empty', ['as' => '.empty', 'uses' => 'CamionController@empty']);
    Route::get('/chercher', ['as' => '.chercher', 'uses' => 'CamionController@chercher']);
    

    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'CamionController@create']);

    Route::get('/facture/{camion}',['as'=>'.facture', 'uses' => 'CamionController@facture']);
    Route::post('/create', ['as' => '.create', 'uses' => 'CamionController@store']);
    Route::get('/destroy/{id_camion}', ['as' => '.destroy', 'uses' => 'CamionController@destroy']);    
    Route::get('/edit/{id_camion}', ['as' => '.edit', 'uses' => 'CamionController@edit']);
    Route::get('/show/{id_camion}', ['as' => '.show', 'uses' => 'CamionController@show']);
    Route::get('/reload', ['as' => '.reload', 'uses' => 'CamionController@reload']);
    Route::post('/update/{id_camion}', ['as' => '.update', 'uses' => 'CamionController@update']);    
});


Route::group(['prefix' => 'decharge', 'as' => 'decharge'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'DechargeController@index']);
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'DechargeController@create']);
    Route::get('/facture/{decharge}',['as'=>'.facture', 'uses' => 'DechargeController@facture']);
    Route::post('/create', ['as' => '.create', 'uses' => 'DechargeController@store']);
    Route::get('/destroy/{id_decharge}', ['as' => '.destroy', 'uses' => 'DechargeController@destroy']);    
    Route::get('/edit/{id_decharge}', ['as' => '.edit', 'uses' => 'DechargeController@edit']);
    Route::get('/show/{id_decharge}', ['as' => '.show', 'uses' => 'DechargeController@show']);
    Route::get('/reload', ['as' => '.reload', 'uses' => 'DechargeController@reload']);
    Route::post('/update/{id_decharge}', ['as' => '.update', 'uses' => 'DechargeController@update']);    
});


Route::group(['prefix' => 'fdr', 'as' => 'fdr'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'FdrController@index']);
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'FdrController@create']);
    Route::get('/facture/{decharge}',['as'=>'.facture', 'uses' => 'FdrController@facture']);
    Route::post('/create', ['as' => '.create', 'uses' => 'FdrController@store']);
    Route::get('/destroy/{id_decharge}', ['as' => '.destroy', 'uses' => 'FdrController@destroy']);    
    Route::get('/edit/{id_decharge}', ['as' => '.edit', 'uses' => 'FdrController@edit']);
    Route::get('/show/{id_decharge}', ['as' => '.show', 'uses' => 'FdrController@show']);
    Route::get('/reload', ['as' => '.reload', 'uses' => 'FdrController@reload']);
    Route::post('/update/{id_decharge}', ['as' => '.update', 'uses' => 'FdrController@update']);    
});



Route::group(['prefix' => 'attachement', 'as' => 'attachement'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'AttachementController@index']);
    Route::get('/test', ['as' => '.test', 'uses' => 'AttachementController@test']);
    Route::post('/create', ['as' => '.create', 'uses' => 'AttachementController@insert']);
    Route::post('/filtrer', ['as' => '.filter', 'uses' => 'AttachementController@filter']);
    Route::post('/generer', ['as' => '.generer', 'uses' => 'AttachementController@generer']);
    Route::get('/vider', ['as' => '.vider', 'uses' => 'AttachementController@vider']);

});

Route::group(['prefix' => 'client', 'as' => 'client'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'ClientController@index']);
    Route::get('/test', ['as' => '.test', 'uses' => 'ClientController@test']);
    Route::post('/create', ['as' => '.create', 'uses' => 'ClientController@insert']);
    Route::post('/filtrer', ['as' => '.filter', 'uses' => 'ClientController@filter']);
    Route::post('/generer', ['as' => '.generer', 'uses' => 'ClientController@generer']);
    Route::get('/vider', ['as' => '.vider', 'uses' => 'ClientController@vider']);

});

Route::group(['prefix' => 'immobilisation', 'as' => 'immobilisation'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'ImmobilisationController@index']);
    Route::get('/test', ['as' => '.test', 'uses' => 'ImmobilisationController@test']);
    Route::post('/create', ['as' => '.create', 'uses' => 'ImmobilisationController@insert']);
    Route::post('/filtrer', ['as' => '.filter', 'uses' => 'ImmobilisationController@filter']);
    Route::post('/generer', ['as' => '.generer', 'uses' => 'ImmobilisationController@generer']);
    Route::get('/vider', ['as' => '.vider', 'uses' => 'ImmobilisationController@vider']);

});


Route::group(['prefix' => 'facture', 'as' => 'facture'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'FactureController@index']);
    Route::get('/test', ['as' => '.test', 'uses' => 'FactureController@test']);
    Route::get('/open/{factrue}', ['as' => '.open', 'uses' => 'FactureController@open']);
    Route::get('/show/{factrue}', ['as' => '.show', 'uses' => 'FactureController@show']);
    Route::get('/edit/{factrue}', ['as' => '.edit', 'uses' => 'FactureController@edit']);
    Route::get('/delete/facture/{factrue}', ['as' => '.delete', 'uses' => 'FactureController@delete']);
    Route::post('/update/{factrue}', ['as' => '.update', 'uses' => 'FactureController@update']);
    
    Route::get('/{factrue}', ['as' => '.download', 'uses' => 'FactureController@download']);
    Route::post('/create', ['as' => '.create', 'uses' => 'FactureController@store']);
    Route::post('/save', ['as' => '.save', 'uses' => 'FactureController@save']);
    Route::post('/filtrer', ['as' => '.filter', 'uses' => 'FactureController@filter']);

    Route::get('/type/camion', ['as' => '.type.camion', 'uses' => 'FactureController@camion']);
    Route::get('/type/immobilisation', ['as' => '.type.immobilisation', 'uses' => 'FactureController@immobilisation']);
    Route::get('/type/attachement', ['as' => '.type.attachement', 'uses' => 'FactureController@attachement']);

    Route::get('/get/attachement/{facture}', ['as' => '.attachements', 'uses' => 'FactureController@getItems']);
    Route::get('/get/client/{facture}', ['as' => '.clients', 'uses' => 'FactureController@getItems2']);


});

Route::group(['prefix' => 'fichier', 'as' => 'fichier'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'FichierController@index']);
    Route::get('/{fichier}', ['as' => '.delete', 'uses' => 'FichierController@delete']);
    
    Route::get('/test', ['as' => '.test', 'uses' => 'FichierController@test']);
    Route::post('/create', ['as' => '.create', 'uses' => 'FichierController@insert']);
    Route::post('/filtrer', ['as' => '.filter', 'uses' => 'FichierController@filter']);
});


Route::get('/c', function () {
    $clearconfig = Artisan::call('storage:link');
    echo "Config cleared<br>";
});

Route::view('/results', 'attachements.results');

Route::group(['prefix' => 'fournisseur', 'as' => 'fournisseur'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'FournisseurController@index']);
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'FournisseurController@create']);
    Route::get('/facture',['as'=>'.facture', 'uses' => 'FournisseurController@facture']);

    Route::post('/create', ['as' => '.create', 'uses' => 'FournisseurController@store']);
    Route::post('/affecter', ['as' => '.affecter', 'uses' => 'FournisseurController@affecter']);
    Route::post('/affecter/update', ['as' => '.affecter.update', 'uses' => 'FournisseurController@affecterUpdate']);
    
    Route::post('/filter', ['as' => '.filter', 'uses' => 'FournisseurController@filter']);
    Route::get('/destroy/{fournisseur}', ['as' => '.destroy', 'uses' => 'FournisseurController@destroy']);    
    Route::get('/relancer/{fournisseur}', ['as' => '.relancer', 'uses' => 'FournisseurController@relancer']);    
    Route::get('/edit/{fournisseur}', ['as' => '.edit', 'uses' => 'FournisseurController@edit']);
    Route::get('/show/{fournisseur}', ['as' => '.show', 'uses' => 'FournisseurController@show']);
    Route::post('/update/{fournisseur}', ['as' => '.update', 'uses' => 'FournisseurController@update']);    
    Route::post('/search', ['as' => '.search', 'uses' => 'FournisseurController@search']);    
    Route::post('/change/state', ['as' => '.update.state', 'uses' => 'FournisseurController@updateState']);
});


Route::post('/sms/send', ['as' => 'send.sms', 'uses' => 'SmsController@send']);
Route::post('/sms/send/bulk', ['as' => 'send.sms.bulk', 'uses' => 'SmsController@sendBulk']);
// send.sms.bulk
Route::get('/sms/create', ['as' => 'send.sms.view', 'uses' => 'SmsController@sendView']);
Route::get('/sms/create/groupe', ['as' => 'send.sms.groupe.view', 'uses' => 'SmsController@sendGroupeView']);
Route::get('/sms', ['as' => 'sms.index', 'uses' => 'SmsController@index']);


    