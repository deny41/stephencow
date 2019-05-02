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
<br>
<div class="responsive">
    <table id="datatable" class="table table-striped table-bordered table-hover" width="100%">
        <thead>                         
            <tr>
                <th data-hide="phone" height="20px">No</th>
                <th data-hide="phone"></i> Code</th>
                <th data-hide="phone,tablet"> member</th>
                <th data-hide="phone,tablet"> Product</th>
                {{-- <th data-hide="phone,tablet"> Web Regist.</th> --}}
                <th data-hide="phone,tablet"> Reg Date</th>
                <th data-hide="phone,tablet"> Sales</th>
                <th data-hide="phone,tablet"> Purchase</th>
                <th data-hide="phone,tablet"> Admin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $p)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $p->om_code }}</td>
                    <td>{{ $p->om_name }}</td>
                    <td>{{ $p->mp_name }}</td>
                    {{-- <td>{{ $p->om_code }}</td> --}}
                    <td>{{ $p->om_created_at }}</td>
                    <td align="right"><input type="hidden" class="ot_sales" value="{{ $p->sales }}"><span class="pull-left">Rp.</span>{{ number_format($p->sales,0,'','.') }}</td>
                    <td align="right"><input type="hidden" class="ot_purchase" value="{{ $p->purchase }}"><span class="pull-left">Rp.</span>{{ number_format($p->purchase,0,'','.') }}</td>
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
<script type="text/javascript">
window.print();
</script>
</html>


