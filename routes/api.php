<?php

Route::get('/users/blocked', 'UsersController@blocked');
Route::get('/users/me', 'UsersController@me');
Route::patch('/users/me', 'UsersController@updateMe');
Route::resource('/users', 'UsersController', ['only' => ['index', 'show', 'update']]);

Route::get('/meals/today', 'MealsController@today');
Route::get('/meals/upcoming', 'MealsController@upcoming');
Route::get('/meals/available', 'MealsController@available');
Route::resource('/meals', 'MealsController', ['except' => ['create', 'edit']]);

Route::resource('/meals/{meal}/registrations', 'MealRegistrationsController');

Route::resource('/rules', 'RulesController', ['only' => ['index']]);
