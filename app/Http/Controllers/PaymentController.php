<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Qiwi\Api\BillPayments;

class PaymentController extends Controller
{
    public function payment_create(){
        $billPayments = new BillPayments(env('QIWI_SECRET_KEY'));
        $billId = $billPayments->generateId();
        $fields = [
            'amount' => 1,
            'currency' => 'RUB',
            'comment' => Auth::id(),
            'expirationDateTime' => $billPayments->getLifetimeByDay(days: 1),
            'successUrl' => route('payment.check', $billId),
        ];

        $payment = Payment::where('user_id', Auth::id())->first();

        $billidData = [
            'user_id' => Auth::id(),
            'dillid' => $billId,
        ];

        if($payment != null){
            $payment->update([
                'dillid' => $billId,
            ]);
        }
        else{
            Payment::create($billidData);
        }

        $url = $billPayments->createBill($billId, $fields);
        redirect()->to($url['payUrl'])->send();
    }

    public function payment_check(){
        $billPayments = new BillPayments(env('QIWI_SECRET_KEY'));
        $payment = Payment::where('user_id', Auth::id())->first();

        if($payment == null){
            return redirect()->route('index');
        }

        $response = $billPayments->getBillInfo($payment['dillid']);

        if ($response['status']['value'] == 'PAID'){
            $payment->delete();
            $user = User::find(Auth::id());
            $user->update([
                'sub' => true,
            ]);
            return redirect()->route('index');
        }

        if ($response['status']['value'] == 'REJECTED'){
            $payment->delete();
            return redirect()->route('index');
        }
        else{
            return 'Ожидание вашего платежа. Ссылка для оплаты: ';
        }
    }

    public function payment_cancel(){
        $billPayments = new BillPayments(env('QIWI_SECRET_KEY'));
        $payment = Payment::where('user_id', Auth::id())->first();

        if($payment == null){
            return redirect()->route('index');
        }

        $billPayments->cancelBill($payment['dillid']);
        $payment->delete();
        return redirect()->route('index');
    }
}
