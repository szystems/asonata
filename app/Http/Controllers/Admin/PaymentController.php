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
use App\Models\User;
use App\Http\Requests\PaymentFormRequest;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DateTimeZone;
use PDF;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentMail;

class PaymentController extends Controller
{

    protected $paginacion = 25;
    protected $campos = array('payments.*','atleta.*','cycles.*','class.*','categories.*','groups.*');

    public function index(Request $request)
    {
        if ($request)
        {
            $queryDesde=$request->input('fdesde');
            $queryHasta=$request->input('fhasta');
            $queryIN=$request->input('fin');
            $queryType=$request->input('ftype');
            $queryCui=$request->input('fcui');
            $queryCategory=$request->input('fcategory');
            $queryCycle=$request->input('fcycle');
            $queryGroup=$request->input('fgroup');
            $queryUser=$request->input('fuser');
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

            $payments = Payment::join('inscriptions', 'inscriptions.id', '=', 'payments.inscription_id')
            ->join('atleta', 'atleta.id', '=', 'inscriptions.atleta_id')
            ->join('cycles', 'cycles.id', '=', 'inscriptions.cycle_id')
            ->join('class', 'class.id', '=', 'inscriptions.class_id')
            ->join('categories', 'categories.id', '=', 'class.category_id')
            ->join('groups', 'groups.id', '=', 'categories.group_id')
            ->join('users', 'users.id', '=', 'payments.user_id')
            ->whereBetween('payments.created_at', [$queryDesde, $queryHasta])
            ->where('payments.type','LIKE',$queryType)
            ->where('inscriptions.inscription_number','LIKE',$queryIN)
            ->where('atleta.cui_dpi','LIKE',$queryCui)
            ->where('categories.id','LIKE',$queryCategory)
            ->where('groups.id','LIKE',$queryGroup)
            ->where('cycles.id','LIKE',$queryCycle)
            ->where('users.id','LIKE',$queryUser)
            ->orderBy('payments.id','desc')
            // ->get('payments.id','payments.inscription_id','payments.type','payments.paid','payments.created_at','payments.updated_at','inscriptions.class_id','inscriptions.cycle_id','inscriptions.atleta_id','inscriptions.inscription_number','atleta.cui_dpi','atleta.image','atleta.birth','atleta.gender','atleta.phone','atleta.whatsapp','atleta.email','cycles.name','cycles.start_date','cycles.end_date','class.cycle_id','class.category_id','class.schedule_id','class.instructor_id','cycle.start_date','cycle.end_date','cycle.inscription_payment','cycle.monthly_payment','cycle.badge','categories.group_id','categories.name','categories.age_from','categories.age_to','groups.name');
            // ->paginate($this->paginacion, $this->campos);
            ->get('payments.*','inscriptions.*','atleta.*','cycles.*','class.*','categories.*','groups.*');


            $total = 0;
            foreach ($payments as $sumaPagos) {
                $total = $total + $sumaPagos->paid;
            }


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
            $usersFilter = User::where('status',1)->where('role_as','!=',3)->orderBy('name','asc')->get();

            $config = Config::first();
            return view('admin.payment.index', compact('queryDesde','queryHasta','queryType','queryIN','queryCui','queryCycle','queryCategory','queryGroup','queryUser','payments','cyclesFilter','categoriesFilter','groupFilter','usersFilter','desde','hasta','config','total'));
        }
    }

    public function show($id)
    {
        $config = Config::first();
        $payment = Payment::join('inscriptions', 'inscriptions.id', '=', 'payments.inscription_id')
        ->join('atleta', 'atleta.id', '=', 'inscriptions.atleta_id')
        ->join('cycles', 'cycles.id', '=', 'inscriptions.cycle_id')
        ->join('class', 'class.id', '=', 'inscriptions.class_id')
        ->join('categories', 'categories.id', '=', 'class.category_id')
        ->join('groups', 'groups.id', '=', 'categories.group_id')
        ->where('payments.id',$id)

        // ->get('payments.id','payments.inscription_id','payments.type','payments.paid','payments.created_at','payments.updated_at','inscriptions.class_id','inscriptions.cycle_id','inscriptions.atleta_id','inscriptions.inscription_number','atleta.cui_dpi','atleta.image','atleta.birth','atleta.gender','atleta.phone','atleta.whatsapp','atleta.email','cycles.name','cycles.start_date','cycles.end_date','class.cycle_id','class.category_id','class.schedule_id','class.instructor_id','cycle.start_date','cycle.end_date','cycle.inscription_payment','cycle.monthly_payment','cycle.badge','categories.group_id','categories.name','categories.age_from','categories.age_to','groups.name');
        ->first('payments.*','atleta. *','cycles.*','class.*','categories.*','groups.*');
        return view('admin.payment.show', compact('payment','config'));
    }

