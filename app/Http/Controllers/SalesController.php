<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\fileExists;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            "createSale",
            "publicSale",
            "removeSale",
            "updateSale",
        ]);
    }

    public function createSale(Request $request)
    {   
        $request->validate([
            "title" => ["required", "string"],
            "description" => ["required", "string"],
            "category_id" => ["required", "integer"],
            "price" => ["required"],
            "image" => ["required", "mimes:png,jpg,jpeg", "max:5000"]
        ]);

        $path = "/storage/" . $request->image->store("images", "public");

        Sale::create([
            "title" => $request->title,
            "description" => $request->description,
            "category_id" => $request->category_id,
            "price" => $request->price,
            "image" => $path,
            "user_id" => Auth::user()->id,
        ]);

        return redirect()->route("my-sales");
    }

    public function publicSale(Request $request)
    {
        $sale = Sale::find($request->id);

        if(!$sale)
        {
            return abort(404);
        }

        if($sale->user_id !== Auth::user()->id)
        {
            return redirect()->route("my-sales");
        }

        $sale->public = (int)$sale->public === 1 ? 0 : 1;

        $sale->save();

        return redirect()->back();
    }

    public function removeSale(Request $request)
    {
        $sale = Sale::find($request->id);

        if(!$sale)
        {
            return abort(404);
        }

        if($sale->user_id !== Auth::user()->id)
        {
            return redirect()->route("my-sales");
        }

        $image = public_path() . $sale->image;

        if(fileExists($image))
        {
            unlink($image);
        }

        $sale->delete();

        return redirect()->back();
    }

    public function updateSale(Request $request)
    {
        $sale = Sale::find($request->id);

        if(!$sale)
        {
            return abort(404);
        }

        if($sale->user_id !== Auth::user()->id)
        {
            return redirect()->route("my-sales");
        }

        $request->validate([
            "title" => ["string"],
            "description" => ["string"],
            "category_id" => ["integer"],
            "image" => ["mimes:png,jpg,jpeg", "max:5000"]
        ]);

        $sale->title = $request->title;
        $sale->description = $request->description;
        $sale->category_id = $request->category_id;
        $sale->price = $request->price;

        if($request->hasFile('image')) 
        {
            $image = public_path() . $sale->image;
            unlink($image);
            $path = "/storage/" . $request->image->store("images", "public");
            $sale->image = $path;
        }

        $sale->save();

        return redirect()->route("one-sale",$sale->id);
    }
}
