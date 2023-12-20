<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Pure css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
        integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">


    <title>{{ __('Check Payments') }}</title>

</head>

<body>
    <center>
        <img align="center" src="{{ $imagen }}" alt="" height="100">
    </center>
    <label>
        <font size="1">{{ __('Report Date') }}:</font>
        <font color="blue" size="1">
            @php
                $horafecha = new DateTime("now", new DateTimeZone('America/Guatemala'));
                $horafecha = $horafecha->format('d-m-Y, H:i:s')
            @endphp
            {{ $horafecha }}
        </font>
    </label>

    <table class="pure-table pure-table-bordered" Width=100%>
        <thead>
            <tr>
                <th colspan="4"><u>{{ __('Check Payments') }}</u></th>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">{{ __('Inscription Date') }}:</font>
                    @php
                        $fecha_inscripcion = date("d-m-Y", strtotime($inscription->created_at));
                    @endphp
                </th>
                <td align="left">
                    <font size="1">
                        {{ $fecha_inscripcion }}
                    </font>
                </td>
                <th align="right">
                    <font size="1">{{ __('Inscription Number') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $inscription->inscription_number }}</font>
                </td>
            </tr>
            <tr>

                <th align="right">
                    <font size="1">{{ __('Status') }}:</font>
                </th>
                <td>
                    <font size="1">
                        @if($inscription->inscription_status == 0) <font color="orange">{{ $inscription->inscription_status == 0 ? __('Pending') : '' }}</font>@endif
                        @if($inscription->inscription_status == 1)<font color="limegreen">{{ $inscription->inscription_status == 1 ? __('Confirmed') : '' }}</font>@endif
                        @if($inscription->inscription_status == 2)<font color="red">{{ $inscription->inscription_status == 2 ? __('Rejected') : '' }}</font>@endif
                        @if($inscription->inscription_status == 3)<font color="black">{{ $inscription->inscription_status == 3 ? __('Expelled') : '' }}</font>@endif
                        @if($inscription->inscription_status == 4)<font color="gray">{{ $inscription->inscription_status == 4 ? __('Retired') : '' }}</font>@endif
                        @if($inscription->inscription_status == 5)<font color="blue">{{ $inscription->inscription_status == 5 ? __('Promoted') : '' }}</font>@endif
                    </font>
                </td>
                @if ($inscription->payments != null)
                    <th align="right">
                        <font size="1">{{ __('Monthly Payment') }}:</font>
                    </th>
                    <td>
                        @php
                            $inscriptionPayments=DB::table('payments')
                            ->where('inscription_id',$inscription->id)
                            ->where('type','>=',2)
                            ->get();
                        @endphp
                        <font size="1">{{ $config->currency_simbol }}{{ number_format($class->CLmonthly_payment,2, '.', ',') }} <b>({{ $inscriptionPayments->count() }}/{{ $inscription->payments }})</b></font>
                    </td>
                @endif
            </tr>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">{{ __('Inscription Payment') }}:</font>
                </th>
                <td>
                    <font size="1">
                        @if($inscription->inscription_payment == 0) <font color="orange">{{ $inscription->inscription_payment == 0 ? __('Pending') : '' }}</font>@endif
                        @if($inscription->inscription_payment == 1) <font color="limegreen">{{ $inscription->inscription_payment == 1 ? __('Paid') : '' }}</font>@endif
                        ({{ $config->currency_simbol }}{{ number_format($class->CLinscription_payment,2, '.', ',') }})
                    </font>

                </td>
                <th align="right">
                    <font size="1">{{ __('Badge Payment') }}:</font>
                </th>
                <td>
                    <font size="1">
                        @if($inscription->badge_payment == 0) <font color="orange">{{ $inscription->badge_payment == 0 ? __('Pending') : '' }}</font>@endif
                        @if($inscription->badge_payment == 1) <font color="limegreen">{{ $inscription->badge_payment == 1 ? __('Paid') : '' }}</font>@endif
                        ({{ $config->currency_simbol }}{{ number_format($class->CLbadge,2, '.', ',') }})
                    </font>
                </td>
            </tr>
            @if ($inscription->notes != null)
                <tr>
                    <th align="right">
                        <font size="1">{{ __('Notes') }}:</font>
                    </th>
                    <td colspan="3">
                        <font size="1">{{ $inscription->notes }}</font>
                    </td>
                </tr>
            @endif
            <tr>
                <th colspan="4"><u>{{ __('Class') }}</u></th>
            </tr>
            @php
                $start_time = date('H:i A', strtotime($class->Sstart_time));
                $end_time = date('H:i A', strtotime($class->Send_time));

                $start_date = date('d-m-Y', strtotime($class->CLstart_date));
                $end_date = date('d-m-Y', strtotime($class->CLend_date));

                $hoy = date("Y-m-d");
                $start_date_status = date("Y-m-d", strtotime($class->CLstart_date));
                $end_date_status = date("Y-m-d", strtotime($class->CLend_date));
            @endphp
            <tr>
                <td colspan="4">
                    <font size="1"><b>{{ $class->Cname }} </b> {{ $start_date }} / {{ $end_date }} ({{ $class->age_from }} - {{ $class->age_to }}) {{ __('Years') }} {{ $class->Fname }}, @if($class->sunday == 1) {{ __('Sunday') }},  @endif @if($class->monday == 1) {{ __('Monday') }},  @endif @if($class->tuesday == 1) {{ __('Tuesday') }},  @endif @if($class->wednesday == 1) {{ __('Wednesday') }},  @endif @if($class->thursday == 1) {{ __('Thursday') }},  @endif @if($class->friday == 1) {{ __('Friday') }},  @endif @if($class->saturday == 1) {{ __('Saturday') }}  @endif {{ $start_time }} - {{ $end_time }}</font>
                </td>
            </tr>
            <tr>
                <th colspan="4"><u>{{ __('Athlete') }}</u></th>
            </tr>
            <tr>
                @php
                    $fecha_nacimiento = date("d-m-Y", strtotime($atleta->birth));
                    $cumpleanos = new DateTime($atleta->birth);
                    $hoy = new DateTime();
                    $annos = $hoy->diff($cumpleanos);
                    $edad = $annos->y;
                @endphp
                <td colspan="4">
                    <font size="1"><b>{{ $atleta->name }}</b> {{ $edad }} {{ __('Years') }}, CUI: {{ $atleta->cui_dpi }}, {{ __('Phone') }}: {{ $atleta->phone }}, {{ __('Whatsapp') }}: {{ $atleta->whatsapp }}, {{ __('Email') }}: {{ $atleta->email }}</font>
                </td>
            </tr>

        </thead>
        {{-- <tbody>
            <tr>
                <td align="center">
                    <font size="1">hola</font>
                </td>
                <td align="center">
                    <font size="1">hola 2</font>
                </td>
            </tr>
        </tbody> --}}
    </table>
    <table class="pure-table pure-table-bordered" Width=100%>
        <thead>
            <tr>
                <th colspan="2"><u>{{ __('Assists') }}</u></th>
            </tr>
            <tr>
                {{-- <th>
                    <font size="1">{{ __('Athlete') }}</font>
                </th> --}}
                <th>
                    <font size="1">{{ __('Date') }}</font>
                </th>
                <th>
                    <font size="1">{{ __('Assist') }}</font>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assists as $assist)
                @php
                    $attendances = \App\Models\Attendance::where('assist_id',$assist->id)->where('atleta_id',$atleta->id)->get();
                @endphp
                @foreach ($attendances as $attendance)
                    <tr>
                        <td align="center"><font size="1">{{ $attendance->created_at->format('d-m-Y') }}</font></td>
                        <td align="center"><font size="1">
                            <p class="text-sm mb-0">
                                @if ($attendance->status == 0)
                                    <font color="red"><b>Ausente</b></font>
                                @elseif ($attendance->status == 1)
                                    <font color="limegreen"><b>Presente</b></font>
                                @endif

                            </p>
                        </font></td>
                    </tr>

                @endforeach
            @endforeach

        </tbody>
    </table>
    <table class="pure-table pure-table-bordered" Width=100%>
        <thead>
            <tr>
                <th colspan="6"><u>{{ __('Payments') }}</u></th>
            </tr>
            <tr>
                <th>
                    <font size="1">{{ __('Payment') }} #</font>
                </th>
                <th>
                    <font size="1">{{ __('Date') }}</font>
                </th>
                <th>
                    <font size="1">{{ __('Cycle') }} / {{ __('Class') }} / {{ __('Group') }}</font>
                </th>
                <th>
                    <font size="1">{{ __('Payment Type') }}</font>
                </th>
                <th>
                    <font size="1">{{ __('Note') }}</font>
                </th>
                <th>
                    <font size="1">{{ __('Paid') }}</font>
                </th>

            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td align="center">
                        <font size="1">
                            <b>{{ $payment->id }}</b>
                        </font>
                    </td>
                    <td align="center">
                        <font size="1"><strong>{{ $payment->created_at->format('d-m-Y') }}</strong></font>
                    </td>
                    <td align="center">
                        <font size="1" color="blue">
                            {{ $payment->inscription->cycle->name }}
                            @php
                                $classinfo = \App\Models\Classs::find($payment->inscription->class_id);
                                $categoryinfo = \App\Models\Category::find($classinfo->category_id);
                            @endphp
                            {{ $categoryinfo->name }} ({{ $categoryinfo->group->name }})
                        </font>
                    </td>
                    <td align="center">
                        <font size="1" color="orange">
                            {{ $payment->type == '0' ? __('Inscription')
                                : ($payment->type == '1' ? __('Badge')
                                : ($payment->type == '2' ? __('Monthly')
                                : ($payment->type == '3' ? __('Exoneration')
                                : "")))
                            }}
                            @if ($payment->note != null)
                            <br>
                            ({{ $payment->note }})
                        @endif
                        </font>
                    </td>
                    <td align="center">
                        <font size="1" color="black">
                            {{ $payment->note }}
                        </font>
                    </td>
                    <td align="center">
                        <font size="1" color="limegreen">
                            {{ $config->currency_simbol }}{{ number_format($payment->paid,2, '.', ',') }}
                        </font>
                    </td>
                </tr>
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td align="right"><font size="3"><b>Total:</b></font></td>
                <td align="center"><h5><b><font size="3" color="blue">{{ $config->currency_simbol }}{{ number_format($total,2, '.', ',') }}</font></b></h5></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
