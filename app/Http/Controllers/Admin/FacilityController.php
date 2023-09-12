<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Facility;
use App\Http\Requests\FacilityFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use DB;

class FacilityController extends Controller
{
    public function index(Request $request)
    {
        if ($request)
        {
            $queryFacility=$request->input('ffacility');
            $facilities=DB::table('facilities')
            ->where('status','=',1)
            ->where('name','LIKE','%'.$queryFacility.'%')
            ->orderBy('name','asc')
            ->paginate(25);
            $filterFacilities = Facility::all();
            return view('admin.facility.index', compact('facilities','queryFacility','filterFacilities'));
        }
    }

    public function show($id)
    {
        $facility = Facility::find($id);
        return view('admin.facility.show', compact('facility'));
    }

    public function add()
    {
        return view('admin.facility.add');
    }

    public function insert(FacilityFormRequest $request)
    {


        $facility = new Facility();
        if($request->hasFile('image'))
        {
            $file1 = $request->file('image');
            $ext1 = $file1->getClientOriginalExtension();
            $filename1 = time().'.'.$ext1;
            $file1->move('assets/uploads/facilities',$filename1);
            $facility->image = $filename1;
        }
        $facility->name = $request->input('name');
        $facility->description = $request->input('description');
        $facility->location = $request->input('location');
        $facility->status = 1;
        $facility->save();

        return redirect('index_facilities')->with('status', __('Facility Added Successfully'));
    }

    public function edit($id)
    {
        $facility = Facility::find($id);
        return view('admin.facility.edit', \compact('facility'));
    }

    public function update(FacilityFormRequest $request, $id)
    {
        $facility = Facility::find($id);
        if($request->hasFile('image'))
        {
            $path = 'assets/uploads/facilities/'.$facility->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file1 = $request->file('image');
            $ext1 = $file1->getClientOriginalExtension();
            $filename1 = time().'.'.$ext1;
            $file1->move('assets/uploads/facilities',$filename1);
            $facility->image = $filename1;
        }
        $facility->name = $request->input('name');
        $facility->description = $request->input('description');
        $facility->location = $request->input('location');
        $facility->update();

        return redirect('index_facilities')->with('status',__('Facility Updated Successfully'));
    }

    public function destroy($id)
    {
        $facility = Facility::find($id);
        if ($facility->image)
        // {
        //     $path = 'assets/uploads/facilities/'.$facility->image;
        //     if (File::exists($path))
        //     {
        //         File::delete($path);

        //     }
        // }
        $facility = Facility::find($id);
        $facility->status = 0;
        $facility->update();
        return redirect('index_facilities')->with('status',__('Facility Deleted Successfully'));
    }

}
