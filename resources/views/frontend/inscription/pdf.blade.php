<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Pure css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
        integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">


    <title>{{ __('Inscription Information') }}</title>

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
    <br>

    <table class="pure-table pure-table-bordered" Width=100%>
        <thead>
            <tr>
                <th colspan="4"><u>{{ __('Inscription Information') }}</u></th>
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
                $start_time = date('h:i A', strtotime($class->Sstart_time));
                $end_time = date('h:i A', strtotime($class->Send_time));

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
                <th colspan="4"><u>{{ __('Athlete Information') }}</u></th>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">{{ __('Date of Birth') }}:</font>
                </th>
                <td>
                    @php
                        $fecha_nacimiento = date("d-m-Y", strtotime($atleta->birth));
                    @endphp
                    <font size="1">{{ $fecha_nacimiento }}</font>
                </td>
                <th align="right">
                    <font size="1">{{ __('Athlete CUI') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $atleta->cui_dpi }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">{{ __('Gender') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $atleta->gender == '0' ? __('Male') : __('Female') }}</font>
                </td>
                <th align="right">
                    <font size="1">{{ __('Name') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $atleta->name }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">{{ __('Phone') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $atleta->phone }}</font>
                </td>
                <th align="right">
                    <font size="1">{{ __('Whatsapp') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $atleta->whatsapp }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">{{ __('Ethnic Group') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $atleta->ethnic_group }}</font>
                </td>
                <th align="right">
                    <font size="1">{{ __('Covid19 Doses Number') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $atleta->doses_number }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">{{ __('Education Obtained') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $atleta->education_obtained }}</font>
                </td>
                <th align="right">
                    <font size="1">{{ __('Tshirt Size') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $atleta->tshirt_size }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">{{ __('Country') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $atleta->country }}</font>
                </td>
                <th align="right">
                    <font size="1">{{ __('State') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $atleta->state }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">{{ __('City') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $atleta->city }}</font>
                </td>
                <th align="right">
                    <font size="1">{{ __('Address') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $atleta->address }}</font>
                </td>
            </tr>
            <tr>
                <th colspan="4"><u>{{ __('Responsible Information') }}</u></th>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">{{ __('Responsible Name') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $atleta->responsible_name }}</font>
                </td>
                <th align="right">
                    <font size="1">{{ __('Responsible DPI') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $atleta->responsible_dpi }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">{{ __('Responsible Phone') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $atleta->responsible_phone }}</font>
                </td>
                <th align="right">
                    <font size="1">{{ __('Responsible Whatsapp') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $atleta->responsible_whatsapp }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">{{ __('Responsible Email') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $atleta->responsible_email }}</font>
                </td>
                <th align="right">
                    <font size="1">{{ __('Responsible Address') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $atleta->responsible_address }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">{{ __('Responsible Covid19 Doses Number') }}:</font>
                </th>
                <td>
                    <font size="1">{{ $atleta->responsible_doses_number }}</font>
                </td>
                <th colspan="2" align="right">
                </th>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">{{ __('Athlete Image') }}:</font>
                </th>
                <td colspan="3">
                    @if ($atleta->image != null)
                        <img align="center" src="{{ $path . '/athletes/' . $atleta->image }}" alt="" height="300">
                    @endif
                </td>
            </tr>
            <tr>

                <th align="right">
                    <font size="1">{{ __('Vaccination Card') }}:</font>
                </th>
                <td colspan="3">
                    @if ($atleta->vaccination_card != null)
                        <img align="center" src="{{ $path . '/vaccination/' . $atleta->vaccination_card }}" alt="" height="300">
                    @endif
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">{{ __('Birth Certificate') }}:</font>
                </th>
                <td colspan="3">
                    @if ($atleta->birth_certificate != null)
                        <img align="center" src="{{ $path . '/certificate/' . $atleta->birth_certificate }}" alt="" height="300">
                    @endif
                </td>
            </tr>

            <tr>
                <th align="right">
                    <font size="1">{{ __('Responsible DPI Image') }}:</font>
                </th>
                <td colspan="3">
                    @if ($atleta->responsible_image != null)
                        <img align="center" src="{{ $path . '/responsible/' . $atleta->responsible_image }}" alt="" height="300">
                    @endif
                </td>
            </tr>

            <tr>
                <th align="right">
                    <font size="1">{{ __('Signed Contract') }}:</font>
                </th>
                <td colspan="3">
                    @if ($atleta->signed_contract != null)
                        <img align="center" src="{{ $path . '/signedcontracts/' . $atleta->signed_contract }}" alt="" height="300">
                    @endif
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
</body>

</html>
