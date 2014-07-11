<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('comment', 'Comment');
Route::model('post', 'Post');
Route::model('cv', 'Cv');
Route::model('role', 'Role');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('comment', '[0-9]+');
Route::pattern('post', '[0-9]+');
Route::pattern('cv', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{

    # Comment Management
    Route::get('comments/{comment}/edit', 'AdminCommentsController@getEdit');
    Route::post('comments/{comment}/edit', 'AdminCommentsController@postEdit');
    Route::get('comments/{comment}/delete', 'AdminCommentsController@getDelete');
    Route::post('comments/{comment}/delete', 'AdminCommentsController@postDelete');
    Route::controller('comments', 'AdminCommentsController');

    # Job Management
    Route::get('job-posts/{post}/show', 'AdminJobPostsController@getShow');
    Route::get('job-posts/{post}/edit', 'AdminJobPostsController@getEdit');
    Route::post('job-posts/{post}/edit', 'AdminJobPostsController@postEdit');
    Route::get('job-posts/{post}/delete', 'AdminJobPostsController@getDelete');
    Route::post('job-posts/{post}/delete', 'AdminJobPostsController@postDelete');
    Route::controller('job-posts', 'AdminJobPostsController');

    # Cv Management
    Route::get('cvs/{cv}/show', 'AdminCvsController@getShow');
    Route::get('cvs/{cv}/edit', 'AdminCvsController@getEdit');
    Route::post('cvs/{cv}/edit', 'AdminCvsController@postEdit');
    Route::get('cvs/{cv}/delete', 'AdminCvsController@getDelete');
    Route::post('cvs/{cv}/delete', 'AdminCvsController@postDelete');
    Route::controller('cvs', 'AdminCvsController');

    # User Management
    Route::get('users/{user}/show', 'AdminUsersController@getShow');
    Route::get('users/{user}/edit', 'AdminUsersController@getEdit');
    Route::post('users/{user}/edit', 'AdminUsersController@postEdit');
    Route::get('users/{user}/delete', 'AdminUsersController@getDelete');
    Route::post('users/{user}/delete', 'AdminUsersController@postDelete');
    Route::controller('users', 'AdminUsersController');

    # User Role Management
    Route::get('roles/{role}/show', 'AdminRolesController@getShow');
    Route::get('roles/{role}/edit', 'AdminRolesController@getEdit');
    Route::post('roles/{role}/edit', 'AdminRolesController@postEdit');
    Route::get('roles/{role}/delete', 'AdminRolesController@getDelete');
    Route::post('roles/{role}/delete', 'AdminRolesController@postDelete');
    Route::controller('roles', 'AdminRolesController');

    # Admin Dashboard
    Route::controller('/', 'AdminDashboardController');
});

/** ------------------------------------------
 *  Recruitment Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'recruitment', 'before' => 'auth'), function()
{

    # Job Management
    Route::get('job-posts/{post}/show', 'RecruitmentJobPostsController@getShow');
    Route::get('job-posts/{post}/edit', 'RecruitmentJobPostsController@getEdit');
    Route::post('job-posts/{post}/edit', 'RecruitmentJobPostsController@postEdit');
    Route::get('job-posts/{post}/delete', 'RecruitmentJobPostsController@getDelete');
    Route::post('job-posts/{post}/delete', 'RecruitmentJobPostsController@postDelete');
    Route::controller('job-posts', 'RecruitmentJobPostsController');

    # Cv Management
    Route::get('cvs/{cv}/show', 'RecruitmentCvsController@getShow');
    Route::get('cvs/{cv}/edit', 'RecruitmentCvsController@getEdit');
    Route::post('cvs/{cv}/edit', 'RecruitmentCvsController@postEdit');
    Route::get('cvs/{cv}/delete', 'RecruitmentCvsController@getDelete');
    Route::post('cvs/{cv}/delete', 'RecruitmentCvsController@postDelete');
    Route::controller('cvs', 'RecruitmentCvsController');

    # Recruitment Dashboard
    Route::controller('/', 'RecruitmentDashboardController');
});
Route::group(array('prefix' => 'user', 'before' => 'auth'), function()
{

    # Cv Management
    Route::get('cvs/{cv}/show', 'UserCvsController@getShow');
    Route::get('cvs/{cv}/edit', 'UserCvsController@getEdit');
    Route::post('cvs/{cv}/edit', 'UserCvsController@postEdit');
    Route::get('cvs/{cv}/delete', 'UserCvsController@getDelete');
    Route::post('cvs/{cv}/delete', 'UserCvsController@postDelete');
    Route::controller('cvs', 'UserCvsController');
});


/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */
Route::get('my-cv',  'UserCvsController@getIndex');
// User reset routes
Route::get('user/reset/{token}', 'UserController@getReset');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset');
//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit');

//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');

//:: Application Routes ::

# Filter for detect language
Route::when('contact-us','detectLang');

# Contact Us Static Page
Route::get('contact-us', function()
{
    // Return about us page
    return View::make('site/contact-us');
});

# Posts - Second to last set, match slug
Route::get('{postSlug}', 'JobController@getView');
Route::post('{postSlug}', 'JobController@postView');

# Index Page - Last route, no matches
Route::get('/', array('before' => 'detectLang','uses' => 'JobController@getIndex'));
