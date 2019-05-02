
<div class="responsive">
    <table id="Transaction" class="table table-striped table-bordered table-hover" width="100%">
        <thead>                         
            <tr>
                 <th  data-class="expand" data-hide="phone"> Code</th>
                <th data-hide="phone"> Name</th>
                <th data-hide="phone"> Credit awal</th>
                <th data-hide="phone"> Sales</th>
                <th data-hide="phone"> Purchase</th>
                <th data-hide="phone"> Promo</th>
                <th data-hide="phone"> Credit Akhir</th>
                <th data-hide="phone"> Keterangan</th>
                <th data-hide="phone,tablet"> Txn Date</th>
                <th data-hide="phone,tablet"> D input</th>
                <th data-hide="phone,tablet"> OP</th>
                <th data-hide="phone,tablet"> Action</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>

        <fieldset>
            <table class="table" border="0" width="100%">
                <tr>
                    <td width="15%">Total Sales</td>
                    <td width="5%">:</td>
                    <td><b><div class="total_sales">{{ number_format($sales,0,'','.') }}</div></b></td>
                </tr>
                <tr>
                    <td>Total Purchase</td>
                    <td>:</td>
                    <td><b><div class="total_purchase">{{ number_format($purchase,0,'','.') }}</div></b></td>
                </tr>
            </table>
        </fieldset>
</div>


<script type="text/javascript">
    
    var date_first = '{{$date_first}}';
    var date_end = '{{$date_end}}';
    var admin = '{{$admin}}';
    var product = '{{$product}}';
    var member = '{{$member}}';

    $('#Transaction').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
              url:'{{ route('hasil_datatable_transaction') }}',
                data:{date_first,date_end,admin,product,member}
            },
            columnDefs: [
                    {
                        targets: 3 ,
                        className: 'right'
                    },
                    {
                        targets: 5 ,
                        className: 'center'
                    },
                    {
                        targets: 6 ,
                        className: 'center'
                    },
                ],
            columns: [
               {data: 'ot_code', name: 'ot_code'},
                    {data: 'om_name', name: 'om_code'},
                    {data: 'ot_first_credit', name: 'om_name',render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp. ' )},
                    {data: 'ot_sales', name: 'sales',render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp. ' )  },
                    {data: 'ot_purchase', name: 'purchase',render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp. ' )},
                    {data: 'promo', name: 'promo',render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp. ' )},
                    {data: 'ot_last_credit', name: 'om_bank',render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp. ' )},
                    {data: 'ot_keterangan_txn', name: 'om_web_regist'},
                    {data: 'ot_date', name: 'detail'},   
                    {data: 'ot_created_at', name: 'detail'},   
                    {data: 'name', name: 'detail'},   
                    {data: 'aksi', name: 'aksi'},   
            ]
        });

</script>