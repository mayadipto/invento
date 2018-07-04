<?php

namespace App\Http\Controllers;

use App\Http\Requests\Purchase\PurchaseInvoiceRequest;
use App\Http\Resources\Purchases\PurchaseInvoiceCollectionResource;
use App\Http\Resources\Purchases\PurchaseInvoiceResource;
use App\Http\Resources\Purchases\PurchaseInvoiceResourceonRe;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\PurchaseFile;
use App\Models\PurchaseInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseInvoiceController extends Controller
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
        $purchases = PurchaseInvoice::orderBy('created_at', 'desc')->paginate(15);
        return PurchaseInvoiceCollectionResource::collection($purchases);
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
    public function store(PurchaseInvoiceRequest $request)
    {
       DB::beginTransaction();
       try{
           // Save Invoice
           $invoice = new PurchaseInvoice;
           $invoice->code = $request->code;
           $invoice->supplier_id = $request->supplier['id'];
           $invoice->purchased_by = 1; // Must be changed on production
           $total = 0;
           foreach ($request->items as $item){
               $total += $item['item']['quantity'] * $item['item']['purchase_price'];
           }
           $invoice->total_purchase_price = $total;
           $invoice->save();

           // Save Purchases
           foreach ($request->items as $purchaseItem){
               $newPurchaseItem = new Purchase;
               $newPurchaseItem->item_id = $purchaseItem['item']['id'];
               $newPurchaseItem->quantity = $purchaseItem['item']['quantity'];
               $newPurchaseItem->purchase_price = $purchaseItem['item']['purchase_price'];
               $newPurchaseItem->sell_price = $purchaseItem['item']['sell_price'];
               $newPurchaseItem->details = $purchaseItem['details'];

               $newPurchaseItem->purchase_invoice_id = $invoice->id;

               $newPurchaseItem->save();

               // Getting the item to be updated
               $oldItem = Item::find($newPurchaseItem->item_id);

               $t_price = (($oldItem->quantity*$oldItem->purchase_price)+
                   ($newPurchaseItem->quantity*$newPurchaseItem->purchase_price));
               $t_quantity = ($oldItem->quantity+$newPurchaseItem->quantity);

               // Updating sell purchase price and quantity
               $oldItem->purchase_price =  $t_price / $t_quantity;
               $oldItem->sell_price = ($newPurchaseItem->sell_price > 0)? $newPurchaseItem->sell_price : $oldItem->sell_price;
               $oldItem->quantity += $newPurchaseItem->quantity;
               $oldItem->update();
           }
           if($request->urls != null){
               foreach ($request->urls as $url) {
                   $newUrl = new PurchaseFile($url);
                   $newUrl->purchase_invoice_id = $invoice->id;
                   $newUrl->save();
               }
           }
           DB::commit();
       }catch (\Exception $e){
           DB::rollBack();
           return response([
               "status"=> false,
               "message"=> 'Purchase failed',
               "error" => $e
           ]);
       }
        return response([
            "status"=> true,
            "message"=> 'Purchase Successful...'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseInvoice  $purchaseInvoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new PurchaseInvoiceResource(PurchaseInvoice::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseInvoice  $purchaseInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseInvoice $purchaseInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseInvoice  $purchaseInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseInvoice $purchaseInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseInvoice  $purchaseInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseInvoice $purchaseInvoice)
    {
        //
    }
}
