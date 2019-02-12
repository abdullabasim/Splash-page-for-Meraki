<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Modles\Clients as clientsModel;
use App\Modles\ClientInfo as clientInfoModel;
use App\Http\Requests\PhoneNumber as phoneNumberRequest;
use App\Http\Requests\VerifyCode as verifyCodeRequest;

class Clients extends Controller
{
    public $mac= "";
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
    function convert2english($string) {
        $newNumbers = range(0, 9);
        // 1. Persian HTML decimal
        $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
        // 2. Arabic HTML decimal
        $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
        // 3. Arabic Numeric
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        // 4. Persian Numeric
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        $string =  str_replace($persianDecimal, $newNumbers, $string);
        $string =  str_replace($arabicDecimal, $newNumbers, $string);
        $string =  str_replace($arabic, $newNumbers, $string);
        return str_replace($persian, $newNumbers, $string);
    }
    function validate_mobile($mobile)
    {

        if (preg_match("/[0-9]+$/i", $mobile)) {

            return true ;
        }else{
            return false ;
        }
    }

    /**
     *use to show input phone number page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function enterPhoneNumberPage()
    {
        return view('phone_number');
    }

    /**
     *use to check if user is verify or not and send verify code using zain api
     *
     * @param phoneNumberRequest $requests
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function verifyPhoneNumber(phoneNumberRequest $requests)
    {
         try
         {

             if($this->validate_mobile($this->convert2english($requests->phone_number)) === false)
                 return redirect('/zain/phone')
                     ->with('error', 'Dear Customer,Please enter a valid phone number.');

             $number = $this->convert2english($requests->phone_number);
                 //  dd(session('client_mac'));
             $checker =clientInfoModel::where('client_mac',session('client_mac'))->
        where('created_at', '>=', Carbon::today())->
        first();


        if($checker != null)
        {


            return redirect('/zain/phone')
                ->with('error', 'Dear customer, you reached Zain WIFI usage limit.');
        }


        $randomCode = $this->randomCode(6);


        $client=clientsModel::create([
            'phone_number'=>$number,
            'verify_code'=>$randomCode,
        ]);

                clientInfoModel::create([
                    'node_id' => session('node_id'),
                    'node_mac' => session('node_mac'),
                    'gateway_id' => session('gateway_id'),
                    'client_ip' => session('client_ip'),
                    'client_mac' => session('client_mac'),
                    'client_id' => $client->id,
                ]);

//               dd(session('base_grant_url') . '?continue_url=' . session('user_continue_url') . '&duration=7200');
//             return redirect(session('base_grant_url')  . '&duration=7200');
             return redirect(session('base_grant_url') . '?continue_url=' . session('user_continue_url') . '&duration=7200');




         }
         catch (\Exception $e)
         {
//            dd($e->getMessage());
             return redirect('/zain/phone')
                 ->with('error', 'Sorry Try Again.');
         }

    }


    /**
     *Use to show Verify  code page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
//    public function verifyCodePage()
//    {
//        return view('verify_page');
//    }

    /**
     * use to verify code after send it to client
     *
     * @param verifyCodeRequest $requests
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
//    public function codeVerify(verifyCodeRequest $requests)
//    {
//        try {
//
//
//            $verifyClient = clientsModel::where('phone_number', $requests->phone_number)->
//            where('verify_code', $requests->verify_code)->
//            where('created_at', '>=', Carbon::today())->
//            WhereNull('verify_at')->
//            first();
//
//
//            if ($verifyClient != null) {
//
//                clientsModel::where('phone_number', $requests->phone_number)->
//                where('verify_code', $requests->verify_code)->
//                where('created_at', '>=', Carbon::today())->
//                update(['verify_at' => Carbon::now()]);
//
//                $clientId = clientsModel::where('verify_code', $requests->verify_code)->
//                where('created_at', '>=', Carbon::today())->
//                first();
//
//
//                clientInfoModel::create([
//                    'node_id' => session('node_id'),
//                    'node_mac' => session('node_mac'),
//                    'gateway_id' => session('gateway_id'),
//                    'client_ip' => session('client_ip'),
//                    'client_mac' => session('client_mac'),
//                    'client_id' => $clientId->id,
//                ]);
//
//                $phoneNumberChecker = substr($clientId->phone_number, 3, 2);
//
//                //dd($phoneNumberChecker);
////                if ($phoneNumberChecker == '78' or $phoneNumberChecker == '79') {
//                    // session()->flush();
//                    return redirect(session('base_grant_url') . '?continue_url=' . session('user_continue_url') . '&duration=7200');
//  //              } else {
//                    // session()->flush();
//      //              return redirect(session('base_grant_url') . '?continue_url=' . session('user_continue_url') . '&duration=7200');
//    //            }
//
//
//            }
//
//            $failureCount = clientsModel::where('phone_number', $requests->phone_number)->
//            where('created_at', '>=', Carbon::today())->first();
//
//            if ($failureCount->failure_count < 3) {
//
//                clientsModel::where('phone_number', $requests->phone_number)->
//                where('created_at', '>=', Carbon::today())->
//                update(['failure_count' => $failureCount->failure_count + 1]);
//
//                return view('verify_page', [
//                    'phoneNumber' => $requests->phone_number,
//                    'sendAgain' => 'true',
//                    'error' => 'Sorry, you entered a wrong PIN.'
//                ]);
//
//            } else {
//                clientsModel::where('phone_number', $requests->phone_number)->
//                where('created_at', '>=', Carbon::today())->
//                delete();
//                return redirect('zain/phone')
//                    ->with('error', 'Dear customer, please request another PIN.');
//            }
//        }
//        catch (\Exception $e)
//        {
//            return redirect('/zain/phone')
//                ->with('error', 'Sorry Try Again.');
//        }
//
//    }

    /**
     * Generate Random code
     *
     * @param $length
     * @return string
     */
    public  function randomCode($length)
    {
        $chars = "1234567890";
        $clen   = strlen( $chars )-1;
        $code  = '';

        for ($i = 0; $i < 4; $i++) {
            $code .= $chars[mt_rand(0,$clen)];
        }
        return ($code);
    }


