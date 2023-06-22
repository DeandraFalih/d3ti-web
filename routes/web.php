<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\ClientLoginController;
use App\Http\Controllers\Admin\Post\ClientPostController;
use App\Http\Controllers\Admin\Event\ClientEventController;
use App\Http\Controllers\Admin\Role\ClientRoleController;
use App\Http\Controllers\Admin\Tags\ClientTagsController;
use App\Http\Controllers\Admin\Product\ClientProductController;
use App\Http\Controllers\Admin\Comment\ClientCommentController;
use App\Http\Controllers\Admin\User\ClientUserController;
use App\Http\Controllers\Admin\Option\ClientOptionController;
use App\Http\Controllers\User\Article\ClientArticleController;


//Admin

//Without Controller
Route::post('/upload-image', function () {
    $image = request()->file('file');

    $imageName = time() . '.' . $image->getClientOriginalExtension();
    $folder = 'storage/images';
    $image->move($folder, $imageName);

    $imagePath = 'https://d3tisolo.vokasi.uns.ac.id/storage/images/' . $imageName;

    return response()->json(['location' => $imagePath]);
});

//Dashboard
Route::GET('/d3ti-admin', function () {
    return view('admin.layout');
})->middleware('auth');

Route::GET('/d3ti-admin', function () {
    return view('admin.dashboard.dashboard');
})->middleware('auth');


//Client Login Controller
Route::GET('/d3ti-login', [ClientLoginController::class, 'login'])->name('login');
Route::POST('/login/process', [ClientLoginController::class, 'process']);
Route::GET('/d3ti-logout', [ClientLoginController::class, 'logout']);


