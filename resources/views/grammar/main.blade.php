@extends('layouts.master')

@section('title', 'Antondzaki')

@section('content')


<h1>Базовый уровень</h1>

<div class="grammar__section">

        <div class="grammar__wrapper">
            @foreach($basic as $rule)
            <div class="grammar__accordion">
                <div class="grammar__header" data-id="rule-{{ $loop->iteration }}">
                    <div class="grammar__header-title">
                      {{ $loop->iteration }}. {{ $rule->name }}
                    </div>
                    <div class="grammar__header-icon">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g stroke="none" stroke-width="5" fill="none" fill-rule="evenodd" stroke-linecap="square">
                                <g transform="translate(1.000000, 1.000000)" stroke="#222222">
                                    <path d="M0,11 L22,11"></path>
                                    <path d="M11,0 L11,22"></path>
                                </g>
                            </g>
                        </svg>
                    </div>

                </div>
                <div class="grammar__content" data-id="rule-{{ $loop->iteration }}">
                    <div class="grammar__text-wrapper">
                        <div class="grammar__text">
                           {!! $rule->description !!}
                        </div>
                    </div>
                </div>

            </div>
            @endforeach

        </div>



</div>

<script>
    $('.grammar__header').click(function(){
        let id = $(this).attr('data-id');
        let textBlock = $('.grammar__content[data-id="'+id+'"]');
        let icon = $(this).find('svg');

        icon.toggleClass('grammar__icon-rotate');
        if(textBlock.css('display') == 'none'){
            textBlock.css('display','block');

        } else {
            textBlock.css('display','none');
        }

    });
</script>

</div>

@endsection
