<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Secction;
use App\Http\Requests\SectionFormRequest;
use App\Models\Slide;
use App\Http\Requests\SlideFormRequest;
use App\Models\Team;
use App\Models\TeamMember;
use Illuminate\Support\Facades\File;
use DB;

class SectionController extends Controller
{
    public function index()
    {
        $section = Secction::first();
        $slides = Slide::all();
        $teams = Team::all();
        return view('admin.section.index', compact('section','slides','teams'));
    }

    public function update(SectionFormRequest $request)
    {
        $section = Secction::first();

        if ($request->input('section') == "inicio") {
            $section->inicio_titulo = $request->input('inicio_titulo');
            $section->inicio_descripcion = $request->input('inicio_descripcion');
            $section->inicio_descripcion_2 = $request->input('inicio_descripcion_2');
            $section->video_link = $request->input('video_link');
            $section->video_titulo = $request->input('video_titulo');
            $section->video_descripcion = $request->input('video_descripcion');
            if($request->hasFile('video_fondo'))
            {
                $path = 'assets/uploads/video/'.$section->video_fondo;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $file = $request->file('video_fondo');
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;
                $file->move('assets/uploads/video/',$filename);
                $section->video_fondo = $filename;
            }
        }

        if ($request->input('section') == "nosotros") {
            $section->nosotros_titulo = $request->input('nosotros_titulo');
            $section->nosotros_descripcion = $request->input('nosotros_descripcion');
            $section->nosotros_descripcion2 = $request->input('nosotros_descripcion2');
            if($request->hasFile('nosotros_imagen'))
            {
                $path1 = 'assets/uploads/nosotros/'.$section->nosotros_imagen;
                if(File::exists($path1))
                {
                    File::delete($path1);
                }
                $file1 = $request->file('nosotros_imagen');
                $ext1 = $file1->getClientOriginalExtension();
                $filename1 = time().'.'.$ext1;
                $file1->move('assets/uploads/nosotros/',$filename1);
                $section->nosotros_imagen = $filename1;
            }
        }

        if ($request->input('section') == "contacto") {
            $section->contacto_titulo = $request->input('contacto_titulo');
            $section->contacto_descripcion = $request->input('contacto_descripcion');
            $section->contacto_titulo2 = $request->input('contacto_titulo2');
            $section->contacto_descripcion2 = $request->input('contacto_descripcion2');
            $section->contacto_direccion = $request->input('contacto_direccion');
            $section->contacto_telefono = $request->input('contacto_telefono');
            $section->contacto_telefono2 = $request->input('contacto_telefono2');
            $section->contacto_email = $request->input('contacto_email');
            $section->contacto_lunes_viernes = $request->input('contacto_lunes_viernes');
            $section->contacto_lunes_viernes2 = $request->input('contacto_lunes_viernes2');
            $section->contacto_domingo = $request->input('contacto_domingo');
        }

        $section->update();

        $request->session()->flash('alert-success', __('La seccion fue actualizada correctamente.'));

        return view('admin.section.index', compact('section'));
    }

    public function addslide(SlideFormRequest $request)
    {
        $slide = new Slide();
        if($request->hasFile('imagen'))
        {
            $file1 = $request->file('imagen');
            $ext1 = $file1->getClientOriginalExtension();
            $filename1 = time().'.'.$ext1;
            $file1->move('assets/uploads/slides',$filename1);
            $slide->imagen = $filename1;
        }
        $slide->titulo = $request->input('titulo');
        $slide->descripcion = $request->input('descripcion');
        $slide->boton_texto = $request->input('boton_texto');
        $slide->boton_link = $request->input('boton_link');
        $slide->save();

        $request->session()->flash('alert-success', __('La diapositiva fue agregada correctamente.'));

        return redirect('sections');
    }

    public function updatecarrousel(SlideFormRequest $request)
    {
        $slide = Slide::find($request->input('slide_id'));
        if($request->hasFile('imagen'))
        {
            $path = 'assets/uploads/slides/'.$slide->imagen;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('imagen');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/slides/',$filename);
            $slide->imagen = $filename;
        }
        $slide->titulo = $request->input('titulo');
        $slide->descripcion = $request->input('descripcion');
        $slide->boton_texto = $request->input('boton_texto');
        $slide->boton_link = $request->input('boton_link');
        $slide->update();

        $request->session()->flash('alert-success', __('La diapositiva fue actualizada correctamente.'));

        return redirect('sections');
    }

    public function destroyslide(Request $request, $id)
    {
        $slide = Slide::find($id);
        // dd($slide);
        if ($slide->imagen)
        {
            $path = 'assets/uploads/slides/'.$slide->imagen;
            if (File::exists($path))
            {
                File::delete($path);

            }
        }
        $slide->delete();

        $request->session()->flash('alert-success', __('La diapositiva fue eliminada correctamente.'));

        return redirect('sections');
    }

    public function addteam(Request $request)
    {
        $team = new Team();
        $team->nombre = $request->input('nombre');
        $team->descripcion = $request->input('descripcion');
        $team->save();

        $request->session()->flash('alert-success', __('El equipo fue creado correctamente.'));

        return redirect('sections');
    }

    public function updateteam(Request $request)
    {
        $team = Team::find($request->input('team_id'));
        $team->nombre = $request->input('nombre');
        $team->descripcion = $request->input('descripcion');
        $team->update();

        $request->session()->flash('alert-success', __('El equipo fue actualizado correctamente.'));

        return redirect('sections');
    }

    public function destroyteam(Request $request, $id)
    {
        $team = Team::find($id);
        $team->delete();

        $teammember = TeamMember::where('team_id',$id);
        $teammember->delete();

        $request->session()->flash('alert-success', __('El equipo eliminado correctamente.'));

        return redirect('sections');
    }

    public function addmember(Request $request)
    {
        $member = new TeamMember();
        $member->team_id = $request->input('team_id');
        $member->cargo = $request->input('cargo');
        $member->nombre = $request->input('nombre');
        $member->save();

        $request->session()->flash('alert-success', __('El miembro fue agregado correctamente.'));

        return redirect('sections');
    }

    public function updatemember(Request $request)
    {
        $member = TeamMember::find($request->input('member_id'));
        $member->nombre = $request->input('nombre');
        $member->cargo = $request->input('cargo');
        $member->update();

        $request->session()->flash('alert-success', __('El miembro fue actualizado correctamente.'));

        return redirect('sections');
    }

    public function destroymember(Request $request, $id)
    {
        $member = TeamMember::find($id);
        $member->delete();

        $request->session()->flash('alert-success', __('El miembro eliminado correctamente.'));

        return redirect('sections');
    }
}
