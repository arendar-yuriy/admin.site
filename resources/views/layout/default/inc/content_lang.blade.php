@if(count(LaravelLocalization::getSupportedLocales())!=1  && count(explode(',',env('LANG_LIST'))) != 1)
    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">{{ Config::get('laravellocalization.supportedLocales.'.App\Helpers\FormLang::getCurrentLang())['native'] }} <span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-menu-right">
            @foreach(LaravelLocalization::getSupportedLocales() as $local=>$value)
                @if($local != \App\Helpers\FormLang::getCurrentLang()  && in_array($local,explode(',',env('LANG_LIST'))))
                    <li><a data-lang="{{ $local }}" class="change-lang-form">{{ $value['native'] }}</a></li>
                @endif
            @endforeach
        </ul>
    </div>
@else
    <div class="btn-group">
        <a href="{{ url()->previous() }}" class="btn btn-success" ><i class=" icon-reply"></i> {{ trans('app.Back') }}</a>
        <button type="button" class="btn btn-primary">{{ Config::get('laravellocalization.supportedLocales.'.App\Helpers\FormLang::getCurrentLang())['native'] }}</button>
    </div>
@endif