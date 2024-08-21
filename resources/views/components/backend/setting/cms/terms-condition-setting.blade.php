<form class="form-horizontal" action="{{ route('admin.terms.update') }}" method="POST"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <x-forms.label name="terms body" />
                    <textarea id="terms_ck"  class="form-control" name="terms_body"
                        placeholder="{{ __('write the answer') }}">{{ $terms }}</textarea>
                    @error('terms_body')
                    <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
            </div>
        </div>
        {{-- <div class="col-md-6">
            <div class="form-group">
                <label for="">Terms Body Latvian</label>
                    <textarea id="terms_body_lt"  class="form-control" name="terms_body_lt"
                        placeholder="{{ __('write the answer') }}">{{ $cms->terms_body_lt }}</textarea>
                    @error('terms_body')
                    <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
            </div>
        </div> --}}
    </div>
    <div class="row mt-3">
        <div class="col-md-6 offset-3 ">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('update terms setting') }}
            </button>
        </div>
    </div>
</form>

