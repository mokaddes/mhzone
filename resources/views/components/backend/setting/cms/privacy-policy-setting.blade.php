<form class="form-horizontal" action="{{ route('admin.privacy.update') }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <x-forms.label name="privacy body" />
                    <textarea id="privacy_ck" class="form-control" name="privacy_body"
                        placeholder="{{ __('write the answer') }}">{{ $privacy }}</textarea>
                    @error('privacy_body')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
            </div>
        </div>
        {{-- <div class="col-md-6">
            <div class="form-group">
                <label for="">Privacy body Latvian</label>
                    <textarea id="privacy_body_lt" class="form-control" name="privacy_body_lt"
                        placeholder="{{ __('write the answer') }}">{{ $cms->privacy_body_lt }}</textarea>
                    @error('privacy_body')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
            </div>
        </div> --}}
    </div>
    <div class="row mt-3">
        <div class="col-6 offset-3 ">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('update about setting') }}
            </button>
        </div>
    </div>
</form>
