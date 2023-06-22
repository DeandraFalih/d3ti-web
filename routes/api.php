<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\api\Auth\LoginController;
use App\Http\Controllers\Admin\api\Post\PostController;
use App\Http\Controllers\Admin\api\Event\EventController;
use App\Http\Controllers\Admin\api\Role\RoleController;
use App\Http\Controllers\Admin\api\Tags\TagsController;
use App\Http\Controllers\Admin\api\Product\ProductController;
use App\Http\Controllers\Admin\api\Comment\CommentController;
use App\Http\Controllers\Admin\api\Option\OptionController;
use App\Http\Controllers\Admin\api\User\UserController;

//Admin


//API Post
Route::middleware('auth:sanctum')->group(function () {
//Post
Route::GET('/d3ti-admin', [PostController::class, 'showDashboard']);
Route::GET('/d3ti-admin/all_post', [PostController::class, 'showPost']);
Route::GET('/d3ti-admin/all_post/user_post/{user_name}', [PostController::class, 'showUserPost']);
Route::GET('/d3ti-admin/all_post/{status}', [PostController::class, 'showPostByStatus']);
Route::GET('/d3ti-admin/add_post', [PostController::class, 'createPostForm']);
Route::POST('/d3ti-admin/add_post/process', [PostController::class, 'createPostProcess']);
Route::GET('/d3ti-admin/edit_post/{post_id}', [PostController::class, 'editPostForm']);
Route::PUT('/d3ti-admin/edit_post/process/{post_id}', [PostController::class, 'editPostProcess']);
Route::GET('/d3ti-admin/preview_post/{post_link}', [PostController::class, 'previewPost']);
Route::PUT('/d3ti-admin/publish_post/process/{post_id}', [PostController::class, 'publishPostProcess']);
Route::DELETE('/d3ti-admin/delete_post/{post_id}', [PostController::class, 'deletePost']);
Route::PUT('/d3ti-admin/trash_post/{post_id}', [PostController::class, 'trashPost']);
//Categories
Route::GET('/d3ti-admin/post_categories', [PostController::class, 'showCategories']);
Route::POST('/d3ti-admin/post_categories/process', [PostController::class, 'createCategoriesProcess']);
Route::PUT('/d3ti-admin/edit_categories/process/{post_categories_id}', [PostController::class, 'editCategoriesProcess']);
Route::DELETE('/d3ti-admin/delete_categories/{post_categories_id}', [PostController::class, 'deleteCategories']);



//API Tags
Route::GET('/d3ti-admin/tags', [TagsController::class, 'showTags']);
Route::POST('/d3ti-admin/tags/process', [TagsController::class, 'createTagsProcess']);
Route::PUT('/d3ti-admin/edit_tags/process/{tags_id}', [TagsController::class, 'editTagsProcess']);
Route::DELETE('/d3ti-admin/delete_tags/{tags_id}', [TagsController::class, 'deleteTags']);



//API Event
Route::GET('/d3ti-admin/all_event', [EventController::class, 'showEvent']);
Route::GET('/d3ti-admin/all_event/user_event/{user_name}', [EventController::class, 'showUserEvent']);
Route::GET('/d3ti-admin/all_event/{status}', [EventController::class, 'showEventByStatus']);
Route::GET('/d3ti-admin/add_event', [EventController::class, 'createEventForm']);
Route::POST('/d3ti-admin/add_event/process', [EventController::class, 'createEventProcess']);
Route::GET('/d3ti-admin/edit_event/{event_id}', [EventController::class, 'editEventForm']);
Route::PUT('/d3ti-admin/edit_event/process/{event_id}', [EventController::class, 'editEventProcess']);
Route::DELETE('/d3ti-admin/delete_event/{event_id}', [EventController::class, 'deleteEvent']);
Route::PUT('/d3ti-admin/trash_event/{event_id}', [EventController::class, 'trashEvent']);



//API Product
//Product
Route::GET('/d3ti-admin/all_product', [ProductController::class, 'showProduct']);
Route::GET('/d3ti-admin/all_product/user_product/{user_name}', [ProductController::class, 'showUserProduct']);
Route::GET('/d3ti-admin/all_product/{status}', [ProductController::class, 'showProductByStatus']);
Route::GET('/d3ti-admin/add_product', [ProductController::class, 'createProductForm']);
Route::POST('/d3ti-admin/add_product/process', [ProductController::class, 'createProductProcess']);
Route::GET('/d3ti-admin/edit_product/{product_id}', [ProductController::class, 'editProductForm']);
Route::PUT('/d3ti-admin/edit_product/process/{product_id}', [ProductController::class, 'editProductProcess']);
Route::DELETE('/d3ti-admin/delete_product/{product_id}', [ProductController::class, 'deleteProduct']);
Route::PUT('/d3ti-admin/trash_product/{product_id}', [ProductController::class, 'trashProduct']);
//Categories
Route::GET('/d3ti-admin/product_categories', [ProductController::class, 'showProductCategories']);
Route::POST('/d3ti-admin/product_categories/process', [ProductController::class, 'createProductCategoriesProcess']);
Route::PUT('/d3ti-admin/edit_product_categories/process/{product_categories_id}', [ProductController::class, 'editProductCategoriesProcess']);
Route::DELETE('/d3ti-admin/delete_product_categories/{product_categories_id}', [ProductController::class, 'deleteProductCategories']);



//API Comment
Route::GET('/d3ti-admin/all_comment/post_comment', [CommentController::class, 'showPostComment']);
Route::PUT('/d3ti-admin/all_comment/post_comment/process/{post_comment_id}', [CommentController::class, 'managePostCommentStatus']);
Route::GET('/d3ti-admin/all_comment/event_comment', [CommentController::class, 'showEventComment']);
Route::PUT('/d3ti-admin/all_comment/event_comment/process/{event_comment_id}', [CommentController::class, 'manageEventCommentStatus']);
Route::get('/d3ti-admin/all_comment/product_comment', [CommentController::class, 'showProductComment']);
Route::put('/d3ti-admin/all_comment/product_comment/process/{product_comment_id}', [CommentController::class, 'manageProductCommentStatus']);


//API Role
Route::GET('/d3ti-admin/role', [RoleController::class, 'showRole']);
Route::PUT('/d3ti-admin/manage_role_permissions/process/{role_id}', [RoleController::class, 'manageRolePermissionsProcess']);
});


//API User
Route::GET('/d3ti-admin/all_user', [UserController::class, 'showAllUser']);
Route::POST('/d3ti-admin/add_user/process', [UserController::class, 'createUserProcess']);
Route::GET('/d3ti-admin/my_profile/{user_username}', [UserController::class, 'myProfile']);
Route::PUT('/d3ti-admin/my_profile/edit_process/{user_id}', [UserController::class, 'editProfileProcess']);



//API Option
Route::GET('/d3ti-admin/gallery', [OptionController::class, 'showGallery']);
Route::GET('/d3ti-admin/youtube', [OptionController::class, 'showYoutube']);
Route::PUT('/d3ti-admin/youtube/edit_show/{youtube_id}', [OptionController::class, 'editShowYoutube']);


//User

//API Post
Route::GET('/event/{event_link}', [EventController::class, 'showArticleEvent']);
