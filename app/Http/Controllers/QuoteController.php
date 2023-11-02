<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuoteRequest;
use App\Http\Requests\UpdateQuoteRequest;
use App\Http\Resources\QuoteResorce;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return QuoteResorce::collection(Quote::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuoteRequest $request)
    {


            $quote = Quote::create($request->validated());
            return new QuoteResorce($quote);

    }

    /**
     * Display the specified resource.
     */
    public function show(Quote $quote)
    {
        return new QuoteResorce($quote);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuoteRequest $request, Quote $quote)
    {
          $quote->update($request->validated());
         return new QuoteResorce($quote);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quote $quote)
    {
        $quote->delete();
        return response()->noContent();
    }
}
