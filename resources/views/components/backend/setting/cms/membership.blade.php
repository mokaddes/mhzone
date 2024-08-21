<form class="form-horizontal" action="{{ route('admin.datadeletion.update') }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Data Deletion</label>
                    <textarea id="dataDeletion" class="form-control" name="data_deletion"
                        placeholder="{{ __('write the answer') }}"> {{  $cms->data_deletion }}</textarea>
                    @error('data_deletion')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Data Deletion Latvian</label>
                    <textarea id="dataDeletion_lt" class="form-control" name="data_deletion_lt"
                        placeholder="{{ __('write the answer') }}"> {{  $cms->data_deletion_lt }}</textarea>
                    @error('data_deletion')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6 offset-3">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('Update') }}
            </button>
        </div>
    </div>
</form>
