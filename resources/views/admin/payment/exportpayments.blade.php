<!DOCTYPE html>
<html>
<head>
  <title>Reporte de Pagos</title>
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
            <th colspan="14" align="center"><b>Filtros:</b></th>
        </tr>
        <tr>
            <th align="right" colspan="2">
                <b>Desde:</b>
            </th>
            <th colspan="12" align="left">
                &nbsp;{{ date('d-m-Y', strtotime($desde)) }}
            </th>
        </tr>
        <tr>
            <th align="right" colspan="2">
                <b>Hasta:</b>
            </th>
            <th colspan="12" align="left">
                &nbsp;{{ date('d-m-Y', strtotime($hasta)) }}
            </th>
        </tr>
        <tr>
            <th align="right" colspan="2">
                <b>Atleta CUI:</b>
            </th>
            <th colspan="12" align="left">
                @if ($queryCui != null)
                    &nbsp;{{ $queryCui }}
                @else
                    &nbsp;{{ __('All') }}
                @endif
            </th>
        </tr>
        <tr>
            <th align="right" colspan="2">
                <b># Inscripcion:</b>
            </th>
            <th colspan="12" align="left">
                @if ($queryIN != null)
                    &nbsp;{{ $queryIN }}
                @else
                    &nbsp;{{ __('All') }}
                @endif
            </th>
        </tr>
        <tr>
            <th align="right" colspan="2">
                <b>{{ __('Cycle') }}:</b>
            </th>
            <th colspan="12" align="left">
                @if ($queryCycle != null)
                @php
                    $cycleinfo = \App\Models\Cycle::find($queryCycle);
                @endphp
                    &nbsp;{{ $cycleinfo->name }}
                @else
                    &nbsp;{{ __('All') }}
                @endif
            </th>
        </tr>
        <tr>
            <th align="right" colspan="2">
                <b>{{ __('Category') }}: </b>
            </th>
            <th colspan="12" align="left">
                @if ($queryCategory != null)
                    @php
                        $categoryinfo = \App\Models\Category::find($queryCategory);
                    @endphp
                    &nbsp;{{ $categoryinfo->name }}
                @else
                    &nbsp;{{ __('All') }}
                @endif
            </th>
        </tr>
        <tr>
            <th align="right" colspan="2">
                <b>{{ __('Group') }}:</b>
            </th>
            <th colspan="12" align="left">
                @if ($queryGroup != null)
                    @php
                        $groupinfo = \App\Models\Group::find($queryGroup);
                    @endphp
                    &nbsp;{{ $groupinfo->name }}
                @else
                    &nbsp;{{ __('All') }}
                @endif
            </th>
        </tr>
        <tr>
            <th align="right" colspan="2">
                <b>{{ __('Payment Type') }}:</b>
            </th>
            <th colspan="12" align="left">
                @if ($queryType != null)
                &nbsp;
                {{ $queryType == '0,0' ? __('Inscription')
                    : ($queryType == '1,1' ? __('Badge')
                    : ($queryType == '2,2' ? __('Monthly')
                    : ($queryType == '3,6' ? __('Exoneration')
                    : "")))
                }}
            @else
                &nbsp;{{ __('All') }}
            @endif
            </th>
        </tr>
        <tr>
            <th align="right" colspan="2">
                <b>{{ __('User') }}:</b>
            </th>
            <th colspan="12" align="left">
                @if ($queryUser != null)
                    @php
                        $userinfo = \App\Models\User::find($queryUser);
                    @endphp
                    &nbsp;{{ $userinfo->name }} ({{ $userinfo->role_as == '0' ? __('User') : ($userinfo->role_as == '1' ? __('Admin') : ($userinfo->role_as == '3' ? __('Instructor') : "")) }})
                @else
                    &nbsp;{{ __('All') }}
                @endif
            </th>
        </tr>
        <tr>
            <th colspan="14" align="center"></th>
        </tr>
        <tr>
            <th colspan="14" align="center"><b>Listado de Pagos</b></th>
        </tr>
        <tr>
            <th colspan="2" align="center"><b>#Pago / #Recibo</b></th>
            <th colspan="2" align="center"><b>Fecha</b></th>
            <th colspan="2" align="center"><b>Atleta</b></th>
            <th colspan="2" align="center"><b>#Inscripción</b></th>
            <th colspan="2" align="center"><b>Tipo Pago</b></th>
            <th colspan="2" align="center"><b>Pagado</b></th>
            <th colspan="2" align="center"><b>Usuario</b></th>
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

                $classinfo = \App\Models\Classs::find($payment->inscription->class_id);
                $categoryinfo = \App\Models\Category::find($classinfo->category_id);
                $userinfo = \App\Models\User::find($payment->user_id);
            @endphp
            <tr>
                <td colspan="2" align="center">{{ $payment->id }} @if ($payment->no_recibo != null) /  {{ $payment->no_recibo }} @endif</td>
                <td colspan="2" align="center">{{ $payment->created_at->format('d-m-Y') }}</td>
                <td colspan="2" align="left">
                    <b>{{ $payment->inscription->atleta->name }},</b>
                    &nbsp;CUI: {{ $payment->inscription->atleta->cui_dpi }}
                </td>
                <td colspan="2" align="center">{{ $payment->inscription->inscription_number }}</td>
                <td colspan="2" align="center">
                    {{ $payment->type == '0' ? __('Inscription')
                        : ($payment->type == '1' ? __('Badge')
                        : ($payment->type == '2' ? __('Monthly')
                        : ($payment->type == '3' ? __('Monthly Exoneration')
                        : ($payment->type == '4' ? __('Monthly Exoneration')
                        : ($payment->type == '5' ? __('Inscription Total Exoneration')
                        : ($payment->type == '6' ? __('Badge Exoneration')
                        : ""))))))
                    }}
                    @if ($payment->note != null),
                        ({{ $payment->note }})
                    @endif
                </td>
                <td colspan="2" align="right">{{ $config->currency_simbol }}.{{ number_format($payment->paid,2, '.', ',') }}</td>
                <td colspan="2" align="left">
                    {{ $userinfo->name }},
                    &nbsp;
                    ({{ $userinfo->role_as == '1' ? __('Admin')
                        : ($userinfo->role_as == '0' ? __('User')
                        : ($userinfo->role_as == '3' ? __('Instructor')
                        : ""))
                    }})
                </td>
            </tr>

        @endforeach
    </tbody>
</table>
<table>
    <thead>
        <tr>
            <th colspan="4" align="center"><b>Resumen</b></th>
        </tr>
        <tr>
            <th colspan="4" align="center"></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="2" align="right"><b>Pagos:</b></td>
            <td colspan="2" align="right">{{ $config->currency_simbol }}.{{ number_format($total-$exonerations,2, '.', ',') }}</td>
        </tr>
        <tr>
            <td colspan="2" align="right"><b>Exoneraciones:</b></td>
            <td colspan="2" align="right">{{ $config->currency_simbol }}.{{ number_format($exonerations,2, '.', ',') }}</td>
        </tr>
        <tr>
            <td colspan="2" align="right"><b>Total:</b></td>
            <td colspan="2" align="right">{{ $config->currency_simbol }}.{{ number_format($total,2, '.', ',') }}</td>
        </tr>
    </tbody>
</table>
</body>
</html>
