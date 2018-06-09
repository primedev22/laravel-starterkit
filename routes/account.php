<?php

/** Backend Account Routes */

Route::get('/account', 'Account\ProfileController@index')->name('account.profile');
Route::post('/account', 'Account\ProfileController@store')->name('account.profile.store');

Route::get('/account/settings', 'Account\SettingsController@index')->name('account.settings');
Route::post('/account/settings', 'Account\SettingsController@store');
Route::get('/account/billing', 'Account\BillingController@index')->name('account.billing');
Route::get('/account/invite', 'Account\InviteController@index')->name('account.invite');

/** Account Subscription Routes */
Route::get('/account/subscription', 'Account\SubscriptionDetailsController@index')->name('account.subscription.details');
// Route::post('/account/subscription', 'Account\SubscriptionController@process')->name('account.subscription');

/** Main Application Routes */

Route::get('/app', 'Account\DashboardController@index')->name('app.dashboard');
