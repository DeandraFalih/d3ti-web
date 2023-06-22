<?php

function getUserPermissions($userRole) {
    $permissions = DB::table('d3ti_role_permission')
        ->join('d3ti_role', 'd3ti_role.role_id', '=', 'd3ti_role_permission.role_id')
        ->where('d3ti_role.role_id', '=', $userRole)
        ->select('d3ti_role_permission.role_permission_name', 'd3ti_role_permission.role_permission_is_granted')
        ->get();
    return $permissions;
}

function getUsersPermissions($userRole, $permissionNames) {
    $permissions = DB::table('d3ti_role_permission')
        ->join('d3ti_role', 'd3ti_role.role_id', '=', 'd3ti_role_permission.role_id')
        ->where('d3ti_role.role_id', '=', $userRole)
        ->whereIn('d3ti_role_permission.role_permission_name', $permissionNames)
        ->select('d3ti_role_permission.role_permission_name', 'd3ti_role_permission.role_permission_is_granted')
        ->get();
    return $permissions;
}




//Post
function getPostCategories($postId) {
    $categories = DB::table('d3ti_post_categories')
        ->join('d3ti_post_categories_link', 'd3ti_post_categories_link.post_categories_id', '=', 'd3ti_post_categories.post_categories_id')
        ->where('d3ti_post_categories_link.post_id', $postId)
        ->select('d3ti_post_categories.post_categories_name')
        ->get()
        ->pluck('post_categories_name')
        ->implode(', ');
    return $categories;
}

function getFirstPostCategory($postId) {
    $categories = DB::table('d3ti_post_categories')
        ->join('d3ti_post_categories_link', 'd3ti_post_categories_link.post_categories_id', '=', 'd3ti_post_categories.post_categories_id')
        ->where('d3ti_post_categories_link.post_id', $postId)
        ->select('d3ti_post_categories.post_categories_name', 'd3ti_post_categories.post_categories_url')
        ->first();

        return $categories;
}

function getPostTags($postId) {
    $tags = DB::table('d3ti_tags')
        ->join('d3ti_post_tags_link', 'd3ti_post_tags_link.tags_id', '=', 'd3ti_tags.tags_id')
        ->where('d3ti_post_tags_link.post_id', $postId)
        ->select('d3ti_tags.tags_name')
        ->get()
        ->pluck('tags_name')
        ->implode(', ');
    return $tags;
}

function getSelectedCategories($postId) {
    $selectedCategories = DB::table('d3ti_post_categories')
        ->join('d3ti_post_categories_link', 'd3ti_post_categories_link.post_categories_id', '=', 'd3ti_post_categories.post_categories_id')
        ->where('d3ti_post_categories_link.post_id', $postId)
        ->select('d3ti_post_categories.post_categories_name', 'd3ti_post_categories.post_categories_id')
        ->get();

    return $selectedCategories;
}

function getSelectedPostUrl($postId) {
    $selectedCategories = DB::table('d3ti_post_categories')
        ->join('d3ti_post_categories_link', 'd3ti_post_categories_link.post_categories_id', '=', 'd3ti_post_categories.post_categories_id')
        ->where('d3ti_post_categories_link.post_id', $postId)
        ->select('d3ti_post_categories.post_categories_url', 'd3ti_post_categories.post_categories_id')
        ->get();

    return $selectedCategories;
}

function getNonSelectedCategories($postId) {
    $nonSelectedCategories = DB::table('d3ti_post_categories')
        ->leftJoin('d3ti_post_categories_link', function($join) use ($postId) {
            $join->on('d3ti_post_categories_link.post_categories_id', '=', 'd3ti_post_categories.post_categories_id')
                 ->where('d3ti_post_categories_link.post_id', '=', $postId);
        })
        ->whereNull('d3ti_post_categories_link.post_id')
        ->select('d3ti_post_categories.post_categories_name', 'd3ti_post_categories.post_categories_id')
        ->get();

    return $nonSelectedCategories;
}

function getSelectedTags($postId) {
    $selectedTags = DB::table('d3ti_tags')
        ->join('d3ti_post_tags_link', 'd3ti_post_tags_link.tags_id', '=', 'd3ti_tags.tags_id')
        ->where('d3ti_post_tags_link.post_id', $postId)
        ->select('d3ti_tags.tags_name', 'd3ti_tags.tags_id')
        ->get();

    return $selectedTags;
}

function getNonSelectedTags($postId) {
    $nonSelectedTags = DB::table('d3ti_tags')
        ->leftJoin('d3ti_post_tags_link', function($join) use ($postId) {
            $join->on('d3ti_tags.tags_id', '=', 'd3ti_post_tags_link.tags_id')
                 ->where('d3ti_post_tags_link.post_id', '=', $postId);
        })
        ->whereNull('d3ti_post_tags_link.post_id')
        ->select('d3ti_tags.tags_name', 'd3ti_tags.tags_id')
        ->get();

    return $nonSelectedTags;
}

