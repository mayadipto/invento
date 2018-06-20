<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Http\Resources\Purchases\PurchaseCollectionResource;
use App\Http\Resources\Purchases\PurchaseResource;
use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return Purchase::all();
        return PurchaseCollectionResource::collection(Purchase::paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequest $request)
    {
        // Setting up new item purchase price and sells price
        DB::beginTransaction();
        try {
            $purchase = new Purchase($request->all());
            $item = Item::find($request->item_id);
            $total_purchase_price = $purchase->purchase_price * $purchase->quantity;
            $total_current_price = $item->purchase_price * $item->quantity;
            $total_qty = $purchase->quantity + $item->quantity;
            $item->purchase_price = ($total_purchase_price + $total_current_price) / $total_qty;
            $item->sell_price = ($request->sell_price != null && $request->sell_price != 0) ?
                $request->sell_price : $item->sell_price;
            $item->quantity = $total_qty;
            $purchase->save();
            $item->update();
            DB::commit();

        }catch (\Exception $exception){
            DB::rollBack();
        }
        if(isset($exception)){
            DB::rollBack();
            return response([
                'status'=> false,
                'message'=> 'Purchase failed...'
            ], Response::HTTP_NOT_MODIFIED);
        }
        return response([
            'status'=> true,
            'message'=> 'Purchase completed...'
        ], Response::HTTP_OK);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        return new PurchaseResource($purchase);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {

        $item = Item::find($purchase->item_id);
        if($item->quantity - $purchase->quantity + $request->quantity < 0){
            return response([
                'status'=> false,
                'message'=> 'Not enough item available to reduce'
            ], Response::HTTP_NOT_MODIFIED);
        }
        DB::beginTransaction();
        try{
            $total_purchase_price = $purchase->purchase_price * $purchase->quantity;
            $total_current_price = $item->purchase_price * $item->quantity;
            $total_new_request_price = $request->purchase_price * $request->quantity;
            $total_new_purchase_price = $total_current_price-$total_purchase_price+$total_new_request_price;
            $total_new_quantity = $item->quantity - $purchase->quantity + $request->quantity;
            $item->purchase_price = ($total_new_quantity != 0) ? $total_new_purchase_price/$total_new_quantity: 0;
            $item->sell_price = $request->sell_price;
            $item->quantity = $total_new_quantity;
            $purchase->purchase_price = $request->purchase_price;
            $purchase->sell_price = $request->sell_price;
            $purchase->quantity = $request->quantity;
            $purchase->details = ($purchase->details != null) ? $purchase->details : $purchase->details;
            $purchase->save();
            $item->update();
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
        }

        if(isset($exception)){
            return response([
                'status'=> false,
                'message'=> 'Purchase failed...'
            ], Response::HTTP_NOT_MODIFIED);
        }
        return response([
            'status'=> true,
            'message'=> 'Purchase updated...'
        ], Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        $item = Item::find($purchase->item_id);
        $pre_item_quantity = $item->quantity;
        $item->quantity = $item->quantity - $purchase->quantity;
        if($item->quantity < 0){
            return response([
                'status'=> false,
                'message'=> 'Purchase not deleted...'
            ], Response::HTTP_NOT_MODIFIED);
        }
        $total_item_price = $item->purchase_price * $pre_item_quantity;
        $total_purchase_price = $purchase->purchase_price * $purchase->quantity;
        $item->purchase_price = ($total_item_price - $total_purchase_price)/ $item->quantity;
        DB::beginTransaction();
        try{
            $purchase->delete();
            $item->update();
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
        }
        if(isset($exception)){
            return response([
                'status'=> false,
                'message'=> 'Purchase not deleted...'
            ], Response::HTTP_NOT_MODIFIED);
        }
        return response([
            'status'=> true,
            'message'=> 'Purchase deleted successfully...'
        ], Response::HTTP_OK);

    }
}
