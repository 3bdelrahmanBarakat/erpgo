<?php

namespace App\Http\Controllers;

use App\Http\Mapper\BankMapper;
use App\Models\BankAccount;
use App\Models\BankTransfer;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use function MongoDB\BSON\toJSON;

class BankTransferController extends Controller
{

    public function index(Request $request)
    {

        if (Auth::user()->can('manage bank transfer')) {
            $account = BankAccount::query()->where('created_by', '=', Auth::id())->get()->pluck('holder_name', 'id');
            $account->prepend('Select Account', '');

            $query = BankTransfer::query()->where('created_by', '=', Auth::id());

            if (!empty($request->date)) {
                $date_range = explode('to', $request->date);
                $query->whereBetween('date', $date_range);
            }

            if (!empty($request->sender_id)) {
                $query->where('sender_id', '=', $request->sender_id);
            }
            if (!empty($request->receiver_id)) {
                $query->where('receiver_id', '=', $request->receiver_id);
            }
            $transfers = $query->get();

            return view('bank-transfer.index', compact('transfers', 'account'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if (Auth::user()->can('create bank transfer')) {
            $creditAccounts = BankAccount::query()
                ->leftJoin('bank_currencies', 'bank_currencies.id', '=', 'bank_accounts.currency_id')
                ->select('bank_accounts.*', DB::raw("CONCAT(bank_accounts.holder_name, ' (', bank_currencies.name, ')') AS name"))
                ->where('bank_accounts.created_by', Auth::id())
                ->get()
                ->pluck('name', 'id');
            $debitAccounts = BankAccount::query()
                ->leftJoin('bank_currencies', 'bank_currencies.id', '=', 'bank_accounts.currency_id')
                ->select('bank_accounts.*', DB::raw("CONCAT(bank_accounts.holder_name, ' (', bank_currencies.name, ')') AS name"))
                ->get()
                ->pluck('name', 'id');

            return view('bank-transfer.create', compact('creditAccounts', 'debitAccounts'));
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }


    public function store(Request $request)
    {
        if (Auth::user()->can('create bank transfer')) {
            $validator = Validator::make(
                $request->all(), [
                    'sender_id' => 'required|numeric',
                    'receiver_id' => 'required|numeric',
                    'debit_amount' => 'required|numeric',
                    'credit_amount' => 'required|numeric',
                    'date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $transfer = new BankTransfer();
            $transfer->sender_id = $request->sender_id;
            $transfer->receiver_id = $request->receiver_id;
            $transfer->debit_amount = $request->debit_amount;
            $transfer->credit_amount = $request->credit_amount;
            $transfer->date = $request->date;
            $transfer->payment_method = 0;
            $transfer->reference = $request->reference;
            $transfer->description = $request->description;
            $transfer->created_by = Auth::id();

            if (Utility::bankAccountBalance($request->sender_id, $request->debit_amount, 'debit')) {
                $transfer->rate = $request->credit_amount / $request->debit_amount;
                Utility::bankAccountBalance($request->receiver_id, $request->credit_amount, 'credit');
                $transfer->save();
            } else {
                return redirect()->back()->with('error', __('Insufficient Balance '));

            }


            return redirect()->route('bank-transfer.index')->with('success', __('Amount successfully transfer.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

//    public function edit(BankTransfer $transfer, $id)
//    {
//        if (\Auth::user()->can('edit bank transfer')) {
//            $transfer = BankTransfer::where('id', $id)->first();
//            $bankAccount = BankAccount::select('*', \DB::raw("CONCAT(bank_name,' ',holder_name) AS name"))->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
//
//            return view('bank-transfer.edit', compact('bankAccount', 'transfer'));
//        } else {
//            return response()->json(['error' => __('Permission denied.')], 401);
//        }
//    }
//
//    public function update(Request $request, BankTransfer $transfer, $id)
//    {
//        if (\Auth::user()->can('edit bank transfer')) {
//            $transfer = BankTransfer::find($id);
//            $validator = \Validator::make(
//                $request->all(), [
//                    'from_account' => 'required|numeric',
//                    'to_account' => 'required|numeric',
//                    'amount' => 'required|numeric',
//                    'date' => 'required',
//                ]
//            );
//            if ($validator->fails()) {
//                $messages = $validator->getMessageBag();
//
//                return redirect()->back()->with('error', $messages->first());
//            }
//
//            Utility::bankAccountBalance($transfer->from_account, $transfer->amount, 'credit');
//            Utility::bankAccountBalance($transfer->to_account, $transfer->amount, 'debit');
//
//            $transfer->from_account = $request->from_account;
//            $transfer->to_account = $request->to_account;
//            $transfer->amount = $request->amount;
//            $transfer->date = $request->date;
//            $transfer->payment_method = 0;
//            $transfer->reference = $request->reference;
//            $transfer->description = $request->description;
//            $transfer->save();
//
//
//            Utility::bankAccountBalance($request->from_account, $request->amount, 'debit');
//            Utility::bankAccountBalance($request->to_account, $request->amount, 'credit');
//
//            return redirect()->route('bank-transfer.index')->with('success', __('Amount successfully transfer updated.'));
//        } else {
//            return redirect()->back()->with('error', __('Permission denied.'));
//        }
//    }
//
//
//    public function destroy(BankTransfer $transfer)
//    {
//
//        if (\Auth::user()->can('delete bank transfer')) {
//            if ($transfer->created_by == \Auth::user()->creatorId()) {
//                $transfer->delete();
//
//                Utility::bankAccountBalance($transfer->from_account, $transfer->amount, 'credit');
//                Utility::bankAccountBalance($transfer->to_account, $transfer->amount, 'debit');
//
//                return redirect()->route('bank-transfer.index')->with('success', __('Amount transfer successfully deleted.'));
//            } else {
//                return redirect()->back()->with('error', __('Permission denied.'));
//            }
//        } else {
//            return redirect()->back()->with('error', __('Permission denied.'));
//        }
//    }
}
