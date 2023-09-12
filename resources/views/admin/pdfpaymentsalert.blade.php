<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Pure css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
        integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">


    <title>{{ __('Payment Alert') }}</title>

</head>

<body>
    <center>
        <img align="center" src="{{ $imagen }}" alt="" height="100">
    </center>
    <h3 align="center"><u>{{ __('Payment Alert') }}</u></h3>
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
                    <font size="1">{{ __('Inscription Number') }}</font>
                </th>
                <th>
                    <font size="1">{{ __('Athlete') }}</font>
                </th>
                <th>
                    <font size="1">{{ __('Status') }}</font>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($activeInscriptions as $inscription)
                @php
                    $cuotas = $inscription->payments;
                    $cuotasPagadas = DB::table('payments')
                    ->where('inscription_id',$inscription->id)
                    ->where('type',2)
                    ->get();
                    $cuotasPendientes = $cuotas - $cuotasPagadas->count();
                @endphp
                @if ($cuotasPendientes != 0)
                    @php
                        $hoy = date("Y-m-d", strtotime(now()->toDateString()));
                        $created_at = date("Y-m-d", strtotime($inscription->created_at));
                        $sumarMeses = date("Y-m-d", strtotime($created_at.'+'.$cuotasPagadas->count().' month' ));

                    @endphp
                    @if ($hoy > $sumarMeses)
                        <tr>
                            <td align="center">
                                <font size="1" color="blue">
                                    <b>{{ $inscription->inscription_number }}</b>
                                </font>
                            </td>
                            @php
                                $atleta = \App\Models\Atleta::find($inscription->atleta_id);
                            @endphp
                            <td align="center">
                                <font size="1">
                                    <b>{{ $atleta->name }}</b><br> CUI: {{ $atleta->cui_dpi }} / {{ $atleta->email }} / {{ $atleta->phone }} / {{ $atleta->whatsapp }}
                                </font>
                            </td>
                            @php
                                $hoy = DateTime::createFromFormat('Y-m-d', $hoy);
                                $mesesDePago = DateTime::createFromFormat('Y-m-d', $sumarMeses);

                                $difference = $mesesDePago->diff($hoy);
                                // ECHO "diferencia: ".$difference->y." Años ".$difference->m." Meses ".$difference->d." Dias";

                                $meses = 0;
                                if ($difference->y > 0) {
                                    $meses = ($meses + ($difference->y * 12));
                                }
                                if ($difference->m > 0) {
                                    $meses = $meses + $difference->m;
                                }
                                if ($difference->d > 0) {
                                    $meses = $meses + 1;
                                }
                            @endphp
                            <td align="center">
                                @if ($meses == 1)
                                    <font size="1" color="orange">
                                        @if ($meses == 1)
                                            {{ __('-1 Month') }}
                                        @endif
                                    </font>
                                @elseif ($meses > 1)
                                    <font size="1" color="red">
                                        @if ($meses > 1)
                                            {{ __('+1 Month') }}
                                        @endif
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
