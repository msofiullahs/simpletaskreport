@extends('layouts.main')

@section('title'){{'Calendar of Indonesia'}}@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="ratio ratio-16x9 mb-5">
            <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=Asia%2FJakarta&amp;src=ZW4uaW5kb25lc2lhbiNob2xpZGF5QGdyb3VwLnYuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;color=%230B8043&amp;showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showNav=1" style="border-width:0;background:none;" scrolling="no"></iframe>
        </div>
    </div>
</div>
@endsection
