<form action="{{ route('frontend.user.address.store') }}" id="address_create_form" class="address_form" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row mb-4">
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <div class="filter_button">
                    <input class="form-check-input d-none" type="radio" name="address_type" value="home"
                        id="home" checked>
                    <label class="form-check-label" for="home" {{ old('home') == 'home' ? 'checked' : '' }}>
                        Home
                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <div class="filter_button">
                    <input class="form-check-input d-none" type="radio" name="address_type" value="office"
                        id="office">
                    <label class="form-check-label" for="office" {{ old('office') == 'office' ? 'checked' : '' }}>
                        Office
                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <div class="filter_button">
                    <input class="form-check-input d-none" type="radio" name="address_type" value="other"
                        id="other">
                    <label class="form-check-label" for="other" {{ old('other') == 'other' ? 'checked' : '' }}>
                        Other
                    </label>
                </div>
            </div>
        </div>

    </div>

    <div class="row">



        <div class="col-md-6 mb-4">
            <div class="form-group">
                <input type="text" name="name" id="name" class="form-control " placeholder="Name" required
                    value="{{ old('name') ?? Auth::user()->name }}">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <input type="text" name="phone" id="phone" class="form-control " placeholder="Phone Number"
                    required value="{{ old('phone') }}">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <input type="text" name="apartment" id="apartment" class="form-control" placeholder="Apartment"
                    required value="{{ old('apartment') }}">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <input type="text" name="address" id="address" class="form-control" placeholder="Address" required
                    value="{{ old('address') }}">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <input type="text" name="city" id="city" class="form-control " placeholder="City" required
                    value="{{ old('city') }}">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <input type="text" name="state" id="state" class="form-control " placeholder="State" required
                    value="{{ old('state') }}">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <input type="number" name="postcode" id="postcode" class="form-control " placeholder="Zip Code"
                    required value="{{ old('postcode') }}">
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class=" text-center mb-2 mt-3">
                <button type="button" class="btn non_width_btn btn-primary me-3" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn non_width_btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</form>
