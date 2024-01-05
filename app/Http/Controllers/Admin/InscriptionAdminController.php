<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Config;
use App\Models\Classs;
use App\Models\Cycle;
use App\Models\Payment;
use App\Models\Atleta;
use App\Models\Inscription;
use App\Models\Category;
use App\Models\Assist;
use App\Models\Attendance;
use App\Http\Requests\AtletaFormRequest;
use App\Http\Requests\AtletaUpdateFormRequest;
use App\Http\Requests\InscriptionFormRequest;
use Illuminate\Support\Facades\File;
use PDF;
use DB;
use DateTime;
use Illuminate\Support\Facades\Mail;
use App\Mail\InscriptionMail;
use App\Mail\InscriptionUpdateMail;
use Carbon\Carbon;

class InscriptionAdminController extends Controller
{
    public function inscriptions(Request $request)
    {
        if ($request)
        {
            $queryInscription=$request->input('finscription');
            $queryStatus=$request->input('fstatus');

            $inscriptions=DB::table('inscriptions')
            ->where('status','=',1)
            ->where('inscription_number','LIKE','%'.$queryInscription.'%')
            ->where('inscription_status','LIKE','%'.$queryStatus.'%')
            ->orderBy('created_at','desc')
            ->paginate(50);

            $config = Config::first();

            return view('admin.inscription.index', compact('queryInscription','queryStatus','inscriptions','config'));
        }
    }

