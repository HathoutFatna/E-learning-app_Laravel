
<?php
use Illuminate\Http\Request;
use App\Cour;
Route::redirect('/', '/home');
//Route::get('/home', function () {return view('Client.home');});
Route::resource('home', 'IndexController');
Route::resource('cours', 'CoursController');
Route::resource('lecons', 'LeconsController');
Route::resource('student', 'StudentController');
Route::resource('test', 'TestController');
Route::post('cours/{id}/test', ['uses' => 'CoursController@test', 'as' => 'cours.test']);
Route::any('/search',function(Request $request){

    $q = $request->input( 'q' );
    $cours = Cour::where('titre','LIKE','%'.$q.'%')->orWhere('description','LIKE','%'.$q.'%')->get();
    $cours->load('enseignants', 'coursChapitres', 'coursQuizzes', 'category');
    if(count($cours) > 0)

        return view('Client.search')->withCours($cours)->withQuery ( $q );
    else return view ('Client.search')->withMessage('No Details found. Try to search again !');
});

Route::any('/searchAdv', function(Request $req){

    $IdCategory = $req->input( 'category' );
    $cour = Cour::where('categories_id','LIKE','%'.$IdCategory.'%')->get();
    $cour->load('enseignants', 'coursChapitres', 'coursQuizzes', 'category');
    if(count($cour) > 0)

        return view('Client.search')->withCours($cour)->withQuery ( $IdCategory);
    else return view ('Client.search')->withMessage('No Details found. Try to search again !');
});
/*Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});*/

Auth::routes(['register' => true]);
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

    // Cours
    Route::delete('cours/destroy', 'CoursController@massDestroy')->name('cours.massDestroy');
    Route::post('cours/media', 'CoursController@storeMedia')->name('cours.storeMedia');
    Route::post('cours/ckmedia', 'CoursController@storeCKEditorImages')->name('cours.storeCKEditorImages');
    Route::resource('cours', 'CoursController');

    // Chapitres
    Route::delete('chapitres/destroy', 'ChapitresController@massDestroy')->name('chapitres.massDestroy');
    Route::resource('chapitres', 'ChapitresController');

    // Lecons
    Route::delete('lecons/destroy', 'LeconsController@massDestroy')->name('lecons.massDestroy');
    Route::post('lecons/media', 'LeconsController@storeMedia')->name('lecons.storeMedia');
    Route::post('lecons/ckmedia', 'LeconsController@storeCKEditorImages')->name('lecons.storeCKEditorImages');
    Route::resource('lecons', 'LeconsController');

    // Questions
    Route::delete('questions/destroy', 'QuestionsController@massDestroy')->name('questions.massDestroy');
    Route::post('questions/media', 'QuestionsController@storeMedia')->name('questions.storeMedia');
    Route::post('questions/ckmedia', 'QuestionsController@storeCKEditorImages')->name('questions.storeCKEditorImages');
    Route::resource('questions', 'QuestionsController');

    // Quizzes
    Route::delete('quizzes/destroy', 'QuizController@massDestroy')->name('quizzes.massDestroy');
    Route::resource('quizzes', 'QuizController');

    //categories
    Route::resource('categories', 'CategoriesController');
});
