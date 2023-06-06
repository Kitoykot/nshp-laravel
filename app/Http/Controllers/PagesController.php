<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            "createSalePage",
            "mySalesPage",
            "updateSalePage",
        ]);
    }

    public function mainPage()
    {
        $sales = Sale::where('public', 1)->latest()->paginate(8);

        return view('welcome', [
            "sales" => $sales,
        ]);
    }

    public function createSalePage()
    {
        return view('create-sale', [
            "categories" => Category::all(),
        ]);
    }

    public function oneSalePage($id)
    {
        $sale = Sale::find($id);

        if(!$sale)
        {
            return abort(404);
        }

        if($sale->public !== 1)
        {
            return redirect()->route("my-sales");
        }

        return view('one-sale', [
            "sale" => $sale,
        ]);
    }

    public function mySalesPage()
    {
        $sales = Sale::where('user_id', Auth::user()->id)->get();

        return view('my-sales', [
            "sales" => $sales,
        ]);
    }

    public function updateSalePage($id)
    {
        $sale = Sale::find($id);

        if(!$sale)
        {
            return abort(404);
        }

        if($sale->user_id !== Auth::user()->id)
        {
            return redirect()->route("my-sales");
        }

        return view('update-sale', [
            "sale" => $sale,
            "categories" => Category::all(),
        ]);
    }

    public function search(Request $request)
    {
        $q = $request->q;

        $sales = Sale::where("public", 1)->where('title', 'LIKE', "%$q%")->get();

        return view("search", [
            "sales" => $sales
        ]);
    }
}
