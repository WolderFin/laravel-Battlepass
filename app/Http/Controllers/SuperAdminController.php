<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{
    public function s_admin(){
        $gifts = DB::table('get_gifts')
            ->join('users','get_gifts.user_id', '=', 'users.id')
            ->join('battlepas','get_gifts.gift_id', '=', 'battlepas.lvl')
            ->select('users.username as username', 'battlepas.description as gift')
            ->orderBy('get_gifts.id', 'desc')
            ->get();
        return view('admin-panel.s-admin', compact('gifts'));
    }
    public function user_give_sub(User $user_id){
        $user_id->update([
            'sub'=>true,
        ]);
        return back()->with('success', 'Попдписка выдана');
    }
}
