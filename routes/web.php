<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Teams
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Units
    Route::delete('units/destroy', 'UnitController@massDestroy')->name('units.massDestroy');
    Route::post('units/parse-csv-import', 'UnitController@parseCsvImport')->name('units.parseCsvImport');
    Route::post('units/process-csv-import', 'UnitController@processCsvImport')->name('units.processCsvImport');
    Route::resource('units', 'UnitController');

    // Premises
    Route::delete('premises/destroy', 'PremiseController@massDestroy')->name('premises.massDestroy');
    Route::post('premises/parse-csv-import', 'PremiseController@parseCsvImport')->name('premises.parseCsvImport');
    Route::post('premises/process-csv-import', 'PremiseController@processCsvImport')->name('premises.processCsvImport');
    Route::resource('premises', 'PremiseController');

    // Courses
    Route::delete('courses/destroy', 'CourseController@massDestroy')->name('courses.massDestroy');
    Route::post('courses/media', 'CourseController@storeMedia')->name('courses.storeMedia');
    Route::post('courses/ckmedia', 'CourseController@storeCKEditorImages')->name('courses.storeCKEditorImages');
    Route::resource('courses', 'CourseController');

    // Groups
    Route::delete('groups/destroy', 'GroupsController@massDestroy')->name('groups.massDestroy');
    Route::post('groups/media', 'GroupsController@storeMedia')->name('groups.storeMedia');
    Route::post('groups/ckmedia', 'GroupsController@storeCKEditorImages')->name('groups.storeCKEditorImages');
    Route::resource('groups', 'GroupsController');

    // Activities
    Route::delete('activities/destroy', 'ActivityController@massDestroy')->name('activities.massDestroy');
    Route::post('activities/media', 'ActivityController@storeMedia')->name('activities.storeMedia');
    Route::post('activities/ckmedia', 'ActivityController@storeCKEditorImages')->name('activities.storeCKEditorImages');
    Route::resource('activities', 'ActivityController');

    // Questions
    Route::delete('questions/destroy', 'QuestionsController@massDestroy')->name('questions.massDestroy');
    Route::post('questions/media', 'QuestionsController@storeMedia')->name('questions.storeMedia');
    Route::post('questions/ckmedia', 'QuestionsController@storeCKEditorImages')->name('questions.storeCKEditorImages');
    Route::post('questions/parse-csv-import', 'QuestionsController@parseCsvImport')->name('questions.parseCsvImport');
    Route::post('questions/process-csv-import', 'QuestionsController@processCsvImport')->name('questions.processCsvImport');
    Route::resource('questions', 'QuestionsController');

    // Variants
    Route::delete('variants/destroy', 'VariantsController@massDestroy')->name('variants.massDestroy');
    Route::post('variants/media', 'VariantsController@storeMedia')->name('variants.storeMedia');
    Route::post('variants/ckmedia', 'VariantsController@storeCKEditorImages')->name('variants.storeCKEditorImages');
    Route::post('variants/parse-csv-import', 'VariantsController@parseCsvImport')->name('variants.parseCsvImport');
    Route::post('variants/process-csv-import', 'VariantsController@processCsvImport')->name('variants.processCsvImport');
    Route::resource('variants', 'VariantsController');

    // Answers
    Route::delete('answers/destroy', 'AnswersController@massDestroy')->name('answers.massDestroy');
    Route::post('answers/media', 'AnswersController@storeMedia')->name('answers.storeMedia');
    Route::post('answers/ckmedia', 'AnswersController@storeCKEditorImages')->name('answers.storeCKEditorImages');
    Route::post('answers/parse-csv-import', 'AnswersController@parseCsvImport')->name('answers.parseCsvImport');
    Route::post('answers/process-csv-import', 'AnswersController@processCsvImport')->name('answers.processCsvImport');
    Route::resource('answers', 'AnswersController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
    Route::get('team-members', 'TeamMembersController@index')->name('team-members.index');
    Route::post('team-members', 'TeamMembersController@invite')->name('team-members.invite');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
