<form class="form-horizontal" action="{{ route('admin.posting.rules.update') }}" method="POST"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row ">
        <div class="col-md-6">
            <div class="form-group">
                <x-forms.label name="posting rules body" />
                    <textarea id="rules" class="form-control" name="posting_rules_body"
                        placeholder="{{ __('write the answer') }}">{{ $rules }}</textarea>
                    @error('posting_rules_body')
                    <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Posting Rules Body Latvian</label>
                    <textarea id="rules_body_lt" class="form-control" name="rules_body_lt"
                        placeholder="{{ __('write the answer') }}">{{ $cms->rules_body_lt }}</textarea>
                    @error('rules_body_lt')
                    <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6 offset-3 ">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('update posting rules setting') }}
            </button>
        </div>
    </div>
</form>
