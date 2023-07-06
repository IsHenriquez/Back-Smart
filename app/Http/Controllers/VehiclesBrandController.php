<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehiclesBrand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class VehiclesBrandController extends Controller
{
    public function index(Request $request)
    {
        /*if(!Auth::user()->can('viewAny',VehiclesBrand::class))
        {
            return response()->json(['error' => 'Sin autorización.', 'success' => false], 403);
        }*/

        $filters    =   $request->input('filter')   ;
        $modelo = VehiclesBrand::query();
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
        /*if(!Auth::user()->can('create',VehiclesBrand::class))
        {
            return response()->json(['error' => 'Sin autorización.".', 'success' => false], 403);
        }*/
        $validator = validator::make($request->all(), [
            'name'=>'required|string|unique:vehicles_brand',
        ]);

        if($validator->fails())
        {
            return response()->json(['error' => 'Error de validación en datos ingresados','errors' => $validator->errors()->all(),'success' => false] );
        }

        $modelo = new VehiclesBrand();
        $modelo->name = $request->name;
        $modelo->save();
        return response()->json(['data' => $modelo, 'success' => true], 200);
    }

    public function show($id)
    {
        $modelo = VehiclesBrand::findOrFail($id);
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
            'name'=>['required','string',Rule::unique('vehicles_brand','name')->ignore($id)]
        ]);

        if($validator->fails())
        {
            return response()->json(['error' => 'Error de validación en datos ingresados','errors' => $validator->errors()->all(),'success' => false]);
        }
        */

        $modelo = VehiclesBrand::find($id);
        /*if(!Auth::user()->can('update',$modelo))
        {
            return response()->json(['error' => 'Sin autorización.', 'success' => false],403);
        }*/

        $modelo->name = $request->name;
        $modelo->save();
        return response()->json(['data' => $modelo, 'success' => true], 200);
    }

    public function destroy($id)
    {
        $modelo = VehiclesBrand::findOrFail($id);
        /*if(!Auth::user()->can('delete',$modelo))
        {
            return response()->json(['error' => 'Sin autorización.', 'success' => false], 403);
        }*/
        $modelo->delete();
        return response()->json([ 'success' => true], 200);
    }
}
