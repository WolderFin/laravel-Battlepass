<?php

namespace App\Http\Controllers;

use App\Models\Battlepas;
use App\Models\GetGift;
use App\Models\Session;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class DevController extends Controller
{
    public function dev(){
        $gifts = DB::table('get_gifts')
            ->join('users','get_gifts.user_id', '=', 'users.id')
            ->join('battlepas','get_gifts.gift_id', '=', 'battlepas.lvl')
            ->select('users.username as username', 'battlepas.description as gift')
            ->orderBy('get_gifts.id', 'desc')
            ->get();
        $settings = Settings::all();
        $settings = $settings->toArray();
        $settings = $settings[0];
        return view('admin-panel.dev', compact('gifts', 'settings'));
    }

    public function setting_update(Request $request){
        $settings = Settings::find(1);
        if ($request['vk_url'] == $settings['vk_url'] && $request['address'] != $settings['address']){
            $settings->update([
                'address'=>$request['address'],
            ]);
            return back()->with('success', 'Адрес изменен');
        }

        if ($request['vk_url'] != $settings['vk_url'] && $request['address'] == $settings['address']){
            $settings->update([
                'vk_url'=> $request['vk_url'],
            ]);
            return back()->with('success', 'ссылка на вк изменена');
        }

        if ($request['vk_url'] != $settings['vk_url'] && $request['address'] != $settings['address']){
            $settings->update([
                'vk_url'=> $request['vk_url'],
                'address'=>$request['address'],
            ]);
            return back()->with('success', 'Данные изменены');
        }
        else{
            return back()->with('error', 'Ничего не изменилось');
        }
    }

    public function global_edit(Request $request){
        $settings = Settings::find(1);
        if ($request['work'] == $settings['works'] && $request['bp_date_end'] != $settings['bp_date_end']){
            $settings->update([
                'bp_date_end'=>$request['bp_date_end'],
            ]);
            return back()->with('success', 'Дата изменена');
        }

        if ($request['work'] != $settings['works'] && $request['bp_date_end'] == $settings['bp_date_end']){
            if($request['work'] == 'on'){
                $settings->update([
                    'works'=> true,
                ]);
            }
            else{
                $settings->update([
                    'works'=> false,
                ]);
            }
            return back()->with('success', 'Статус изменен');
        }

        if ($request['work'] != $settings['works'] && $request['bp_date_end'] != $settings['bp_date_end']){
            $settings->update([
                'works'=> $request['work'],
                'bp_date_end'=>$request['bp_date_end'],
            ]);
            return back()->with('success', 'Параметры изменены');
        }
        else{
            return back()->with('error', 'Ничего не изменилось');
        }

    }

    public function drop_dattlePass(){
        Battlepas::truncate();
        GetGift::truncate();
        Session::truncate();
        return back()->with('success', 'Боевой пропуск сброшен!');
    }

    public function user_drop_sub(){
        $users = User::all();
        foreach ($users as $user){
            if ($user['sub']){
                $user->update([
                    'sub'=>false,
                ]);
            }
        }
        return back()->with('success', 'подписики сброшены!');
    }

    public function full_battlepass(Request $request){
        $csvFile = $request->file('bp_csv');

        if ($csvFile) {
            $reader = Reader::createFromPath($csvFile->getRealPath(), 'r');
            $reader->setDelimiter(';');

            $records = $reader->getRecords(); // Получить записи

            foreach ($records as $record) {
                $data = $record;
                if (count($data) == 2) {
                    Battlepas::create([
                        'description' => $data[0],
                        'plug' => $data[1],
                    ]);
                }
            }

            return back()->with('success', 'Боевой пропуск заполнен!');
        } else {
            return back()->with('error', 'Неизвестная ошибка');
        }
    }
}
