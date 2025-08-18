<h1>Statistics Report</h1>
<p>Total: {{ $stats['stats']['total'] }}</p>
<p>Today: {{ $stats['stats']['today'] }}</p>
<p>Admins: {{ \App\Models\User::count() }}</p>
<p>Top Source: {{ $stats['stats']['top_source']['signup_source'] ?? 'N/A' }}</p>
<h3>Top Sources</h3>
<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>Source</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($stats['top_sources'] as $source)
            <tr>
                <td>{{ $source['signup_source'] }}</td>
                <td>{{ $source['total'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
