<?php

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

Route::get('/', 'EventController@showList');

// API

Route::post('api/event/{id}/attendance', 'EventMemberController@editStatus');

// Authentication

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Profile

Route::get('profile/{id}', 'ProfileController@showProfile');

// Events

Route::get('event', 'EventController@showCreateForm');
Route::post('event', 'EventController@create');
Route::get('event/{id}', 'EventController@show')->name('event');
Route::delete('event/{id}', 'EventController@delete');
Route::get('event/{id}/edit', 'EventController@showEditForm');
Route::post('event/{id}', 'EventController@edit');

// Search

Route::get('search', 'EventController@search');

// Static pages

Route::get('faq', 'StaticPagesController@showFAQ');
Route::get('contacts', 'StaticPagesController@showContacts');
Route::get('about', 'StaticPagesController@showAbout');
Route::get('privacy', 'StaticPagesController@showPrivacy');
Route::get('team', 'StaticPagesController@showTeam');
Route::get('terms', 'StaticPagesController@showTerms');
