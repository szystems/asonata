<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Config;
use App\Models\Classs;
use App\Models\Category;
use App\Models\Cycle;
use App\Models\Atleta;
use App\Models\Inscription;
use App\Http\Requests\AtletaFormRequest;
use App\Http\Requests\AtletaUpdateFormRequest;
use App\Http\Requests\InscriptionFormRequest;
use Illuminate\Support\Facades\File;
use PDF;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\InscriptionMail;

class InscriptionsController extends Controller
{

    public function inscriptionscyles()
    {
        $today = date("Y-m-d");
        $cycles=DB::table('cycles')
            ->where('status','=',1)
            ->where('end_date','>',$today)
            ->orderBy('end_date','asc')
            ->paginate(25);
        $config = Config::first();
        return view('frontend.inscription.indexcycles', compact('config','cycles'));
    }

    public function inscriptionsclasses(Request $request, $id)
    {
        if ($request) {
            $queryCategory = $request->input('fcategory');
            $idcycle = $id;
            $today = date("Y-m-d");
            $classes=DB::table('class as cl')
            ->join('cycles as c','cl.cycle_id','=','c.id')
            ->join('categories as cat','cl.category_id','=','cat.id')
            ->join('groups as g','cat.group_id','=','g.id')
            ->join('schedule as s','cl.schedule_id','=','s.id')
            ->join('facilities as f','s.facility_id','=','f.id')
            ->join('users as i','cl.instructor_id','=','i.id')
            ->select('cl.id','cl.cycle_id as CLcycle_id','cl.category_id as CLcategory_id','cl.schedule_id as CLschedule_id','cl.instructor_id as CLinstructor_id','cl.start_date as CLstart_date','cl.end_date as CLend_date','cl.notes as CLnotes','cl.monthly_payment as CLmonthly_payment','cl.inscription_payment as CLinscription_payment','cl.badge as CLbadge','c.name as CYid','c.start_date as CYstart_date','c.end_date as CYend_date','c.description as CYdescription','c.status as CYstatus','g.name as Gname','g.description as Gdescription','g.image as Gimage','g.status as Gstatus','g.contract as Gcontract','cat.name as Cname','cat.age_from','cat.age_to','cat.description as Cdescription','cat.image as Cimage','cat.status as Cstatus','cat.requirements as Crequirements','cat.implements as Cimplements','cat.contract as Ccontract','s.facility_id','s.start_time as Sstart_time','s.end_time as Send_time','s.sunday','s.monday','s.tuesday','s.wednesday','s.thursday','s.friday','s.saturday','s.quota','f.name as Fname','f.description as Fdescription','f.location','f.image as Fimage','f.status as Fstatus','i.name as Iname','i.email','i.phone','i.whatsapp')
            ->where('cl.cycle_id', $id)
            ->where('cl.end_date','>',$today)
            ->where('cl.status',1)
            ->where('cl.category_id','LIKE',$queryCategory)
            // ->orderBy('cl.start_date')
            // ->orderBy('age_from','asc')
            ->orderBy('cat.name','asc')
            ->orderBy(DB::raw('HOUR(s.start_time)'))
            ->get();
            $config = Config::first();
            $categoriesFilter = Category::where('status',1)->orderBy('name','asc')->get();
            // return view('frontend.inscription.index', compact('config','classes'));
            return view('frontend.inscription.index', compact('config','classes','categoriesFilter','queryCategory','idcycle'));
        }
    }

