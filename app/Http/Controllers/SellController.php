<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellRequest;
use App\Http\Resources\SellsResource\SellCollectionResource;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sell = Sell::orderBy('created_at', 'desc')->get();
        return SellCollectionResource::collection($sell);
//        return $sell;
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
    public function store(SellRequest $request)
    {
        $sell = new Sell($request->all());
        return $sell;
//        DB::beginTransaction();
//        try{
//            $item = Item::find($request->item_id);
//            if($request->quantity > $item->quantity){
//                return response([
//                    'status'=> false,
//                    'message'=> 'Purchase not deleted...'
//                ]);
//            }
//            $sell = new Sell();
//            $sell->code = $request->code;
//            if($request->customer_id == null){
//                $customer = new Customer();
//                $customer->name = $request->customer_name;
//                $customer->code = $request->customer_code;
//                $customer->contact_no = $request->customer_contact_no;
//                $customer->save();
//                $sell->customer_id = $customer->id;
//            }else{
//                $sell->customer_id = $request->customer_id;
//            }
//            $sell->item_id = $request->item_id;
//            $sell->sell_by = $request->sell_by;
//            $sell->quantity = $request->quantity;
//            $sell->sell_price = $request->sell_price;
//            $sell->discount = $request->discount;
//            $sell->purchase_price = $item->purchase_price;
//            $sell->sell_price = $request->sell_price;
//            $total = $request->discount*($request->sell_price*$request->quantity);
//            $sell->total = $total*$request->vat/100.00 + $total;
//
//            $item->quantity -= $sell->quantity;
//            $sell->save();
//            $item->update();
//            DB::commit();
//        }catch (\Exception $e){
//            DB::rollBack();
//            return response([
//                'status'=> false,
//                'message'=> 'Sell operation failed'
//            ]);
//        }
//        return $sell;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function show(Sell $sell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function edit(Sell $sell)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sell $sell)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sell $sell)
    {
        DB::beginTransaction();
        try{
            $item = Item::find($sell->item_id);
            $item->quantity = $item->quantity + $sell->quantity;
            $item->update();
            $sell->delete();
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            return response([
                'status'=> false,
                'message'=> 'Sell not deleted'
            ]);
        }
        return response([
            'status'=> true,
            'message'=> 'Sell deleted successfully...'
        ]);
    }
}
