<?php

namespace App\Http\Controllers;

use App\Models\GetGift;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function admin(){
        return view('admin-panel.admin');
    }

    public function redirect_to_user_info(Request $request){
        $admin_data = User::find(Auth::id());
        $role = $admin_data->getRoleNames();
        $data_redirect = $request->toArray();
        $data_user= User::find($data_redirect['user_id']);

        if ($data_user == null){
            return back()->with('error', 'Такого ID нет!');
        }
        if (!$data_user['sub'] && $role[0] == "admin"){
            return back()->with('error', 'У пользователя нет активной подписки!');
        }
        if ($data_user['id'] == Auth::id()){
            return back()->with('error', 'Данное действие недоступно!');
        }
        else{
            return redirect()->route('admin.user.info', $data_redirect['user_id']);
        }
    }

    public function user_info(User $user_id){
        $session = Session::where('user_id', $user_id->id)->orderBy('id', 'desc')->get();
        $lvl = $session->count();
        $last_gift = GetGift::where('user_id', $user_id->id)->orderBy('id', 'desc')->get()->first();
        if (!$last_gift ){
            $last_gift = 0;
        }
        else{
            $last_gift = $last_gift['gift_id'];
        }
        if ($session->isEmpty()){
            $difference = 'Нет посещений!';
            $last_date = "";
        }
        else{
            $last_date = $session->first()->created_at;
            $difference= $last_date->diffInHours(now());
        }
        return view('user-info.info', compact('user_id','session', 'difference', 'last_date', 'lvl', 'last_gift'));
    }

    public function user_add_session(User $user_id){
        Session::create([
            'user_id'=> $user_id->id,
        ]);
        return back()->with('success', 'Посещение добавлено');
    }

    public function user_give_gift(User $user_id, Request $request){
        GetGift::create([
            'user_id'=> $user_id->id,
            'gift_id'=> $request->lvl,
        ]);
        return back()->with('success', 'Приз выдан!');
    }
}
