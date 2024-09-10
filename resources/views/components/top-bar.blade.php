<div class="topbar">
    <div class="container">
        <div class="row">

            <div class="col col-lg-7 col-md-5 col-sm-12 col-12">
                <div class="contact-intro">
                    @isset($data)
                        <ul>
                            <li><i>
                                    @php
                                        $clockImage = isset($data['image']) ? 'storage/' . $data['image'] : null;
                                    @endphp

                                    @if ($clockImage && File::exists(public_path($clockImage)))
                                        <img src="{{ asset($clockImage) }}" style="height:27px;width: 27px;" alt="">
                                    @else
                                        <img src="{{ asset('assets/images/icon/1.png') }}" alt="">
                                    @endif
                                </i>
                                @if ($data['working_days'] && $data['working_time'])
                                    {{ $data['working_days'] }} || {{ $data['working_time'] }}
                                @endif
                            </li>
                        </ul>
                    @endisset
                </div>
            </div>
            <div class="col col-lg-5 col-md-7 col-sm-12 col-12">

                <div class="contact-info">
                    <ul>
                        @isset($data)
                            <li><a href="tel:+6494461709"><i><img src="{{ asset('assets/images/icon/2.png') }}"
                                            alt=""></i>
                                    @if ($data['phone'])
                                        {{ $data['phone'] }}
                                    @endif
                                </a></li>
                        @endisset

                        <li class="lan-sec">
                            <form action="{{ Url('/') }}" method="POST" id="languageForm">
                                <input type="hidden" id="language" name="language" value="{{ app()->getLocale() }}">
                                <input type="hidden" id="language_id" name="language_id" value="{{ $localLangId }}">
                                <input type="hidden" id="page_id" name="page_id" value="{{ $page->id }}">
                                <input type="hidden" id="page_slug" name="page_slug" value="{{ Request::path() }}">
                                @csrf
                                <div class="lang-menu">
                                    @isset($languages)
                                        @php
                                            // Find the default language from the $languages array
                                            $defaultLanguage = $languages->where('id', $localLangId)->first();
                                        @endphp

                                        <button type="button" class="flag-button">
                                            <span class="flag-img ">
                                                @php
                                                    $defaultLanguageImg = isset($defaultLanguage->icon)
                                                        ? 'storage/' . $defaultLanguage->icon
                                                        : null;
                                                @endphp

                                                @if ($defaultLanguageImg && File::exists(public_path($defaultLanguageImg)))
                                                    <img src="{{ asset($defaultLanguageImg) }}" alt="">
                                                @endif
                                                <span>{{ $defaultLanguage ? $defaultLanguage->name : '' }}</span>
                                            </span>
                                        </button>
                                    @endisset

                                    @if ($languages)
                                        <ul class="">
                                            @foreach ($languages as $key => $lang)
                                                <li class="flag-item" data-lang="{{ $lang->code }}"
                                                    data-id="{{ $lang->id }}">
                                                    <span
                                                        class="flag-img {{ $localLangId == $lang->id ? ' active' : '' }}">
                                                        @php
                                                            $langImage = isset($lang->icon)
                                                                ? 'storage/' . $lang->icon
                                                                : null;
                                                        @endphp

                                                        @if ($lang && File::exists(public_path($langImage)))
                                                            <img src="{{ asset($langImage) }}" alt="">
                                                        @endif

                                                        <span>{{ $lang->name }}</span>
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
