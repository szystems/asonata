<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Pure css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
        integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">


    <title>{{ __('Assists Alerts') }}</title>

</head>

<body>
    <center>
        <img align="center" src="{{ $imagen }}" alt="" height="100">
    </center>
    <h3 align="center"><u>{{ __('Assists alerts for the current cycle') }}</u></h3>
    <label>
        <font size="1">{{ __('Report Date') }}:</font>
        <font color="blue" size="1">
            @php
                $horafecha = new DateTime("now", new DateTimeZone(Auth::user()->timezone));
                $horafecha = $horafecha->format('d-m-Y, H:i:s')
            @endphp
            {{ $horafecha }}
        </font>
    </label>
    <table class="pure-table pure-table-bordered" Width=100%>
        <thead>
            <tr>
                <th>
                    <font size="1">{{ __('Athlete') }}</font>
                </th>
                <th>
                    <font size="1">{{ __('Class') }}</font>
                </th>
                <th>
                    <font size="1">{{ __('Instructor') }}</font>
                </th>
                <th>
                    <font size="1">{{ __('Inscription') }}</font>
                </th>

                <th>
                    <font size="1">{{ __('Status') }}</font>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($activeInscriptionsCycleInstructor as $inscription)
                @php
                    //obtenemos las cabeceras de asistencias
                    $asistenciasReales = \App\Models\Assist::where('class_id',$inscription->class_id)->get();
                    //contamos el total de asistencias encontradas que nos da el numero maximo de asistencias
                    $totalAsistencias = $asistenciasReales->count();

                    //recorremos las asistencias reales para obtener el numero de asistencias del Atleta
                    $asistencias = 0;
                    foreach ($asistenciasReales as $asistencia) {
                        $attendances = \App\Models\Attendance::where('assist_id',$asistencia->id)->where('atleta_id',$inscription->atleta_id)->where('status',1)->get();
                        $asistencias = $asistencias + $attendances->count();
                    }

                    $ausencias = $totalAsistencias - $asistencias;
                @endphp
                @if ($ausencias >= 3)
                    @if ($asistencias != $totalAsistencias)
                        <tr>
                            @php
                                $atleta = \App\Models\Atleta::find($inscription->atleta_id);
                                $class = \App\Models\Classs::find($inscription->class_id);
                                $cycle = \App\Models\Cycle::find($class->cycle_id);
                                $instructor = \App\Models\User::find($class->instructor_id);
                                $category = \App\Models\Category::find($class->category_id);
                                $scheduleClass = \App\Models\Schedule::find($class->schedule_id);
                                $facilityName = \App\Models\Facility::find($scheduleClass->facility_id);
                                $start_dateClass = date("d-m-Y", strtotime($class->start_date));
                                $end_dateClass = date("d-m-Y", strtotime($class->end_date));
                                $start_timeClass = date('H:i A', strtotime($scheduleClass->start_time));
                                $end_timeClass = date('H:i A', strtotime($scheduleClass->end_time));
                            @endphp
                            <td align="center">
                                <font size="1">
                                    <b>{{ $atleta->name }}</b><br> CUI: {{ $atleta->cui_dpi }} / {{ $atleta->email }} <br> {{ $atleta->phone }} / {{ $atleta->whatsapp }}
                                </font>
                            </td>
                            <td align="center">
                                <font size="1">
                                    <b>{{ $category->name }} ({{ $cycle->name }})</b><br> <font color="limegreen"> {{ $start_dateClass }}</font> / </i><font color="red"> {{ $end_dateClass }}</font> / {{ $facilityName->name }} / {{ $start_timeClass }} - {{ $end_timeClass }} <br> {{ $scheduleClass->sunday == 1 ? __('Sunday').',' : '' }} {{ $scheduleClass->monday == 1 ? __('Monday').',' : '' }} {{ $scheduleClass->tuesday == 1 ? __('Tuesday').',' : '' }} {{ $scheduleClass->wednesday == 1 ? __('Wednesday').',' : '' }} {{ $scheduleClass->thursday == 1 ? __('Thursday').',' : '' }} {{ $scheduleClass->friday == 1 ? __('Friday').',' : '' }} {{ $scheduleClass->saturday == 1 ? __('Saturday').',' : '' }}
                                </font>
                            </td>
                            <td align="center">
                                <font size="1">
                                    <b>{{ $instructor->name }}
                                </font>
                            </td>
                            <td align="center">
                                <font size="1" color="blue">
                                    <b>{{ $inscription->inscription_number }}</b>
                                </font>
                            </td>


                            <td align="center">
                                @if ($ausencias >= 3 and $ausencias <= 5)
                                    <font size="1" color="orange">
                                        {{ $asistencias }} / {{ $totalAsistencias }}
                                    </font>
                                @elseif ($ausencias >= 6 )
                                    <font size="1" color="red">
                                        {{ $asistencias }} / {{ $totalAsistencias }}
                                    </font>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endif
            @endforeach

        </tbody>
    </table>


</body>

</html>
