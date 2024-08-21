<table class="table table-hover text-nowrap table-bordered">
    <thead>
        <tr class="text-center">
            <th width="2%">#</th>
            <th width="5%">{{ __('Thumbnail') }}</th>
            <th width="10%">{{ __('Title') }}</th>
            <th width="10%">{{ __('Price') }}</th>
            <th width="10%">{{ __('Discount') }}</th>
            <th width="10%">{{ __('Discounted Price') }}</th>
            <th width="10%">{{ __('Available items') }}</th>

            @if ($showCategory)
                <th width="10%">{{ __('Department') }}</th>
            @endif
            <th width="10%">{{ __('Is Banner') }}</th>
            @if ($showCustomer)
                <th width="10%">{{ __('Seller') }}</th>
            @endif
            <th width="10%">{{ __('Status') }}</th>
            <th width="5%">{{ __('Actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($ads as $key =>$ad)
            <tr>
                <td class="text-center" tabindex="0">
                    {{ $key + 1 }}
                </td>
                <td class="text-center" tabindex="0">
                    <img src="{{ getPhoto($ad->thumbnail) }}" class="rounded" height="50px" width="50px"
                        alt="image">
                </td>
                <td tabindex="0">
                    {{ Str::limit($ad->title, 38, '...') }}
                    @if ($ad->featured)
                        <span class="badge badge-warning">
                            {{ __('Featured') }}
                        </span>
                    @endif
                    @if ($ad->popular)
                        <span class="badge badge-info">
                            {{ __('Popular') }}
                        </span>
                    @endif
                    @if ($ad->trending)
                        <span class="badge badge-secondary">
                            {{ __('Trending') }}
                        </span>
                    @endif
                </td>
                <td class="text-center" tabindex="0">
                     ${{ $ad->price }}
                </td>
                <td class="text-center" tabindex="0">
                     {{ $ad->discount }}%
                </td>
                <td class="text-center" tabindex="0">
                     ${{ $ad->price_after_discount }}
                </td>
                <td class="text-center" tabindex="0">
                    {{ $ad->qty }}
               </td>
                @if ($showCategory)
                    <td tabindex="0">
                        {{ $ad->department->name }}
                        <br>
                        <small>{{ $ad->category->name ?? '' }}</small>
                        <br>
                        <small>{{ $ad->subcategory->name ?? '' }}</small>
                        <br>

                    </td>
                @endif
                <td class="text-center" tabindex="0">
                    <div class="dropdown show">
                        <button  type="button" class="dropdown-toggle btn-sm btn btn-{{ $ad->is_banner == 1? "info" : "danger" }}" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          {{ $ad->is_banner == 1? "Active" : "Inactive" }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                         @if($ad->is_banner == 0)
                          <a class="dropdown-item" href="{{ route('module.ad.is_bannr.active',$ad->id) }}" onclick="return confirm('Are you sure to perform this action?')">Active</a>
                          @else
                          <a class="dropdown-item" href="{{ route('module.ad.is_bannr.inactive', $ad->id) }}" onclick="return confirm('Are you sure to perform this action?')">Inactive</a>
                          @endif

                        </div>
                    </div>
                </td>

                @if ($showCustomer)
                    <td class="text-center" tabindex="0">
                        <a href="{{ route('module.customer.show', ['customer' => $ad->customer->username]) }}">
                            {{ $ad->customer->username }}
                        </a>
                    </td>
                @endif
                <td class="text-center" tabindex="0">
                    <button type="button"
                        class="dropdown-toggle btn-sm btn btn-{{ $ad->status == 'active' ? 'success' : ($ad->status == 'pending' ? 'warning' : 'secondary') }}"
                        data-toggle="dropdown" aria-expanded="false">
                        {{ ucfirst($ad->status) }}
                    </button>
                    <ul class="dropdown-menu" x-placement="bottom-start"
                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        @if ($ad->status == 'pending' || $ad->status == 'sold' || $ad->status == 'declined')
                            <li><a onclick="return confirm('Are you sure to perform this action?')"
                                    class="dropdown-item"
                                    href="{{ route('module.ad.status', [$ad->slug, 'active']) }}">
                                    <i class="fas fa-check text-success"></i> {{ __('Mark as active') }}
                                </a>
                            </li>
                        @endif
                        @if ($ad->status == 'active')
                            <li><a onclick="return confirm('Are you sure to perform this action?')"
                                    class="dropdown-item" href="{{ route('module.ad.status', [$ad->slug, 'sold']) }}">
                                    <i class="fas fa-hourglass-end text-danger"></i> {{ __('Mark as sold') }}
                                </a>
                            </li>
                        @endif
                            <li><a onclick="return confirm('Are you sure to perform this action?')"
                                    class="dropdown-item"
                                    href="{{ route('module.ad.status', [$ad->slug, 'declined']) }}">
                                    <i class="fas fa-times text-danger"></i> {{ __('Mark as declined') }}
                                </a>
                            </li>

                    </ul>
                </td>

                <td class="text-center" tabindex="0">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false">
                        {{ __('options') }}
                    </button>
                    <ul class="dropdown-menu" x-placement="bottom-start"
                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <li><a class="dropdown-item" href="{{ route('module.ad.show', $ad->slug) }}">
                                <i class="fas fa-eye text-info"></i> {{ __('View details') }}
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('frontend.ad.details', $ad->slug ) }}">
                                <i class="fas fa-link text-secondary"></i> {{ __('Website link') }}
                            </a>
                        </li>
                        <li><a class="dropdown-item" href="javascript:voie(0)" data-toggle="modal" data-target="#discount-{{ $ad->id }}">
                            <i class="fa fa-eraser"></i> {{ __('Make Deal Of the day') }}
                        </a>
                      </li>
                        <!-- <li><a class="dropdown-item" href="{{ route('module.ad.edit', $ad->id) }}">
                                <i class="fas fa-edit text-success"></i> {{ __('Edit ad') }}
                            </a>
                        </li> -->
                        {{-- <li><a class="dropdown-item" href="{{ route('module.ad.show_gallery', $ad->id) }}">
                                <i class="fas fa-images text-warning"></i></i> {{ __('Ad gallary') }}
                            </a>
                        </li> --}}
                        {{-- <li><a class="dropdown-item"
                                href="{{ route('module.ad.custom.field.value.edit', $ad->id) }}">
                                <i class="fas fa-edit text-info"></i> {{ __('edit custom fields') }}
                            </a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('module.ad.custom.field.value.sorting', $ad->id) }}">
                                <i class="fas fa-arrows-alt text-warning"></i> {{ __('sorting custom fields') }}
                            </a>
                        </li> --}}
                        {{-- <li>
                            <form action="{{ route('module.ad.destroy', $ad->id) }}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="dropdown-item"
                                    onclick="return confirm('{{ __('are you sure want to delete this item') }}?');">
                                    <i class="fas fa-trash text-danger"></i> {{ __('delete ad') }}
                                </button>
                            </form>
                        </li> --}}
                    </ul>
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="discount-{{ $ad->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-{{ $ad->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Make deal of the day
                        <br>
                        <small class="text-danger">(You can set only one product at a time)</small>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{ route('module.ad.deal_of_the_day',$ad->slug)}}" method="post">
                        @csrf
                    <div class="modal-body">
                        <div class="col-md-12 mb-3">
                            <label for="">Is deal of day</label>
                            <select name="is_deal_of_day" id="is_deal_of_day" class="form-control @error('is_deal_of_day') is-invalid @enderror">
                                <option value="1" {{ $ad->is_deal_of_day == "1"? "selected" : "" }}>Active</option>
                                <option value="0" {{ $ad->is_deal_of_day == "0"? "selected" : "" }}>Inactive</option>
                            </select>
                            @error('is_deal_of_day')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Ad Price</label>
                            <input type="number" name="price" id="price{{ $ad->id }}"
                                class="form-control price @error('price') is-invalid @enderror"
                                   oninput="calculateFinalPrice('{{ $ad->id }}')"
                                value="{{ $ad->price }}" placeholder="{{ __('enter ad price') }}">
                            @error('price')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Ad Discount Price <small>(Optional)</small></label>
                            <input type="number" name="discount" id="discount{{ $ad->id }}" min="0" max="99"
                                   oninput="calculateFinalPrice('{{ $ad->id }}')"
                                class="form-control discount @error('discount') is-invalid @enderror"
                                value="{{ $ad->discount }}" placeholder="{{ __('enter ad discount') }}">
                            @error('discount')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Price After Discount</label>
                            <input type="number" name="price_after_discount" id="price_after_discount{{ $ad->id }}"
                                class="form-control price_after_discount @error('price_after_discount') is-invalid @enderror" readonly
                                value="{{ $ad->price_after_discount }}" placeholder="{{ __('Price after discount') }}">
                            @error('price_after_discount')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
                </div>
                </div>
            </div>
        @empty
            <tr>
                <td colspan="10" class="text-center">
                    {{-- <x-not-found word="Ad" route="module.ad.create" /> --}}
                    <a href="javascript:void(0);" class="text-danger">
                        There is no ads found in this page
                    </a>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>


