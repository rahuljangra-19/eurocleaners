
<div class="wpo-contact-widget widget">
    <h2>{{ $data['title'] ?? '' }}</h2>
    <p>{{ $data['description'] ?? '' }}</p>
    @isset($contactPage)
    <a href="{{ URL($contactPage->slug) }}">Contact Us</a>
    @endisset
</div>
