<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Config;
use App\Models\Payment;
use App\Models\Inscription;
use DB;
use PDF;

class FrontendController extends Controller
{
    public function index()
    {
        $config = Config::first();

        $activeInscriptions = Inscription::where('status',1)
        ->where('inscription_status',1)
        ->where('payments','!=',null)
        ->orderBy('created_at','desc')
        ->get();

        $today = date("Y-m-d");

        $activeInscriptionsCycle = Inscription::join('cycles', 'cycles.id', 'inscriptions.cycle_id')
        ->where('cycles.start_date','<=',$today)
        ->where('cycles.end_date','>=',$today)
        ->where('inscriptions.status',1)
        ->where('inscriptions.inscription_status',1)
        ->where('inscriptions.payments','!=',null)
        ->orderBy('inscriptions.created_at','desc')
        ->get('inscriptions.*','cycles.*');

        $activeInscriptionsCycleInstructor = Inscription::join('cycles', 'cycles.id', 'inscriptions.cycle_id')
        ->join('class', 'class.id', 'inscriptions.class_id')
        ->join('users', 'users.id', 'class.instructor_id')
        ->where('cycles.start_date','<=',$today)
        ->where('cycles.end_date','>=',$today)
        ->where('inscriptions.status',1)
        ->where('inscriptions.inscription_status',1)
        ->where('inscriptions.payments','!=',null)
        ->orderBy('class.id','desc')
        ->get('inscriptions.*','cycles.*','class.*','users.*');

        $pendingInscriptions = Inscription::join('cycles', 'cycles.id', 'inscriptions.cycle_id')
        ->join('class', 'class.id', 'inscriptions.class_id')
        ->join('users', 'users.id', 'class.instructor_id')
        ->where('inscriptions.status',1)
        ->where('inscriptions.inscription_status',0)
        ->orderBy('class.id','desc')
        ->get('inscriptions.*','cycles.*','class.*','users.*');

        return view('admin.index', compact('config','activeInscriptions','activeInscriptionsCycle','activeInscriptionsCycleInstructor','pendingInscriptions'));
    }

    public function pdfalertpayments(Request $request)
    {
        if ($request)
        {
            $activeInscriptions = Inscription::where('status',1)
            ->where('inscription_status',1)
            ->where('payments','!=',null)
            ->orderBy('created_at','desc')
            ->get();

            $config = Config::first();

            $verpdf = "Browser";
            $nompdf = date('m/d/Y g:ia');
            $path = public_path('assets/uploads/');

            $currency = $config->currency_simbol;

            if ($config->logo == null)
            {
                $logo = null;
                $imagen = null;
            }
            else
            {
                    $logo = $config->logo;
                    $imagen = public_path('assets/uploads/logos/'.$logo);
            }


            $config = Config::first();

            if ( $verpdf == "Download" )
            {
                $pdf = PDF::loadView('admin.pdfpaymentsalert', compact('imagen','config','activeInscriptions'));

                return $pdf->download ('Alertas de Pago '.$nompdf.'.pdf');
            }
            if ( $verpdf == "Browser" )
            {
                $pdf = PDF::loadView('admin.pdfpaymentsalert', compact('imagen','config','activeInscriptions'));

                return $pdf->stream ('Alertas de Pagos '.$nompdf.'.pdf');
            }
        }
    }

    public function pdfassistsalertinstructor(Request $request)
    {
        if ($request)
        {
            $today = date("Y-m-d");

            $activeInscriptionsCycleInstructor = Inscription::join('cycles', 'cycles.id', 'inscriptions.cycle_id')
            ->join('class', 'class.id', 'inscriptions.class_id')
            ->join('users', 'users.id', 'class.instructor_id')
            ->where('cycles.start_date','<=',$today)
            ->where('cycles.end_date','>=',$today)
            ->where('inscriptions.status',1)
            ->where('inscriptions.inscription_status',1)
            ->where('inscriptions.payments','!=',null)
            ->orderBy('inscriptions.created_at','desc')
            ->get('inscriptions.*','cycles.*','class.*','users.*');

            $config = Config::first();

            $verpdf = "Browser";
            $nompdf = date('m/d/Y g:ia');
            $path = public_path('assets/uploads/');

            $currency = $config->currency_simbol;

            if ($config->logo == null)
            {
                $logo = null;
                $imagen = null;
            }
            else
            {
                    $logo = $config->logo;
                    $imagen = public_path('assets/uploads/logos/'.$logo);
            }


            $config = Config::first();

            if ( $verpdf == "Download" )
            {
                $pdf = PDF::loadView('admin.pdfassistsalertinstructor', compact('imagen','config','activeInscriptionsCycleInstructor'));
                $pdf->setPaper('A4', 'landscape');
                return $pdf->download ('Alertas de Asistencias '.$nompdf.'.pdf');
            }
            if ( $verpdf == "Browser" )
            {
                $pdf = PDF::loadView('admin.pdfassistsalertinstructor', compact('imagen','config','activeInscriptionsCycleInstructor'));
                $pdf->setPaper('A4', 'landscape');
                return $pdf->stream ('Alertas de Asistencias '.$nompdf.'.pdf');
            }
        }
    }

    public function pdfassistsalert(Request $request)
    {
        if ($request)
        {
            $today = date("Y-m-d");

            $activeInscriptionsCycle = Inscription::join('cycles', 'cycles.id', 'inscriptions.cycle_id')
            ->where('cycles.start_date','<=',$today)
            ->where('cycles.end_date','>=',$today)
            ->where('inscriptions.status',1)
            ->where('inscriptions.inscription_status',1)
            ->where('inscriptions.payments','!=',null)
            ->orderBy('inscriptions.created_at','desc')
            ->get('inscriptions.*','cycles.*');

            $config = Config::first();

            $verpdf = "Browser";
            $nompdf = date('m/d/Y g:ia');
            $path = public_path('assets/uploads/');

            $currency = $config->currency_simbol;

            if ($config->logo == null)
            {
                $logo = null;
                $imagen = null;
            }
            else
            {
                    $logo = $config->logo;
                    $imagen = public_path('assets/uploads/logos/'.$logo);
            }


            $config = Config::first();

            if ( $verpdf == "Download" )
            {
                $pdf = PDF::loadView('admin.pdfassistsalert', compact('imagen','config','activeInscriptionsCycle'));
                return $pdf->download ('Alertas de Asistencias '.$nompdf.'.pdf');
            }
            if ( $verpdf == "Browser" )
            {
                $pdf = PDF::loadView('admin.pdfassistsalert', compact('imagen','config','activeInscriptionsCycle'));
                return $pdf->stream ('Alertas de Asistencias '.$nompdf.'.pdf');
            }
        }
    }
}
