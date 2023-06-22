<?php

namespace App\Http\Controllers\Admin\api\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategories;
use App\Models\ProductCategoriesLink;
use App\Models\Tags;
use App\Models\ProductTagsLink;
use App\Http\Resources\FormatPostResource;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * 
     * 
     * 
     * CMS
     * 
     * 
     * 
     **/
    

    /**
     * 
     * Product
     * 
     **/

    public function showProduct()
    {
        $data_product = Product::
        where('product_status', '!=', 'trash')
        ->get();

        return [
            'data_product' => $data_product,
        ];
    }

    public function showUserProduct($user_name)
    {
        $data_product = Product::
        where('product_author', $user_name)
        ->where('product_status', '!=', 'trash')
        ->get();

        return [
            'data_product' => $data_product,
        ];
    }

    public function showProductByStatus($status)
    {
        $data_product = Product::
        where('product_status', $status)
        ->get();

        return [
            'data_product' => $data_product,
        ];
    }

    public function createProductForm()
    {
        $data_product_categories=ProductCategories::all();
        $data_tags=Tags::all();

        return [
            'data_product_categories' => $data_product_categories,
            'data_tags' => $data_tags,
        ];
    }

    public function createProductProcess(Request $request)
    {
        $product = Product::create([
            'product_title' => $request->title,
            'product_featured_image' => $request->featured,
            'product_content' => $request->content,
            'product_excerpt' => $request->excerpt,
            'product_release_date' => $request->release_date,
            'product_owner' => $request->owner,
            'product_date' => $request->date,
            'product_author' => $request->author,
            'product_link' => $request->link,
            'product_meta' => $request->meta,
            'product_status' => $request->status,
        ]);

        $productId = $product->product_id;
        $categoryIds = $request->category;
        $tagsIds = $request->tags;

        //Create a new category record to database
        foreach ($categoryIds as $categoryId) {
            $link = new ProductCategoriesLink();
            $link->product_id = $productId;
            $link->product_categories_id = $categoryId;
            $link->save();
        }

        //Create a new tag record to database
        foreach ($tagsIds as $tagsId) {
            $link = new ProductTagsLink();
            $link->product_id = $productId;
            $link->tags_id = $tagsId;
            $link->save();
        }
    }

    public function editProductForm($product_id)
    {
        $data_product = Product::where('product_id', '=', $product_id)->get();
        $data_category = ProductCategories::all();
        $data_tags = Tags::all();

        return [
            'data_product' => $data_product,
            'data_category' => $data_category,
            'data_tags' => $data_tags,
        ];
    }

    public function editProductProcess(Request $request, $product_id)
    {
        $db_product = Product::findOrFail($product_id);

        $featured = $request->featured;

        $data = [
            'product_title' => $request->title,
            'product_content' => $request->content,
            'product_excerpt' => $request->excerpt,
            'product_release_date' => $request->release_date,
            'product_owner' => $request->owner,
            'product_date' => $request->date,
            'product_meta' => $request->meta,
            'product_status' => $request->status,
        ];

        //Check if there is value in the $featured. And if there is, it will update the featured image
        if ($featured != "") {
            $data['product_featured_image'] = $featured;
        }

        //Update the data
        $db_product->update($data);

        $categoryIds = $request->category;
        $tagsIds = $request->tags;

        //Remove current categories record on the database
        ProductCategoriesLink::where('product_id', $product_id)->delete();

        //Create a new category record to database
        foreach ($categoryIds as $categoryId) {
            $link = new ProductCategoriesLink();
            $link->product_id = $product_id;
            $link->product_categories_id = $categoryId;
            $link->save();
        }

        //Remove current tags record on the database
        ProductTagsLink::where('product_id', $product_id)->delete();

        //Create a new tag record to database
        foreach ($tagsIds as $tagsId) {
            $link = new ProductTagsLink();
            $link->product_id = $product_id;
            $link->tags_id = $tagsId;
            $link->save();
        }
    }

    public function deleteProduct($product_id)
    {
        $data_product = Product::findOrFail($product_id);
        $data_product->delete();
    }

    public function trashProduct($product_id)
    {
        $product = Product::findOrFail($product_id);
        $product->update([
            'product_status' => 'Trash',
        ]);
    }

    /**
     * 
     * Product Categories
     * 
     **/

    public function showProductCategories()
    {
        $data_product_categories=ProductCategories::all();

        return [
            'data_product_categories' => $data_product_categories,
        ];

    }

    public function createProductCategoriesProcess(Request $request)
    {
        $receive = ProductCategories::create([
            'product_categories_name' => $request->name,
            'product_categories_description' => $request->description,
            'product_categories_url' => $request->url,
        ]);
    }

    public function editProductCategoriesProcess(Request $request, $product_categories_id)
    {
        $data_product_categories = ProductCategories::findOrFail($product_categories_id);
      
        $data_product_categories->update([
            'product_categories_name' => $request->name,
            'product_categories_description' => $request->description,
            'product_categories_url' => $request->url,
        ]);
    }

    public function deleteProductCategories($product_categories_id)
    {
        $data_categories = ProductCategories::findOrFail($product_categories_id);
        $data_categories->delete();
    }





    /**
     * 
     * 
     * 
     * Frontend Website
     * 
     * 
     * 
     **/







    public function showHomepage()
    {
        $data_product=Product::limit(6)
        ->orderBy('product_id', 'desc')
        ->where('product_status', '=', "Published")
        ->get();

        return [
            'data_product' => $data_product,
        ];
    }

    public function showProductArticle($product_link)
    {
        $data_product=Product::
        where('product_link', '=', $product_link)
        ->get();

        return [
            'data_product' => $data_product,
        ];
    }
}
