<?php

Route::resource('meals', 'MealsController', ['except' => ['create', 'index']]);
Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'update']]);
Route::resource('/meals/{meal}/registrations', 'MealRegistrationsController');
