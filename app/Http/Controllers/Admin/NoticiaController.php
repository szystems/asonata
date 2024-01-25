<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Noticia;
use App\Http\Requests\NoticiaFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use DB;
use Carbon\Carbon;
use DateTime;

class NoticiaController extends Controller
{
    public function index(Request $request)
    {
        if ($request)
        {
            $queryNoticia=$request->input('fnoticia');
            $noticias= Noticia::where('titulo','LIKE','%'.$queryNoticia.'%')
            ->orderBy('updated_at','desc')
            ->paginate(50);
            // dd($noticias);
            return view('admin.noticia.index', compact('noticias','queryNoticia'));
        }
    }

    public function show($id)
    {
        $noticia = Noticia::find($id);
        return view('admin.noticia.show', compact('noticia'));
    }

    public function add()
    {
        return view('admin.noticia.add');
    }

    public function insert(NoticiaFormRequest $request)
    {


        $noticia = new Noticia();
        if($request->hasFile('imagen'))
        {
            $file1 = $request->file('imagen');
            $ext1 = $file1->getClientOriginalExtension();
            $filename1 = time().'.'.$ext1;
            $file1->move('assets/uploads/noticias',$filename1);
            $noticia->imagen = $filename1;
        }
        $noticia->titulo = $request->input('titulo');
        $noticia->contenido = $request->input('contenido');
        $noticia->save();

        return redirect('index_noticias')->with('status', __('Noticia agregada correctamente.'));
    }

    public function edit($id)
    {
        $noticia = Noticia::find($id);
        return view('admin.noticia.edit', \compact('noticia'));
    }

    public function update(NoticiaFormRequest $request, $id)
    {
        $noticia = Noticia::find($id);
        if($request->hasFile('imagen'))
        {
            $path = 'assets/uploads/noticias/'.$noticia->imagen;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file1 = $request->file('imagen');
            $ext1 = $file1->getClientOriginalExtension();
            $filename1 = time().'.'.$ext1;
            $file1->move('assets/uploads/noticias',$filename1);
            $noticia->imagen = $filename1;
        }
        $noticia->titulo = $request->input('titulo');
        $noticia->contenido = $request->input('contenido');
        $noticia->update();

        return redirect('index_noticias')->with('status',__('Noticia actualizada correctamente'));
    }

    public function destroy($id)
    {
        $noticia = Noticia::find($id);
        if ($noticia->imagen)
        {
            $path = 'assets/uploads/noticias/'.$noticia->imagen;
            if (File::exists($path))
            {
                File::delete($path);

            }
        }
        $noticia->delete();
        return redirect('index_noticias')->with('status',__('Noticia eliminada correctamente'));
    }

    public function uploadimagen(Request $request)
    {
        if ($request->hasFile('upload'))
        {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = \pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'),$fileName);

            $url = asset('media/' . $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
