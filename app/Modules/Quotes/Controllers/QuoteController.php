<?php

namespace App\Modules\Quotes\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Quotes\Models\Quote;
use App\Modules\Quotes\Requests\CreateQuoteRequest;
use App\Modules\Quotes\Services\QuoteService;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function createQuote(Request $request)
    {
        return (new QuoteService)->createQuote($request);
    }

    public function getQuote(Request $request)
    {
        if ($request->has('filter.status')) {
            $keyword = $request->input('filter.status');
            $quote = Quote::where(function ($query) use ($keyword) {
                $query->where('status', 'LIKE', "%$keyword%");
            })
            ->paginate(50);
            if ($quote->isEmpty()) {
                return response()->json(['status' => false]);
            }
            else{
                return response()->json([ 'quotes' => $quote], 200);
            }
        }
           
        return (new QuoteService)->getQuote();
    }

    public function UpdatePrice(Request $request, $reference_id)
    {
        return (new QuoteService)->UpdatePrice($request, $reference_id);
    }

    public function getSingleQuote(Request $request, $reference_id)
    {
        return (new QuoteService)->getSingleQuote($request, $reference_id);
    }

    
}
