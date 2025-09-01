<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cycle;
use App\Http\Requests\CycleFormRequest;
use App\Http\Requests\CycleEditFormRequest;
use App\Models\Schedule;
use App\Http\Requests\ScheduleFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use DB;

class CycleController extends Controller
{
    public function index(Request $request)
    {
        if ($request)
        {
            $queryCycle=$request->input('fcycle');
            $cycles=DB::table('cycles')
            ->where('status','=',1)
            ->where('name','LIKE','%'.$queryCycle.'%')
            ->orderBy('end_date','desc')
            ->get();
            $filterCycles = Cycle::all();
            return view('admin.cycle.index', compact('cycles','queryCycle','filterCycles'));
        }
    }

    public function show($id)
    {
        $cycle = Cycle::find($id);
        $schedules=DB::table('schedule')
            ->where('status',1)
            ->where('cycle_id',$id)
            ->orderBy('facility_id','asc')
            ->orderBy(DB::raw('HOUR(start_time)'))
            ->get();
        return view('admin.cycle.show', compact('cycle','schedules'));
    }

    public function add()
    {
        return view('admin.cycle.add');
    }

    public function insert(CycleFormRequest $request)
    {
        $start_date = $request->get('start_date');
        $start_date = date("Y-m-d", strtotime($start_date));

        $end_date = $request->get('end_date');
        $end_date = date("Y-m-d", strtotime($end_date));

        $cycle = new Cycle();
        $cycle->name = $request->input('name');
        $cycle->description = $request->input('description');
        $cycle->start_date = $start_date;
        $cycle->end_date = $end_date;
        $cycle->status = 1;
        $cycle->mostrar = $request->input('mostrar') == TRUE ? '1':'0';
        $cycle->save();

        return redirect('index_cycles')->with('status', __('Cycle Added Successfully'));
    }

    public function edit($id)
    {
        $cycle = Cycle::find($id);
        return view('admin.cycle.edit', compact('cycle'));
    }

    public function update(CycleEditFormRequest $request, $id)
    {
        $start_date = $request->get('start_date');
        $start_date = date("Y-m-d", strtotime($start_date));

        $end_date = $request->get('end_date');
        $end_date = date("Y-m-d", strtotime($end_date));

        $cycle = Cycle::find($id);
        $cycle->name = $request->input('name');
        $cycle->description = $request->input('description');
        $cycle->start_date = $start_date;
        $cycle->end_date = $end_date;
        $cycle->mostrar = $request->input('mostrar') == TRUE ? '1':'0';
        $cycle->update();

        return redirect('index_cycles')->with('status',__('Cycle Updated Successfully'));
    }

    public function destroy($id)
    {
        $cycle = Cycle::find($id);
        $cycle->status = 0;
        $cycle->update();
        return redirect('index_cycles')->with('status',__('Cycle Deleted Successfully'));
    }

    public function addschedule($id)
    {
        $cycle_id = $id;
        $facilities=DB::table('facilities')
            ->where('status',1)
            ->orderBy('name','asc')
            ->get();
        return view('admin.cycle.addschedule', compact('cycle_id','facilities'));
    }

    public function insertschedule(ScheduleFormRequest $request)
    {


        $schedule = new Schedule();
        $schedule->cycle_id = $request->input('cycle_id');
        $schedule->facility_id = $request->input('facility_id');
        $schedule->start_time = $request->input('start_time');
        $schedule->end_time = $request->input('end_time');
        $schedule->quota = $request->input('quota');
        $schedule->sunday = $request->input('sunday') == TRUE ? '1':'0';
        $schedule->monday = $request->input('monday') == TRUE ? '1':'0';
        $schedule->tuesday = $request->input('tuesday') == TRUE ? '1':'0';
        $schedule->wednesday = $request->input('wednesday') == TRUE ? '1':'0';
        $schedule->thursday = $request->input('thursday') == TRUE ? '1':'0';
        $schedule->friday = $request->input('friday') == TRUE ? '1':'0';
        $schedule->saturday = $request->input('saturday') == TRUE ? '1':'0';
        $schedule->status = 1;
        $schedule->save();

        $cycle = Cycle::find($schedule->cycle_id);
        $schedules=DB::table('schedule')
            ->where('status',1)
            ->where('cycle_id',$schedule->cycle_id)
            ->orderBy('facility_id','asc')
            ->get();

        //return view('admin.cycle.show', compact('cycle','schedules'))->with('status', __('Schedule Added Successfully'));
        return redirect('show-cycle/'.$schedule->cycle_id)->with('status', __('Schedule Added Successfully'));
    }

    public function editschedule($id)
    {
        $schedule = Schedule::find($id);
        $facilities=DB::table('facilities')
            ->where('status',1)
            ->orderBy('name','asc')
            ->get();
        return view('admin.cycle.editschedule', compact('schedule','facilities'));
    }

    public function updateschedule(ScheduleFormRequest $request, $id)
    {
        $schedule = Schedule::find($id);
        $schedule->facility_id = $request->input('facility_id');
        $schedule->start_time = $request->input('start_time');
        $schedule->end_time = $request->input('end_time');
        $schedule->quota = $request->input('quota');
        $schedule->sunday = $request->input('sunday') == TRUE ? '1':'0';
        $schedule->monday = $request->input('monday') == TRUE ? '1':'0';
        $schedule->tuesday = $request->input('tuesday') == TRUE ? '1':'0';
        $schedule->wednesday = $request->input('wednesday') == TRUE ? '1':'0';
        $schedule->thursday = $request->input('thursday') == TRUE ? '1':'0';
        $schedule->friday = $request->input('friday') == TRUE ? '1':'0';
        $schedule->saturday = $request->input('saturday') == TRUE ? '1':'0';
        $schedule->update();

        return redirect('show-cycle/'.$schedule->cycle_id)->with('status', __('Schedule Added Successfully'));
    }

    public function destroyschedule($id)
    {
        $schedule = Schedule::find($id);
        $cycle_id = $schedule->cycle_id;
        $schedule->status = 0;
        $schedule->update();
        return redirect('show-cycle/'.$schedule->cycle_id)->with('status',__('Schedule Deleted Successfully'));
    }
}
