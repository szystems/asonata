<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Config;
use App\Models\Classs;
use App\Models\Cycle;
use App\Models\Atleta;
use App\Models\Assist;
use App\Models\Attendance;
use App\Models\Inscription;
use App\Models\Payment;
use PDF;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class FrontendController extends Controller
{
    public function index()
    {
        $config = Config::first();
        return view('frontend.index', compact('config'));
    }

    public function aboutus()
    {
        $config = Config::first();
        return view('frontend.aboutus', compact('config'));
    }

    public function contact()
    {
        $config = Config::first();
        return view('frontend.contact', compact('config'));
    }

    public function sendcontactemail(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $subject = $request->input('subject');
        $mensaje = $request->input('mensaje');

        $config = Config::first();

        Mail::to($config->email)->send(new ContactMail($name, $email, $phone, $subject, $mensaje));

        $request->session()->flash('alert-success', "Tu mensaje se ha enviado, muchas gracias por comunicarte con Asonata Xela");

        return view('frontend.contact', compact('config'));
    }

    public function queries(Request $request)
    {
        return view('frontend.queries.index');
    }

    public function queryinscription(Request $request)
    {
        $inscription=DB::table('inscriptions')
        ->where('inscription_number',$request->input('inscription_number'))
        ->first();
        if ($inscription != null) {
            $atleta = Atleta::find($inscription->atleta_id);
            $idclass = $inscription->class_id;
            $config = Config::first();

            $class=DB::table('class as cl')
            ->join('cycles as c','cl.cycle_id','=','c.id')
            ->join('categories as cat','cl.category_id','=','cat.id')
            ->join('groups as g','cat.group_id','=','g.id')
            ->join('schedule as s','cl.schedule_id','=','s.id')
            ->join('facilities as f','s.facility_id','=','f.id')
            ->join('users as i','cl.instructor_id','=','i.id')
            ->select('cl.id','cl.cycle_id as CLcycle_id','cl.category_id as CLcategory_id','cl.schedule_id as CLschedule_id','cl.instructor_id as CLinstructor_id','cl.start_date as CLstart_date','cl.end_date as CLend_date','cl.notes as CLnotes','cl.monthly_payment as CLmonthly_payment','cl.inscription_payment as CLinscription_payment','cl.badge as CLbadge','c.name as CYid','c.start_date as CYstart_date','c.end_date as CYend_date','c.description as CYdescription','c.status as CYstatus','g.name as Gname','g.description as Gdescription','g.image as Gimage','g.status as Gstatus','cat.name as Cname','cat.age_from','cat.age_to','cat.description as Cdescription','cat.image as Cimage','cat.status as Cstatus','cat.requirements as Crequirements','cat.implements as Cimplements','s.facility_id','s.start_time as Sstart_time','s.end_time as Send_time','s.sunday','s.monday','s.tuesday','s.wednesday','s.thursday','s.friday','s.saturday','s.quota','f.name as Fname','f.description as Fdescription','f.location','f.image as Fimage','f.status as Fstatus','i.name as Iname','i.email','i.phone','i.whatsapp')
            ->where('cl.id',$idclass)
            ->first();

            return view('frontend.inscription.inscriptionform', compact('atleta','class','config','inscription'));
        } else {
            $request->session()->flash('alert-danger', __('Inscription not found, please try again'));
            return view('frontend.queries.index');
        }
    }

    public function querypayments(Request $request)
    {
        $inscription=DB::table('inscriptions')
        ->where('inscription_number',$request->input('inscription_number'))
        ->first();

        if ($inscription != null) {
            $atleta = Atleta::find($inscription->atleta_id);
            $idclass = $inscription->class_id;

            $class=DB::table('class as cl')
            ->join('cycles as c','cl.cycle_id','=','c.id')
            ->join('categories as cat','cl.category_id','=','cat.id')
            ->join('groups as g','cat.group_id','=','g.id')
            ->join('schedule as s','cl.schedule_id','=','s.id')
            ->join('facilities as f','s.facility_id','=','f.id')
            ->join('users as i','cl.instructor_id','=','i.id')
            ->select('cl.id','cl.cycle_id as CLcycle_id','cl.category_id as CLcategory_id','cl.schedule_id as CLschedule_id','cl.instructor_id as CLinstructor_id','cl.start_date as CLstart_date','cl.end_date as CLend_date','cl.notes as CLnotes','cl.monthly_payment as CLmonthly_payment','cl.inscription_payment as CLinscription_payment','cl.badge as CLbadge','c.name as CYid','c.start_date as CYstart_date','c.end_date as CYend_date','c.description as CYdescription','c.status as CYstatus','g.name as Gname','g.description as Gdescription','g.image as Gimage','g.status as Gstatus','cat.name as Cname','cat.age_from','cat.age_to','cat.description as Cdescription','cat.image as Cimage','cat.status as Cstatus','cat.requirements as Crequirements','cat.implements as Cimplements','s.facility_id','s.start_time as Sstart_time','s.end_time as Send_time','s.sunday','s.monday','s.tuesday','s.wednesday','s.thursday','s.friday','s.saturday','s.quota','f.name as Fname','f.description as Fdescription','f.location','f.image as Fimage','f.status as Fstatus','i.name as Iname','i.email','i.phone','i.whatsapp')
            ->where('cl.id',$idclass)
            ->first();

            $payments = Payment::join('inscriptions', 'inscriptions.id', '=', 'payments.inscription_id')
            ->join('atleta', 'atleta.id', '=', 'inscriptions.atleta_id')
            ->join('cycles', 'cycles.id', '=', 'inscriptions.cycle_id')
            ->join('class', 'class.id', '=', 'inscriptions.class_id')
            ->join('categories', 'categories.id', '=', 'class.category_id')
            ->join('groups', 'groups.id', '=', 'categories.group_id')
            ->where('payments.inscription_id',$inscription->id)
            ->orderBy('payments.created_at','desc')
            // ->get('payments.id','payments.inscription_id','payments.type','payments.paid','payments.created_at','payments.updated_at','inscriptions.class_id','inscriptions.cycle_id','inscriptions.atleta_id','inscriptions.inscription_number','atleta.cui_dpi','atleta.image','atleta.birth','atleta.gender','atleta.phone','atleta.whatsapp','atleta.email','cycles.name','cycles.start_date','cycles.end_date','class.cycle_id','class.category_id','class.schedule_id','class.instructor_id','cycle.start_date','cycle.end_date','cycle.inscription_payment','cycle.monthly_payment','cycle.badge','categories.group_id','categories.name','categories.age_from','categories.age_to','groups.name');
            ->get('payments.*','atleta.*','cycles.*','class.*','categories.*','groups.*');


            $total = 0;
            foreach ($payments as $sumaPagos) {
                $total = $total + $sumaPagos->paid;
            }

            $assists = Assist::where('class_id',$class->id)->get();

            $config = Config::first();
            return view('frontend.inscription.paymentsinscription', compact('inscription','payments','config','total','atleta','idclass','class','assists'));
        } else {
            $request->session()->flash('alert-danger', __('Inscription not found, please try again'));
            return view('frontend.queries.index');
        }
    }

    public function pdfinscriptionpayments(Request $request)
    {
        if ($request)
        {
            $inscription=DB::table('inscriptions')
            ->where('inscription_number',$request->input('inscription_number'))
            ->first();

            if ($inscription != null) {
                $atleta = Atleta::find($inscription->atleta_id);
                $idclass = $inscription->class_id;

                $class=DB::table('class as cl')
                ->join('cycles as c','cl.cycle_id','=','c.id')
                ->join('categories as cat','cl.category_id','=','cat.id')
                ->join('groups as g','cat.group_id','=','g.id')
                ->join('schedule as s','cl.schedule_id','=','s.id')
                ->join('facilities as f','s.facility_id','=','f.id')
                ->join('users as i','cl.instructor_id','=','i.id')
                ->select('cl.id','cl.cycle_id as CLcycle_id','cl.category_id as CLcategory_id','cl.schedule_id as CLschedule_id','cl.instructor_id as CLinstructor_id','cl.start_date as CLstart_date','cl.end_date as CLend_date','cl.notes as CLnotes','cl.monthly_payment as CLmonthly_payment','cl.inscription_payment as CLinscription_payment','cl.badge as CLbadge','c.name as CYid','c.start_date as CYstart_date','c.end_date as CYend_date','c.description as CYdescription','c.status as CYstatus','g.name as Gname','g.description as Gdescription','g.image as Gimage','g.status as Gstatus','cat.name as Cname','cat.age_from','cat.age_to','cat.description as Cdescription','cat.image as Cimage','cat.status as Cstatus','cat.requirements as Crequirements','cat.implements as Cimplements','s.facility_id','s.start_time as Sstart_time','s.end_time as Send_time','s.sunday','s.monday','s.tuesday','s.wednesday','s.thursday','s.friday','s.saturday','s.quota','f.name as Fname','f.description as Fdescription','f.location','f.image as Fimage','f.status as Fstatus','i.name as Iname','i.email','i.phone','i.whatsapp')
                ->where('cl.id',$idclass)
                ->first();

                $payments = Payment::join('inscriptions', 'inscriptions.id', '=', 'payments.inscription_id')
                ->join('atleta', 'atleta.id', '=', 'inscriptions.atleta_id')
                ->join('cycles', 'cycles.id', '=', 'inscriptions.cycle_id')
                ->join('class', 'class.id', '=', 'inscriptions.class_id')
                ->join('categories', 'categories.id', '=', 'class.category_id')
                ->join('groups', 'groups.id', '=', 'categories.group_id')
                ->where('payments.inscription_id',$inscription->id)
                ->orderBy('payments.created_at','desc')
                // ->get('payments.id','payments.inscription_id','payments.type','payments.paid','payments.created_at','payments.updated_at','inscriptions.class_id','inscriptions.cycle_id','inscriptions.atleta_id','inscriptions.inscription_number','atleta.cui_dpi','atleta.image','atleta.birth','atleta.gender','atleta.phone','atleta.whatsapp','atleta.email','cycles.name','cycles.start_date','cycles.end_date','class.cycle_id','class.category_id','class.schedule_id','class.instructor_id','cycle.start_date','cycle.end_date','cycle.inscription_payment','cycle.monthly_payment','cycle.badge','categories.group_id','categories.name','categories.age_from','categories.age_to','groups.name');
                ->get('payments.*','atleta.*','cycles.*','class.*','categories.*','groups.*');

                $total = 0;
                foreach ($payments as $sumaPagos) {
                    $total = $total + $sumaPagos->paid;
                }

                $assists = Assist::where('class_id',$class->id)->get();

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
                    $pdf = PDF::loadView('frontend.queries.pdfpayments',['atleta'=>$atleta,'idclass'=>$idclass,'inscription'=>$inscription,'class'=>$class,'payments'=>$payments,'assists'=>$assists,'total'=>$total,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency]);

                    return $pdf->download ($inscription->inscription_number.$nompdf.'.pdf');
                }
                if ( $verpdf == "Browser" )
                {
                    $pdf = PDF::loadView('frontend.queries.pdfpayments',['atleta'=>$atleta,'idclass'=>$idclass,'inscription'=>$inscription,'class'=>$class,'payments'=>$payments,'assists'=>$assists,'total'=>$total,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency]);

                    return $pdf->stream ($inscription->inscription_number.$nompdf.'.pdf');
                }
            }
        }
    }
}
