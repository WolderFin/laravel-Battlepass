<?php

namespace App\Http\Controllers;

use App\Models\Battlepas;
use App\Models\GetGift;
use App\Models\Payment;
use App\Models\Session;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Qiwi\Api\BillPayments;
use League\Csv\Reader;
use League\Csv\Statement;
use function Laravel\Prompts\select;


class IndexController extends Controller
{
    public function index(){
        $user_data = User::find(Auth::id());
        $settings = Settings::find(1);
        if($user_data == null){
            $role[0] = null;
        }
        else{
            $role = $user_data->getRoleNames();
        }
        if($role[0] == 'user' || $role[0] == null){
            if ($user_data != null){
                $session = Session::where('user_id', $user_data->id)->orderBy('id', 'desc')->get();
                $lvl = $session->count();
                $last_gift = GetGift::where('user_id', $user_data->id)->orderBy('id', 'desc')->get()->first();
                if($last_gift == null){
                    $last_gift['gift_id'] = 0;
                }
            }
            else{
                $lvl = 0;
                $last_gift['gift_id'] = 0;
            }

            $battlepass = Battlepas::all();
            $billPayments = new BillPayments(env('QIWI_SECRET_KEY'));
            $payment = Payment::where('user_id', Auth::id())->first();
            if($payment != null){
                $response = $billPayments->getBillInfo($payment['dillid']);
            }
            else{
                $response=null;
            }
            if($settings['works']){
                return redirect()->route('technical.work');
            }
            else{
                return view('index', compact('battlepass','user_data','response', 'lvl', 'last_gift', 'settings'));
            }

        }
        else{
            return redirect()->route('redirect.role');
        }

    }
    public function technical_work(){
        $globalVar = GlobalVar::find(1);
        if ($globalVar['works'] == false){
            return redirect()->route('index');
        }
        else{
            return view('works');
        }
    }
    public function role_redirect(){
        $user_data = User::find(Auth::id());
        $globalVar = settings::find(1);
        if($user_data != null){
            $role = $user_data->getRoleNames();
            if($role[0] == 'user'){
                return redirect()->route('index');
            }
            if($role[0] == 'admin'){
                return redirect()->route('panel.admin');
            }
            if($role[0] == 's-admin'){
                return redirect()->route('panel.s-admin');
            }
            if($role[0] == 'dev'){
                return redirect()->route('panel.dev');
            }
        }
        else{
            if($globalVar['works'] == true){

            }
            else{
                return redirect()->route('index');
            }
        }
    }
}