    public function showinscription($id)
    {
        $inscription = Inscription::find($id);
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
        ->where('payments.inscription_id',$id)
        ->orderBy('payments.id','desc')
        // ->get('payments.id','payments.inscription_id','payments.type','payments.paid','payments.created_at','payments.updated_at','inscriptions.class_id','inscriptions.cycle_id','inscriptions.atleta_id','inscriptions.inscription_number','atleta.cui_dpi','atleta.image','atleta.birth','atleta.gender','atleta.phone','atleta.whatsapp','atleta.email','cycles.name','cycles.start_date','cycles.end_date','class.cycle_id','class.category_id','class.schedule_id','class.instructor_id','cycle.start_date','cycle.end_date','cycle.inscription_payment','cycle.monthly_payment','cycle.badge','categories.group_id','categories.name','categories.age_from','categories.age_to','groups.name');
        ->get('payments.*','atleta.*','cycles.*','class.*','categories.*','groups.*');

        $paymentssubtotal = Payment::join('inscriptions', 'inscriptions.id', '=', 'payments.inscription_id')
        ->join('atleta', 'atleta.id', '=', 'inscriptions.atleta_id')
        ->join('cycles', 'cycles.id', '=', 'inscriptions.cycle_id')
        ->join('class', 'class.id', '=', 'inscriptions.class_id')
        ->join('categories', 'categories.id', '=', 'class.category_id')
        ->join('groups', 'groups.id', '=', 'categories.group_id')
        ->where('payments.inscription_id',$id)
        ->whereNotBetween('payments.type', [3,6])
        ->orderBy('payments.created_at','desc')
        // ->get('payments.id','payments.inscription_id','payments.type','payments.paid','payments.created_at','payments.updated_at','inscriptions.class_id','inscriptions.cycle_id','inscriptions.atleta_id','inscriptions.inscription_number','atleta.cui_dpi','atleta.image','atleta.birth','atleta.gender','atleta.phone','atleta.whatsapp','atleta.email','cycles.name','cycles.start_date','cycles.end_date','class.cycle_id','class.category_id','class.schedule_id','class.instructor_id','cycle.start_date','cycle.end_date','cycle.inscription_payment','cycle.monthly_payment','cycle.badge','categories.group_id','categories.name','categories.age_from','categories.age_to','groups.name');
        ->get('payments.*','atleta.*','cycles.*','class.*','categories.*','groups.*');

        $paymentsexonerations = Payment::join('inscriptions', 'inscriptions.id', '=', 'payments.inscription_id')
        ->join('atleta', 'atleta.id', '=', 'inscriptions.atleta_id')
        ->join('cycles', 'cycles.id', '=', 'inscriptions.cycle_id')
        ->join('class', 'class.id', '=', 'inscriptions.class_id')
        ->join('categories', 'categories.id', '=', 'class.category_id')
        ->join('groups', 'groups.id', '=', 'categories.group_id')
        ->where('payments.inscription_id',$id)
        ->whereBetween('payments.type', [3,6])
        ->orderBy('payments.created_at','desc')
        // ->get('payments.id','payments.inscription_id','payments.type','payments.paid','payments.created_at','payments.updated_at','inscriptions.class_id','inscriptions.cycle_id','inscriptions.atleta_id','inscriptions.inscription_number','atleta.cui_dpi','atleta.image','atleta.birth','atleta.gender','atleta.phone','atleta.whatsapp','atleta.email','cycles.name','cycles.start_date','cycles.end_date','class.cycle_id','class.category_id','class.schedule_id','class.instructor_id','cycle.start_date','cycle.end_date','cycle.inscription_payment','cycle.monthly_payment','cycle.badge','categories.group_id','categories.name','categories.age_from','categories.age_to','groups.name');
        ->get('payments.*','atleta.*','cycles.*','class.*','categories.*','groups.*');

        $subtotal = 0;
        $exonerations = 0;
        $total = 0;
        foreach ($payments as $sumaPagos) {
            $total = $total + $sumaPagos->paid;
        }
        foreach ($paymentssubtotal as $sumaPagos) {
            $subtotal = $subtotal + $sumaPagos->paid;
        }
        foreach ($paymentsexonerations as $sumaPagos) {
            $exonerations = $exonerations + $sumaPagos->paid;
        }

        $assists = Assist::where('class_id',$class->id)->get();

        $config = Config::first();

        $today = date("Y-m-d");
        $classesavailable=DB::table('class as cl')
        ->join('cycles as c','cl.cycle_id','=','c.id')
        ->join('categories as cat','cl.category_id','=','cat.id')
        ->join('groups as g','cat.group_id','=','g.id')
        ->join('schedule as s','cl.schedule_id','=','s.id')
        ->join('facilities as f','s.facility_id','=','f.id')
        ->join('users as i','cl.instructor_id','=','i.id')
        ->select('cl.id','cl.cycle_id as CLcycle_id','cl.category_id as CLcategory_id','cl.schedule_id as CLschedule_id','cl.instructor_id as CLinstructor_id','cl.start_date as CLstart_date','cl.end_date as CLend_date','cl.notes as CLnotes','cl.monthly_payment as CLmonthly_payment','cl.inscription_payment as CLinscription_payment','cl.badge as CLbadge','c.name as CYid','c.start_date as CYstart_date','c.end_date as CYend_date','c.description as CYdescription','c.status as CYstatus','g.name as Gname','g.description as Gdescription','g.image as Gimage','g.status as Gstatus','cat.name as Cname','cat.age_from','cat.age_to','cat.description as Cdescription','cat.image as Cimage','cat.status as Cstatus','cat.requirements as Crequirements','cat.implements as Cimplements','s.facility_id','s.start_time as Sstart_time','s.end_time as Send_time','s.sunday','s.monday','s.tuesday','s.wednesday','s.thursday','s.friday','s.saturday','s.quota','f.name as Fname','f.description as Fdescription','f.location','f.image as Fimage','f.status as Fstatus','i.name as Iname','i.email','i.phone','i.whatsapp')
        ->where('cl.end_date','>',$today)
        ->where('cl.status',1)
        ->orderBy('cl.start_date')
        ->orderBy('age_from','asc')
        ->orderBy('cat.name')
        ->orderBy(DB::raw('HOUR(s.start_time)'))
        ->get();

        return view('admin.inscription.show', compact('atleta','class','config','inscription','payments','exonerations','total','subtotal','assists','classesavailable'));
    }

