<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SolutionController;
use App\Http\Controllers\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('Register', [AuthController::class, 'Register']);
Route::post('Login', [AuthController::class, 'Login']);

Route::middleware('auth:api')->group(function () {

    Route::get('auth/get', [AuthController::class, 'getUser']);
    Route::post('auth/update', [AuthController::class, 'update']);
    Route::get('auth/delete', [AuthController::class, 'deleteImage']);

    Route::get('categories', [CategoryController::class, 'fetchAll']);
    Route::get('types', [TypeController::class, 'fetchAll']);
    Route::get('books', [BookController::class, 'fetchAll']);
    Route::get('authors', [AuthorController::class, 'fetchAll']);

    Route::get('book/get/{id}', [BookController::class, 'getBook']);
    Route::get('author/get/{id}', [AuthorController::class, 'getAuthor']);

    Route::get('book/search/{name?}', [BookController::class, 'search']);
    Route::get('category/search/{name?}', [CategoryController::class, 'search']);
    Route::get('author/search/{name?}', [AuthorController::class, 'search']);
    Route::get('type/search/{name?}', [TypeController::class, 'search']);

    Route::get('category/type/{id}', [CategoryController::class, 'TypesOfCategory']);
    Route::get('book/type/{id}', [TypeController::class, 'BooksOfType']);
    Route::get('book/author/{id}', [AuthorController::class, 'BooksOfAuthor']);



    Route::middleware('check_Admin')->group(function () {

        Route::prefix('category')->group(function () {
            Route::post('add', [CategoryController::class, 'store']);
            Route::delete('delete/{id}', [CategoryController::class, 'deleteCategory']);
        });

        Route::prefix('type')->group(function () {
            Route::post('add', [TypeController::class, 'store']);
            Route::delete('delete/{id}', [TypeController::class, 'deleteType']);
        });

        Route::prefix('author')->group(function () {
            Route::post('add', [AuthorController::class, 'store']);
            Route::delete('delete/{id}', [AuthorController::class, 'deleteAuthor']);
        });

        Route::prefix('book')->group(function () {
            Route::post('add', [BookController::class, 'store']);
            Route::post('update/{id}', [BookController::class, 'updateBook']);
            Route::delete('delete/{id}', [BookController::class, 'deleteBook']);
        });

        Route::prefix('answer')->group(function () {
            Route::post('add', [AnswerController::class, 'store']);
            Route::post('update/{id}', [AnswerController::class, 'update']);
        });




        Route::prefix('solution')->group(function () {

            Route::post('add', [SolutionController::class, 'store']);
            Route::delete('delete/{id}', [SolutionController::class, 'delete']);
            Route::post('update/{id}', [SolutionController::class, 'update']);

        });

    });

    Route::get('code', [AuthController::class, 'Verification']);

    Route::middleware('check_User')->group(function () {

        Route::prefix('library')->group(function () {
            Route::post('add', [LibraryController::class, 'add']);
            Route::post('sign/add', [LibraryController::class, 'addSign']);
            Route::get('show/{id}', [LibraryController::class, 'booksOfCondition']);
        });

        Route::prefix('note')->group(function () {
            Route::post('add', [NoteController::class, 'store']);
            Route::post('show', [NoteController::class, 'myNotes']);
            Route::post('update/{id}', [NoteController::class, 'update']);
            Route::delete('delete/{id}', [NoteController::class, 'deleteNote']);
            Route::delete('delete', [NoteController::class, 'deleteNotes']);
        });

        Route::prefix('question')->group(function () {
            Route::post('add', [QuestionController::class, 'store']);
            Route::get('show/{id}', [QuestionController::class, 'QuestionsOfBook']);
            Route::post('update/{id}', [QuestionController::class, 'update']);
            Route::delete('delete/{id}', [QuestionController::class, 'delete']);
        });

        Route::prefix('evaluation')->group(function () {
            Route::post('add', [EvaluationController::class, 'store']);
            Route::post('update/{id}', [EvaluationController::class, 'update']);
            Route::delete('delete/{id}', [EvaluationController::class, 'delete']);
        });

        Route::prefix('complaint')->group(function () {
            Route::post('add', [ComplaintController::class, 'store']);
            Route::get('index', [ComplaintController::class, 'complaints']);
            Route::post('update/{id}', [ComplaintController::class, 'update']);
            Route::delete('delete/{id}', [ComplaintController::class, 'delete']);
        });

        Route::prefix('notification')->group(function () {

            Route::post('sFcmTo',[AuthController::class, 'storeFcmToken']);

        });


    });

    Route::get('logout', [AuthController::class, 'Logout']);
});
