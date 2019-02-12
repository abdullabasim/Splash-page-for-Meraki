<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Modles\ClientInfo as clientInfoModel;


class Clients extends Controller
{

    public function index(Request $request)
    {

        session(['base_grant_url' => $request->base_grant_url,
                'user_continue_url'=>$request->user_continue_url,
                'node_id'=>$request->node_id,
                'node_mac'=>$request->node_mac,
                'gateway_id'=>$request->gateway_id,
                'client_ip'=>$request->client_ip,
                'client_mac'=>$request->client_mac
        ]);




        return view('index');
    }

    public function verifyUser()
    {
        date_default_timezone_set('Asia/Baghdad');
        try
        {

            if(session('client_mac') == null)
                return back();

           $start = Carbon::now()->subDays(1);
           $end =  Carbon::now();

           //  where('created_at', '>=',Carbon::parse('-24 hours'))->

        $checker =clientInfoModel::where('client_mac',session('client_mac'))->
        where('created_at', '>=', $start)
            ->where('created_at', '<=', $end)->
      //  where('created_at', '>=', Carbon::today())->
        first();

        if($checker != null)
        {

            return view('index',[
                'notAllow'=>'notAllow'
            ]);
        }

        clientInfoModel::create([
            'node_id' => session('node_id'),
            'node_mac' => session('node_mac'),
            'gateway_id' => session('gateway_id'),
            'client_ip' => session('client_ip'),
            'client_mac' => session('client_mac'),
            'client_id' => 0,
        ]);

        return redirect(session('base_grant_url') . '?continue_url=' . session('user_continue_url') . '&duration=7200');
        }
        catch (\Exception $e)
        {
            return redirect('/');

        }


    }










}
