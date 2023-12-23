<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Pure css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
        integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">


    <title>{{ __('Payments') }}</title>

</head>

<body>
    <center>
        <img align="center" src="{{ $imagen }}" alt="" height="100">
    </center>
    <h3 align="center"><u>{{ __('Payments') }}</u></h3>
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
    <label for="">
        <font size="1"><strong><u>{{ __('Filter by') }}:</u></strong></font>
    </label>
    <br>
    <label for="">
        <font size="1">{{ __('From') }}: </font>
        <font size="1" color="blue">{{ date('d-m-Y', strtotime($desde)) }}</font>
    </label>
    <label for="">
        <font size="1">{{ __('To') }}: </font>
        <font size="1" color="blue">{{ date('d-m-Y', strtotime($hasta)) }}</font>
    </label>
    <label for="">
        <font size="1">{{ __('Athlete CUI') }}</font>
        <font size="1" color="blue">
            @if ($queryCui != null)
                {{ $queryCui }}
            @else
                {{ __('All') }}
            @endif
        </font>
    </label>
    <label for="">
        <font size="1">{{ __('Inscription Number') }}</font>
        <font size="1" color="blue">
            @if ($queryIN != null)
                {{ $queryIN }}
            @else
                {{ __('All') }}
            @endif
        </font>
    </label>
    <label for="">
        <font size="1">{{ __('Cycle') }}</font>
        <font size="1" color="blue">
            @if ($queryCycle != null)
                @php
                    $cycleinfo = \App\Models\Cycle::find($queryCycle);
                @endphp
                {{ $cycleinfo->name }}
            @else
                {{ __('All') }}
            @endif
        </font>
    </label>
    <label for="">
        <font size="1">{{ __('Category') }}: </font>
        <font size="1" color="blue">
            @if ($queryCategory != null)
                @php
                    $categoryinfo = \App\Models\Category::find($queryCategory);
                @endphp
                {{ $categoryinfo->name }}
            @else
                {{ __('All') }}
            @endif
        </font>
    </label>
    <label for="">
        <font size="1">{{ __('Group') }}: </font>
        <font size="1" color="blue">
            @if ($queryGroup != null)
                @php
                    $groupinfo = \App\Models\Group::find($queryGroup);
                @endphp
                {{ $groupinfo->name }}
            @else
                {{ __('All') }}
            @endif
        </font>
    </label>
    <label for="">
        <font size="1">{{ __('Payment Type') }}: </font>
        <font size="1" color="blue">
            @if ($queryType != null)
                {{ $queryType == '0,0' ? __('Inscription')
                    : ($queryType == '1,1' ? __('Badge')
                    : ($queryType == '2,2' ? __('Monthly')
                    : ($queryType == '3,6' ? __('Exoneration')
                    : "")))
                }}
            @else
                {{ __('All') }}
            @endif
        </font>
    </label>
    <label for="">
        <font size="1">{{ __('User') }}: </font>
        <font size="1" color="blue">
            @if ($queryUser != null)
                @php
                    $userinfo = \App\Models\User::find($queryUser);
                @endphp
                {{ $userinfo->name }} ({{ $userinfo->role_as == '0' ? __('User') : ($userinfo->role_as == '1' ? __('Admin') : ($userinfo->role_as == '3' ? __('Instructor') : "")) }})
            @else
                {{ __('All') }}
            @endif
        </font>
    </label>
    <h5><u>{{ __('Resume') }}:</u></h5>
    <table class="pure-table pure-table-bordered" Width=100%>
        <thead>
            <tr>
                <th>
                    <font size="1">{{ __('Payment') }} #</font>
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
            @php
                $exonerations = 0;
            @endphp
            @foreach ($payments as $payment)
            @php
                if($payment->type >= '3' && $payment->type <=6){
                    $exonerations = $exonerations + $payment->paid;
                }
            @endphp
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
                            @php
                                $classinfo = \App\Models\Classs::find($payment->inscription->class_id);
                                $categoryinfo = \App\Models\Category::find($classinfo->category_id);
                                $userinfo = \App\Models\User::find($payment->user_id);
                            @endphp
                            Categoría: {{ $categoryinfo->name }} <br>

                            Ciclo: {{ $payment->inscription->cycle->name }} <br>
                            Grupo: {{ $categoryinfo->group->name }}

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
            @endforeach

        </tbody>
        <tfoot>
            <tr align="right">
                <td></td>
                <td></td>
                <td></td>
                <td><h6><b>{{ __('Payments') }}:</b></h6></td>
                <td><h6><b><font color="limegreen">{{ $config->currency_simbol }}{{ number_format($total-$exonerations,2, '.', ',') }}</font></b></h6></td>
                <td></td>
                <td></td>
            </tr>
            <tr align="right">
                <td></td>
                <td></td>
                <td></td>
                <td><h6><b>{{ __('Exonerations') }}:</b></h6></td>
                <td><h6><b><font color="orange">{{ $config->currency_simbol }}{{ number_format($exonerations,2, '.', ',') }}</font></b></h6></td>
                <td></td>
                <td></td>
            </tr>
            <tr align="right">
                <td></td>
                <td></td>
                <td></td>
                <td><h4><b>Total:</b></h4></td>
                <td><h4><b><font color="blue">{{ $config->currency_simbol }}{{ number_format($total,2, '.', ',') }}</font></b></h4></td>
                <td></td>
                <td></td>
            </tr>
        </tfoot>
    </table>


</body>

</html>
