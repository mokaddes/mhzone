@props(['ad'])

<div class="product-item__sidebar-item">
    @if ($ad->show_phone && $ad->phone !== null)
        <div class="card-number">
            <div class="number number--hide text--body-2">
                <span class="icon">
                    <x-svg.phone-icon width="32" height="32" />
                </span>
                {{ Str::limit($ad->phone, 8, ' XXXXXXXX') }}
            </div>
            <div class="number number--show text--body-2">
                <span class="icon">
                    <x-svg.phone-icon width="32" height="32" />
                </span>
                {{ $ad->phone }}
            </div>

            <span class="text--body-4 message">{{ __('reveal_phone_number') }}</span>
        </div>
    @endif

    @if (auth('user')->check() && auth('user')->user()->username !== $ad->customer->username)

        @if (isset($ad->customer->phone) && $ad->customer->show_phone == 1)
            <a href="javascript:;" class="btn w-100 mb-2 bg-primary phn-show">
                <span class="icon--left">
                    <x-svg.phone-icon stroke="#ffffff" />
                </span>
                <span class="phn-text">{{ __('Click to show phone') }}</span>
                <span class="phn-no d-none">{{ $ad->customer->phone }}</span>
            </a>
        @endif
        <form action="{{ route('frontend.message.store', $ad->customer->username) }}" method="POST"
            id="sendMessageForm">
            @csrf
            <input type="hidden" value="." name="body">
            <button type="submit" class="btn w-100">
                <span class="icon--left">
                    <x-svg.message-icon width="24" height="24" stroke="white" strokeWidth="1.6" />
                </span>
                {{ __('send_message') }}
            </button>
        </form>
        @if ($ad->customer->email)
            <a href="javascript:;" class="btn w-100 mt-2 bg-success" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop">
                <span class="icon--left">
                    <x-svg.envelope-icon stroke="#ffffff" />
                </span>
                {{ __('send_message_via_email') }}
            </a>
        @endif
        @if ($ad->whatsapp)
            <a href="https://web.wechat.com/{{ $ad->whatsapp }}" class="btn w-100 mt-2 bg-secondary" target="_blank">
                <span class="icon--left">
                    <img src="{{ asset('images/wechat.png') }}" alt="">
                </span>
                {{ __('Send message via WeChat') }}
            </a>
        @endif
    @endif
    @if (!auth('user')->check())
    @if (isset($ad->customer->phone) && $ad->customer->show_phone == 1)
            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn w-100 mb-2 bg-danger">
                <span class="icon--left">
                    <x-svg.phone-icon stroke="#ffffff" />
                </span>
                <span class="phn-text">{{ __('Click to show phone') }}</span>
            </a>
        @endif
        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn w-100">
            <span class="icon--left">
                <x-svg.message-icon width="24" height="24" stroke="white" strokeWidth="1.6" />
            </span>
            {{ __('send_message') }}
        </a>
        @if ($ad->whatsapp)
            <a href="https://web.wechat.com/{{ $ad->whatsapp }}" class="btn w-100 mt-2 bg-success" target="_blank">
                <span class="icon--left">
                    <img src="{{ asset('images/wechat.png') }}" alt="">
                </span>
                {{ __('Send message via WeChat') }}
            </a>
        @endif
        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn w-100 mt-2 bg-secondary">
            <span class="icon--left">
                <x-svg.envelope-icon stroke="#ffffff" />
            </span>
            {{ __('send_message_via_email') }}
        </a>
    @endif
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('frontend.mail.to.customer') }}" method="post">
            @csrf
            <input type="hidden" value="{{ $ad->customer->email }}" name="customer_email">
            <input type="hidden" value="{{ $ad->customer->name }}" name="customer_name">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Send mail to customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="mb-2">Subject</label>
                            <input type="text" name="subject" class="form-control" placeholder="subject" required>
                            @error('subject')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="mt-2">Message</label>
                            <textarea name="message" class="form-control" cols="30" rows="10" style="height: 200px;"
                                placeholder="Message" required></textarea>
                                @error('message')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-secondary" data-bs-dismiss="modal"
                        style="border: 0;">Close</button>
                    <button type="submit" class="btn btn-primary" style="border: 0;">Mail Send</button>
                </div>
            </div>
        </form>
    </div>
</div>
