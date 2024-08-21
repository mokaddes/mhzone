<form action="{{ route('frontend.user.address.update', $address->id) }}" id="address_update_form" class="address_form" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row mb-4">
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <div class="filter_button">
                    <input class="form-check-input d-none" type="radio" name="address_type" value="home"
                        id="home{{ $address->id }}" {{ $address->address_type == 'home' ? 'checked' : '' }}>
                    <label class="form-check-label" for="home{{ $address->id }}">
                        Home
                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <div class="filter_button">
                    <input class="form-check-input d-none" type="radio" name="address_type" value="office"
                        id="office{{ $address->id }}" {{ $address->address_type == 'office' ? 'checked' : '' }}>
                    <label class="form-check-label" for="office{{ $address->id }}">
                        Office
                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <div class="filter_button">
                    <input class="form-check-input d-none" type="radio" name="address_type" value="other"
                        id="other{{ $address->id }}" {{ $address->address_type == 'other' ? 'checked' : '' }}>
                    <label class="form-check-label" for="other{{ $address->id }}">
                        Other
                    </label>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="form-group">
                <label for="" class="form-label">Name</label>
                <input type="text" name="name" id="name" value="{{ $address->name }}" class="form-control"
                    placeholder="Name" required>
            </div>
        </div>
        <div class="col-md-12 mb-2">
            <div class="form-group">
                <label for="" class="form-label">Phone Number</label>
                <input type="text" name="phone" id="phone" value="{{ $address->phone }}" class="form-control"
                    placeholder="Phone Number" required>
            </div>
        </div>
        <div class="col-md-12 mb-2">
            <div class="form-group">
                <label for="" class="form-label">Apartment</label>
                <input type="text" name="apartment" id="apartment" value="{{ $address->apartment }}"
                    class="form-control" placeholder="Apartment" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="form-group">
                <label for="" class="form-label">Address</label>
                <input type="text" name="address" id="address" value="{{ $address->address }}" class="form-control"
                    placeholder="Address" required>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label for="" class="form-label">City</label>
                <input type="text" name="city" id="city" value="{{ $address->city }}" class="form-control"
                    placeholder="City" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label for="" class="form-label">State</label>
                <input type="text" name="state" id="state" value="{{ $address->state }}" class="form-control"
                    placeholder="State" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label for="" class="form-label">Zip Code</label>
                <input type="number" name="postcode" id="postcode" value="{{ $address->postcode }}"
                    class="form-control " placeholder="Zip Code" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class=" text-center mb-2 mt-3">
                <button type="button" class="btn non_width_btn btn-primary" data-bs-dismiss="modal" style="font-size: 16px;">Close</button>
                <button type="submit" class="btn non_width_btn btn-primary" style="font-size: 16px;">Update</button>
            </div>
        </div>
    </div>
</form>