    public function addinscription()
    {
        $atletas=DB::table('atleta')
        ->where('status','=',1)
        ->get();

        $today = date("Y-m-d");
        $classes=DB::table('class as cl')
        ->join('cycles as c','cl.cycle_id','=','c.id')
        ->join('categories as cat','cl.category_id','=','cat.id')
        ->join('groups as g','cat.group_id','=','g.id')
        ->join('schedule as s','cl.schedule_id','=','s.id')
        ->join('facilities as f','s.facility_id','=','f.id')
        ->join('users as i','cl.instructor_id','=','i.id')
        ->select('cl.id','cl.cycle_id as CLcycle_id','cl.category_id as CLcategory_id','cl.schedule_id as CLschedule_id','cl.instructor_id as CLinstructor_id','cl.start_date as CLstart_date','cl.end_date as CLend_date','cl.notes as CLnotes','cl.monthly_payment as CLmonthly_payment','cl.inscription_payment as CLinscription_payment','cl.badge as CLbadge','c.name as CYid','c.start_date as CYstart_date','c.end_date as CYend_date','c.description as CYdescription','c.status as CYstatus','g.name as Gname','g.description as Gdescription','g.image as Gimage','g.status as Gstatus','cat.name as Cname','cat.age_from','cat.age_to','cat.description as Cdescription','cat.image as Cimage','cat.status as Cstatus','cat.requirements as Crequirements','cat.implements as Cimplements','s.facility_id','s.start_time as Sstart_time','s.end_time as Send_time','s.sunday','s.monday','s.tuesday','s.wednesday','s.thursday','s.friday','s.saturday','s.quota','f.name as Fname','f.description as Fdescription','f.location','f.image as Fimage','f.status as Fstatus','i.name as Iname','i.email','i.phone','i.whatsapp')
        ->where('cl.end_date','>',$today)
        ->where('cl.status',1)
        ->orderBy('cl.start_date')
        ->orderBy('age_from','asc')
        ->orderBy('cat.name')
        ->orderBy(DB::raw('HOUR(s.start_time)'))
        ->get();
        $config = Config::first();

        return view('admin.inscription.add',compact('atletas','classes','config'));
    }

    public function insertinscription(InscriptionFormRequest $request)
    {
        $idatleta = $request->input('atleta_id');
        $idclass = $request->input('class_id');
        $class = Classs::find($idclass);
        $idcycle = $class->cycle_id;

        $existeAtletaCiclo=DB::table('inscriptions')
        ->where('cycle_id',$idcycle)
        ->where('atleta_id',$idatleta)
        ->where('status',1)
        ->whereBetween('inscription_status', [0,4])
        ->get();

        if($existeAtletaCiclo->count() >= 1)
        {
            // $request->session()->flash('alert-danger', __('An inscription has already been created in this cycle with this CUI, if I already make the registration form you can consult it in search or approach the central offices'));
            return redirect('inscriptions')->with('status', __('An Inscription has already been created in this cycle with this CUI, reject the other request or delete it.'));
        }
        else
        {
            $inscription = new Inscription();
            $inscription->class_id = $idclass;
            $inscription->cycle_id = $idcycle;
            $inscription->atleta_id = $idatleta;
            $inscription->contract = 1;
            $inscription->inscription_payment = 0;
            $inscription->badge_payment = 0;
            $inscription->inscription_status = 0;
            $inscription->status = 1;
            $inscription->notes = $request->input('notes');
            $inscription->save();

            $fecha = $inscription->created_at;
            $fecha = date("dmY", strtotime($fecha));
            $idinscription = $inscription->id;

            $inscription_number = "INSC-".$fecha.$idinscription;

            $inscription = Inscription::find($inscription->id);
            $inscription->inscription_number = $inscription_number;
            $inscription->update();

            $atleta = Atleta::find($idatleta);

            Mail::to($atleta->email)->send(new InscriptionMail($inscription));
            Mail::to($atleta->responsible_email)->send(new InscriptionMail($inscription));

            return redirect('inscriptions')->with('status', __('Inscription Added Successfully'));
        }


    }

