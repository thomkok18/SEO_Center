<div style="font-family: Verdana,serif">
    <p>Hoi {{$to['firstname']}},</p>
    <p>De link crawler is klaar met scannen.</p>
    <p>Datum van de scan: {{date_format(date_create(now()), 'd-m-Y')}}</p>
    <br>

    <b>Anchor tags die online staan:</b>
    @forelse($anchorsFound as $anchorFound)
        <div><span style="color:green;">✔</span> | {{$anchorFound['anchor_text']}} ({{$anchorFound['anchor_url']}}) staat online op {{$anchorFound['website']}}</div>
        <br>
    @empty
        <p>Er staan geen gezochte anchor tags online.</p>
    @endforelse
    <br>

    <b>Anchor tags die niet online staan:</b>
    @forelse($anchorsMissing as $anchorMissing)
        <div><span style="color:red;">X</span> | {{$anchorMissing['anchor_text']}} ({{$anchorMissing['anchor_url']}}) staat niet online op {{$anchorMissing['website']}}</div>
        <br>
    @empty
        <p>Er staan geen gezochte anchor tags offline.</p>
    @endforelse
    <br>

    <b>Anchor tags waarvan de website niet kon worden opgehaald:</b>
    @forelse($anchorsUnableToLoad as $anchorUnableToLoad)
        <div><span style="color:orange;">⌛</span> | {{$anchorUnableToLoad['anchor_text']}} ({{$anchorUnableToLoad['anchor_url']}}) kon niet worden gecontroleerd op {{$anchorUnableToLoad['website']}}</div>
        <br>
    @empty
        <p>Alle websites die werden gecrawled zijn succesvol doorzocht.</p>
    @endforelse
    <br>

    <p>Tot volgende maand!</p>
    <p>Met vriendelijke groet,</p>
    <p>{{$from[0]['name']}}</p>
</div>
