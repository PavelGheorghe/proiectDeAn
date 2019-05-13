<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use Excel;
use App\Models\SmsHistory;
use App\Models\Clients;

use App\Http\Requests;

class SmsHistoryController extends Controller
{
    public function index()
    {   
        return view('smsHistory.index', [
            'active_menu' => 'sms_history',
            'clients' => Clients::get(),
            'statuses' => config('ctrl.status.sms')
        ]);
    }

    public function datatable(Request $request)
    { 

        dd($request->all());
        $sms_histories = SmsHistory::query();
        $sms_histories->searchByString( 'phone_number', 'phone_number');
        $sms_histories->searchByNumber( 'client_id', 'client_id');
        $sms_histories->searchByNumber( 'phone_sender', 'phone_sender');
        $sms_histories->searchByNumber( 'status','send_status');
        $sms_histories->searchByDate(  'created_startdate', 'created_finishdate' , 'created_at');

        $sms_histories = $sms_histories->orderBy('created_at', 'asc')->get();
       
        $statuses= config('ctrl.status.sms');

       
        return Datatables::of( $sms_histories)
            ->addColumn('action', function ( SmsHistory $sms) {
                return view( 'smsHistory.chunk.action', [
                    'id'        => $sms->id,
                    'resource'  => 'sms_history',
                ]);
            })
            ->editColumn('client_id', function ( SmsHistory $sms) {
               return $sms->client->name;
            })
            ->editColumn('send_status', function ( SmsHistory $sms) use( $statuses) {
                return  strtoupper(array_search( $sms->send_status , $statuses));   
            })
            ->make(true);
    }

    public function show($id)
    {
        $sms = SmsHistory::find( $id);

        return view('smsHistory.show',[
            'sms'=> $sms,
        ]);
    }

    public function export(Request $request)
    {

        $sms_histories = SmsHistory::query();
        $sms_histories->searchByString('phone_number', 'phone_number');
        $sms_histories->searchByNumber('client_id', 'client_id');
        $sms_histories->searchByDate('created_startdate', 'created_finishdate', 'created_at');

        $sms_histories = $sms_histories->orderBy('created_at', 'asc')->get();
        
       
        $statuses = config('ctrl.status.sms');

        $smsArray[] = [
            trans('lang.id'),
            trans('lang.phone_number'),
            trans('lang.sms_text'),
            trans('lang.send_status'),
            trans('lang.send_message'),
            trans('lang.send_description'),
            trans('lang.phone_sender'),
            trans('lang.clients'),
            trans('lang.provider'),
            trans('lang.tag1'),
            trans('lang.tag2'),
            trans('lang.created_at'),
        ];
        try {
            foreach ( $sms_histories as $sms) {

                $smsArray[] = [
                    trans('lang.id') => $sms->id,
                    trans('lang.phone_number') => $sms->phone_number,
                    trans('lang.sms_text') => $sms->sms_text,
                    trans('lang.send_status') =>  array_search($sms->send_status, $statuses),
                    trans('lang.send_description') =>  $sms->send_desc,
                    trans('lang.send_message') =>  $sms->send_message,
                    trans('lang.phone_sender') => $sms->phone_sender,
                    trans('lang.clients') => $sms->client->name,
                    trans('lang.provider') => $sms->provider,
                    trans('lang.tag1') => $sms->tag1,
                    trans('lang.tag2') => $sms->tag2,
                    trans('lang.created_at') => $sms->created_at,
                ];
            }

     
            $excelFile = Excel::create(trans( 'lang.sms_history') . '_' . date('d_m_Y'), function ($excel) use ( $smsArray) {
                $excel->setTitle(trans( 'lang.sms_history'));
                $excel->sheet(trans( 'lang.sms_history'), function ($sheet) use ( $smsArray) {
                    $sheet->fromArray( $smsArray, null, 'A1', true, false);
                });
            });
            $excelFile = $excelFile->string('xlsx'); //change xlsx for the format you want, default is xls
         
            $response = array(
                'name' => trans( 'lang.sms') . '_' . date('d_m_Y'), //no extention needed
                'file' => 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,' . base64_encode($excelFile), //mime type of used format
            );

            return response()->json($response);
        } catch (\Exception $e) {

            return response()->json([
                'type' => 'error',
                'message' => trans('lang.export_error'),
            ]);
        }
    }
    
}
