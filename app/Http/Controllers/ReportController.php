<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Estagio;
use App\Models\Parecerista;
use Carbon\Carbon;

class ReportController extends Controller
{
    private $cursos;

    public function __construct(Estagio $estagio){
        $this->cursos = $estagio->nomcurOptions();

    }

    public function index(){
        $this->authorize('admin');

        return view('reports.index')->with([
            'cursos' => $this->cursos,
            'pareceristas' => Parecerista::all(),
        ]);
    }

    public function report(Request $request){
        $this->authorize('admin');

        $request->validate([   //form request
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $start_date = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');

        $estagios = Estagio::whereBetween('data_final', [$start_date, $end_date])->orderBy('data_final', 'asc');

        if($request->curso) {
            $estagios = $estagios->where('nomcur',$request->curso);
        }

        if ($request->empresa) {
            $estagios = $estagios->whereHas('empresa', function ($query) use ($request) {
                $query->where('nome', 'like', '%' . $request->empresa . '%');
            });
        }

        if($request->numparecerista) {
            $estagios = $estagios->where('numparecerista',$request->numparecerista);
        }

        if($request->cargahoras) {
            $estagios = $estagios->where('cargahoras',$request->cargahoras);
        }

        return view('reports.index')->with([
            'cursos' => $this->cursos,
            'pareceristas' => Parecerista::all(),
            'estagios' => $estagios->paginate()
        ]);
    }
}