//Client Post Controller
//Post
Route::middleware('auth')->group(function () {
Route::GET('/d3ti-admin', [ClientPostController::class, 'showDashboard']);
Route::GET('/d3ti-admin/all_post', [ClientPostController::class, 'showPost']);
Route::GET('/d3ti-admin/all_post/user_post', [ClientPostController::class, 'showUserPost']);
Route::GET('/d3ti-admin/all_post/{status}', [ClientPostController::class, 'showPostByStatus']);
Route::GET('/d3ti-admin/add_post', [ClientPostController::class, 'createPostForm']);
Route::POST('/d3ti-admin/add_post/process', [ClientPostController::class, 'createPostProcess']);
Route::GET('/d3ti-admin/edit_post/{post_id}', [ClientPostController::class, 'editPostForm']);
Route::PUT('/d3ti-admin/edit_post/process/{post_id}', [ClientPostController::class, 'editPostProcess']);
Route::GET('/d3ti-admin/review_post/{post_id}', [ClientPostController::class, 'editPostForm']);
Route::GET('/d3ti-admin/review_post/preview/{post_link}', [ClientPostController::class, 'previewPost']);
Route::PUT('/d3ti-admin/publish_post/process/{post_id}', [ClientPostController::class, 'publishPostProcess']);
Route::DELETE('/d3ti-admin/delete_post/{post_id}', [ClientPostController::class, 'deletePost']);
Route::PUT('/d3ti-admin/trash_post/{post_id}', [ClientPostController::class, 'trashPost']);
//Categories
Route::GET('/d3ti-admin/post_categories', [ClientPostController::class, 'showCategories']);
Route::POST('/d3ti-admin/post_categories/process', [ClientPostController::class, 'createCategoriesProcess']);
Route::PUT('/d3ti-admin/edit_categories/process/{post_categories_id}', [ClientPostController::class, 'editCategoriesProcess']);
Route::DELETE('/d3ti-admin/delete_categories/{post_categories_id}', [ClientPostController::class, 'deleteCategories']);



//Client Event Controller
//Event
Route::GET('/d3ti-admin/all_event', [ClientEventController::class, 'showEvent']);
Route::GET('/d3ti-admin/all_event/user_event', [ClientEventController::class, 'showUserEvent']);
Route::GET('/d3ti-admin/all_event/{status}', [ClientEventController::class, 'showEventByStatus']);
Route::GET('/d3ti-admin/add_event', [ClientEventController::class, 'createEventForm']);
Route::POST('/d3ti-admin/add_event/process', [ClientEventController::class, 'createEventProcess']);
Route::GET('/d3ti-admin/edit_event/{event_id}', [ClientEventController::class, 'editEventForm']);
Route::PUT('/d3ti-admin/edit_event/process/{event_id}', [ClientEventController::class, 'editEventProcess']);
Route::GET('/d3ti-admin/review_event/{event_id}', [ClientEventController::class, 'editEventForm']);
Route::GET('/d3ti-admin/review_event/preview/{event_link}', [ClientEventController::class, 'previewEvent']);
Route::DELETE('/d3ti-admin/delete_event/{event_id}', [ClientEventController::class, 'deleteEvent']);
Route::PUT('/d3ti-admin/trash_event/{event_id}', [ClientEventController::class, 'trashEvent']);



//Client Product Controller
//Product
Route::GET('/d3ti-admin/all_product', [ClientProductController::class, 'showProduct']);
Route::GET('/d3ti-admin/all_product/user_product', [ClientProductController::class, 'showUserProduct']);
Route::GET('/d3ti-admin/all_product/{status}', [ClientProductController::class, 'showProductByStatus']);
Route::GET('/d3ti-admin/add_product', [ClientProductController::class, 'createProductForm']);
Route::POST('/d3ti-admin/add_product/process', [ClientProductController::class, 'createProductProcess']);
Route::GET('/d3ti-admin/edit_product/{product_id}', [ClientProductController::class, 'editProductForm']);
Route::PUT('/d3ti-admin/edit_product/process/{product_id}', [ClientProductController::class, 'editProductProcess']);
Route::GET('/d3ti-admin/review_product/{product_id}', [ClientProductController::class, 'editProductForm']);
Route::GET('/d3ti-admin/review_product/preview/{product_link}', [ClientProductController::class, 'previewProduct']);
Route::DELETE('/d3ti-admin/delete_product/{product_id}', [ClientProductController::class, 'deleteProduct']);
Route::PUT('/d3ti-admin/trash_product/{product_id}', [ClientProductController::class, 'trashProduct']);
//Categories
Route::GET('/d3ti-admin/product_categories', [ClientProductController::class, 'showProductCategories']);
Route::POST('/d3ti-admin/product_categories/process', [ClientProductController::class, 'createProductCategoriesProcess']);
Route::PUT('/d3ti-admin/edit_product_categories/process/{product_categories_id}', [ClientProductController::class, 'editProductCategoriesProcess']);
Route::DELETE('/d3ti-admin/delete_product_categories/{product_categories_id}', [ClientProductController::class, 'deleteProductCategories']);



//Client Tags Controller
Route::GET('/d3ti-admin/tags', [ClientTagsController::class, 'showTags']);
Route::POST('/d3ti-admin/tags/process', [ClientTagsController::class, 'createTagsProcess']);
Route::PUT('/d3ti-admin/edit_tags/process/{tags_id}', [ClientTagsController::class, 'editTagsProcess']);
Route::DELETE('/d3ti-admin/delete_tags/{tags_id}', [ClientTagsController::class, 'deleteTags']);



//Client Comment Controller
Route::GET('/d3ti-admin/all_comment/post_comment', [ClientCommentController::class, 'showPostComment']);
Route::PUT('/d3ti-admin/all_comment/post_comment/approve/{post_comment_id}', [ClientCommentController::class, 'ApprovePostComment']);
Route::PUT('/d3ti-admin/all_comment/post_comment/reject/{post_comment_id}', [ClientCommentController::class, 'RejectPostComment']);
Route::GET('/d3ti-admin/all_comment/event_comment', [ClientCommentController::class, 'showEventComment']);
Route::PUT('/d3ti-admin/all_comment/event_comment/approve/{event_comment_id}', [ClientCommentController::class, 'ApproveEventComment']);
Route::PUT('/d3ti-admin/all_comment/event_comment/reject/{event_comment_id}', [ClientCommentController::class, 'RejectEventComment']);
Route::GET('/d3ti-admin/all_comment/product_comment', [ClientCommentController::class, 'showProductComment']);
Route::PUT('/d3ti-admin/all_comment/product_comment/approve/{product_comment_id}', [ClientCommentController::class, 'ApproveProductComment']);
Route::PUT('/d3ti-admin/all_comment/product_comment/reject/{product_comment_id}', [ClientCommentController::class, 'RejectProductComment']);



//Client Role Controller
Route::GET('/d3ti-admin/role', [ClientRoleController::class, 'showRole']);
Route::PUT('/d3ti-admin/manage_role_permissions/process/{role_id}', [ClientRoleController::class, 'manageRolePermissionsProcess']);
});