    public function editinscription($id)
    {
        $inscription = Inscription::find($id);
        $atleta = Atleta::find($inscription->atleta_id);
        $class=DB::table('class as cl')
        ->join('cycles as c','cl.cycle_id','=','c.id')
        ->join('categories as cat','cl.category_id','=','cat.id')
        ->join('groups as g','cat.group_id','=','g.id')
        ->join('schedule as s','cl.schedule_id','=','s.id')
        ->join('facilities as f','s.facility_id','=','f.id')
        ->join('users as i','cl.instructor_id','=','i.id')
        ->select('cl.id','cl.cycle_id as CLcycle_id','cl.category_id as CLcategory_id','cl.schedule_id as CLschedule_id','cl.instructor_id as CLinstructor_id','cl.start_date as CLstart_date','cl.end_date as CLend_date','cl.notes as CLnotes','cl.monthly_payment as CLmonthly_payment','cl.inscription_payment as CLinscription_payment','cl.badge as CLbadge','c.name as CYid','c.start_date as CYstart_date','c.end_date as CYend_date','c.description as CYdescription','c.status as CYstatus','g.name as Gname','g.description as Gdescription','g.image as Gimage','g.status as Gstatus','cat.name as Cname','cat.age_from','cat.age_to','cat.description as Cdescription','cat.image as Cimage','cat.status as Cstatus','cat.requirements as Crequirements','cat.implements as Cimplements','s.facility_id','s.start_time as Sstart_time','s.end_time as Send_time','s.sunday','s.monday','s.tuesday','s.wednesday','s.thursday','s.friday','s.saturday','s.quota','f.name as Fname','f.description as Fdescription','f.location','f.image as Fimage','f.status as Fstatus','i.name as Iname','i.email','i.phone','i.whatsapp')
        ->where('cl.id',$inscription->class_id)
        ->first();

        $config = Config::first();

        return view('admin.inscription.edit',compact('atleta','class','inscription','config'));
    }

