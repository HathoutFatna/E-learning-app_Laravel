<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Cours
    Route::apiResource('cours', 'CoursApiController');

    // Chapitres
    Route::apiResource('chapitres', 'ChapitresApiController');

    // Lecons
    Route::post('lecons/media', 'LeconsApiController@storeMedia')->name('lecons.storeMedia');
    Route::apiResource('lecons', 'LeconsApiController');

    // Questions
    Route::post('questions/media', 'QuestionsApiController@storeMedia')->name('questions.storeMedia');
    Route::apiResource('questions', 'QuestionsApiController');

    // Quizzes
    Route::apiResource('quizzes', 'QuizApiController');
});