function countAllPost()
{
    return DB::table('d3ti_post')
        ->where('post_status', '!=', 'Trash')
        ->count();
}

function countUserPost($userName) {
    $count = DB::table('d3ti_post')
        ->where('post_author', '=', $userName)
        ->where('post_status', '!=', 'Trash')
        ->count();
    return $count;
}

function countUserPostView($userName) {
    $count = DB::table('d3ti_post')
        ->where('post_author', '=', $userName)
        ->where('post_status', '!=', 'Trash')
        ->sum('post_view');
    return $count;
}

function countPostByStatus($status) {
    $count = DB::table('d3ti_post')
        ->where('post_status', '=', $status)
        ->count();
    return $count;
}





//Event
function getSelectedEventTags($eventId) {
    $selectedTags = DB::table('d3ti_tags')
        ->join('d3ti_event_tags_link', 'd3ti_event_tags_link.tags_id', '=', 'd3ti_tags.tags_id')
        ->where('d3ti_event_tags_link.event_id', $eventId)
        ->select('d3ti_tags.tags_name', 'd3ti_tags.tags_id')
        ->get();

    return $selectedTags;
}

function getNonSelectedEventTags($eventId) {
    $nonSelectedTags = DB::table('d3ti_tags')
        ->leftJoin('d3ti_event_tags_link', function($join) use ($eventId) {
            $join->on('d3ti_tags.tags_id', '=', 'd3ti_event_tags_link.tags_id')
                 ->where('d3ti_event_tags_link.event_id', '=', $eventId);
        })
        ->whereNull('d3ti_event_tags_link.event_id')
        ->select('d3ti_tags.tags_name', 'd3ti_tags.tags_id')
        ->get();

    return $nonSelectedTags;
}

function getEventTags($eventId) {
    $tags = DB::table('d3ti_tags')
        ->join('d3ti_event_tags_link', 'd3ti_event_tags_link.tags_id', '=', 'd3ti_tags.tags_id')
        ->where('d3ti_event_tags_link.event_id', $eventId)
        ->select('d3ti_tags.tags_name')
        ->get()
        ->pluck('tags_name')
        ->implode(', ');
    return $tags;
}

function countAllEvent()
{
    return DB::table('d3ti_event')
        ->where('event_status', '!=', 'Trash')
        ->count();
}

function countUserEvent($userName) {
    $count = DB::table('d3ti_event')
        ->where('event_author', '=', $userName)
        ->where('event_status', '!=', 'Trash')
        ->count();
    return $count;
}

function countEventByStatus($status) {
    $count = DB::table('d3ti_event')
        ->where('event_status', '=', $status)
        ->count();
    return $count;
}



//Product
function getProductCategories($productId) {
    $categories = DB::table('d3ti_product_categories')
        ->join('d3ti_product_categories_link', 'd3ti_product_categories_link.product_categories_id', '=', 'd3ti_product_categories.product_categories_id')
        ->where('d3ti_product_categories_link.product_id', $productId)
        ->select('d3ti_product_categories.product_categories_name')
        ->get()
        ->pluck('product_categories_name')
        ->implode(', ');
    return $categories;
}

function getProductTags($productId) {
    $tags = DB::table('d3ti_tags')
        ->join('d3ti_product_tags_link', 'd3ti_product_tags_link.tags_id', '=', 'd3ti_tags.tags_id')
        ->where('d3ti_product_tags_link.product_id', $productId)
        ->select('d3ti_tags.tags_name')
        ->get()
        ->pluck('tags_name')
        ->implode(', ');
    return $tags;
}

function getSelectedProductCategories($productId) {
    $selectedCategories = DB::table('d3ti_product_categories')
        ->join('d3ti_product_categories_link', 'd3ti_product_categories_link.product_categories_id', '=', 'd3ti_product_categories.product_categories_id')
        ->where('d3ti_product_categories_link.product_id', $productId)
        ->select('d3ti_product_categories.product_categories_name', 'd3ti_product_categories.product_categories_id')
        ->get();

    return $selectedCategories;
}

function getNonSelectedProductCategories($productId) {
    $nonSelectedCategories = DB::table('d3ti_product_categories')
        ->leftJoin('d3ti_product_categories_link', function($join) use ($productId) {
            $join->on('d3ti_product_categories_link.product_categories_id', '=', 'd3ti_product_categories.product_categories_id')
                 ->where('d3ti_product_categories_link.product_id', '=', $productId);
        })
        ->whereNull('d3ti_product_categories_link.product_id')
        ->select('d3ti_product_categories.product_categories_name', 'd3ti_product_categories.product_categories_id')
        ->get();

    return $nonSelectedCategories;
}

