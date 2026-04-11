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
    private function sanitizeHtmlContent($html)
    {
        // Eliminar etiquetas script/style completas antes de aplicar whitelist.
        $clean = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', (string) $html);
        $clean = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', '', (string) $clean);

        // Permitir solo etiquetas editoriales comunes en noticias.
        $clean = strip_tags(
            (string) $clean,
            '<p><br><strong><b><em><i><u><ul><ol><li><blockquote><h1><h2><h3><h4><h5><h6><a><img>'
        );

        // Remover atributos inline peligrosos y javascript: en href/src.
        $clean = preg_replace('/\s+on[a-z]+\s*=\s*(["\']).*?\1/iu', '', (string) $clean);
        $clean = preg_replace('/\s+on[a-z]+\s*=\s*[^\s>]+/iu', '', (string) $clean);
        $clean = preg_replace('/(href|src)\s*=\s*(["\'])\s*javascript:.*?\2/iu', '$1="#"', (string) $clean);

        return $clean;
    }

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
            $filename1 = bin2hex(random_bytes(16)).'.'.$ext1;
            $file1->move('assets/uploads/noticias',$filename1);
            $noticia->imagen = $filename1;
        }
        $noticia->titulo = $request->input('titulo');
        $noticia->contenido = $this->sanitizeHtmlContent($request->input('contenido'));
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
            $filename1 = bin2hex(random_bytes(16)).'.'.$ext1;
            $file1->move('assets/uploads/noticias',$filename1);
            $noticia->imagen = $filename1;
        }
        $noticia->titulo = $request->input('titulo');
        $noticia->contenido = $this->sanitizeHtmlContent($request->input('contenido'));
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
        $request->validate([
            'upload' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:3000',
        ]);

        if ($request->hasFile('upload'))
        {
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = bin2hex(random_bytes(16)) . '.' . $extension;

            $request->file('upload')->move(public_path('media'),$fileName);

            $url = asset('media/' . $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
