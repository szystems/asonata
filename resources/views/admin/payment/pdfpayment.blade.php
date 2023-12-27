<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Pure css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
        integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">


    <title>{{ __('Payment') }}</title>

</head>

<body>
    <center>
        <img align="center" src="{{ $imagen }}" alt="" height="100">
    </center>
    <h3 align="center"><u>{{ __('Payment') }}</u></h3>
    <label>
        <font size="1">{{ __('Report Date') }}:</font>
        <font color="blue" size="1">
            @php
                $horafecha = new DateTime("now", new DateTimeZone(Auth::user()->timezone));
                $horafecha = $horafecha->format('d-m-Y, H:i:s')
            @endphp
            {{ $horafecha }} ({{ Auth::user()->timezone }})
        </font>
    </label>
    <br>

    <h5><u>{{ __('Payment') }}:</u></h5>
    <table class="pure-table pure-table-bordered" Width=100%>
        <thead>
            <tr>
                <th>
                    <font size="1">#{{ __('Payment') }} / #Recibo</font>
                </th>
                <th>
                    <font size="1">{{ __('Date') }}</font>
                </th>
                <th>
                    <font size="1">{{ __('Athlete') }}</font>
                </th>
                <th>
                    <font size="1">{{ __('Inscription Number') }}</font>
                </th>
                <th>
                    <font size="1">{{ __('Payemnt Type') }}</font>
                </th>
                <th>
                    <font size="1">{{ __('Paid') }}</font>
                </th>
                <th>
                    <font size="1">{{ __('User') }}</font>
                </th>

            </tr>
        </thead>
        <tbody>

                <tr>
                    <td align="center">
                        <font size="1">
                            <b>{{ $payment->id }} @if ($payment->no_recibo != null) /  {{ $payment->no_recibo }} @endif</b>
                        </font>
                    </td>
                    <td align="center">
                        <font size="1"><strong>{{ $payment->created_at->format('d-m-Y') }}</strong></font>
                    </td>
                    <td align="center">
                        <font size="1">
                            <b>{{ $payment->inscription->atleta->name }}</b><br>
                            CUI: {{ $payment->inscription->atleta->cui_dpi }}<br>
                            {{ $payment->inscription->atleta->email }}<br>
                            {{ $payment->inscription->atleta->phone }} / {{ $payment->inscription->atleta->whatsapp }}
                        </font>
                    </td>
                    <td align="center">
                        <font size="1" color="blue">
                            <b>{{ $payment->inscription->inscription_number }}</b><br>
                            Ciclo: {{ $payment->inscription->cycle->name }}
                            @php
                                $classinfo = \App\Models\Classs::find($payment->inscription->class_id);
                                $categoryinfo = \App\Models\Category::find($classinfo->category_id);
                                $userinfo = \App\Models\User::find($payment->user_id);
                            @endphp
                            Grupo: {{ $categoryinfo->group->name }} <br> Categoria: {{ $categoryinfo->name }}
                        </font>
                    </td>
                    <td align="center">
                        <font size="1" color="orange">
                            {{ $payment->type == '0' ? __('Inscription')
                                                : ($payment->type == '1' ? __('Badge')
                                                : ($payment->type == '2' ? __('Monthly')
                                                : ($payment->type == '3' ? __('Monthly Exoneration')
                                                : ($payment->type == '4' ? __('Monthly Exoneration')
                                                : ($payment->type == '5' ? __('Inscription Total Exoneration')
                                                : ($payment->type == '6' ? __('Badge Exoneration')
                                                : ""))))))
                                            }}
                        </font>
                        <font size="1">
                            @if ($payment->note != null)
                                <br>
                                ({{ $payment->note }})
                            @endif
                        </font>
                    </td>
                    <td align="center">
                        <font size="1" color="limegreen">
                            {{ $config->currency_simbol }}{{ number_format($payment->paid,2, '.', ',') }}
                        </font>
                    </td>
                    <td align="center">
                        <font size="1"><strong>{{ $userinfo->name }}</strong><br>
                            ({{ $userinfo->role_as == '1' ? __('Admin')
                            : ($userinfo->role_as == '0' ? __('User')
                            : ($userinfo->role_as == '3' ? __('Instructor')
                            : "")) }})
                        </font>
                    </td>

                </tr>

        </tbody>
    </table>


</body>

</html>
