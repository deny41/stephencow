<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<script type="text/javascript">
    
    Highcharts.chart('container', {
    title: {
        text: 'Zone with dash style'
    },
    subtitle: {
        text: 'Dotted line typically signifies prognosis'
    },
    xAxis: {
            categories: [
                @foreach ($data as $element)
                    '{{ $element->ot_date or null }}',
                @endforeach
            ]
    },
    series: [{
            name: 'Sales',
            data: [
                @foreach ($data as $element)
                    {{ $element->sales_total or null }},
                @endforeach
            ],
            zoneAxis: 'x',
            zones: [{
                value: 8
            }, {
                dashStyle: 'dot'
            }]
        },
        {
            name: 'Purchase',
            data: [
                @foreach ($data as $element)
                    {{ $element->sales_purchase or null }},
                @endforeach
            ],
            zoneAxis: 'x',
            zones: [{
                value: 8
            }, {
                dashStyle: 'dot'
            }]
        }]
    });


</script>