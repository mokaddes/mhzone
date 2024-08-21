<form class="form-horizontal" action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-md-12">
            {{-- <div class="form-group">
                <x-forms.label name="about background" />
                    <input type="file" class="form-control dropify" data-default-file="{{ $aboutBackground }}"
                        name="about_background" autocomplete="image" data-allowed-file-extensions="jpg png jpeg"
                        accept="image/png, image/jpg, image/jpeg">
            </div> --}}
            <div class="form-group">
                <x-forms.label name="about title" />
                    <input type="text" name="about_title" class="form-control" value="{{ $cms->about_title }}">
                    @error('about_title')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
            </div>
            <div class="form-group">
                <x-forms.label name="about body" />
                    <textarea id="about_ck" class="form-control" name="about body"
                        placeholder="{{ __('write the answer') }}">{{ $aboutcontent }}</textarea>
                    @error('about_body')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Mission Title</label>
                    <input type="text" name="mission_title" class="form-control" value="{{ $cms->mission_title }}">
                    @error('mission_title')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
            </div>
            <div class="form-group">
                <label for="">Mission Body</label>
                    <textarea id="about_ck_lt" class="form-control" name="mission_body"
                        placeholder="{{ __('write the answer') }}">{{ $cms->mission_body }}</textarea>
                    @error('mission_body')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Vission Title</label>
                    <input type="text" name="vission_title" class="form-control" value="{{ $cms->vission_title }}">
                    @error('vission_title')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
            </div>
            <div class="form-group">
                <label for="">Vission Body</label>
                    <textarea id="about_ck_vission" class="form-control" name="vission_body"
                        placeholder="{{ __('write the answer') }}">{{ $cms->vission_body }}</textarea>
                    @error('vission_body')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Core values Title</label>
                    <input type="text" name="core_value_title" class="form-control" value="{{ $cms->core_value_title }}">
                    @error('core_value_title')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
            </div>
            <div class="form-group">
                <label for="">Core values Body</label>
                    <textarea id="about_ck_core_values" class="form-control" name="core_value_body"
                        placeholder="{{ __('write the answer') }}">{{ $cms->core_value_body }}</textarea>
                    @error('core_value_body')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Purpose Title</label>
                    <input type="text" name="purpose_title" class="form-control" value="{{ $cms->purpose_title }}">
                    @error('purpose_title')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
            </div>
            <div class="form-group">
                <label for="">Purpose Body</label>
                    <textarea id="about_ck_purpose" class="form-control" name="purpose_body"
                        placeholder="{{ __('write the answer') }}">{{ $cms->purpose_body }}</textarea>
                    @error('purpose_body')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6 offset-3 ">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('update about setting') }}
            </button>
        </div>
    </div>
</form>
