<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    if(Auth::user()){
        return view('home');
    }else{
        return view('welcome');
    }
});

Auth::routes();

Route::group(['middleware' => ['web','auth']], function () {
    Route::get('/home', ['as' => 'index','uses' => 'HomeController@index']);
    Route::get('/405', ['as' => 'four.zero.five','uses' => 'HomeController@fourzerofive']);
});

Route::group(['prefix' => 'profile'], function () {
    Route::get('/', ['as' => 'profile.index','uses' => 'ProfileController@index']);
    Route::get('/image', ['as' => 'profile.image','uses' => 'ProfileController@image']);
    Route::get('/name', ['as' => 'profile.name','uses' => 'ProfileController@name']);
    Route::get('/remove', ['as' => 'image.remove','uses' => 'ProfileController@remove']);
    Route::post('/upload', ['as' => 'image.upload','uses' => 'ProfileController@upload']);
    Route::post('/update', ['as' => 'profile.update','uses' => 'ProfileController@update']);
});

Route::group(['prefix' => 'employees'], function () {
    Route::get('/', ['as' => 'employees.index','uses' => 'EmployeesController@index']);
    Route::get('/search', ['as' => 'employees.search','uses' => 'EmployeesController@search']);
    Route::delete('/delete/{employee}',['as' => 'employees.destroy','uses' => 'EmployeesController@destroy']);
});

Route::group(['prefix' => 'students'], function () {
    Route::get('/', ['as' => 'students.index','uses' => 'StudentsController@index']);
    Route::get('/search', ['as' => 'students.search','uses' => 'StudentsController@search']);
    Route::delete('/delete/{student}',['as' => 'students.destroy','uses' => 'StudentsController@destroy']);
});

Route::group(['prefix' => 'questions'], function () {
    Route::get('/', ['as' => 'questions.index','uses' => 'QuestionsController@index']);
    Route::get('/add', ['as' => 'questions.add','uses' => 'QuestionsController@add']);
    Route::get('/edit/{question}', ['as' => 'questions.edit','uses' => 'QuestionsController@edit']);
    Route::get('/search', ['as' => 'questions.search','uses' => 'QuestionsController@search']);
    Route::post('/store',['as' => 'questions.store','uses' => 'QuestionsController@store']);
    Route::patch('/patch/{question}',['as' => 'questions.update','uses' => 'QuestionsController@update']);
    Route::delete('/delete/{question}',['as' => 'questions.destroy','uses' => 'QuestionsController@destroy']);
});

Route::group(['prefix' => 'for'], function () {
    Route::get('/', ['as' => 'for.index','uses' => 'QuestionsForController@index']);
    Route::get('/add', ['as' => 'for.add','uses' => 'QuestionsForController@add']);
    Route::get('/edit/{for}', ['as' => 'for.edit','uses' => 'QuestionsForController@edit']);
    Route::get('/search', ['as' => 'for.search','uses' => 'QuestionsForController@search']);
    Route::post('/store',['as' => 'for.store','uses' => 'QuestionsForController@store']);
    Route::patch('/patch/{for}',['as' => 'for.update','uses' => 'QuestionsForController@update']);
    Route::delete('/delete/{for}',['as' => 'for.destroy','uses' => 'QuestionsForController@destroy']);
});

Route::group(['prefix' => 'groups'], function () {
    Route::get('/', ['as' => 'groups.index','uses' => 'GroupsController@index']);
    Route::get('/add', ['as' => 'groups.add','uses' => 'GroupsController@add']);
    Route::get('/edit/{group}', ['as' => 'groups.edit','uses' => 'GroupsController@edit']);
    Route::get('/search', ['as' => 'groups.search','uses' => 'GroupsController@search']);
    Route::post('/store',['as' => 'groups.store','uses' => 'GroupsController@store']);
    Route::patch('/patch/{group}',['as' => 'groups.update','uses' => 'GroupsController@update']);
    Route::delete('/delete/{group}',['as' => 'groups.destroy','uses' => 'GroupsController@destroy']);
});

Route::group(['prefix' => 'global'], function () {
    Route::get('/', ['as' => 'global_variables.index','uses' => 'GlobalVariablesController@index']);
    Route::get('/add', ['as' => 'global_variables.add','uses' => 'GlobalVariablesController@add']);
    Route::get('/edit/{global_variable}', ['as' => 'global_variables.edit','uses' => 'GlobalVariablesController@edit']);
    Route::get('/search', ['as' => 'global_variables.search','uses' => 'GlobalVariablesController@search']);
    Route::post('/store',['as' => 'global_variables.store','uses' => 'GlobalVariablesController@store']);
    Route::patch('/patch/{global_variable}',['as' => 'global_variables.update','uses' => 'GlobalVariablesController@update']);
    Route::delete('/delete/{global_variable}',['as' => 'global_variables.destroy','uses' => 'GlobalVariablesController@destroy']);
});

Route::group(['prefix' => 'groups_questions'], function () {
    Route::get('/{group_id}', ['as' => 'groups_questions.index','uses' => 'GroupsQuestionsController@index']);
    Route::get('/add/{group_id}', ['as' => 'groups_questions.add','uses' => 'GroupsQuestionsController@add']);
    Route::post('/store',['as' => 'groups_questions.store','uses' => 'GroupsQuestionsController@store']);
    Route::delete('/delete/{group_question}',['as' => 'groups_questions.destroy','uses' => 'GroupsQuestionsController@destroy']);
});

Route::group(['prefix' => 'migrate_options'], function () {
    Route::get('/', ['as' => 'migrate_options.index','uses' => 'MigrateSettingsController@index']);
    Route::get('/migrate/{id}', ['as' => 'migrate_options.migrate','uses' => 'MigrateSettingsController@migrate']);
    Route::get('/delete/{id}', ['as' => 'migrate_options.delete','uses' => 'MigrateSettingsController@delete']);
});

Route::group(['prefix' => 'deans'], function () {
    Route::get('/', ['as' => 'deans.index','uses' => 'DeanEvaluationController@index']);
    Route::get('/evaluate/{sjc_id}', ['as' => 'deans.evaluate','uses' => 'DeanEvaluationController@migrate']);
});

Route::group(['prefix' => 'faculty'], function () {
    Route::get('/', ['as' => 'faculty.index','uses' => 'FacultyEvaluationController@index']);
    Route::get('/evaluate/{sjc_id}', ['as' => 'faculty.evaluate','uses' => 'FacultyEvaluationController@migrate']);
});