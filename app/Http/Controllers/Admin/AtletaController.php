<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Atleta;
use App\Models\Inscription;
use App\Models\Attendance;
use App\Models\Assist;
use App\Models\Config;
use App\Http\Requests\AtletaFormRequest;
use App\Http\Requests\AtletaUpdateFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use PDF;
use DB;

class AtletaController extends Controller
{
    public function index(Request $request)
    {
        if ($request)
        {
            $queryAtleta=$request->input('fatleta');
            $atletas=DB::table('atleta')
            ->where('status','=',1)
            ->where('name','LIKE','%'.$queryAtleta.'%')
            ->orWhere('cui_dpi','LIKE','%'.$queryAtleta.'%')
            ->where('status','=',1)
            ->where('name','LIKE','%'.$queryAtleta.'%')
            ->orWhere('phone','LIKE','%'.$queryAtleta.'%')
            ->where('status','=',1)
            ->where('name','LIKE','%'.$queryAtleta.'%')
            ->orWhere('email','LIKE','%'.$queryAtleta.'%')
            ->where('status','=',1)
            ->where('name','LIKE','%'.$queryAtleta.'%')
            ->orWhere('cui_dpi','LIKE','%'.$queryAtleta.'%')
            ->where('status','=',1)
            ->orderBy('name','asc')
            ->paginate(25);

            $filterAtletas = Atleta::all();

            return view('admin.atleta.index', compact('atletas','queryAtleta','filterAtletas'));
        }
    }

    public function show($id)
    {
        $atleta = Atleta::find($id);

        $inscriptions= Inscription::join('class','class.id','inscriptions.class_id')
        ->join('cycles','cycles.id','inscriptions.cycle_id')
        ->where('inscriptions.status',1)
        ->where('inscriptions.atleta_id',$id)
        ->orderBy('inscriptions.created_at','desc')
        ->get('inscriptions.*','class.*','cycles.*');
        $config = Config::first();

        return view('admin.atleta.show', compact('atleta','inscriptions','config'));
    }

    public function add()
    {
        return view('admin.atleta.add');
    }

    public function insert(AtletaFormRequest $request)
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

        return redirect('index_athletes')->with('status', __('Athlete Added Successfully'));
    }

    public function edit($id)
    {
        $atleta = Atleta::find($id);
        return view('admin.atleta.edit', \compact('atleta'));
    }

    public function update(AtletaUpdateFormRequest $request, $id)
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

        if (Auth::id() == $id) {
            return redirect('show-athlete/'.$id)->with('status',__('Athlete Updated Successfully'));
        }else{
            return redirect('index_athletes')->with('status',__('Athlete Updated Successfully'));
        }

    }

    public function destroy($id)
    {
        $atleta = Atleta::find($id);
        // if ($atleta->image)
        // {
        //     $path = 'assets/uploads/athletes/'.$atleta->image;
        //     if (File::exists($path))
        //     {
        //         File::delete($path);

        //     }
        // }
        $atleta = Atleta::find($id);
        $atleta->status = 0;
        $atleta->email = $atleta->email.'-Deleted';
        $atleta->update();
        return redirect('index_athletes')->with('status',__('Athlete Deleted Successfully'));
    }

    public function pdf(Request $request)
    {
        if ($request)
        {
            $atleta = Atleta::find($request->input('ratleta'));

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
                $pdf = PDF::loadView('admin.atleta.pdf',['atleta'=>$atleta,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency]);

                return $pdf->download ('Atleta: '.$atleta->name.$nompdf.'.pdf');
            }
            if ( $verpdf == "Browser" )
            {
                $pdf = PDF::loadView('admin.atleta.pdf',['atleta'=>$atleta,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency]);

                return $pdf->stream ('Atleta: '.$atleta->name.$nompdf.'.pdf');
            }
        }
    }
}
