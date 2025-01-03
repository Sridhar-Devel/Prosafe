<x-mail::message>
Your locker {{ $visit->locker_id }} in {{ $visit->locker->floor->name }} has been visited by
@if ($visit->customer_id)
    {{ $visit->customer->customer_name }}
@endif
@if ($visit->customer2_id)
    {{ $visit->customer2->customer_name }}
@endif
@if ($visit->customer3_id)
    {{ $visit->customer3->customer_name }}
@endif
at {{ $visit->created_at->format('H:i') }} on {{ $visit->created_at->format('d.m.Y') }}.

For More Details Regarding this ***Visit***, Please look into the ***Prosafe*** Dashboard.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
