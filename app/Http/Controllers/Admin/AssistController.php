<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Cycle;
use App\Models\Classs;
use App\Models\Category;
use App\Models\Group;
use App\Models\Inscription;
use App\Models\Atleta;
use App\Models\Config;
use App\Models\Assist;
use App\Models\Attendance;
use App\Http\Requests\PaymentFormRequest;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DateTimeZone;
use PDF;
use DB;

class AssistController extends Controller
{
    public function index(Request $request)
    {
        if ($request)
        {
            $queryDesde=$request->input('fdesde');
            $queryHasta=$request->input('fhasta');
            $queryCui=$request->input('fcui');
            $queryCategory=$request->input('fcategory');
            $queryCycle=$request->input('fcycle');
            $queryGroup=$request->input('fgroup');
            // $payments=Payment::all();

            if ($queryDesde != "" or $queryHasta != "") {


                $queryDesde = date("Y-m-d 00:00:00", strtotime($queryDesde));
                $queryHasta = date("Y-m-d 23:59:59", strtotime($queryHasta));

            }else
            {

                //$queryDesde = Payment::min('created_at');
                $queryHasta = Payment::max('created_at');

                $queryDesde = date("Y-m-d 00:00:00", strtotime($queryHasta.'- 1 month'));
                $queryHasta = date("Y-m-d 23:59:59", strtotime($queryHasta));
            }

            $attendances = Attendance::join('assists', 'assists.id', '=', 'attendances.assist_id')
            ->join('class', 'class.id', '=', 'assists.class_id')
            ->join('categories', 'categories.id', '=', 'class.category_id')
            ->join('groups', 'groups.id', '=', 'categories.group_id')
            ->join('cycles', 'cycles.id', '=', 'class.cycle_id')
            ->join('atleta', 'atleta.id', '=', 'attendances.atleta_id')
            ->whereBetween('attendances.created_at', [$queryDesde, $queryHasta])
            ->where('atleta.cui_dpi','LIKE',$queryCui)
            ->where('class.category_id','LIKE',$queryCategory)
            ->where('groups.id','LIKE',$queryGroup)
            ->where('cycles.id','LIKE',$queryCycle)
            ->orderBy('attendances.created_at','asc')
            ->get('attendances.*','asissts.*','class.*','cycles.*');

            $presentes = Attendance::join('assists', 'assists.id', '=', 'attendances.assist_id')
            ->join('class', 'class.id', '=', 'assists.class_id')
            ->join('categories', 'categories.id', '=', 'class.category_id')
            ->join('groups', 'groups.id', '=', 'categories.group_id')
            ->join('cycles', 'cycles.id', '=', 'class.cycle_id')
            ->join('atleta', 'atleta.id', '=', 'attendances.atleta_id')
            ->whereBetween('attendances.created_at', [$queryDesde, $queryHasta])
            ->where('atleta.cui_dpi','LIKE',$queryCui)
            ->where('class.category_id','LIKE',$queryCategory)
            ->where('groups.id','LIKE',$queryGroup)
            ->where('cycles.id','LIKE',$queryCycle)
            ->where('attendances.status',1)->orderBy('attendances.created_at','asc')
            ->get();

            $noPresentes = Attendance::join('assists', 'assists.id', '=', 'attendances.assist_id')
            ->join('class', 'class.id', '=', 'assists.class_id')
            ->join('categories', 'categories.id', '=', 'class.category_id')
            ->join('groups', 'groups.id', '=', 'categories.group_id')
            ->join('cycles', 'cycles.id', '=', 'class.cycle_id')
            ->join('atleta', 'atleta.id', '=', 'attendances.atleta_id')
            ->whereBetween('attendances.created_at', [$queryDesde, $queryHasta])
            ->where('atleta.cui_dpi','LIKE',$queryCui)
            ->where('class.category_id','LIKE',$queryCategory)
            ->where('groups.id','LIKE',$queryGroup)
            ->where('cycles.id','LIKE',$queryCycle)
            ->where('attendances.status',0)->orderBy('attendances.created_at','asc')
            ->get();


            $queryDesde = new DateTime($queryDesde, new DateTimeZone(date_default_timezone_get()));
            $queryDesde->setTimezone(new DateTimeZone(Auth::user()->timezone));

            $queryHasta = new DateTime($queryHasta, new DateTimeZone(date_default_timezone_get()));
            $queryHasta->setTimezone(new DateTimeZone(Auth::user()->timezone));

            $desde = $queryDesde->format("d-m-Y");
            $hasta = $queryHasta->format("d-m-Y");

            $queryDesde = $queryDesde->format("Y-m-d H:i:s");
            $queryHasta = $queryHasta->format("Y-m-d H:i:s");

            $cyclesFilter = Cycle::where('status',1)->get();
            $categoriesFilter = Category::where('status',1)->orderBy('name','asc')->get();
            $groupFilter = Group::where('status',1)->orderBy('name','asc')->get();

            $config = Config::first();
            // return view('admin.payment.index', compact('queryDesde','queryHasta','queryType','queryIN','queryCui','queryCycle','queryCategory','queryGroup','payments','cyclesFilter','categoriesFilter','groupFilter','desde','hasta','config','total'));
            return view('admin.assist.index', compact('queryDesde','queryHasta','queryCui','queryCycle','queryCategory','queryGroup','attendances','presentes','noPresentes','cyclesFilter','categoriesFilter','groupFilter','desde','hasta','config'));
        }
    }

