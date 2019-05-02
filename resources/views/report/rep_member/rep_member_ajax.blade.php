<div class="responsive">
    <table id="member" class="table table-striped table-bordered table-hover" width="100%">
        <thead>                         
            <tr>
                <th data-hide="phone">No</th>
                <th data-hide="phone" data-class="expand"> Login id</th>
                <th data-hide="phone,tablet"> member</th>
                <th data-hide="phone,tablet"> Sales</th>
                <th data-hide="phone,tablet"> Purchase</th>
                <th data-hide="phone,tablet"> Detail</th>
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
                    <td><b><div class="total_sales">{{ number_format($sales_awal,0,'','.') }}</div></b></td>
                </tr>
                <tr>
                    <td>Total Purchase</td>
                    <td>:</td>
                    <td><b><div class="total_purchase">{{ number_format($purchase_awal,0,'','.') }}</div></b></td>
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

    $('#member').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url:'{{ route('hasil_datatable_member') }}',
            data:{date_first,date_end,admin,product,member}
        },
        columnDefs: [
                {
                    targets: 0 ,
                    className: 'center'
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
            {data: 'DT_Row_Index', name: 'DT_Row_Index'},
            {data: 'om_code', name: 'om_code'},
            {data: 'om_name', name: 'om_name'},
            {data: 'sales', name: 'sales'},
            {data: 'purchase', name: 'purchase'},
            {data: 'detail', name: 'detail'},
            {data: 'aksi', name: 'aksi'},   
        ]
    });

        

</script>