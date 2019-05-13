<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use Excel;
use App\Models\User;
use App\Models\Clients;

use App\Http\Requests;

class ClientsController extends Controller
{
    public function index()
    {  
        return view('clients.index', [
            'active_menu' => 'clients',
        ]);
    }

    public function datatable(Request $request)
    {   
        $clients= Clients::get();
       
        return Datatables::of($clients)
            ->addColumn('action', function (Clients $client) {
                return view('clients.chunk.action', [
                    'id'        => $client->id,
                    'resource'  => 'clients',
                    'status'    => $client->status,
                ]);
            })
            ->editColumn('status', function ( Clients $client) {

                if ( $client->status == Clients::CLIENT_STATUS_ENABLE ) {
                    return trans('lang.enable');
                }
                if ( $client->status == Clients::CLIENT_STATUS_DISABLE ) {
                    return trans('lang.disable');
                }
              
            })
            ->make(true);
    }


    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $rules = config('validations.web.client.create');
        $this->validate($request, $rules);
    
        $input = $request->all();
        $input[ 'status'] = isset( $input['status']) && $input['status'] == 'on' ? Clients::CLIENT_STATUS_ENABLE : Clients::CLIENT_STATUS_DISABLE;
      
        DB::transaction(function () use ($input) {
            $client = Clients::create($input);
            $client->token =  md5(str_random(6));
            $client->save();
        });

        return response()->view('message.success', [
            'message' => trans('lang.user_create_success'),
        ]);
    }
    public function edit($id)
    {
        $client = Clients::find($id);

        return view('clients.edit', [
            'client' => $client,
        ]);
    }
    public function update($id, Request $request)
    {
        $rules = config('validations.web.client.update');
        $rules['email'] .= ',' . $id . ',id,deleted_at,NULL';
        $this->validate($request, $rules);
    
        $client = Clients::find($id);
        $input = $request->all();
        $input['status'] = isset($input['status']) && $input['status'] == 'on' ? Clients::CLIENT_STATUS_ENABLE : Clients::CLIENT_STATUS_DISABLE;
        $client->fill($input);
        $client->save();

        return response()->view('message.success', [
            'message' => trans('lang.client_update_success'),
        ]);
    }

    public function destroy( $id)
    {  
        $client = Clients::find($id);
        $client->delete();

        return response()->json([
            'type' => 'success',
            'message' => trans('lang.client_delete_success'),
        ]);
    }

    public function change_status($id)
    {
        $client = Clients::find($id);
        $client->status = $client->status ? Clients::CLIENT_STATUS_DISABLE : Clients::CLIENT_STATUS_ENABLE;
        $client->save();

        return response()->json([
            'type' => 'success',
            'message' => trans('lang.status_was_changed'),
        ]);

    }

    public function export(Request $request)
    {
        $clients = Clients::query();
        $clients->whereNull('deleted_at');
        $clients->searchByString('name', 'name');
        $clients->searchByString('email', 'email');
        $clients->searchByString('status', 'status');
        $clients->searchByString('credits', 'credits');
        $clients->searchByString('token', 'token');
        $clients->searchByString('created_at', 'created_at');
        

        $clients = $clients->orderBy('created_at', 'asc')->get();

        $clientsArray[] = [
            trans( 'lang.name'),
            trans( 'lang.email'),
            trans( 'lang.status'),
            trans( 'lang.credits'),
            trans( 'lang.token'),
            trans( 'lang.created_at'),
        ];
        try {
            foreach ( $clients as $client) {

                $clientsArray[] = [
                    trans('lang.name') => $client->name,
                    trans( 'lang.email') => $client->email,
                    trans( 'lang.status') => $client->status ? trans('lang.enable'): trans('lang.disable'),
                    trans('lang.credits') => $client->credits,
                    trans('lang.token') => $client->token,
                    trans('lang.created_at') => $client->created_at,
                ];
            }

            $excelFile = Excel::create(trans('lang.users') . '_' . date('d_m_Y'), function ($excel) use ( $clientsArray) {
                $excel->setTitle(trans('lang.users'));
                $excel->sheet(trans('lang.users'), function ($sheet) use ( $clientsArray) {
                    $sheet->fromArray( $clientsArray, null, 'A1', true, false);
                });
            });
            $excelFile = $excelFile->string('xlsx'); //change xlsx for the format you want, default is xls
            $response = array(
                'name' => trans('lang.clients') . '_' . date('d_m_Y'), //no extention needed
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
