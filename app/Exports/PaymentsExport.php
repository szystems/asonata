<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use PhpOffice\PhpSpreadsheet\Shared\XMLWriter;

use Illuminate\Support\Facades\Auth;

use DateTime;
use DateTimeZone;

use App\Models\Cycle;
use App\Models\Classs;
use App\Models\Category;
use App\Models\Group;
use App\Models\Inscription;
use App\Models\Atleta;
use App\Models\Config;
use App\Models\User;

class PaymentsExport implements FromView
{
    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }



    public function view(): View
    {
        $queryDesde = $this->request->input('fdesde');
        $queryHasta = $this->request->input('fhasta');
        $queryIN = $this->request->input('fin');
        $queryType = $this->request->input('ftype');
        $queryCui = $this->request->input('fcui');
        $queryCategory = $this->request->input('fcategory');
        $queryCycle = $this->request->input('fcycle');
        $queryGroup = $this->request->input('fgroup');
        $queryUser = $this->request->input('fuser');

        if ($queryType == null) {
            $queryType = "0,6";
        }

        $paymentType = str_split($queryType);
        $typeFrom = $paymentType[0];
        $typeTo = $paymentType[2];

        if ($queryDesde != "" or $queryHasta != "") {


            $queryDesde = date("Y-m-d 00:00:00", strtotime($queryDesde));
            $queryHasta = date("Y-m-d 23:59:59", strtotime($queryHasta));

        }else
        {

            //$queryDesde = Payment::min('created_at');
            $queryHasta = Payment::max('created_at');

            $queryDesde = date("Y-m-d 00:00:00", strtotime($queryHasta.'- 1 month'));
            $queryHasta = date("Y-m-d 23:59:59", strtotime($queryHasta));
        }
        $payments = Payment::join('inscriptions', 'inscriptions.id', '=', 'payments.inscription_id')
        ->join('atleta', 'atleta.id', '=', 'inscriptions.atleta_id')
        ->join('cycles', 'cycles.id', '=', 'inscriptions.cycle_id')
        ->join('class', 'class.id', '=', 'inscriptions.class_id')
        ->join('categories', 'categories.id', '=', 'class.category_id')
        ->join('groups', 'groups.id', '=', 'categories.group_id')
        ->join('users', 'users.id', '=', 'payments.user_id')
        ->whereBetween('payments.created_at', [$queryDesde, $queryHasta])
        ->whereBetween('payments.type',[$typeFrom,$typeTo])
        ->where('inscriptions.inscription_number','LIKE',$queryIN)
        ->where('atleta.cui_dpi','LIKE',$queryCui)
        ->where('categories.id','LIKE',$queryCategory)
        ->where('groups.id','LIKE',$queryGroup)
        ->where('cycles.id','LIKE',$queryCycle)
        ->where('users.id','LIKE',$queryUser)
        ->orderBy('payments.id','desc')
        // ->get('payments.id','payments.inscription_id','payments.type','payments.paid','payments.created_at','payments.updated_at','inscriptions.class_id','inscriptions.cycle_id','inscriptions.atleta_id','inscriptions.inscription_number','atleta.cui_dpi','atleta.image','atleta.birth','atleta.gender','atleta.phone','atleta.whatsapp','atleta.email','cycles.name','cycles.start_date','cycles.end_date','class.cycle_id','class.category_id','class.schedule_id','class.instructor_id','cycle.start_date','cycle.end_date','cycle.inscription_payment','cycle.monthly_payment','cycle.badge','categories.group_id','categories.name','categories.age_from','categories.age_to','groups.name');
        // ->paginate($this->paginacion, $this->campos);
        ->get('payments.*','inscription.*','atleta.*','cycles.*','class.id','categories.*','groups.*');


        $total = 0;
        foreach ($payments as $sumaPagos) {
            $total = $total + $sumaPagos->paid;
        }


        $queryDesde = new DateTime($queryDesde, new DateTimeZone(date_default_timezone_get()));
        $queryDesde->setTimezone(new DateTimeZone(Auth::user()->timezone));

        $queryHasta = new DateTime($queryHasta, new DateTimeZone(date_default_timezone_get()));
        $queryHasta->setTimezone(new DateTimeZone(Auth::user()->timezone));

        $desde = $queryDesde->format("d-m-Y");
        $hasta = $queryHasta->format("d-m-Y");

        $queryDesde = $queryDesde->format("Y-m-d H:i:s");
        $queryHasta = $queryHasta->format("Y-m-d H:i:s");

        $cyclesFilter = Cycle::where('status',1)->get();
        $categoriesFilter = Category::where('status',1)->orderBy('name','asc')->get();
        $groupFilter = Group::where('status',1)->orderBy('name','asc')->get();
        $usersFilter = User::where('status',1)->where('role_as','!=',3)->orderBy('name','asc')->get();

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

        // Retornar la vista blade con los request
        return view('admin.payment.exportpayments', [


            'queryDesde' => $queryDesde,
            'queryHasta' => $queryHasta,
            'queryType' => $queryType,
            'queryIN' => $queryIN,
            'queryCui' => $queryCui,
            'queryCycle' => $queryCycle,
            'queryCategory' => $queryCategory,
            'queryGroup' => $queryGroup,
            'queryUser' => $queryUser,
            'payments' => $payments,
            'cyclesFilter' => $cyclesFilter,
            'categoriesFilter' => $categoriesFilter,
            'groupFilter' => $groupFilter,
            'usersFilter' => $usersFilter,
            'desde' => $desde,
            'hasta' => $hasta,
            'config' => $config,
            'total' => $total

        ]);
    }
}