function getSelectedProductTags($productId) {
    $selectedTags = DB::table('d3ti_tags')
        ->join('d3ti_product_tags_link', 'd3ti_product_tags_link.tags_id', '=', 'd3ti_tags.tags_id')
        ->where('d3ti_product_tags_link.product_id', $productId)
        ->select('d3ti_tags.tags_name', 'd3ti_tags.tags_id')
        ->get();

    return $selectedTags;
}

function getNonSelectedProductTags($productId) {
    $nonSelectedTags = DB::table('d3ti_tags')
        ->leftJoin('d3ti_product_tags_link', function($join) use ($productId) {
            $join->on('d3ti_tags.tags_id', '=', 'd3ti_product_tags_link.tags_id')
                 ->where('d3ti_product_tags_link.product_id', '=', $productId);
        })
        ->whereNull('d3ti_product_tags_link.product_id')
        ->select('d3ti_tags.tags_name', 'd3ti_tags.tags_id')
        ->get();

    return $nonSelectedTags;
}

function countAllProduct()
{
    return DB::table('d3ti_product')
        ->where('product_status', '!=', 'Trash')
        ->count();
}

function countUserProduct($userName) {
    $count = DB::table('d3ti_product')
        ->where('product_author', '=', $userName)
        ->where('product_status', '!=', 'Trash')
        ->count();
    return $count;
}

function countProductByStatus($status) {
    $count = DB::table('d3ti_product')
        ->where('product_status', '=', $status)
        ->count();
    return $count;
}



//Comment
function getPostComment($postId) {
    $postComment = DB::table('d3ti_post_comment')
        ->where('post_id', $postId)
        ->where('post_comment_status', 'Approved')
        ->get();

    return $postComment;
}

function getEventComment($eventId) {
    $eventComment = DB::table('d3ti_event_comment')
        ->where('event_id', $eventId)
        ->where('event_comment_status', 'Approved')
        ->get();

    return $eventComment;
}

function getProductComment($productId) {
    $productComment = DB::table('d3ti_product_comment')
        ->where('product_id', $productId)
        ->where('product_comment_status', 'Approved')
        ->get();

    return $productComment;
}

function countPostComment($postId) {
    $countPostComment = DB::table('d3ti_post_comment')
        ->where('post_id', $postId)
        ->where('post_comment_status', 'Approved')
        ->count();

    return $countPostComment;
}

function countEventComment($eventId) {
    $countEventComment = DB::table('d3ti_event_comment')
        ->where('event_id', $eventId)
        ->where('event_comment_status', 'Approved')
        ->count();

    return $countEventComment;
}

function countProductComment($productId) {
    $countProductComment = DB::table('d3ti_product_comment')
        ->where('product_id', $productId)
        ->where('product_comment_status', 'Approved')
        ->count();

    return $countProductComment;
}

function countAllComment() {
    $countAllPostComment = DB::table('d3ti_post_comment')->count();
    $countAllEventComment = DB::table('d3ti_event_comment')->count();
    $countAllProductComment = DB::table('d3ti_product_comment')->count();

    return [
        'post' => $countAllPostComment,
        'event' => $countAllEventComment,
        'product' => $countAllProductComment,
    ];
}

function countTotalComment() {
    $countAllPostComment = DB::table('d3ti_post_comment')->count();
    $countAllEventComment = DB::table('d3ti_event_comment')->count();
    $countAllProductComment = DB::table('d3ti_product_comment')->count();
  
    $totalComments = $countAllPostComment + $countAllEventComment + $countAllProductComment;

    return $totalComments;
}

function countSeparatePendingComment() {
    $countPendingProductComment = DB::table('d3ti_product_comment')
        ->where('product_comment_status', 'Pending')
        ->count();

    $countPendingEventComment = DB::table('d3ti_event_comment')
        ->where('event_comment_status', 'Pending')
        ->count();

    $countPendingPostComment = DB::table('d3ti_post_comment')
        ->where('post_comment_status', 'Pending')
        ->count();

    return [
        'product' => $countPendingProductComment,
        'event' => $countPendingEventComment,
        'post' => $countPendingPostComment,
    ];
}

function countPendingComment() {
    $countPendingProductComment = DB::table('d3ti_product_comment')
        ->where('product_comment_status', 'Pending')
        ->count();

    $countPendingEventComment = DB::table('d3ti_event_comment')
        ->where('event_comment_status', 'Pending')
        ->count();

    $countPendingPostComment = DB::table('d3ti_post_comment')
        ->where('post_comment_status', 'Pending')
        ->count();

    $totalPendingComments = $countPendingProductComment + $countPendingEventComment + $countPendingPostComment;

    return $totalPendingComments;
}

//Role
function getUserRole($userRole){
    $role_name = DB::table('d3ti_role')
        ->where('role_id', $userRole)
        ->value('role_name');

    return $role_name;
}

function getNonUserRole($userRole){
    $role_name = DB::table('d3ti_role')
        ->where('role_id', '!=', $userRole)
        ->where('role_name', '!=', 'Superadmin')
        ->get();

    return $role_name;
}
