@if ($language_enable && $setting->language_changing && isset(currentLanguage()->icon))
    <div class="language_switch dropdown mt-3">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="flag-icon {{ currentLanguage()->icon }}"></i>
            <span class="text-uppercase">{{ currentLanguage()->code }}</span>
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            @foreach ($languages as $lang)
                <li>
                    <a class="dropdown-item {{ currentLanguage()->code == $lang->code ? 'active' : '' }}"
                        href="{{ route('changeLanguage', $lang->code) }}">
                        <i class="flag-icon {{ $lang->icon }}"></i>
                        {{ $lang->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif
