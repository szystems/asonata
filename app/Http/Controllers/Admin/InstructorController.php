<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UserCreateFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Config;
use PDF;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\userMail;

class InstructorController extends Controller
{
    public function users(Request $request)
    {
        if ($request)
        {
            $queryUser=$request->input('fuser');
            $users=DB::table('users')
            ->where('status','=',1)
            ->where('role_as',3)
            ->where('name','LIKE','%'.$queryUser.'%')
            ->orWhere('phone','LIKE','%'.$queryUser.'%')
            ->where('status','=',1)
            ->where('role_as',3)
            ->where('name','LIKE','%'.$queryUser.'%')
            ->orWhere('email','LIKE','%'.$queryUser.'%')
            ->where('status','=',1)
            ->where('role_as',3)
            ->where('name','LIKE','%'.$queryUser.'%')
            ->orWhere('whatsapp','LIKE','%'.$queryUser.'%')
            ->where('status','=',1)
            ->where('role_as',3)
            ->orderBy('name','asc')
            ->paginate(25);
            $filterUsers = User::all();
            return view('admin.instructor.index', compact('users','queryUser','filterUsers'));
        }
    }

    public function showuser($id)
    {
        $user = User::find($id);
        return view('admin.instructor.show', compact('user'));
    }

    public function adduser()
    {
        return view('admin.instructor.add');
    }

    public function insertuser(UserCreateFormRequest $request)
    {
        $user = new User();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/users',$filename);
            $user->image = $filename;
        }
        $user->role_as = $request->input('role_as');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = 'eshop'.rand(1111,9999);
        $user->phone = $request->input('phone');
        $user->whatsapp = $request->input('whatsapp');
        $user->address1 = $request->input('address1');
        $user->address2 = $request->input('address2');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->country = $request->input('country');
        $user->zipcode = $request->input('zipcode');
        $user->description = $request->input('description');
        $user->timezone = $request->input('timezone');
        $user->save();

        Mail::to($user->email)->send(new UserMail($user));

        return redirect('instructores')->with('status', __('Instructor Added Successfully'));
    }

    public function edituser($id)
    {
        $user = User::find($id);
        return view('admin.instructor.edit', \compact('user'));
    }

    public function updateuser(UserFormRequest $request, $id)
    {
        $user = User::find($id);
        if($request->hasFile('image'))
        {
            $path = 'assets/uploads/users  n/'.$user->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/users',$filename);
            $user->image = $filename;
        }
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->whatsapp = $request->input('whatsapp');
        $user->address1 = $request->input('address1');
        $user->address2 = $request->input('address2');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->country = $request->input('country');
        $user->zipcode = $request->input('zipcode');
        $user->description = $request->input('description');
        $user->timezone = $request->input('timezone');
        $user->update();

        if (Auth::id() == $id) {
            return redirect('show-instructor/'.$id)->with('status',__('Instructor Updated Successfully'));
        }else{
            return redirect('instructores')->with('status',__('Instructor Updated Successfully'));
        }

    }

    public function destroyuser($id)
    {
        $user = User::find($id);
        // if ($user->image)
        // {
        //     $path = 'assets/uploads/category/'.$user->image;
        //     if (File::exists($path))
        //     {
        //         File::delete($path);

        //     }
        // }
        $user = User::find($id);
        $user->status = 0;
        $user->email = $user->email.'-Deleted';
        $user->update();
        return redirect('instructores')->with('status',__('Instructor Deleted Successfully'));
    }

    public function pdf(Request $request)
    {
        if ($request)
        {
            $user = User::find($request->input('ruser'));

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
                $pdf = PDF::loadView('admin.instructor.pdf',['user'=>$user,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency]);

                return $pdf->download ('User: '.$user->name.$nompdf.'.pdf');
            }
            if ( $verpdf == "Browser" )
            {
                $pdf = PDF::loadView('admin.instructor.pdf',['user'=>$user,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency]);

                return $pdf->stream ('User: '.$user->name.$nompdf.'.pdf');
            }
        }
    }
}