    public function pdf(Request $request)
    {
        if ($request)
        {
            $queryDesde=$request->input('fdesde');
            $queryHasta=$request->input('fhasta');
            $queryCui=$request->input('fcui');
            $queryCategory=$request->input('fcategory');
            $queryCycle=$request->input('fcycle');
            $queryGroup=$request->input('fgroup');
            // $payments=Payment::all();

            if ($queryDesde != "" or $queryHasta != "") {


                $queryDesde = date("Y-m-d 00:00:00", strtotime($queryDesde));
                $queryHasta = date("Y-m-d 23:59:59", strtotime($queryHasta));

            }else
            {

                //$queryDesde = Payment::min('created_at');
                $queryHasta = Payment::max('created_at');

                $queryDesde = date("Y-m-d 00:00:00", strtotime($queryHasta.'- 1 month'));
                $queryHasta = date("Y-m-d 23:59:59", strtotime($queryHasta));
            }

            $attendances = Attendance::join('assists', 'assists.id', '=', 'attendances.assist_id')
            ->join('class', 'class.id', '=', 'assists.class_id')
            ->join('categories', 'categories.id', '=', 'class.category_id')
            ->join('groups', 'groups.id', '=', 'categories.group_id')
            ->join('cycles', 'cycles.id', '=', 'class.cycle_id')
            ->join('atleta', 'atleta.id', '=', 'attendances.atleta_id')
            ->whereBetween('attendances.created_at', [$queryDesde, $queryHasta])
            ->where('atleta.cui_dpi','LIKE',$queryCui)
            ->where('class.category_id','LIKE',$queryCategory)
            ->where('groups.id','LIKE',$queryGroup)
            ->where('cycles.id','LIKE',$queryCycle)
            ->orderBy('attendances.created_at','asc')
            ->get('attendances.*','asissts.*','class.*','cycles.*');

            $presentes = Attendance::join('assists', 'assists.id', '=', 'attendances.assist_id')
            ->join('class', 'class.id', '=', 'assists.class_id')
            ->join('categories', 'categories.id', '=', 'class.category_id')
            ->join('groups', 'groups.id', '=', 'categories.group_id')
            ->join('cycles', 'cycles.id', '=', 'class.cycle_id')
            ->join('atleta', 'atleta.id', '=', 'attendances.atleta_id')
            ->whereBetween('attendances.created_at', [$queryDesde, $queryHasta])
            ->where('atleta.cui_dpi','LIKE',$queryCui)
            ->where('class.category_id','LIKE',$queryCategory)
            ->where('groups.id','LIKE',$queryGroup)
            ->where('cycles.id','LIKE',$queryCycle)
            ->where('attendances.status',1)->orderBy('attendances.created_at','asc')
            ->get();

            $noPresentes = Attendance::join('assists', 'assists.id', '=', 'attendances.assist_id')
            ->join('class', 'class.id', '=', 'assists.class_id')
            ->join('categories', 'categories.id', '=', 'class.category_id')
            ->join('groups', 'groups.id', '=', 'categories.group_id')
            ->join('cycles', 'cycles.id', '=', 'class.cycle_id')
            ->join('atleta', 'atleta.id', '=', 'attendances.atleta_id')
            ->whereBetween('attendances.created_at', [$queryDesde, $queryHasta])
            ->where('atleta.cui_dpi','LIKE',$queryCui)
            ->where('class.category_id','LIKE',$queryCategory)
            ->where('groups.id','LIKE',$queryGroup)
            ->where('cycles.id','LIKE',$queryCycle)
            ->where('attendances.status',0)->orderBy('attendances.created_at','asc')
            ->get();


            $queryDesde = new DateTime($queryDesde, new DateTimeZone(date_default_timezone_get()));
            $queryDesde->setTimezone(new DateTimeZone(Auth::user()->timezone));

            $queryHasta = new DateTime($queryHasta, new DateTimeZone(date_default_timezone_get()));
            $queryHasta->setTimezone(new DateTimeZone(Auth::user()->timezone));

            $desde = $queryDesde->format("d-m-Y");
            $hasta = $queryHasta->format("d-m-Y");

            $queryDesde = $queryDesde->format("Y-m-d H:i:s");
            $queryHasta = $queryHasta->format("Y-m-d H:i:s");

            $cyclesFilter = Cycle::where('status',1)->get();
            $categoriesFilter = Category::where('status',1)->orderBy('name','asc')->get();
            $groupFilter = Group::where('status',1)->orderBy('name','asc')->get();

            $verpdf = "Browser";
            $nompdf = date('m/d/Y g:ia');
            $path = public_path('assets/uploads/');

            $config = Config::first();

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

            if ( $verpdf == "Download" )
            {
                $pdf = PDF::loadView('admin.assist.pdf', compact('imagen','queryDesde','queryHasta','queryCui','queryCycle','queryCategory','queryGroup','attendances','presentes','noPresentes','cyclesFilter','categoriesFilter','groupFilter','desde','hasta','hasta','config'));

                return $pdf->download ('Reporte asistencias: '.$nompdf.'.pdf');
            }
            if ( $verpdf == "Browser" )
            {
                $pdf = PDF::loadView('admin.assist.pdf', compact('imagen','queryDesde','queryHasta','queryCui','queryCycle','queryCategory','queryGroup','attendances','presentes','noPresentes','cyclesFilter','categoriesFilter','groupFilter','desde','hasta','hasta','config'));

                return $pdf->stream ('Reporte asistencias: '.$nompdf.'.pdf');
            }
        }
    }
}