//Client User Controller
Route::GET('/d3ti-admin/all_user', [ClientUserController::class, 'showAllUser']);
Route::POST('/d3ti-admin/add_user/process', [ClientUserController::class, 'createUserProcess']);
Route::GET('/d3ti-admin/my_profile', [ClientUserController::class, 'myProfile']);
Route::GET('/d3ti-admin/user_profile/{user_id}', [ClientUserController::class, 'viewProfile']);
Route::PUT('/d3ti-admin/my_profile/edit_process', [ClientUserController::class, 'editProfileProcess']);



//Client Option Controller
Route::GET('/d3ti-admin/gallery', [ClientOptionController::class, 'showGallery']);
Route::GET('/d3ti-admin/youtube', [ClientOptionController::class, 'showYoutube']);
Route::GET('/d3ti-admin/youtube/sync', [ClientOptionController::class, 'syncYoutube']);
Route::PUT('/d3ti-admin/youtube/edit_show', [ClientOptionController::class, 'editShowYoutube']);



/*----------------------------------------------*/


//User

//Homepage
Route::GET('/', function () {
    return view('user.layout');
});

//Client Article Controller
Route::GET('/', [ClientArticleController::class, 'showPostHomepage']);
Route::GET('/{post_url}/{post_link}', [ClientArticleController::class, 'showPostArticle']);
Route::GET('/p/category/{post_category}', [ClientArticleController::class, 'showPostCategory']);
Route::POST('/p/comment/add_comment/process', [ClientArticleController::class, 'createPostCommentProcess']);
Route::GET('/e/event/{event_link}', [ClientArticleController::class, 'showEventArticle']);
Route::GET('/e/category/event', [ClientArticleController::class, 'showAllEvent']);
Route::POST('/e/comment/add_comment/process', [ClientArticleController::class, 'createEventCommentProcess']);
Route::GET('/pr/category/{product_category}', [ClientArticleController::class, 'showProductCategory']);
Route::GET('/pr/{product_url}/{product_link}', [ClientArticleController::class, 'showProductArticle']);
Route::POST('/pr/comment/add_comment/process', [ClientArticleController::class, 'createProductCommentProcess']);
Route::GET('/search', [ClientArticleController::class, 'searchArticle']);
Route::GET('/dosen', [ClientArticleController::class, 'showListDosen']);


//Profil
Route::GET('/tentang', function () {
    return view('user.profil.about');
});

//Akademik
Route::GET('/kalender-akademik', function () {
    return view('user.akademik.kalenderakademik');
});
Route::GET('/kurikulum', function () {
    return view('user.akademik.kurikulum');
});
Route::GET('/tugas-akhir', function () {
    return view('user.akademik.tugasakhir');
});
Route::GET('/fasilitas', function () {
    return view('user.akademik.fasilitas');
});
Route::GET('/pusat-layanan-terpadu', function () {
    return view('user.akademik.pusatlayananterpadu');
});

//Mahasiswa
Route::GET('/prestasi-mahasiswa', function () {
    return view('user.mahasiswa.prestasi');
});
Route::GET('/emailkomp', function () {
    return view('user.mahasiswa.emailkomp');
});

//Calon Mahasiswa
Route::GET('/prospek', function () {
    return view('user.calonmahasiswa.prospek');
});

//Alumni
Route::GET('/forum-alumni', function () {
    return view('user.alumni.forum');
});
Route::GET('/tracer-alumni', function () {
    return view('user.alumni.tracer');
});

//Penelitian
Route::GET('/penelitian-penelitian', function () {
    return view('user.penelitian.penelitian');
});

Route::GET('/penelitian-pengabdian', function () {
    return view('user.penelitian.pengabdian');
});

Route::GET('/penelitian-produk', function () {
    return view('user.penelitian.produk');
});

Route::GET('/penelitian-jurnal', function () {
    return view('user.penelitian.jurnal');
});

Route::GET('/penelitian-bukuajar', function () {
    return view('user.penelitian.bukuajar');
});

//Kontak
Route::GET('/contact', function () {
    return view('user.profil.contact');
});