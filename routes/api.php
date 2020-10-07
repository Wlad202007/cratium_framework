<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Teams
    Route::apiResource('teams', 'TeamApiController');

    // Units
    Route::apiResource('units', 'UnitApiController');

    // Premises
    Route::apiResource('premises', 'PremiseApiController');

    // Courses
    Route::post('courses/media', 'CourseApiController@storeMedia')->name('courses.storeMedia');
    Route::apiResource('courses', 'CourseApiController');

    // Groups
    Route::post('groups/media', 'GroupsApiController@storeMedia')->name('groups.storeMedia');
    Route::apiResource('groups', 'GroupsApiController');

    // Activities
    Route::post('activities/media', 'ActivityApiController@storeMedia')->name('activities.storeMedia');
    Route::apiResource('activities', 'ActivityApiController');

    // Questions
    Route::post('questions/media', 'QuestionsApiController@storeMedia')->name('questions.storeMedia');
    Route::apiResource('questions', 'QuestionsApiController');

    // Variants
    Route::post('variants/media', 'VariantsApiController@storeMedia')->name('variants.storeMedia');
    Route::apiResource('variants', 'VariantsApiController');

    // Answers
    Route::post('answers/media', 'AnswersApiController@storeMedia')->name('answers.storeMedia');
    Route::apiResource('answers', 'AnswersApiController');

    // Documents
    Route::post('documents/media', 'DocumentsApiController@storeMedia')->name('documents.storeMedia');
    Route::apiResource('documents', 'DocumentsApiController');

    // Reviews
    Route::post('reviews/media', 'ReviewsApiController@storeMedia')->name('reviews.storeMedia');
    Route::apiResource('reviews', 'ReviewsApiController');

    // Folders
    Route::apiResource('folders', 'FoldersApiController');

    // Signatures
    Route::post('signatures/media', 'SignatureApiController@storeMedia')->name('signatures.storeMedia');
    Route::apiResource('signatures', 'SignatureApiController');

    // Templates
    Route::post('templates/media', 'TemplateApiController@storeMedia')->name('templates.storeMedia');
    Route::apiResource('templates', 'TemplateApiController');

    // Scores
    Route::apiResource('scores', 'ScoresApiController');
});
