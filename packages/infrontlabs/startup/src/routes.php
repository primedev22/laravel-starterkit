<?php

/** Backend Account Routes */

Route::get('/account', 'Account\ProfileController@index')->name('account.index');
Route::post('/account', 'Account\ProfileController@store')->name('account.profile.store');

Route::get('/account/team/invite/resend/{teamInvite}', 'Account\TeamController@resendInvite')->name('account.team.invite.resend');

Route::get('/accounts', 'Account\ManageAccountsController@index')->name('accounts');
Route::post('/accounts', 'Account\ManageAccountsController@store')->name('accounts.store');
Route::get('/accounts/{account}', 'Account\AccountRedirectController')->name('accounts.switch');

Route::get('/account/password', 'Account\PasswordController@index')->name('account.password');
Route::post('/account/password', 'Account\PasswordController@store')->name('account.password.store');

Route::get('/account/user/invites', 'Account\UserInvitesController@index')->name('account.user.invites');
Route::get('/account/user/invites/accept/{teamInvite}', 'Account\UserInvitesController@accept')->name('account.user.invites.accept');

Route::group(['middleware' => 'subscription.inactive'], function () {
    Route::post('/account/subscribe', 'Account\SubscriptionCreateController@process')->name('account.subscribe.process');
});

/** Account Admin Routes */
Route::group(['middleware' => 'account.admin'], function () {

    Route::get('/account/settings', 'Account\SettingsController@index')->name('account.settings');
    Route::post('/account/settings', 'Account\SettingsController@store');

    Route::group(['middleware' => ['subscription.notcancelled']], function () {
        Route::get('/account/subscription/cancel', 'Account\SubscriptionCancelController@index')->name('account.subscription.cancel');
        Route::post('/account/subscription/cancel', 'Account\SubscriptionCancelController@process')->name('account.subscription.cancel.process');
        Route::get('/account/subscription/swap', 'Account\SubscriptionSwapController@index')->name('account.subscription.swap');
        Route::post('/account/subscription/swap', 'Account\SubscriptionSwapController@store')->name('account.subscription.swap.store');
    });

    Route::group(['middleware' => 'subscription.cancelled'], function () {
        Route::get('/account/subscription/resume', 'Account\SubscriptionResumeController@index')->name('account.subscription.resume');
        Route::post('/account/subscription/resume', 'Account\SubscriptionResumeController@process')->name('account.subscription.resume.process');
    });

    Route::group(['middleware' => 'subscription.customer'], function () {
        Route::get('/account/subscription', 'Account\SubscriptionDetailsController@index')->name('account.subscription.index');
        Route::get('/account/subscription/card', 'Account\SubscriptionCardController@index')->name('account.subscription.card');
        Route::post('/account/subscription/card', 'Account\SubscriptionCardController@store')->name('account.subscription.card.store');
        Route::get('/account/subscription/invoices', 'Account\SubscriptionInvoicesController@index')->name('account.subscription.invoices');
        Route::get('/account/subscription/invoices/{invoice}', 'Account\SubscriptionInvoicesController@download')->name('account.subscription.invoices.download');
    });

});

Route::group(['middleware' => ['subscription.active']], function () {
    Route::get('/account/team', 'Account\TeamController@index')->name('account.team');
    Route::post('/account/team', 'Account\TeamController@invite')->name('account.team.invite')->middleware('can:admin account');
    Route::delete('/account/team/{user}', 'Account\TeamController@delete')->name('account.team.delete')->middleware('can:admin account');
    Route::post('/account/team/{user}', 'Account\TeamController@edit')->name('account.team.edit')->middleware('can:admin account');
});
