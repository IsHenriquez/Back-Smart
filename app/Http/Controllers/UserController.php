<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {
        /*if(!Auth::user()->can('viewAny',User::class))
        {
            return response()->json(['error' => 'Sin autorización.', 'success' => false], 403);
        }*/

        $filters    =   $request->input('filter')   ;
        $modelo = User::query();
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
        $return = array('success'=>true,"data" =>$var,"total" => $modelo->count());
        return response()->json($return,200);
    }

    public function store(Request $request)
    {
        /*if(!Auth::user()->can('create',User::class))
        {
            return response()->json(['error' => 'Sin autorización.".', 'success' => false], 403);
        }*/

        $validator = validator::make($request->all(), [
            'id_user_type'=>'required',
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email'=>'required|email|unique:users',
            'active'=>'required|boolean',
            'password'=>'required|max:12|min:6|string'
        ]);

        if($validator->fails())
        {
            return response()->json(['error' => 'Error de validación en datos ingresados','errors' => $validator->errors()->all(),'success' => false] );
        }

        $modelo = new User();
        $modelo->active                       =   $request->active                                          ;
        $modelo->id_user_type                 =   $request->id_user_type                                    ;
        $modelo->id_vehicle                   =   $request->id_vehicle                                      ;
        $modelo->name                         =   $request->name                                            ;
        $modelo->last_name                    =   $request->last_name                                       ;
        $modelo->mother_last_name             =   $request->mother_last_name                                ;
        $modelo->identification_number        =   $request->identification_number                           ;
        $modelo->gender                       =   $request->gender                                          ;
        if($request->birth_date!==null && $request->birth_date!==""){
            $modelo->birth_date                   =   date('Y-m-d',strtotime($request->birth_date))         ;
        }
        $modelo->phone                        =   $request->phone                                           ;
        $modelo->email                        =   $request->email                                           ;
        $modelo->password                     =   app('hash')->make($request->password, ['rounds' => 12])   ;
        $modelo->save();
        return response()->json(['data' => $modelo, 'success' => true], 200);
    }

    public function show($id)
    {
        $modelo = User::findOrFail($id);
        /*if(!Auth::user()->can('view',$modelo))
        {
            return response()->json(['error' => 'Sin autorización.', 'success' => false], 403);
        }*/
        $arreglo = $modelo->toArray();
        return response()->json(['data' => $arreglo, 'success' => true], 200);
    }

    public function update(Request $request, $id)
    {
        /*
        $validator = validator::make($request->all(), [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'active'=>'required|boolean',
            'id_user_type'=>'required',
            'email'=>['required','email',Rule::unique('users','email')->ignore($id)],
            'password'=>'max:12|min:6|string'
        ]);

        if($validator->fails())
        {
            return response()->json(['error' => 'Error de validación en datos ingresados','errors' => $validator->errors()->all(),'success' => false]);
        }
        */

        $modelo = User::find($id);
        /*if(!Auth::user()->can('update',$modelo))
        {
            return response()->json(['error' => 'Sin autorización.', 'success' => false],403);
        }*/

        if($request->input('password'))
        {
            $modelo->password= app('hash')->make($request->input('password'), ['rounds' => 12]);
        }
        if($modelo->id_vehicle!== null && $modelo->id_vehicle!==""){
            $modeloV = Vehicles::find($modelo->id_vehicle);
            $modeloV->is_busy=0;
            $modeloV->save();
        }
        $modelo->active                       =   $request->active                                          ;
        $modelo->id_user_type                 =   $request->id_user_type                                    ;
        $modelo->id_vehicle                   =   $request->id_vehicle                                      ;
        $modelo->name                         =   $request->name                                            ;
        $modelo->last_name                    =   $request->last_name                                       ;
        $modelo->mother_last_name             =   $request->mother_last_name                                ;
        $modelo->identification_number        =   $request->identification_number                           ;
        $modelo->gender                       =   $request->gender                                          ;
        $modelo->birth_date                   =   date('Y-m-d',strtotime($request->birth_date))             ;
        $modelo->phone                        =   $request->phone                                           ;
        $modelo->email                        =   $request->email                                           ;
        $modelo->password                     =   app('hash')->make($request->password, ['rounds' => 12])   ;
        $modelo->save();
        return response()->json(['data' => $modelo, 'success' => true], 200);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        /*if(!Auth::user()->can('delete',$user))
        {
            return response()->json(['error' => 'Sin autorización.', 'success' => false], 403);
        }*/
        $user->delete();
        return response()->json([ 'success' => true], 200);
    }
}
