<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
//model
use App\Model\Expense;
use App\Model\DetailExpense;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = trim($request->input('search'));
        $type = $request->input('type');
        $sql['expense']=Expense::with('detailExpense')->search($search,$type)->orderBy('updated_at','desc')->paginate(10);
        $sql['detail']=DetailExpense::get();
        return view('page.expense.index',$sql)->with($request->only('search','type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fecha = trim($request -> input('fecha'));
        $encargado = trim($request -> input('encargado'));
        $detalle = trim($request -> input('detalle'));

        $rules=array(
            'fecha' => 'required',
            'encargado' => 'required',
            'detalle' => 'required'
        );
        $data=array(
            'fecha' => $fecha,
            'encargado' => $encargado,
            'detalle' => $detalle
        );
        $validator = \Validator::make($data, $rules);
        if ($validator->fails())
        {   
            return redirect('expense')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            try{
                $hash = base64_encode(strval(microtime()));
                $sql = new Expense;
                $sql -> codigo = substr($hash, 4, 7);
                $sql -> fecha = date("Y-m-d",strtotime($fecha));
                $sql -> encargado = $encargado;
                $sql -> detalle = $detalle;
                $sql -> save();

                return redirect('expense')->with('message', 'La Guardo correctamente el detalle de gasto, para ingresar el detalle precione <i class="material-icons">&#xE89C;</i>.');
            }catch(\Illuminate\Database\QueryException $e){   
                return redirect('expense')->with('message', 'La Guardo correctamente el detalle de gasto, para ingresar el detalle precione <i class="material-icons">&#xE89C;</i>.');
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
    public function edit($id)
    {
        $sql = Expense::find($id);
        return $sql->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fecha = trim($request -> input('fecha'));
        $encargado = trim($request -> input('encargado'));
        $detalle = trim($request -> input('detalle'));

        $rules=array(
            'fecha' => 'required',
            'encargado' => 'required',
            'detalle' => 'required'
        );
        $data=array(
            'fecha' => $fecha,
            'encargado' => $encargado,
            'detalle' => $detalle
        );
        $validator = \Validator::make($data, $rules);
        if ($validator->fails())
        {   
            return array('message'=>'Error de servidor.');
        }else{
            try{
                $sql = Expense::find($id);
                $sql -> fecha = date("Y-m-d",strtotime($fecha));
                $sql -> encargado = $encargado;
                $sql -> detalle = $detalle;
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
    public function destroy($id)
    {
        //
        $sql = Expense::find($id);
        $detail = DetailExpense::where('expense_id',$sql->id)->get();
        foreach ($detail as $value) {
            $sqlDetail = DetailExpense::find($value->id);
            $sqlDetail->delete();
        }
        $sql->delete();
        return redirect('expense')->with('message', 'Elimanado correctamente.');

    }

    public function pdf($id)
    {
        
        $nommesFech = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Ocutbre", "Noviembre", "Diciembre");
        

        $sql = Expense::with('detailExpense')->where('id',$id)->first();

        list($y,$w,$d)=explode("-", date('Y-m-d'));
        $titleDate = $d.' de '.$nommesFech[$w-1].' de '.$y;

        /*$html=' <table style="border:none" width="100%">
                    <thead>
                        <tr>
                            <th style="border:none;padding-bottom: 20px;" align="center">
                                <div style="font-weight: bold;text-align:center;font-size:15pt;">
                                    RENDICIÓN DE GASTOS
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th style="border:none" >Cochabamba, '.$titleDate.'</th>
                        </tr>
                        <tr>
                            <th style="border:none" >Encargado: '.$sql->encargado.'</th>
                        </tr>
                        <tr>
                            <th style="border:none" >Fecha de rendición: '.date("d-m-Y",strtotime($sql->fecha)).'</th>
                        </tr>
                        <tr>
                            <th style="border:none">Detalle/Evento/Actividad: '.$sql->detalle.'</th>
                        </tr>
                    </thead>
                </table>';*/
        $html='
            <table style="border:none;" align="center" width="100%">
                <thead>
                    <tr>
                        <th colspan="4" style="border:none;padding-bottom: 20px;" align="center">
                            <div style="font-weight: bold;text-align:center;font-size:15pt;">
                                RENDICIÓN DE GASTOS
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="4" style="border:none" >Cochabamba, '.$titleDate.'</th>
                    </tr>
                    <tr>
                        <th colspan="4" style="border:none" >Encargado: '.$sql->encargado.'</th>
                    </tr>
                    <tr>
                        <th colspan="4" style="border:none" >Fecha de rendición: '.date("d-m-Y",strtotime($sql->fecha)).'</th>
                    </tr>
                    <tr>
                        <th colspan="4" style="padding-bottom: 20px;border:none">Detalle/Evento/Actividad: '.$sql->detalle.'</th>
                    </tr>
                    <tr bgcolor="#E6E6E6">
                        <th width="5%" valign="middle" align="center">N°</th>
                        <th width="30%" valign="middle" align="center">CUENTA</th>
                        <th width="50%" valign="middle" align="center">DETALLE</th>
                        <th width="15%" valign="middle" align="center">TOTAL (Bs)</th>
                    </tr>
                </thead>
                <tbody>';
            $total=0;
            foreach ($sql->detailExpense as $key => $value) { 
                $total = $total + number_format($value->total,2,".","");
            $html.='<tr>
                        <td valign="middle" align="center">'.++$key.'</td>
                        <td valign="middle">'.$value->cuenta.'</td>
                        <td valign="middle">'.$value->detalle.'</td>
                        <td valign="middle" align="right">'.number_format($value->total,2,".","").'</td>
                    </tr>';
            }
        $html.='</tbody>
                <tfoot>
                    <tr bgcolor="#D7F8FF">
                        <td valign="middle" align="center" style="font-weight: bold;" colspan="3">TOTAL </td>
                        <td valign="middle" align="right" style="font-weight: bold;">'.$total.'</td>
                    </tr>
                </tfoot>
            </table>';


        $mpdf=new \mPDF('c','letter','','',20,15,28,25,5,10); 
        //$mpdf->showWatermarkImage = true;
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->list_indent_first_level = 0;
        $mpdf->SetHTMLHeader('
            <table width="100%" style="border:none; vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
                <tr>
                    <td width="33%" style="border:none;"><img alt="NextSofts" src="image/corazon_maria.png" width="70" height="100" /></td>
                    <td width="33%" align="center" style="border:none;"></td>
                    <td width="33%" style="border:none;text-align: right; "><img alt="NextSofts" src="image/nextsofts.jpg" height="90" /></td>
                </tr>
            </table>
        ');

        $mpdf->SetHTMLFooter('
            <table width="100%" style="border:none;vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
                <tr>
                    <td width="33%" style="border:none;"><span style="font-weight: bold; font-style: italic;">www.nextsofts.com</span></td>
                    <td width="33%" align="center" style="border:none;font-weight: bold; font-style: italic;">{PAGENO}/{nbpg}</td>
                    <td width="33%" style="border:none;text-align: right; ">Rendición de gastos</td>
                </tr>
            </table>

        ');
        $stylesheet = file_get_contents('assets/css/mpdf/mpdfstyletables.css');
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Reporte-Gastos-'.date('Ymd').'.pdf','I');
        exit;
    }
}