    public function showinscriptionclass($id)
    {
        $config = Config::first();
        $class=DB::table('class as cl')
        ->join('cycles as c','cl.cycle_id','=','c.id')
        ->join('categories as cat','cl.category_id','=','cat.id')
        ->join('groups as g','cat.group_id','=','g.id')
        ->join('schedule as s','cl.schedule_id','=','s.id')
        ->join('facilities as f','s.facility_id','=','f.id')
        ->join('users as i','cl.instructor_id','=','i.id')
        ->select('cl.id','cl.cycle_id as CLcycle_id','cl.category_id as CLcategory_id','cl.schedule_id as CLschedule_id','cl.instructor_id as CLinstructor_id','cl.start_date as CLstart_date','cl.end_date as CLend_date','cl.notes as CLnotes','cl.monthly_payment as CLmonthly_payment','cl.inscription_payment as CLinscription_payment','cl.badge as CLbadge','c.name as CYid','c.start_date as CYstart_date','c.end_date as CYend_date','c.description as CYdescription','c.status as CYstatus','g.name as Gname','g.description as Gdescription','g.image as Gimage','g.status as Gstatus','g.contract as Gcontract','cat.name as Cname','cat.age_from','cat.age_to','cat.description as Cdescription','cat.image as Cimage','cat.status as Cstatus','cat.requirements as Crequirements','cat.implements as Cimplements','cat.contract as Ccontract','s.facility_id','s.start_time as Sstart_time','s.end_time as Send_time','s.sunday','s.monday','s.tuesday','s.wednesday','s.thursday','s.friday','s.saturday','s.quota','f.name as Fname','f.description as Fdescription','f.location','f.image as Fimage','f.status as Fstatus','i.name as Iname','i.email','i.phone','i.whatsapp')
        ->where('cl.id',$id)
        ->first();
        return view('frontend.inscription.showinscriptionclass', compact('config','class'));
    }

    public function inscriptionathlete(Request $request)
    {
        $cui_dpi = $request->input('cui_dpi');
        $idclass = $request->input('idclass');
        $config = Config::first();

        $atleta=DB::table('atleta')
        ->where('cui_dpi',$cui_dpi)
        ->first();

        $class=DB::table('class as cl')
        ->join('cycles as c','cl.cycle_id','=','c.id')
        ->join('categories as cat','cl.category_id','=','cat.id')
        ->join('groups as g','cat.group_id','=','g.id')
        ->join('schedule as s','cl.schedule_id','=','s.id')
        ->join('facilities as f','s.facility_id','=','f.id')
        ->join('users as i','cl.instructor_id','=','i.id')
        ->select('cl.id','cl.cycle_id as CLcycle_id','cl.category_id as CLcategory_id','cl.schedule_id as CLschedule_id','cl.instructor_id as CLinstructor_id','cl.start_date as CLstart_date','cl.end_date as CLend_date','cl.notes as CLnotes','cl.monthly_payment as CLmonthly_payment','cl.inscription_payment as CLinscription_payment','cl.badge as CLbadge','c.name as CYid','c.start_date as CYstart_date','c.end_date as CYend_date','c.description as CYdescription','c.status as CYstatus','g.name as Gname','g.description as Gdescription','g.image as Gimage','g.status as Gstatus','g.contract as Gcontract','cat.name as Cname','cat.age_from','cat.age_to','cat.description as Cdescription','cat.image as Cimage','cat.status as Cstatus','cat.requirements as Crequirements','cat.implements as Cimplements','cat.contract as Ccontract','s.facility_id','s.start_time as Sstart_time','s.end_time as Send_time','s.sunday','s.monday','s.tuesday','s.wednesday','s.thursday','s.friday','s.saturday','s.quota','f.name as Fname','f.description as Fdescription','f.location','f.image as Fimage','f.status as Fstatus','i.name as Iname','i.email','i.phone','i.whatsapp')
        ->where('cl.id',$idclass)
        ->first();

        if ($atleta) {

            // $existeAtletaCiclo=DB::table('inscriptions as i')
            // ->join('atleta as a','i.atleta_id','=','a.id')
            // ->join('class as c','i.class_id','=','c.id')
            // ->select('i.id','i.class_id','i.atleta_id','i.inscription_number','i.inscription_payment as Iinscription_payment','i.badge_payment as Ibadge_payment','i.contract','i.notes as Inotes','i.status as Istatus','c.cycle_id','c.category_id','c.instructor_id','c.start_date','c.end_date','c.notes as Cnotes','c.inscription_payment as Cinscription_payment','c.monthly_payment','c.badge','c.status as Cstatus','a.*')
            // ->where('i.atleta_id', $atleta->id)
            // ->where('i.class_id','>',$class->id)
            // ->where('i.status',1)
            // ->get();

            $existeAtletaCiclo=DB::table('inscriptions')
            ->where('cycle_id',$class->CLcycle_id)
            ->where('atleta_id',$atleta->id)
            ->where('status',1)
            ->whereBetween('inscription_status', [0,4])
            ->get();

            if($existeAtletaCiclo->count() >= 1)
            {
                $request->session()->flash('alert-danger', __('An inscription has already been created in this cycle with this CUI, if I already make the registration form you can consult it in search or approach the central offices'));
                return view('frontend.inscription.showinscriptionclass', compact('config','class'));
            }
            else
            {
                return view('frontend.inscription.showathlete', compact('atleta','class','config'));
            }
        }else{
            return view('frontend.inscription.newathlete', compact('cui_dpi','class','config'));
        }
    }

