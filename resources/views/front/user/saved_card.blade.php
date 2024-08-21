@extends('front.layouts.master')

@section('title', __('Cards'))

@section('content')
    <div class="saved_card">
        <div class="container">
            <section class="card" id="card">
                <div class="front">
                    <div class="brand-logo" id="brand-logo">
                        @if (isset($card))
                            @if ($card->card_type == 'MasterCard')
                                <img src="https://raw.githubusercontent.com/falconmasters/formulario-tarjeta-credito-3d/master/img/logos/mastercard.png" alt="">
                            @else
                                <img src="https://raw.githubusercontent.com/falconmasters/formulario-tarjeta-credito-3d/master/img/logos/visa.png" alt="">
                            @endif
                        @endif
                    </div>
                    <img src="https://raw.githubusercontent.com/falconmasters/formulario-tarjeta-credito-3d/master/img/chip-tarjeta.png" class="chip">
                    <div class="details">

                        <div class="group" id="number">
                            <p class="label">Card Number</p>
                            <p class="number">
                                {{ isset($card->card_number) ? cardNumberFormat($card->card_number) : '#### #### #### ####' }}
                            </p>
                        </div>

                        <div class="flexbox row">
                            <div class="group col-sm-12" id="name">
                                <p class="label"> Card's Holder </p>
                                <p class="name">{{ $card->card_name ?? 'John Doe' }}</p>
                            </div>
                            <div class="group col-sm-12" id="expiration">
                                <p class="label">Expiration</p>
                                <p class="expiration"><span class="month">{{ $card->exp_month ?? 'MM' }}</span> / <span class="year">{{ $card->exp_year ?? 'YY' }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="back">
                    <div class="magnetic-bar"></div>
                    <div class="details">
                        <div class="group" id="signature">
                            <p class="label">Signature</p>
                            <div class="signature">
                                <p></p>
                            </div>
                        </div>
                        <div class="group" id="ccv">
                            <p class="label">CCV</p>
                            <p class="ccv" id="showCvcCode"></p>
                        </div>
                    </div>
                    <p class="legend">This card is the property of xyz bank limited. By accepting signing or using this
                        card, you agree to be the terms & conditions the use of this card when issued angd as amended time
                        to time.</p>
                </div>
            </section>
            <!-- Container Button to open the form -->
            <div class="container-btn">
                <button class="btn-open-form d-none" id="btn-open-form">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <!-- Form -->
            <form action="{{ route('frontend.user.card.store') }}" id="card-form" method="post" class="card-form active">
                @csrf
                <div class="group mt-5">
                    <label for="inputNumber">Card Number</label>
                    <input type="text" id="inputNumber" name="card_number"
                        value="{{ isset($card->card_number) ? cardNumberFormat($card->card_number) : old('card_number') }}"
                        maxlength="19" autocomplete="off">
                </div>

                <div class="group">
                    <label for="inputHolder">Card's Holder Name</label>
                    <input type="text" id="inputHolder" name="card_name"
                        value="{{ old('name') ?? ($card->card_name ?? '') }}" maxlength="19" autocomplete="off">
                </div>
                <div class="flexbox row">
                    <div class="group expire col-sm-12">
                        <label for="selectMonth">Expiration</label>
                        <div class="flexbox">
                            <div class="group-select">
                                <select name="exp_month" id="selectMonth">
                                    <option disabled selected> Month</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option
                                            value="{{ $i }}"
                                            {{ isset($card->exp_month) && $card->exp_month == $i ? 'selected' : '' }}>
                                            {{ $i }} </option>
                                    @endfor
                                </select>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="group-select">
                                <select name="exp_year" id="selectYear">
                                    <option disabled selected> Year</option>
                                    @for ($i = date('Y'); $i <= date('Y') + 12; $i++)
                                        <option
                                            value="{{ $i }}"
                                            {{ isset($card->exp_year) && $card->exp_year == $i ? 'selected' : '' }}>
                                            {{ $i }} </option>
                                    @endfor
                                </select>
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="group ccv col-sm-12">
                        <label for="inputCCV">CVC</label>
                        <input type="text" name="cvc" id="inputCCV" value="{{ old('cvc') ?? ($card->cvc ?? '') }}" maxlength="3">
                    </div>
                </div>
                <button type="submit" class="btn-submit"> Submit</button>
            </form>
        </div>
    </div>

@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('front/css/card.css') }}">
@endpush

@push('js')
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script src="{{ asset('front/js/card.js') }}" crossorigin="anonymous"></script>
    <script>
        var cvcNumber = $("#inputCCV").val();
        // alert(cvcNumber);
        $("#showCvcCode").html(cvcNumber);
        // showCvcCode
    </script>
@endpush