    public function pdf(Request $request)
    {
        if ($request)
        {
            $queryDesde=$request->input('fdesde');
            $queryHasta=$request->input('fhasta');
            $queryIN=$request->input('fin');
            $queryType=$request->input('ftype');
            $queryCui=$request->input('fcui');
            $queryCategory=$request->input('fcategory');
            $queryCycle=$request->input('fcycle');
            $queryGroup=$request->input('fgroup');
            $queryUser=$request->input('fuser');
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
            $payments = Payment::join('inscriptions', 'inscriptions.id', '=', 'payments.inscription_id')
            ->join('atleta', 'atleta.id', '=', 'inscriptions.atleta_id')
            ->join('cycles', 'cycles.id', '=', 'inscriptions.cycle_id')
            ->join('class', 'class.id', '=', 'inscriptions.class_id')
            ->join('categories', 'categories.id', '=', 'class.category_id')
            ->join('groups', 'groups.id', '=', 'categories.group_id')
            ->join('users', 'users.id', '=', 'payments.user_id')
            ->whereBetween('payments.created_at', [$queryDesde, $queryHasta])
            ->where('payments.type','LIKE',$queryType)
            ->where('inscriptions.inscription_number','LIKE',$queryIN)
            ->where('atleta.cui_dpi','LIKE',$queryCui)
            ->where('categories.id','LIKE',$queryCategory)
            ->where('groups.id','LIKE',$queryGroup)
            ->where('cycles.id','LIKE',$queryCycle)
            ->where('users.id','LIKE',$queryUser)
            ->orderBy('payments.id','desc')
            // ->get('payments.id','payments.inscription_id','payments.type','payments.paid','payments.created_at','payments.updated_at','inscriptions.class_id','inscriptions.cycle_id','inscriptions.atleta_id','inscriptions.inscription_number','atleta.cui_dpi','atleta.image','atleta.birth','atleta.gender','atleta.phone','atleta.whatsapp','atleta.email','cycles.name','cycles.start_date','cycles.end_date','class.cycle_id','class.category_id','class.schedule_id','class.instructor_id','cycle.start_date','cycle.end_date','cycle.inscription_payment','cycle.monthly_payment','cycle.badge','categories.group_id','categories.name','categories.age_from','categories.age_to','groups.name');
            // ->paginate($this->paginacion, $this->campos);
            ->get('payments.*','inscription.*','atleta.*','cycles.*','class.id','categories.*','groups.*');


            $total = 0;
            foreach ($payments as $sumaPagos) {
                $total = $total + $sumaPagos->paid;
            }


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
            $usersFilter = User::where('status',1)->where('role_as','!=',3)->orderBy('name','asc')->get();

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
                $pdf = PDF::loadView('admin.payment.pdf', compact('imagen','queryDesde','queryHasta','queryType','queryIN','queryCui','queryCycle','queryCategory','queryGroup','queryUser','payments','cyclesFilter','categoriesFilter','groupFilter','usersFilter','desde','hasta','config','total'));

                return $pdf->download ('Reporte Pagos: '.$nompdf.'.pdf');
            }
            if ( $verpdf == "Browser" )
            {
                $pdf = PDF::loadView('admin.payment.pdf', compact('imagen','queryDesde','queryHasta','queryType','queryIN','queryCui','queryCycle','queryCategory','queryGroup','queryUser','payments','cyclesFilter','categoriesFilter','groupFilter','usersFilter','desde','hasta','config','total'));

                return $pdf->stream ('Reporte Pagos: '.$nompdf.'.pdf');
            }
        }
    }

    public function addpayment(PaymentFormRequest $request)
    {
        $payment = new Payment();
        $payment->inscription_id =$request->input('inscription_id');
        $payment->type = $request->input('type');
        $payment->paid = $request->input('paid');
        $payment->note = $request->input('note');
        $payment->user_id = $request->input('user_id');
        $payment->save();

        $inscription = Inscription::find($request->input('inscription_id'));
        $atleta = Atleta::find($inscription->atleta_id);
        $idclass = $inscription->class_id;

        Mail::to($atleta->email)->send(new PaymentMail($inscription));
        Mail::to($atleta->responsible_email)->send(new PaymentMail($inscription));

        return redirect('inscriptions')->with('status', __('Payment Added Successfully'));
    }

    public function pdfpayment(Request $request)
    {
        if ($request)
        {
            $config = Config::first();
            $payment = Payment::join('inscriptions', 'inscriptions.id', '=', 'payments.inscription_id')
            ->join('atleta', 'atleta.id', '=', 'inscriptions.atleta_id')
            ->join('cycles', 'cycles.id', '=', 'inscriptions.cycle_id')
            ->join('class', 'class.id', '=', 'inscriptions.class_id')
            ->join('categories', 'categories.id', '=', 'class.category_id')
            ->join('groups', 'groups.id', '=', 'categories.group_id')
            ->where('payments.id',$request->input('rid'))

            // ->get('payments.id','payments.inscription_id','payments.type','payments.paid','payments.created_at','payments.updated_at','inscriptions.class_id','inscriptions.cycle_id','inscriptions.atleta_id','inscriptions.inscription_number','atleta.cui_dpi','atleta.image','atleta.birth','atleta.gender','atleta.phone','atleta.whatsapp','atleta.email','cycles.name','cycles.start_date','cycles.end_date','class.cycle_id','class.category_id','class.schedule_id','class.instructor_id','cycle.start_date','cycle.end_date','cycle.inscription_payment','cycle.monthly_payment','cycle.badge','categories.group_id','categories.name','categories.age_from','categories.age_to','groups.name');
            ->first('payments.*','atleta*','cycles.*','class.*','categories.*','groups.*');

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

            if ( $verpdf == "Download" )
            {
                $pdf = PDF::loadView('admin.payment.pdfpayment', compact('imagen','payment','config'));

                return $pdf->download ('Reporte Pago: '.$nompdf.'.pdf');
            }
            if ( $verpdf == "Browser" )
            {
                $pdf = PDF::loadView('admin.payment.pdfpayment', compact('imagen','payment','config'));

                return $pdf->stream ('Reporte Pago: '.$nompdf.'.pdf');
            }
        }
    }
}