    public function insertathlete(AtletaFormRequest $request)
    {
        $birth = $request->get('birth');
        $birth = date("Y-m-d", strtotime($birth));

        $atleta = new Atleta();
        if($request->hasFile('image'))
        {
            $file1 = $request->file('image');
            $ext1 = $file1->getClientOriginalExtension();
            $filename1 = time().'.'.$ext1;
            $file1->move('assets/uploads/athletes',$filename1);
            $atleta->image = $filename1;
        }
        if($request->hasFile('responsible_image'))
        {
            $file2 = $request->file('responsible_image');
            $ext2 = $file2->getClientOriginalExtension();
            $filename2 = time().'.'.$ext2;
            $file2->move('assets/uploads/responsible',$filename2);
            $atleta->responsible_image = $filename2;
        }
        if($request->hasFile('vaccination_card'))
        {
            $file3 = $request->file('vaccination_card');
            $ext3 = $file3->getClientOriginalExtension();
            $filename3 = time().'.'.$ext3;
            $file3->move('assets/uploads/vaccination',$filename3);
            $atleta->vaccination_card = $filename3;
        }
        if($request->hasFile('birth_certificate'))
        {
            $file4 = $request->file('birth_certificate');
            $ext4 = $file4->getClientOriginalExtension();
            $filename4 = time().'.'.$ext4;
            $file4->move('assets/uploads/certificate',$filename4);
            $atleta->birth_certificate = $filename4;
        }
        if($request->hasFile('signed_contract'))
        {
            $file5 = $request->file('signed_contract');
            $ext5 = $file5->getClientOriginalExtension();
            $filename5 = time().'.'.$ext5;
            $file5->move('assets/uploads/signedcontracts',$filename5);
            $atleta->signed_contract = $filename5;
        }
        $atleta->name = $request->input('name');
        $atleta->cui_dpi = $request->input('cui_dpi');
        $atleta->birth = $birth;
        $atleta->gender = $request->input('gender');

        $atleta->doses_number = $request->input('doses_number');
        $atleta->ethnic_group = $request->input('ethnic_group');
        $atleta->education_obtained = $request->input('education_obtained');
        $atleta->tshirt_size = $request->input('tshirt_size');

        $atleta->phone = $request->input('phone');
        $atleta->whatsapp = $request->input('whatsapp');
        $atleta->email = $request->input('email');
        $atleta->address = $request->input('address');
        $atleta->city = $request->input('city');
        $atleta->state = $request->input('state');
        $atleta->country = $request->input('country');
        $atleta->status = 1;
        $atleta->responsible_name = $request->input('responsible_name');
        $atleta->responsible_dpi = $request->input('responsible_dpi');
        $atleta->responsible_phone = $request->input('responsible_phone');
        $atleta->responsible_whatsapp = $request->input('responsible_whatsapp');
        $atleta->responsible_email = $request->input('responsible_email');
        $atleta->responsible_address = $request->input('responsible_address');

        $atleta->kinship = $request->input('kinship');
        $atleta->responsible_doses_number = $request->input('responsible_doses_number');

        $atleta->save();

        $idclass = $request->input('idclass');
        $config = Config::first();

        $class=DB::table('class as cl')
        ->join('cycles as c','cl.cycle_id','=','c.id')
        ->join('categories as cat','cl.category_id','=','cat.id')
        ->join('groups as g','cat.group_id','=','g.id')
        ->join('schedule as s','cl.schedule_id','=','s.id')
        ->join('facilities as f','s.facility_id','=','f.id')
        ->join('users as i','cl.instructor_id','=','i.id')
        ->select('cl.id','cl.cycle_id as CLcycle_id','cl.category_id as CLcategory_id','cl.schedule_id as CLschedule_id','cl.instructor_id as CLinstructor_id','cl.start_date as CLstart_date','cl.end_date as CLend_date','cl.notes as CLnotes','cl.monthly_payment as CLmonthly_payment','cl.inscription_payment as CLinscription_payment','cl.badge as CLbadge','c.name as CYid','c.start_date as CYstart_date','c.end_date as CYend_date','c.description as CYdescription','c.status as CYstatus','g.name as Gname','g.description as Gdescription','g.image as Gimage','g.status as Gstatus','g.contract as Gcontract','cat.name as Cname','cat.age_from','cat.age_to','cat.description as Cdescription','cat.image as Cimage','cat.status as Cstatus','cat.requirements as Crequirements','cat.implements as Cimplements','cat.contract as Ccontract','s.facility_id','s.start_time as Sstart_time','s.end_time as Send_time','s.sunday','s.monday','s.tuesday','s.wednesday','s.thursday','s.friday','s.saturday','s.quota','f.name as Fname','f.description as Fdescription','f.location','f.image as Fimage','f.status as Fstatus','i.name as Iname','i.email','i.phone','i.whatsapp')
        ->where('cl.id',$idclass)
        ->first();

        $inscription = new Inscription();
        $inscription->class_id = $idclass;
        $inscription->cycle_id = $class->CLcycle_id;
        $inscription->atleta_id = $atleta->id;
        $inscription->contract = 1;
        $inscription->inscription_payment = 0;
        $inscription->badge_payment = 0;
        $inscription->status = 1;
        $inscription->save();

        $fecha = $inscription->created_at;
        $fecha = date("dmY", strtotime($fecha));
        $idinscription = $inscription->id;

        $inscription_number = "INSC-".$fecha.$idinscription;

        $inscription = Inscription::find($inscription->id);
        $inscription->inscription_number = $inscription_number;
        $inscription->update();

        try {
            Mail::to($atleta->email)->send(new InscriptionMail($inscription));
            Mail::to($atleta->responsible_email)->send(new InscriptionMail($inscription));
            Mail::to($config->email)->send(new InscriptionMail($inscription));
        }
        catch (exception $e) {
            $request->session()->flash('alert-success', __('The registration has been created correctly, save this information to be able to consult again if your request has been confirmed, any questions or comments, contact us. Automatic mail could not be sent.'));

            return view('frontend.inscription.inscriptionform', compact('atleta','class','config','inscription'));
        }



        $request->session()->flash('alert-success', __('The registration has been created correctly, save this information to be able to consult again if your request has been confirmed, any questions or comments, contact us'));

        return view('frontend.inscription.inscriptionform', compact('atleta','class','config','inscription'));
    }

