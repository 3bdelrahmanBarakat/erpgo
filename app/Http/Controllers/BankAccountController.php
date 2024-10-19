<?php

namespace App\Http\Controllers;

use App\Http\Mapper\BankMapper;
use App\Models\BankAccount;
use App\Models\BankCurrency;
use App\Models\BillPayment;
use App\Models\CustomField;
use App\Models\InvoicePayment;
use App\Models\Payment;
use App\Models\Revenue;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BankAccountController extends Controller
{

    public function index()
    {
        if (Auth::user()->can('create bank account')) {
            $accounts = BankAccount::query()
                ->where('created_by', Auth::id())
                ->orderBy('holder_name')
                ->get();
//            $accounts = BankMapper::map($accounts);
            return view('bankAccount.index', compact('accounts'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if (Auth::user()->can('create bank account')) {
            $customFields = CustomField::query()
                ->where('created_by', '=', Auth::user()->creatorId())
                ->where('module', '=', 'account')
                ->get();
            $currencies = BankCurrency::query()->get();
            return view('bankAccount.create', compact('customFields','currencies'));
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->can('create bank account')) {

            $validator = Validator::make(
                $request->all(), [
                    'holder_name' => 'required',
                    'bank_name' => 'required',
                    'currency_id' => 'required|not_in:0',
                    'account_number' => 'required',
                    'opening_balance' => 'required',
                    'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                ]
            );

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->route('bank-account.index')->with('error', $messages->first());
            }

            $account = new BankAccount();
            $account->holder_name = $request->holder_name;
            $account->bank_name = $request->bank_name;
            $account->account_number = $request->account_number;
            $account->currency_id = $request->currency_id;
            $account->opening_balance = $request->opening_balance;
            $account->contact_number = $request->contact_number;
            $account->bank_address = $request->bank_address;
            $account->created_by = Auth::id();
            $account->save();
            CustomField::saveData($account, $request->customField);

            return redirect()->route('bank-account.index')->with('success', __('Account successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function edit(BankAccount $bankAccount)
    {
        if (Auth::user()->can('edit bank account')) {
            if ($bankAccount->created_by == Auth::user()->creatorId()) {
                $bankAccount->customField = CustomField::getData($bankAccount, 'account');
                $customFields = CustomField::query()->where('created_by', '=', Auth::user()->creatorId())->where('module', '=', 'account')->get();
                return view('bankAccount.edit', compact('bankAccount', 'customFields'));
            } else {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, BankAccount $bankAccount)
    {
        if (Auth::user()->can('create bank account')) {

            $validator = Validator::make(
                $request->all(), [
                    'holder_name' => 'required',
                    'bank_name' => 'required',
                    'account_number' => 'required',
                    'opening_balance' => 'required',
                    'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                ]
            );

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->route('bank-account.index')->with('error', $messages->first());
            }

            $bankAccount->holder_name = $request->holder_name;
            $bankAccount->bank_name = $request->bank_name;
            $bankAccount->account_number = $request->account_number;
            $bankAccount->opening_balance = $request->opening_balance;
            $bankAccount->contact_number = $request->contact_number;
            $bankAccount->bank_address = $request->bank_address;
            $bankAccount->created_by = Auth::user()->creatorId();
            $bankAccount->save();
            CustomField::saveData($bankAccount, $request->customField);

            return redirect()->route('bank-account.index')->with('success', __('Account successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function destroy(BankAccount $bankAccount)
    {
        if (Auth::user()->can('delete bank account')) {
            if ($bankAccount->created_by == Auth::user()->creatorId()) {
                $revenue = Revenue::query()->where('account_id', $bankAccount->id)->first();
                $invoicePayment = InvoicePayment::query()->where('account_id', $bankAccount->id)->first();
                $transaction = Transaction::query()->where('account', $bankAccount->id)->first();
                $payment = Payment::query()->where('account_id', $bankAccount->id)->first();
                $billPayment = BillPayment::query()->first();

                if (!empty($revenue) && !empty($invoicePayment) && !empty($transaction) && !empty($payment) && !empty($billPayment)) {
                    return redirect()->route('bank-account.index')->with('error', __('Please delete related record of this account.'));
                } else {
                    $bankAccount->delete();

                    return redirect()->route('bank-account.index')->with('success', __('Account successfully deleted.'));
                }

            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
