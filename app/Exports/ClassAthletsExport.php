<?php

namespace App\Exports;

use App\Models\Classs;
use App\Models\Inscription;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use PhpOffice\PhpSpreadsheet\Shared\XMLWriter;

use Illuminate\Support\Facades\Auth;

use DateTime;
use DateTimeZone;

class ClassAthletsExport implements FromView
{
    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }



    public function view(): View
    {
        $class = Classs::find($this->request->input('fclass'));
        $inscritos = Inscription::join('class', 'class.id', '=', 'inscriptions.class_id')
        ->join('atleta', 'atleta.id', '=', 'inscriptions.atleta_id')
        ->where('inscriptions.class_id',$this->request->input('fclass'))
        ->where('inscriptions.status','1')
        ->where('inscriptions.inscription_status','1')
        ->orderBy('atleta.name','asc')
        ->get('inscriptions.*','class.*');

        $nompdf = date('m/d/Y g:ia');
        //dd($class);
        // Retornar la vista blade con los request
        return view('admin.class.exportclassathlets', [
            'inscritos' => $inscritos,
            'class' => $class,
        ]);
    }
}
