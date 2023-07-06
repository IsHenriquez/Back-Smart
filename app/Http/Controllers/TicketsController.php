<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TicketsController extends Controller
{
    public function index(Request $request)
    {
        /*if(!Auth::user()->can('viewAny', Ticket::class)) {
            return response()->json(['error' => 'Sin autorización.', 'success' => false], 403);
        }*/
        $filters    =   $request->input('filter')   ;
        $modelo = Ticket::query();
        if(isset($filters))
        {
            $filters=json_decode($filters);
            $arrOperadores = ['>','<','=','!=','<=','>='];
            $arrOperadoresConv = ['eq'=>'=', '=='=>'=', '='=>'=','gt'=>'>=', 'lt'=>'<=', 'like'=>'like','!='=>'!=','<>'=>'<>','in'=>'in'];
            $arrCamposFecha = ['created_at','updated_at'];

            foreach ($filters as &$filter){
                $operador = $arrOperadoresConv[$filter->operator];

                if(\array_search($operador, $arrOperadores) !== false and (\array_search($filter->property, $arrCamposFecha) !== false))
                {
                    $fecha = Carbon::createFromFormat('d-m-Y', $filter->value)->setTimezone(\config('app.timezone'))->format('Y-m-d');
                    $modelo->whereDate($filter->property,$operador,$fecha);
                }elseif ($operador=="in")
                {
                    $modelo->whereIn($filter->property,$filter->value);
                }
                elseif(\array_search($operador, $arrOperadores) !== false)
                {
                    $modelo->where($filter->property,$operador,$filter->value);
                }
                elseif ($operador == 'like' and isset($filter->value))
                {
                    $modelo->where($filter->property,$operador,'%'.$filter->value.'%');
                }
            }
        }
        $var = $modelo->get();
        $return = [
            'success' => true,
            'data' => $var,
            'total' => $modelo->count()
        ];

        return response()->json($return, 200);
    }

    public function store(Request $request)
    {
        /*if (!Auth::user()->can('create', Ticket::class)) {
            return response()->json(['error' => 'Sin autorización.', 'success' => false], 403);
        }*/

        $validator = Validator::make($request->all(), [
            'id_managing_user' => 'required|exists:users,id',
            'id_status' => 'required|exists:tickets_status,id',
            'id_type' => 'required|exists:tickets_type,id',
            'id_category' => 'required|exists:tickets_category,id',
            'id_priority' => 'required|exists:tickets_priority,id',
            'id_customer' => 'nullable|exists:customer,id',
            'title' => 'required',
            'description' => 'required',
            'address' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'fecha_ingreso_solicitud' => 'nullable|date',
            'fecha_realizar_servicio' => 'nullable|date',
            'fecha_termino_servicio' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Error de validación en los datos ingresados', 'errors' => $validator->errors()->all(), 'success' => false]);
        }

        $modelo = new Ticket();
        $modelo->id_managing_user = $request->id_managing_user;
        $modelo->id_status = $request->id_status;
        $modelo->id_type = $request->id_type;
        $modelo->id_category = $request->id_category;
        $modelo->id_priority = $request->id_priority;
        $modelo->id_customer = $request->id_customer;
        $modelo->title = $request->title;
        $modelo->description = $request->description;
        $modelo->address = $request->address;
        $modelo->latitude = $request->latitude;
        $modelo->longitude = $request->longitude;
        $modelo->fecha_ingreso_solicitud = $request->fecha_ingreso_solicitud;
        $modelo->fecha_realizar_servicio = $request->fecha_realizar_servicio;
        $modelo->fecha_termino_servicio = $request->fecha_termino_servicio;
        $modelo->save();
        return response()->json(['data' => $modelo, 'success' => true], 200);
    }

    public function show($id)
    {
        $modelo = Ticket::findOrFail($id);

        /* if (!Auth::user()->can('view', $modelo)) {
            return response()->json(['error' => 'Sin autorización.', 'success' => false], 403);
        } */

        $arreglo = $modelo->toArray();

        return response()->json(['data' => $arreglo, 'success' => true], 200);
    }

    public function update(Request $request, $id)
    {
        /*
        $validator = Validator::make($request->all(), [
            'id_managing_user' => 'required|exists:users,id',
            'id_status' => 'required|exists:tickets_status,id',
            'id_type' => 'required|exists:tickets_type,id',
            'id_category' => 'required|exists:tickets_category,id',
            'id_priority' => 'required|exists:tickets_priority,id',
            'id_customer' => 'nullable|exists:customer,id',
            'title' => 'required',
            'description' => 'required',
            'address' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'fecha_ingreso_solicitud' => 'nullable|date',
            'fecha_realizar_servicio' => 'nullable|date',
            'fecha_termino_servicio' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Error de validación en los datos ingresados', 'errors' => $validator->errors()->all(), 'success' => false]);
        }
        */

        $modelo = Ticket::find($id);

        /* if (!Auth::user()->can('update', $modelo)) {
            return response()->json(['error' => 'Sin autorización.', 'success' => false], 403);
        } */


        $modelo->id_managing_user = $request->id_managing_user;
        $modelo->id_status = $request->id_status;
        $modelo->id_type = $request->id_type;
        $modelo->id_category = $request->id_category;
        $modelo->id_priority = $request->id_priority;
        $modelo->id_customer = $request->id_customer;
        $modelo->title = $request->title;
        $modelo->description = $request->description;
        $modelo->address = $request->address;
        $modelo->latitude = $request->latitude;
        $modelo->longitude = $request->longitude;
        $modelo->fecha_ingreso_solicitud = $request->fecha_ingreso_solicitud;
        $modelo->fecha_realizar_servicio = $request->fecha_realizar_servicio;
        $modelo->fecha_termino_servicio = $request->fecha_termino_servicio;
        $modelo->save();

        return response()->json(['data' => $modelo, 'success' => true], 200);
    }

    public function destroy($id)
    {
        $modelo = Ticket::findOrFail($id);

        /* if (!Auth::user()->can('delete', $modelo)) {
            return response()->json(['error' => 'Sin autorización.', 'success' => false], 403);
        } */

        $modelo->delete();

        return response()->json(['success' => true], 200);
    }

    public function eventList(Request $request){

        $idManagingUser = $request->id_user;
        $results = DB::select('CALL getEventList(?)', [$idManagingUser]);
        $return = array('success'=>true,"data" =>$results,"total" => count($results));
        return response()->json($return,200);
    }
}
