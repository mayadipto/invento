<?php

namespace App\Http\Controllers;

use App\Http\Requests\Expense\ExpenseInvoiceRequest;
use App\Http\Resources\Expense\ExpenseInvoiceCollectionResource;
use App\Http\Resources\Expense\ExpenseInvoiceResource;
use App\Models\Expense;
use App\Models\ExpenseInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ExpenseInvoiceCollectionResource::collection(ExpenseInvoice::orderBy('created_at', 'desc')->paginate(50));
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
    public function store(ExpenseInvoiceRequest $request)
    {
        DB::beginTransaction();
        try{
            $expense_invoice = new ExpenseInvoice();
            $total_amount = 0;

            foreach ($request->expense_items as $expense) {
                $total_amount += $expense['amount'];
            }
            $last_invoice = ExpenseInvoice::orderBy('created_at', 'desc')->first();
            if($last_invoice) {
                $code = $last_invoice->code;
                preg_match('/\d+/', $code, $code);
                $code = 'expense-'. ($code[0]+1);
            }
            else{
                $code = 'expense-1000000';
            }
            $expense_invoice->code = $code;
            $expense_invoice->total_amount = $total_amount;
            $expense_invoice->expense_by = $request->expense_by['id'];
            $expense_invoice->save();
            $urls = [];
            foreach ($request->urls as $url) {
                $url['expense_invoice_id']= $expense_invoice->id;
                $urls[] = $url;
            }
            DB::table('expense_files')->insert($urls);
            foreach ($request->expense_items as $expense) {
                $expense_obj = new Expense($expense);
                $expense_obj->expense_invoice_id = $expense_invoice->id;
                $expense_obj->save();
            }
            DB::commit();
            return response()->json(['status'=> true], 201);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['status'=>false, 'error'=> $e], 406);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpenseInvoice  $expenseInvoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expenseInvoice = ExpenseInvoice::find($id);
        return new ExpenseInvoiceResource($expenseInvoice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpenseInvoice  $expenseInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseInvoice $expenseInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpenseInvoice  $expenseInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpenseInvoice $expenseInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpenseInvoice  $expenseInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseInvoice $expenseInvoice)
    {
        //
    }
}