    public function updateathlete(AtletaUpdateFormRequest $request, $id)
    {
        $birth = $request->get('birth');
        $birth = date("Y-m-d", strtotime($birth));

        $atleta = Atleta::find($id);
        if($request->hasFile('image'))
        {
            $path = 'assets/uploads/athletes/'.$atleta->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file1 = $request->file('image');
            $ext1 = $file1->getClientOriginalExtension();
            $filename1 = time().'.'.$ext1;
            $file1->move('assets/uploads/athletes',$filename1);
            $atleta->image = $filename1;
        }
        if($request->hasFile('responsible_image'))
        {
            $path = 'assets/uploads/responsible/'.$atleta->responsible_image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file2 = $request->file('responsible_image');
            $ext2 = $file2->getClientOriginalExtension();
            $filename2 = time().'.'.$ext2;
            $file2->move('assets/uploads/responsible',$filename2);
            $atleta->responsible_image = $filename2;
        }
        if($request->hasFile('vaccination_card'))
        {
            $path = 'assets/uploads/vaccination/'.$atleta->vaccination_card;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file3 = $request->file('vaccination_card');
            $ext3 = $file3->getClientOriginalExtension();
            $filename3 = time().'.'.$ext3;
            $file3->move('assets/uploads/vaccination',$filename3);
            $atleta->vaccination_card = $filename3;
        }
        if($request->hasFile('birth_certificate'))
        {
            $path = 'assets/uploads/certificate/'.$atleta->birth_certificate;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file4 = $request->file('birth_certificate');
            $ext4 = $file4->getClientOriginalExtension();
            $filename4 = time().'.'.$ext4;
            $file4->move('assets/uploads/certificate',$filename4);
            $atleta->birth_certificate = $filename4;
        }
        if($request->hasFile('signed_contract'))
        {
            $path = 'assets/uploads/signedcontracts/'.$atleta->signed_contract;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file5 = $request->file('signed_contract');
            $ext5 = $file5->getClientOriginalExtension();
            $filename5 = time().'.'.$ext5;
            $file5->move('assets/uploads/signedcontracts',$filename5);
            $atleta->signed_contract = $filename5;
        }
        $atleta->name = $request->input('name');
        $atleta->cui_dpi = $request->input('cui_dpi');
        $atleta->birth = $birth;
        $atleta->gender = $request->input('gender');

        $atleta->doses_number = $request->input('doses_number');
        $atleta->ethnic_group = $request->input('ethnic_group');
        $atleta->education_obtained = $request->input('education_obtained');
        $atleta->tshirt_size = $request->input('tshirt_size');

        $atleta->phone = $request->input('phone');
        $atleta->whatsapp = $request->input('whatsapp');
        $atleta->email = $request->input('email');
        $atleta->address = $request->input('address');
        $atleta->city = $request->input('city');
        $atleta->state = $request->input('state');
        $atleta->country = $request->input('country');
        $atleta->responsible_name = $request->input('responsible_name');
        $atleta->responsible_dpi = $request->input('responsible_dpi');
        $atleta->responsible_phone = $request->input('responsible_phone');
        $atleta->responsible_whatsapp = $request->input('responsible_whatsapp');
        $atleta->responsible_email = $request->input('responsible_email');
        $atleta->responsible_address = $request->input('responsible_address');

        $atleta->kinship = $request->input('kinship');
        $atleta->responsible_doses_number = $request->input('responsible_doses_number');

        $atleta->update();

        $idclass = $request->input('idclass');
        $config = Config::first();

        $class=DB::table('class as cl')
        ->join('cycles as c','cl.cycle_id','=','c.id')
        ->join('categories as cat','cl.category_id','=','cat.id')
        ->join('groups as g','cat.group_id','=','g.id')
        ->join('schedule as s','cl.schedule_id','=','s.id')
        ->join('facilities as f','s.facility_id','=','f.id')
        ->join('users as i','cl.instructor_id','=','i.id')
        ->select('cl.id','cl.cycle_id as CLcycle_id','cl.category_id as CLcategory_id','cl.schedule_id as CLschedule_id','cl.instructor_id as CLinstructor_id','cl.start_date as CLstart_date','cl.end_date as CLend_date','cl.notes as CLnotes','cl.monthly_payment as CLmonthly_payment','cl.inscription_payment as CLinscription_payment','cl.badge as CLbadge','c.name as CYid','c.start_date as CYstart_date','c.end_date as CYend_date','c.description as CYdescription','c.status as CYstatus','g.name as Gname','g.description as Gdescription','g.image as Gimage','g.status as Gstatus','g.contract as Gcontract','cat.name as Cname','cat.age_from','cat.age_to','cat.description as Cdescription','cat.image as Cimage','cat.status as Cstatus','cat.requirements as Crequirements','cat.implements as Cimplements','cat.contract as Ccontract','s.facility_id','s.start_time as Sstart_time','s.end_time as Send_time','s.sunday','s.monday','s.tuesday','s.wednesday','s.thursday','s.friday','s.saturday','s.quota','f.name as Fname','f.description as Fdescription','f.location','f.image as Fimage','f.status as Fstatus','i.name as Iname','i.email','i.phone','i.whatsapp')
        ->where('cl.id',$idclass)
        ->first();

        $inscription = new Inscription();
        $inscription->class_id = $idclass;
        $inscription->cycle_id = $class->CLcycle_id;
        $inscription->atleta_id = $atleta->id;
        $inscription->contract = 1;
        $inscription->inscription_payment = 0;
        $inscription->badge_payment = 0;
        $inscription->status = 1;
        $inscription->save();

        $fecha = $inscription->created_at;
        $fecha = date("dmY", strtotime($fecha));
        $idinscription = $inscription->id;

        $inscription_number = "INSC-".$fecha.$idinscription;

        $inscription = Inscription::find($inscription->id);
        $inscription->inscription_number = $inscription_number;
        $inscription->update();

        try {
            Mail::to($atleta->email)->send(new InscriptionMail($inscription));
            Mail::to($atleta->responsible_email)->send(new InscriptionMail($inscription));
            Mail::to($config->email)->send(new InscriptionMail($inscription));
        }
        catch (exception $e) {
            $request->session()->flash('alert-success', __('The registration has been created correctly, save this information to be able to consult again if your request has been confirmed, any questions or comments, contact us. Automatic mail could not be sent.'));

            return view('frontend.inscription.inscriptionform', compact('atleta','class','config','inscription'));
        }

        $request->session()->flash('alert-success', __('The registration has been created correctly, save this information to be able to consult again if your request has been confirmed, any questions or comments, contact us'));
        return view('frontend.inscription.inscriptionform', compact('atleta','class','config','inscription'));
    }

