<?php

Route::resource('meals', 'MealsController', ['except' => ['create', 'edit']]);
Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'update']]);
Route::resource('/meals/{meal}/registrations', 'MealRegistrationsController');
