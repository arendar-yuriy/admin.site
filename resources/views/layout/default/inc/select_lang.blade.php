@if(count(LaravelLocalization::getSupportedLocales())!=1 && count(explode(',',env('LANG_LIST'))) != 1)
    <li class="dropdown language-switch">
        <a class="dropdown-toggle" data-toggle="dropdown">
            <img src="/img/flags/{{ LaravelLocalization::getCurrentLocale() }}.png" class="position-left" alt="{{ LaravelLocalization::getCurrentLocaleName() }}">
            {{ LaravelLocalization::getCurrentLocaleNative() }}
            <span class="caret"></span>
        </a>

        <ul class="dropdown-menu">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                @if($localeCode != LaravelLocalization::getCurrentLocale() && in_array($localeCode,explode(',',env('LANG_LIST'))))
                    <li>
                        <a href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                            <img src="/img/flags/{{$localeCode}}.png" alt="{{ $properties['native'] }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </li>
@else
    <li class="language-switch">
        <a class="dropdown-toggle" >
            <img src="/img/flags/{{ LaravelLocalization::getCurrentLocale() }}.png" class="position-left" alt="{{ LaravelLocalization::getCurrentLocaleName() }}">
            {{ LaravelLocalization::getCurrentLocaleNative() }}

        </a>


    </li>
@endif