    public function pdf(Request $request)
    {
        if ($request)
        {
            $atleta = Atleta::find($request->input('ratleta'));
            $idclass = $request->input('ridclass');

            $class=DB::table('class as cl')
            ->join('cycles as c','cl.cycle_id','=','c.id')
            ->join('categories as cat','cl.category_id','=','cat.id')
            ->join('groups as g','cat.group_id','=','g.id')
            ->join('schedule as s','cl.schedule_id','=','s.id')
            ->join('facilities as f','s.facility_id','=','f.id')
            ->join('users as i','cl.instructor_id','=','i.id')
            ->select('cl.id','cl.cycle_id as CLcycle_id','cl.category_id as CLcategory_id','cl.schedule_id as CLschedule_id','cl.instructor_id as CLinstructor_id','cl.start_date as CLstart_date','cl.end_date as CLend_date','cl.notes as CLnotes','cl.monthly_payment as CLmonthly_payment','cl.inscription_payment as CLinscription_payment','cl.badge as CLbadge','c.name as CYid','c.start_date as CYstart_date','c.end_date as CYend_date','c.description as CYdescription','c.status as CYstatus','g.name as Gname','g.description as Gdescription','g.image as Gimage','g.status as Gstatus','g.contract as Gcontract','cat.name as Cname','cat.age_from','cat.age_to','cat.description as Cdescription','cat.image as Cimage','cat.status as Cstatus','cat.requirements as Crequirements','cat.implements as Cimplements','cat.contract as Ccontract','s.facility_id','s.start_time as Sstart_time','s.end_time as Send_time','s.sunday','s.monday','s.tuesday','s.wednesday','s.thursday','s.friday','s.saturday','s.quota','f.name as Fname','f.description as Fdescription','f.location','f.image as Fimage','f.status as Fstatus','i.name as Iname','i.email','i.phone','i.whatsapp')
            ->where('cl.id',$idclass)
            ->first();

            $inscription = Inscription::find($request->input('ridinscription'));

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


            $config = Config::first();

            if ( $verpdf == "Download" )
            {
                $pdf = PDF::loadView('frontend.inscription.pdf',['atleta'=>$atleta,'class'=>$class,'inscription'=>$inscription,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency]);

                return $pdf->download ('Inscripcion: '.$inscription->inscriptionnumber.$nompdf.'.pdf');
            }
            if ( $verpdf == "Browser" )
            {
                $pdf = PDF::loadView('frontend.inscription.pdf',['atleta'=>$atleta,'class'=>$class,'inscription'=>$inscription,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency]);

                return $pdf->stream ('Inscripcion: '.$inscription->inscriptionnumber.$nompdf.'.pdf');
            }
        }
    }
}