    public function updateinscription(InscriptionFormRequest $request, $id)
    {
        $inscription = Inscription::find($id);

        $atleta = Atleta::find($inscription->atleta_id);

        $noReciboInscription = $request->input('no_recibo_inscription');
        $noReciboInscriptionExoneration = $request->input('no_recibo_inscription_exoneration');
        $noReciboBadge = $request->input('no_recibo_badge');
        $noReciboBadgeExoneration = $request->input('no_recibo_badge_exoneration');

        //obtener los datos de la clase
        $class=DB::table('class as cl')
        ->join('cycles as c','cl.cycle_id','=','c.id')
        ->join('categories as cat','cl.category_id','=','cat.id')
        ->join('groups as g','cat.group_id','=','g.id')
        ->join('schedule as s','cl.schedule_id','=','s.id')
        ->join('facilities as f','s.facility_id','=','f.id')
        ->join('users as i','cl.instructor_id','=','i.id')
        ->select('cl.id','cl.cycle_id as CLcycle_id','cl.category_id as CLcategory_id','cl.schedule_id as CLschedule_id','cl.instructor_id as CLinstructor_id','cl.start_date as CLstart_date','cl.end_date as CLend_date','cl.notes as CLnotes','cl.monthly_payment as CLmonthly_payment','cl.inscription_payment as CLinscription_payment','cl.badge as CLbadge','c.name as CYid','c.start_date as CYstart_date','c.end_date as CYend_date','c.description as CYdescription','c.status as CYstatus','g.name as Gname','g.description as Gdescription','g.image as Gimage','g.status as Gstatus','cat.name as Cname','cat.age_from','cat.age_to','cat.description as Cdescription','cat.image as Cimage','cat.status as Cstatus','cat.requirements as Crequirements','cat.implements as Cimplements','s.facility_id','s.start_time as Sstart_time','s.end_time as Send_time','s.sunday','s.monday','s.tuesday','s.wednesday','s.thursday','s.friday','s.saturday','s.quota','f.name as Fname','f.description as Fdescription','f.location','f.image as Fimage','f.status as Fstatus','i.name as Iname','i.email','i.phone','i.whatsapp')
        ->where('cl.id',$inscription->class_id)
        ->first();

        if(($request->input('inscription_status') == '1') and ($inscription->inscription_status == '1') ){
            //si es la misma inscripcion y ya esta confirmada solo actualizar

            //ver si no se a pagado inscripcion: crear pago y actualizar estado
            if ($inscription->inscription_payment == 0 and  $request->input('inscription_payment') == 1) {

                //si hay exoneraciones
                $exonarate_inscription = $request->input('exonerate_inscription') == TRUE ? '1':'0';
                $exonerate_inscription_qty = $request->input('exoneration_inscription_qty');


                $payment = new Payment();
                $payment->inscription_id = $inscription->id;

                if ($exonarate_inscription == 1) {
                    $payment->no_recibo = $noReciboInscriptionExoneration;
                    $payment->type = 5;
                    $payment->note = $request->input('note_inscription');
                    $payment->paid = $exonerate_inscription_qty;
                }else {
                    $payment->no_recibo = $noReciboInscription;
                    $payment->type = 0;
                    $payment->paid = $class->CLinscription_payment;
                }

                $payment->user_id = Auth::user()->id;
                $payment->save();

                if ($exonarate_inscription == 1) {
                    if ($exonerate_inscription_qty < $class->CLinscription_payment) {
                        $resto_inscripcion = $class->CLinscription_payment - $exonerate_inscription_qty;

                        $payment = new Payment();
                        $payment->no_recibo = $noReciboInscriptionExoneration;
                        $payment->inscription_id = $inscription->id;
                        $payment->type = 0;
                        $payment->paid = $resto_inscripcion;
                        $payment->user_id = Auth::user()->id;
                        $payment->save();
                    }
                }


                $inscription->inscription_payment = $request->input('inscription_payment');
            }

            //ver si no se a pagado gafete: crear pago y actualizar estado
            if ($inscription->badge_payment == 0 and  $request->input('badge_payment') == 1) {

                $exonarate_badge = $request->input('exonerate_badge') == TRUE ? '1':'0';
                $exonerate_badge_qty = $request->input('exoneration_badge_qty');

                $payment = new Payment();

                $payment->inscription_id = $inscription->id;

                if ($exonarate_badge == 1) {
                    $payment->no_recibo = $noReciboBadgeExoneration;
                    $payment->type = 6;
                    $payment->note = $request->input('note_badge');
                    $payment->paid = $exonerate_badge_qty;
                }else {
                    $payment->no_recibo = $noReciboBadge;
                    $payment->type = 1;
                    $payment->paid = $class->CLbadge;
                }

                $payment->user_id = Auth::user()->id;
                $payment->save();

                if ($exonarate_badge == 1) {
                    if ($exonerate_badge_qty < $class->CLbadge) {
                        $resto_gafete = $class->CLbadge - $exonerate_badge_qty;

                        $payment = new Payment();
                        $payment->no_recibo = $noReciboBadgeExoneration;
                        $payment->inscription_id = $inscription->id;
                        $payment->type = 1;
                        $payment->paid = $resto_gafete;
                        $payment->user_id = Auth::user()->id;
                        $payment->save();
                    }
                }


                $inscription->badge_payment = $request->input('badge_payment');
            }

            $inscription->inscription_status = $request->input('inscription_status');
            if ($request->input('notes') != null and $request->input('notes') != $inscription->notes)  {
                $inscription->notes = $request->input('notes');
            } elseif ($request->input('notes') == null) {
                $inscription->notes = 'La Inscripcion esta confirmada.';
            }
            $inscription->update();

            try {
                Mail::to($atleta->email)->send(new InscriptionUpdateMail($inscription));
                Mail::to($atleta->responsible_email)->send(new InscriptionUpdateMail($inscription));
            }
            catch (exception $e) {
                return redirect('show-inscription/'.$id)->with('status', __('Inscription Updated Successfully'));
            }

            return redirect('show-inscription/'.$id)->with('status', __('Inscription Updated Successfully'));

        } elseif ((($request->input('inscription_status') == '1') and ($inscription->inscription_status == '0')) or (($request->input('inscription_status') == '1') and ($inscription->inscription_status == '2'))) {
            //si se quiere confirmar una inscripcion que este en pendiente o rechazada
            //ver cupo, pagos deacuerdo a fecha de inscripcion y finalizacion de clase

                //obtener cupos ocupados
                $cuposOcupados=DB::table('inscriptions as i')
                ->join('class as c','i.class_id','=','c.id')
                ->where('c.schedule_id',$class->CLschedule_id)
                ->where('i.inscription_status','=',1)
                ->where('i.status','=',1)
                ->get();

                //obtenemos cupo total y cupo ocupado
                $disponibilidad = $class->quota;
                $ocupados = $cuposOcupados->count();
                //restamos los cupos ocupados a la disponibilidad
                $disponibles = $disponibilidad - $ocupados;

                if ($disponibles >= 1) {
                    // si hay 1 o mas cupos disponibles se realiza la confirmacion

                    $today = new DateTime();
                    $start_date = new DateTime($class->CLstart_date);
                    $end_date = new DateTime($class->CLend_date);


                    if ($today < $start_date) {
                        // obtener la diferencia meses y dias entre fecha inicial y final
                        $difference = $start_date->diff($end_date);
                        // ECHO "diferencia: ".$difference->y." Años ".$difference->m." Meses ".$difference->d." Dias";

                        $meses = 0;
                        if ($class->CLmonthly_payment != "0.00") {
                            if ($difference->y > 0) {
                                $meses = ($meses + ($difference->y * 12));
                            }
                            if ($difference->m > 0) {
                                $meses = $meses + $difference->m;
                            }
                            if ($difference->d > 0) {
                                $meses = $meses + 1;
                            }
                        }


                        $hoy = $today->format('Y/m/d');
                        $inicio = $start_date->format('Y/m/d');
                        $final = $end_date->format('Y/m/d');

                        // echo "Pagos: ".$meses;

                        // echo "<br>".$hoy."<br>";
                        // echo $inicio."<br>";
                        // echo $final."<br>";
                        $inscription->payments = $meses;
                        if ($class->CLinscription_payment == "0.00") {
                            $inscription->inscription_payment = 1;
                        }
                        if ($class->CLbadge == "0.00") {
                            $inscription->badge_payment = 1;
                        }
                        $inscription->inscription_status = 1;
                        $inscription->notes = 'La inscripción fue confirmada.';
                        $inscription->update();

                        try {
                            Mail::to($atleta->email)->send(new InscriptionUpdateMail($inscription));
                            Mail::to($atleta->responsible_email)->send(new InscriptionUpdateMail($inscription));
                        }
                        catch (exception $e) {
                            return redirect('show-inscription/'.$id)->with('status', __('Inscription Updated Successfully'));
                        }

                        return redirect('show-inscription/'.$id)->with('status', __('Inscription Confirmed Successfully'));

                    } elseif ($today >= $start_date and $today < $end_date) {
                        //si la fecha esta entre la fecha inicial y final ver cuantos meses quedan
                        $difference = $today->diff($end_date);
                        // ECHO "diferencia: ".$difference->y." Años ".$difference->m." Meses ".$difference->d." Dias";

                        $meses = 0;
                        if ($class->CLmonthly_payment != "0.00") {
                            if ($difference->y > 0) {
                                $meses = ($meses + ($difference->y * 12));
                            }
                            if ($difference->m > 0) {
                                $meses = $meses + $difference->m;
                            }
                            if ($difference->d > 0) {
                                $meses = $meses + 1;
                            }
                        }

                        $inscription->payments = $meses;
                        if ($class->CLinscription_payment == "0.00") {
                            $inscription->inscription_payment = 1;
                        }
                        if ($class->CLbadge == "0.00") {
                            $inscription->badge_payment = 1;
                        }
                        $inscription->inscription_status = 1;
                        $inscription->notes = 'La inscripción fue confirmada.';
                        $inscription->update();

                        try {
                            Mail::to($atleta->email)->send(new InscriptionUpdateMail($inscription));
                            Mail::to($atleta->responsible_email)->send(new InscriptionUpdateMail($inscription));
                        }
                        catch (exception $e) {
                            return redirect('show-inscription/'.$id)->with('status', __('Inscription Updated Successfully'));
                        }

                        return redirect('show-inscription/'.$id)->with('status', __('Inscription Confirmed Successfully'));

                    }elseif ($today >= $end_date) {
                        //si la fecha es mayor a la fecha final rechazar la inscripcion
                        $inscription->inscription_status = 2;
                        $inscription->notes = 'La inscripción fue rechazada porque la clase ya finalizo.';
                        $inscription->update();

                        try {
                            Mail::to($atleta->email)->send(new InscriptionUpdateMail($inscription));
                            Mail::to($atleta->responsible_email)->send(new InscriptionUpdateMail($inscription));
                        }
                        catch (exception $e) {
                            return redirect('show-inscription/'.$id)->with('status', __('Registration was rejected the class has already ended'));
                        }

                        return redirect('show-inscription/'.$id)->with('status', __('Registration was rejected the class has already ended'));
                    }



                } else {
                    //si no hay cupos se rechaza la inscripcion

                    $inscription->inscription_status = 2;
                    $inscription->notes = 'La inscripción fue rechazada por falta de cupo en la clase seleccionada';
                    $inscription->update();

                    try {
                        Mail::to($atleta->email)->send(new InscriptionUpdateMail($inscription));
                        Mail::to($atleta->responsible_email)->send(new InscriptionUpdateMail($inscription));
                    }
                    catch (exception $e) {
                        return redirect('show-inscription/'.$id)->with('status', __('Registration was rejected due to lack of space in the selected class'));
                    }

                    return redirect('show-inscription/'.$id)->with('status', __('Registration was rejected due to lack of space in the selected class'));
                }



        } elseif (($request->input('inscription_status') != '1' and ($inscription->inscription_status != '1'))) {
            if ($request->input('inscription_status') == 2 and $inscription->inscription_status == 0) {
                $inscription->inscription_status = 2;
                if ($request->input('notes') != null and $request->input('notes') != $inscription->notes)  {
                    $inscription->notes = $request->input('notes');
                } elseif ($request->input('notes') == null) {
                    $inscription->notes = 'La Inscripcion fue rechazada.';
                }
                $inscription->update();

                try {
                    Mail::to($atleta->email)->send(new InscriptionUpdateMail($inscription));
                    Mail::to($atleta->responsible_email)->send(new InscriptionUpdateMail($inscription));
                }
                catch (exception $e) {
                    return redirect('show-inscription/'.$id)->with('status', 'La inscripción se edito correctamente a: Rechazada');
                }

                return redirect('show-inscription/'.$id)->with('status', 'La inscripción se edito correctamente a: Rechazada');
            } else {
                $inscription->inscription_status = $request->input('inscription_status');
                if ($request->input('notes') != null and $request->input('notes') != $inscription->notes)  {
                    $inscription->notes = $request->input('notes');
                } elseif ($request->input('notes') == null) {
                    $inscription->notes = 'La Inscripcion ya no esta activa.';
                }
                $inscription->update();

                try {
                    Mail::to($atleta->email)->send(new InscriptionUpdateMail($inscription));
                    Mail::to($atleta->responsible_email)->send(new InscriptionUpdateMail($inscription));
                }
                catch (exception $e) {
                    return redirect('show-inscription/'.$id)->with('status', __('Inscription Updated Successfully'));
                }

                return redirect('show-inscription/'.$id)->with('status', __('Inscription Updated Successfully'));
            }




        }elseif (($request->input('inscription_status') == '1' and ($inscription->inscription_status == '3')) or ($request->input('inscription_status') == '1' and ($inscription->inscription_status == '4')) or ($request->input('inscription_status') == '1' and ($inscription->inscription_status == '5'))) {
            //si se quiere confirmar una inscripcion que fue expulsado, retirado o promovido no se podra realizar

            try {
                Mail::to($atleta->email)->send(new InscriptionUpdateMail($inscription));
                Mail::to($atleta->responsible_email)->send(new InscriptionUpdateMail($inscription));
            }
            catch (exception $e) {
                return redirect('show-inscription/'.$id)->with('status', __('The registration has already been changed to status: promoted, expelled or withdrawn, so it cannot be changed to confirmed status.'));
            }

            return redirect('show-inscription/'.$id)->with('status', __('The registration has already been changed to status: promoted, expelled or withdrawn, so it cannot be changed to confirmed status.'));
        }
        elseif (($request->input('inscription_status') == '3' and ($inscription->inscription_status == '1')) or ($request->input('inscription_status') == '4' and ($inscription->inscription_status == '1')) or ($request->input('inscription_status') == '5' and ($inscription->inscription_status == '1'))) {
            //cambiar estado de confirmado a expulsado, retirado o promovido
            $inscription->inscription_status = $request->input('inscription_status');
            if ($request->input('notes') != null and $request->input('notes') != $inscription->notes)  {
                $inscription->notes = $request->input('notes');
            } elseif ($request->input('notes') == null) {
                $inscription->notes = 'La Inscripcion ya no esta activa.';
            }
            $inscription->update();

            try {
                Mail::to($atleta->email)->send(new InscriptionUpdateMail($inscription));
                Mail::to($atleta->responsible_email)->send(new InscriptionUpdateMail($inscription));
            }
            catch (exception $e) {
                return redirect('show-inscription/'.$id)->with('status', __('Se cambio el estado de la inscripción y ya no se encuentra activa.'));
            }

            return redirect('show-inscription/'.$id)->with('status', __('Se cambio el estado de la inscripción y ya no se encuentra activa.'));
        }

    }

    public function destroyinscription($id)
    {
        $inscription = Inscription::find($id);
        $inscription->status = 0;
        $inscription->inscription_status = '2';
        $inscription->update();
        return redirect('inscriptions')->with('status',__('Inscription Deleted Successfully'));
    }

    public function updateclassinscription(Request $request)
    {
        $class = Classs::find($request->input('class_id'));
        $idcycle = $class->cycle_id;

        $inscription = Inscription::find($request->input('inscription_id'));
        $inscription->class_id = $request->input('class_id');
        $inscription->cycle_id = $idcycle;
        $inscription->update();

        return redirect('inscriptions')->with('status', __('Inscription Updated Successfully'));
    }

    public function deleteoldinscriptions()
    {
        DB::table('inscriptions')
        ->where('inscription_status', 0)
        ->where('updated_at', '<', Carbon::now()->subDays(10))
        ->delete();

        DB::table('inscriptions')
        ->where('inscription_status', 2)
        ->where('updated_at', '<', Carbon::now()->subDays(10))
        ->delete();
        return redirect('inscriptions')->with('status',__('Old inscriptions deleted'));
    }


}
