<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
//model
use App\Model\DetailExpense;
use App\Model\Expense;

class DetailExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $sql['detail'] = DetailExpense::where('expense_id',$id)->orderBy('updated_at','desc')->get();
        $sql['expense'] = Expense::where('id',$id)->first();
        $sql['id'] = $id;
        return view('page.detail.index',$sql);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $expense_id)
    {
        $cuenta = trim($request -> input('cuenta'));
        $detalle = trim($request -> input('detalle'));
        $total = trim($request -> input('total'));

        $rules=array(
            'cuenta' => 'required',
            'detalle' => 'required',
            'total' => 'required'
        );
        $data=array(
            'cuenta' => $cuenta,
            'detalle' => $detalle,
            'total' => $total
        );
        $validator = \Validator::make($data, $rules);
        if ($validator->fails())
        {   
            return redirect('detail-expense/'.$expense_id)
                        ->withErrors($validator)
                        ->withInput();
        }else{
            try{
                $sql = new DetailExpense;
                $sql -> expense_id = $expense_id;
                $sql -> cuenta = $cuenta;
                $sql -> detalle = $detalle;
                $sql -> total = $total;
                $sql -> save();

                return redirect('detail-expense/'.$expense_id)->with('message', 'La Guardo correctamente el detalle de gasto.');
            }catch(\Illuminate\Database\QueryException $e){   
                return redirect('detail-expense/'.$expense_id)->with('message', 'Error en la base de datos.');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($expense_id, $id)
    {
        $sql = DetailExpense::find($id);
        return $sql->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $expense_id, $id)
    {
        //
        $cuenta = trim($request -> input('cuenta'));
        $detalle = trim($request -> input('detalle'));
        $total = trim($request -> input('total'));

        $rules=array(
            'cuenta' => 'required',
            'detalle' => 'required',
            'total' => 'required'
        );
        $data=array(
            'cuenta' => $cuenta,
            'detalle' => $detalle,
            'total' => $total
        );
        $validator = \Validator::make($data, $rules);
        if ($validator->fails())
        {   
            return array('message'=>'Error de servidor.');
        }else{
            try{
                $sql = DetailExpense::find($id);
                $sql -> cuenta = $cuenta;
                $sql -> detalle = $detalle;
                $sql -> total = $total;
                $sql -> save();

                return array('message'=>'Guardado Exitosamente.');
            }catch(\Illuminate\Database\QueryException $e){   
                return array('message'=>'Error de Base de Datos.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($expense_id, $id)
    {
        //
        $sql = DetailExpense::find($id);
        $sql->delete();
        return redirect('detail-expense/'.$expense_id)->with('message', 'Elimanado correctamente.');
    }
}
