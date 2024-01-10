<!DOCTYPE html>
<html>
<head>
  <title>Listado de Alumnos de Clase</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      text-align: left;
      padding: 8px;
      border: 1px solid #ddd;
    }

    th {
      background-color: #4CAF50;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
<table>
    <thead>
        <tr>
            <th colspan="14" align="center" color="red" size="1"><b>Asonata</b></th>
        </tr>
        <tr>
            <th colspan="14" align="center"><b>Reporte de Pagos</b></th>
        </tr>
        <tr>
            <th colspan="14" align="center"></th>
        </tr>
        <tr>
            <th colspan="2" align="right">
                <h6>
                    <b>Fecha de reporte: </b>
                </h6>
            </th>
            <th colspan="12" align="left">
                @php
                    $horafecha = new DateTime("now", new DateTimeZone(Auth::user()->timezone));
                    $horafecha = $horafecha->format('d-m-Y, H:i:s')
                @endphp
                &nbsp;{{ $horafecha }} ({{ Auth::user()->timezone }})
            </th>
        </tr>
        <tr>
            <th colspan="14" align="center"></th>
        </tr>
        <tr>
            <th colspan="14" align="center"><b>Clase:</b></th>
        </tr>
        <tr>
            @php
                $categoryClass = \App\Models\Category::find($class->category_id);
            @endphp
            <th align="right" colspan="2">
                <b>{{ __('Category') }}:</b>
            </th>
            <th colspan="12" align="left">
                &nbsp;{{ $categoryClass->name }}
            </th>
        </tr>
        <tr>
            @php
                $scheduleClass = \App\Models\Schedule::find($class->schedule_id);

                $facilityName = \App\Models\Facility::find($scheduleClass->facility_id);

                $start_timeClass = date('H:i A', strtotime($scheduleClass->start_time));
                $end_timeClass = date('H:i A', strtotime($scheduleClass->end_time));
            @endphp
            <th align="right" colspan="2">
                <b>{{ __('Schedule') }}:</b>
            </th>
            <th colspan="12" align="left">
                &nbsp;{{ $facilityName->name }} / {{ $start_timeClass }} - {{ $end_timeClass }} / {{ $scheduleClass->sunday == 1 ? __('Sunday').',' : '' }} {{ $scheduleClass->monday == 1 ? __('Monday').',' : '' }} {{ $scheduleClass->tuesday == 1 ? __('Tuesday').',' : '' }} {{ $scheduleClass->wednesday == 1 ? __('Wednesday').',' : '' }} {{ $scheduleClass->thursday == 1 ? __('Thursday').',' : '' }} {{ $scheduleClass->friday == 1 ? __('Friday').',' : '' }} {{ $scheduleClass->saturday == 1 ? __('Saturday').',' : '' }}
            </th>
        </tr>
        <tr>
            @php
                $instructorClass = \App\Models\User::find($class->instructor_id);
            @endphp
            <th align="right" colspan="2">
                <b>{{ __('Instructor') }}:</b>
            </th>
            <th colspan="12" align="left">
                &nbsp;{{ $instructorClass->name }}
            </th>
        </tr>
        <tr>
            @php
                $start_dateClass = date("d-m-Y", strtotime($class->start_date));
            @endphp
            <th align="right" colspan="2">
                <b>{{ __('Start Date') }}:</b>
            </th>
            <th colspan="12" align="left">
                &nbsp;{{ $start_dateClass }}
            </th>
        </tr>
        <tr>
            @php
                $end_dateClass = date("d-m-Y", strtotime($class->end_date));
            @endphp
            <th align="right" colspan="2">
                <b>{{ __('End Date') }}:</b>
            </th>
            <th colspan="12" align="left">
                &nbsp;{{ $end_dateClass }}
            </th>
        </tr>
        <tr>
            <th colspan="14" align="center"></th>
        </tr>
        <tr>
            <th colspan="14" align="center"><b>Listado de Pagos</b></th>
        </tr>
        <tr>
            <th colspan="7" align="center"><b>{{ __('Athlete') }}</b></th>
            <th colspan="1" align="center"><b>{{ __('Talla') }}</b></th>
            <th colspan="4" align="center"><b>{{ __('Responsible') }}</b></th>
            <th colspan="2" align="center"><b># {{ __('Inscription') }}</b></th>
        </tr>
    </thead>
    <tbody>
        @php
            $talla = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
            //21 = XL
            //20 = L
            //19 = M
            //18 = S
        @endphp
        @foreach ($inscritos as $inscrito)
            @php
                $atleta = \App\Models\Atleta::find($inscrito->atleta_id);

                for ($i=0; $i <= 16 ; $i++) {
                    if($atleta->tshirt_size == $i)
                    {
                        $talla[$i]++;
                    }

                }
                if ($atleta->tshirt_size == "XL") {
                        $talla[20]++;
                }
                if ($atleta->tshirt_size == "L") {
                    $talla[19]++;
                }

                if ($atleta->tshirt_size == "M") {
                    $talla[18]++;
                }
                if ($atleta->tshirt_size == "S") {
                    $talla[17]++;
                }
            @endphp
            <tr>
                <td colspan="7" align="left">
                    <b>{{ $atleta->name }}</b>
                    &nbsp;
                    <b>CUI: </b> {{ $atleta->cui_dpi }}
                </td>
                <td colspan="1" align="center">
                    {{ $atleta->tshirt_size }}
                </td>
                <td colspan="4" align="left">
                    <b>{{ $atleta->responsible_name }}</b>
                </td>
                <td colspan="2" align="left">
                    {{ $inscrito->inscription_number }}
                </td>

            </tr>

        @endforeach
    </tbody>
</table>
<table>
    <thead>
        <tr>
            <th colspan="4" align="center"><b>Total de Tallas</b></th>
        </tr>
        <tr>
            <th colspan="1" align="center"></th>
        </tr>
    </thead>
    <tbody>
        @if ($talla[17] != 0)
            <tr>
                <td colspan="2" align="right"><b><b>Talla S:</b>&nbsp;&nbsp;</b></td>
                <td colspan="1" align="center">{{$talla[17]}}</td>
            </tr>
        @endif
        @if ($talla[18] != 0)
        <tr>
            <td colspan="2" align="right"><b><b>Talla M:</b>&nbsp;&nbsp;</b></td>
            <td colspan="1" align="center">{{$talla[18]}}</td>
        </tr>
        @endif
        @if ($talla[19] != 0)
        <tr>
            <td colspan="2" align="right"><b><b>Talla L:</b>&nbsp;&nbsp;</b></td>
            <td colspan="1" align="center">{{$talla[19]}}</td>
        </tr>
        @endif
        @if ($talla[20] != 0)
        <tr>
            <td colspan="2" align="right"><b><b>Talla XL:</b>&nbsp;&nbsp;</b></td>
            <td colspan="1" align="center">{{$talla[20]}}</td>
        </tr>
        @endif
        @for ($i = 1; $i <= 16; $i++)
            @if ($talla[$i] != 0)
                <tr>
                    <td colspan="2" align="right"><b><b>Talla {{ $i }}:</b>&nbsp;&nbsp;</b></td>
                    <td colspan="1" align="center">{{$talla[$i]}}</td>
                </tr>
            @endif
        @endfor
    </tbody>
</table>
</body>
</html>
