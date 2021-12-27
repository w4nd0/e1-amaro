<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;

class ProductController extends Controller
{
    private $product;
    private $tag;

    public function __construct(Product $product, Tag $tag)
    {
        $this->product = $product;
        $this->tag = $tag;
        $this->middleware('request.information')->only('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = $request->product;
        $tag = $request->tag;

        if ($product) {
            $query = $this->product->where([
                ['name', 'like', '%' . $product . '%']
            ])->get();
        } elseif ($tag) {
            $resultQuery = $this->tag->where([
                ['name', $tag]
            ])->with(['products' => function ($q) {
                $q->select('product_id', 'name');
            }])->get()->first();

            $query = collect($resultQuery['products'])->unique();
        } else {
            return $this->product->all()->toJson();
        }

        return $query->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $array = $request->products;
        // $products = reset($array);

        foreach ($request->products as $product) {
            // dd($product['name']);

            $newProduct = $this->product->create(array('id' => $product['id'], 'name' => $product['name']));

            if ($request->file->extension() == 'xml') {
                $tags = reset($product['tags']);
            } else {
                $tags = $product['tags'];
            }
            // dd($tags);
            foreach ($tags as $tag) {
                $newTag = $this->tag->firstOrCreate(array('name' => $tag));
                $newProduct->tags()->attach($newTag['id']);
            }
        }
        //     // $array = $product['tags'];
        //     // $tags = reset($array);
        //     // dd($product['tags'][0]);
        //         dd($tag);

        //     }
        // }
        return response()->json(array('bom' => 'legal'), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product->with('tags')->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