    /**
     *Send another Verify code
     *
     * @param phoneNumberRequest $requests
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
//    public function sendAgain(phoneNumberRequest $requests)
//    {
//        try
//        {
//
//
//        //check if phone number is verify or not
//        $checker =clientsModel::where('phone_number',$requests->phone_number)->
//        where('verify_at', '>=', Carbon::today())->
//        first();
//
//        if($checker != null)
//        {
//            if($checker->failure_cont == 3)
//            {
//
//                clientsModel::where('phone_number',$requests->phone_number)->
//                where('verify_at', '=', Carbon::today())->delete();
//
//                return redirect('/zain/phone')
//                    ->with('error', 'Dear customer, please request another PIN.');
//            }
//
//            return redirect('/zain/phone')
//                ->with('error', 'Dear customer, you reached Zain WIFI usage limit.');
//        }
//
//        $phoneNumberChecker = substr($requests->phone_number , 3,2);
//
//        $randomCode = $this->randomCode(6);
//        $client = new \GuzzleHttp\Client();
//
//        $request = $client->get('http://172.16.36.48/api/directsms/sms.php?phone='.$requests->phone_number.'&msg=Welcome+to+Zain+WIFI+service,+your+PIN+code+is:'.$randomCode.'&sender=ZainWifi');
//
//        $response = $request->getBody();
//
//        clientsModel::where('phone_number',$requests->phone_number)->
//        where('created_at', '>=', Carbon::today())->
//            update(['verify_code' => $randomCode ,
//                     'failure_count'=>0
//                   ]);
//
//
//        return view('verify_page',[
//            'phoneNumber' => $requests->phone_number,
//        ]);
//        }
//
//        catch (\Exception $e)
//        {
//            return redirect('/zain/phone')
//                ->with('error', 'Sorry Try Again.');
//        }
//    }
}
