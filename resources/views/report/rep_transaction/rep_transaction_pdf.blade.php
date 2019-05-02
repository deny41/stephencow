<!DOCTYPE html>
<html>
<head>
    <title></title>
<style type="text/css">
    
    .table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    tr.nobor td {
      border: 0;
    }
    body {
        font-size: 12px;
    }
    @media print{
        .print{
            display: none;
        }
    }

</style>
</head>
<body>
<div class="responsive">
    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
        <thead>                         
            <tr>
                <th data-class="expand">No</th>
                <th data-hide="phone"><i class="fa fa-fw fa-key text-muted hidden-md hidden-sm hidden-xs"></i> Code</th>
                <th data-hide="phone"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Name</th>
                <th data-hide="phone"><i class="fa fa-fw fa-list text-muted hidden-md hidden-sm hidden-xs"></i> FC</th>
                <th data-hide="phone"><i class="fa fa-fw fa-list text-muted hidden-md hidden-sm hidden-xs"></i> Sales</th>
                <th data-hide="phone"><i class="fa fa-fw fa-list text-muted hidden-md hidden-sm hidden-xs"></i> Purchase</th>
                <th data-hide="phone"><i class="fa fa-fw fa-list text-muted hidden-md hidden-sm hidden-xs"></i> LC</th>
                <th data-hide="phone"><i class="fa fa-fw fa-list text-muted hidden-md hidden-sm hidden-xs"></i> Keterangan</th>
                <th data-hide="phone,tablet"><i class="fa fa-fw fa-th txt-color-blue hidden-md hidden-sm hidden-xs"></i> Txn Date</th>
                <th data-hide="phone,tablet"><i class="fa fa-fw fa-th txt-color-blue hidden-md hidden-sm hidden-xs"></i> D input</th>
                <th data-hide="phone,tablet"><i class="fa fa-fw fa-th txt-color-blue hidden-md hidden-sm hidden-xs"></i> OP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $p)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $p->username }}</td>
                    <td>{{ $p->om_name }}</td>
                    <td align="right"><span class="pull-left">Rp .</span> {{ number_format($p->ot_first_credit,0,'','.') }}</td>
                    <td align="right"><input type="hidden" class="ot_sales" value="{{ $p->ot_sales }}">
                        <span class="pull-left">Rp .</span> {{ number_format($p->ot_sales,0,'','.') }}</td>
                    <td align="right"><input type="hidden" class="ot_purchase" value="{{ $p->ot_purchase }}">
                        <span class="pull-left">Rp .</span> {{ number_format($p->ot_purchase,0,'','.') }}</td>
                    <td align="right"><span class="pull-left">Rp .</span> {{ number_format($p->ot_last_credit,0,'','.') }}</td>
                    <td>{{ $p->ot_notes }}</td>
                    <td>{{ date('d-M-y',strtotime($p->ot_date)) }}</td>
                    <td>{{ date('d-M-y H:i',strtotime($p->ot_created_at)) }}</td>
                    <td>{{ $p->ot_operator }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    
    <table class="" border="0px" width="100%">
        <tr class="nobor">
            <td width="15%">Total Sales</td>
            <td width="5%">:</td>
            <td><b><div class="total_sales"></div>Rp. {{ number_format($sales_awal,0,'','.') }}</b></td>
        </tr>
        <tr class="nobor">
            <td>Total Purchase</td>
            <td>:</td>
            <td><b><div class="total_purchase"></div>Rp. {{ number_format($purchase_awal,0,'','.') }}</b></td>
        </tr>
    </table>
</div>
</body>
</html>
