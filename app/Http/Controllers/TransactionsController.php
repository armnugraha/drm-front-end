<?php

namespace App\Http\Controllers;

use PDF;
use App\Transaction;
use Illuminate\Http\Request;
use Validator;

class TransactionsController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $date = $request->get('date');

        $transactions = Transaction::orderBy('invoice_no', 'desc')
            ->where(function ($query) use ($q, $date) {
                if ($q) {
                    $query->where('invoice_no', 'like', '%'.$q.'%');
                    $query->orWhere('customer', 'like', '%'.$q.'%');
                }
                if ($date) {
                    $query->where('created_at', 'like', $date.'%');
                }
            })->paginate(25);

        return view('transactions.index', compact('transactions', 'date'));
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function receipt(Transaction $transaction)
    {
        return view('transactions.receipt', compact('transaction'));
    }

    public function pdf(Transaction $transaction)
    {
        // return view('transactions.pdf', compact('transaction'));
        $pdf = PDF::loadView('transactions.pdf', compact('transaction'));

        return $pdf->stream($transaction->invoice_no.'.faktur.pdf');
    }

    public function storeTransaction(Request $request)
    {
        $requestData = $request->all();

        $handle_validator = [
            'invoice' => 'unique:transactions'
        ];

        $validator = Validator::make($requestData, $handle_validator);

        if ($validator->fails()) {
            $response = [
                'status' => "Invoice sudah ada"
            ];

            return response()->json($response);
        }

        $requestData["items"] = json_decode($requestData["items"], TRUE);

        Transaction::create($requestData);

        $response = [
            'status' => "Ok"
        ];

        return response()->json($response);
    }

    public function getTransaction($invoice)
    {
        $data = Transaction::where("invoice", 'LIKE', '%'.$invoice.'%')->get();

        $response = [
            'data' => $data
        ];

        return response()->json($response);
    }
}