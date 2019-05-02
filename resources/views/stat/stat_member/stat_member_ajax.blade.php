@include('layouts._scripts')
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<script type="text/javascript">
    

Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Monthly Average Rainfall'
    },
    subtitle: {
        text: 'Source: WorldClimate.com'
    },
    xAxis: {
        categories: [
            @foreach ($tgl as $index1 => $d)
                '{{ $d->tgl_tgl }}',
            @endforeach
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Rainfall (mm)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
    @foreach ($tgl as $index1 => $d)
                {
                @foreach ($product as $index2 => $p)
                    @if ($d->tgl_tgl == $p->tgl_prd) 
                            name: '{{ $p->ot_product }}',
                    @endif
                @endforeach

                            data: [
                @foreach ($product as $index2 => $p)
                    @if ($d->tgl_tgl == $p->tgl_prd) 
                            {{ $p->prd }},
                    @endif
                @endforeach
                            ],

                },
    @endforeach
    ]
});


</script>