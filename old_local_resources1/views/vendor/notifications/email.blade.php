<table style="width:100%">
    <tr>
        <td style="width:100%">
            <div style="float:left">{{date('m/d/Y')}}</div>
            <div style="float:right">
                <a href="{{config('app.url')}}"><img src="{{ asset('images/img-ivn-contact-us.jpg') }}" alt="IVN"></a>
            </div>
            <div style="clear:both"></div>
        </td>
    </tr>
</table>
@component('mail::message')
{{-- Greeting --}}

@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# Hej!
@else
# Hej!
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
Mvh,<br>{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
Hvis du har problemer med at klikke på linket, kan du kopiere denne URL og sætte den direkte ind i din browser: [{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endisset
@endcomponent
