@extends('layout.default.main')

@section('central')
    <div class="row">
        @foreach($listUsers as $user)

                <div class="col-lg-3 col-md-6 ">
                    <div class="thumbnail">
                        <div class="thumb thumb-rounded thumb-slide">
                            <?php
                            $socials = $user->socials()->where('name', $user->social_network)->first();
                            if ($socials !== null)
                                $photo = $socials->photo;
                            else
                                $photo = '';
                            ?>
                                @if(!empty($photo))
                                    {!! MediaImage::getImage($photo,211,211,['alt'=>$user->name.' '.$user->lastname]) !!}
                                @else
                                    <img id="avatar" src="/img/placeholder.jpg" alt="{{ $user->name }} {{ $user->lastname }}">
                                @endif
                                <div class="caption-overflow">
										<span>
											<a href="{{ route('edit_siteusers',['id'=>$user->id]) }}" class="btn bg-success-400 btn-icon btn-xs"><i class="icon-link"></i></a>
                                            @if(Auth::user()->can([$controller.'-add-delete']))
                                                <a href="#" class="btn bg-success-400 btn-icon btn-xs remove-button-{{ $user->id }}"><i class="icon-bin"></i></a>
                                                <script>
                                                    $(document).ready(function(){

                                                        $('.remove-button-{{ $user->id }}').on('click',function(e){
                                                            e.preventDefault();
                                                            var url = '{{ route('delete_'.$controller,['id'=>$user->id]) }}';

                                                            bootbox.confirm("{{ trans('app.remove_confirm') }}", function(result) {
                                                                if(result){
                                                                    $.ajax({
                                                                        type: "GET",
                                                                        url: url,
                                                                        data: {},
                                                                        dataType: "json",
                                                                        success: function(data){
                                                                            Main.actionData(data);
                                                                        }
                                                                    });
                                                                }
                                                            });
                                                        });
                                                    });
                                                </script>
                                            @endif
                                        </span>
                                </div>
                        </div>



                        <div class="caption text-center">
                            <h6 class="text-semibold no-margin">{{ $user->name }} {{ $user->lastname }}</h6>
                            <ul class="icons-list mt-15">
                                @foreach($user->socials()->get() as $item)
                                    <li><a target="_blank" href="{{ $item->link }}" data-popup="tooltip" title="{{ $item->name }}"><i class="{{ Config::get('admin.social_icons.'.$item->name) }}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

        @endforeach
    </div>
@endsection