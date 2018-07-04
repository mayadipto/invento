<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sell\SellInvoiceRequest;
use App\Http\Resources\SellsResource\SellInvoiceCollectionResource;
use App\Http\Resources\SellsResource\SellInvoiceResource;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Sell;
use App\Models\SellInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class SellInvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt', ['except' => []]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = SellInvoice::orderBy('created_at', 'desc')->paginate(20);
        return SellInvoiceCollectionResource::collection($invoices);
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
    public function store(SellInvoiceRequest $request)
    {
        $user_id = 1;
        $code = $request->code;
        $customer = $request->customer;
        $vat = $request->vat;
        DB::beginTransaction();
        try{
            if($customer['id'] == null){
                $customer = new Customer($customer);
                $customer_code = Customer::orderBy('created_at', 'desc')->first()->code;
                preg_match('/[0-9]+/', $customer_code,$customer_code);
                $customer->code = 'cus-'.($customer_code[0]+1);
                $customer->save();
                $customer_id = $customer->id;
            }else{
                $customer_id = $customer['id'];
            }
            $total_purchase_price = 0;
            $total_sell_price = 0;
            $sell_items = [];
            for ($i=0; $i<count($request->sell_items); $i++) {
                $sell_item = new Sell();
                $item_id = $request->sell_items[$i]['item']['id'];
                $quantity = $request->sell_items[$i]['item']['quantity'];
                $sell_price = $request->sell_items[$i]['item']['sell_price'];
                $discount = $request->sell_items[$i]['discount'];
                $details = $request->sell_items[$i]['details'];
                $item = Item::find($item_id);
                if($quantity> $item->quantity){
                    throw new \Exception('Item not available');
                }
                $item->quantity -= $quantity;
                $pp = $item->purchase_price * $quantity;
                $total_purchase_price += $pp;
                $sp = ($sell_price * $quantity);
                $total_sell_price += ($sp - (($sp*$discount)/100));
                $sell_item->item_id = $item_id;
                $sell_item->quantity = $quantity;
                $sell_item->purchase_price = $item->purchase_price;
                $sell_item->sell_price = $sell_price;
                $sell_item->discount = $discount;
                $sell_item->details = $details;
                $sell_items[] = $sell_item;
                $item->update();
                //Save $item here
            }
            $sell_invoice = new SellInvoice();
            $sell_invoice->code = $code;
            $sell_invoice->sell_by = $user_id;
            $sell_invoice->customer_id = $customer_id;
            $sell_invoice->total_purchase_price = $total_purchase_price;
            $sell_invoice->total_sell_price = $total_sell_price;
            $sell_invoice->vat = $vat;
            $sell_invoice->vat_amount = ($total_sell_price*$vat)/100;
            $sell_invoice->save();

//            return $sell_invoice;

            foreach ($sell_items as $sell){
                $sell->sell_invoice_id = $sell_invoice->id;
                $sell->save();
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            return $e;
        }
        return Response([
            'status' => true,
            'message'=> 'Items sold successfully...',
            'invoice_id'=> $sell_invoice->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SellInvoice  $sellInvoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = SellInvoice::find($id);
        return new SellInvoiceResource($invoice);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SellInvoice  $sellInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(SellInvoice $sellInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SellInvoice  $sellInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SellInvoice $sellInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SellInvoice  $sellInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(SellInvoice $sellInvoice)
    {
        //
    }
}
