<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Pure css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
        integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">


    <title>{{ __('Assists') }}</title>

</head>

<body>
    <center>
        <img align="center" src="{{ $imagen }}" alt="" height="100">
    </center>
    <h3 align="center"><u>{{ __('Assists') }}</u></h3>
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
                    $groupinfo = \App\Models\Category::find($queryCategory);
                @endphp
                {{ $groupinfo->name }}
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
                    <font size="1">{{ __('Date') }}</font>
                </th>
                <th>
                    <font size="1">{{ __('Athlete') }}</font>
                </th>
                <th>
                    <font size="1">{{ __('Class') }}</font>
                </th>
                <th>
                    <font size="1">{{ __('Presents') }}: <font size="1" color="limegreen"><b>{{ $presentes->count() }}</b></font> <br> {{ __('Not Presents') }}: <font size="1" color="red"><b>{{ $noPresentes->count() }}</b></font>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                @php
                    $assistinfo = \App\Models\Assist::find($attendance->assist_id);
                    $atletainfo = \App\Models\Atleta::find($attendance->atleta_id);
                    $classinfo = \App\Models\Classs::find($assistinfo->class_id);
                    $categoryinfo = \App\Models\Category::find($classinfo->category_id);
                    $cycleinfo = \App\Models\Cycle::find($classinfo->cycle_id);
                @endphp
                <tr>
                    <td align="center">
                        <font size="1"><strong>{{ $attendance->created_at->format('d-m-Y') }}</strong></font>
                    </td>
                    <td align="center">
                        <font size="1">
                            <b>{{ $attendance->atleta->name }}</b>
                            CUI: {{ $attendance->atleta->cui_dpi }}<br>
                            {{ $attendance->atleta->phone }} / {{ $attendance->atleta->whatsapp }} / {{ $attendance->atleta->email }}
                        </font>
                    </td>
                    <td align="center">
                        <font size="1" color="blue">
                            <b>{{ $categoryinfo->name }}</b> {{ $cycleinfo->name }}<br>
                            ({{ $categoryinfo->group->name }})
                        </font>
                    </td>
                    <td align="center">
                        <font size="1">
                            @if ($attendance->status == 0)
                                <font size="1" color="red"><b>{{ __('Not Present') }}</b></font>
                            @else
                                <font size="1" color="limegreen"><b>{{ __('Present') }}</b></font>
                            @endif
                        </font>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>


</body>

</html>
