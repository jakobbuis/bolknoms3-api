<?php

// Custom routes for convenience
Route::get('/users/blocked', 'UsersController@blocked');
Route::get('/users/me', 'UsersController@me');

// Basis resources
Route::resource('meals', 'MealsController', ['except' => ['create', 'edit']]);
Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'update']]);
Route::resource('/meals/{meal}/registrations', 'MealRegistrationsController');
Route::resource('rules', 'RulesController', ['only' => ['index']]);
