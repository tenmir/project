<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\ReactionTypeController;
use App\Models\FriendRequest;

Route::post('signUp',[LoginController::class,'signUp']);
Route::post('signIn',[LoginController::class,'signIn']);

Route::group(["middleware" => "auth:sanctum"], function() {
    Route::post('posts',[PostController::class,'getPosts']);
    Route::post('editPosts',[PostController::class,'editPosts']);
    Route::post('createPost',[PostController::class,'createPost']);
    Route::post('deletePost',[PostController::class,'deletePost']);
    Route::post('createComment',[CommentController::class,'createComment']);
    Route::post('getComments',[CommentController::class,'getComments']);
    Route::post('makeReaction',[ReactionController::class,'makeReaction']);
    Route::post('makeReactionType',[ReactionTypeController::class,'makeReactionType']);
    Route::post('makeTag',[TagsController::class,'makeTag']);
    Route::post('makePostTag',[PostController::class,'makePostTag']);
    Route::post('upload',[FileController::class,'store']);
    Route::post('search',[SearchController::class,'search'])->name('posts.search');
    Route::post('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('profileUpdate', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('createProfile', [ProfileController::class, 'createProfile']);
    Route::post('/friend-request/{receiver}',[FriendRequestController::class,'sendRequest']);
    Route::post('/accept-request/{request}', [FriendRequestController::class, 'acceptRequest']);
    Route::post('/reject-request/{request}', [FriendRequestController::class, 'rejectRequest']);
    Route::post('/blacklist-request/{request}',[FriendRequestController::class,'sendBlacklist']);
    Route::post('/blacklist-remove/{request}',[FriendRequestController::class,'removeBlacklist']);
    Route::post('getAllFriends',[FriendRequestController::class,'getAcceptedFriends']);
    Route::post('getBlacklistedUsers',[FriendRequestController::class,'getBlacklistedUsers']);
});