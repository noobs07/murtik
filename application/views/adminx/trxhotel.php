

<!-- content -->
<div class="col-md-10">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>Transaksi</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class=col-lg-4>Status: <select id="status" onChange="statusTransaksi()" class="form-control select2 select2-hidden-accessible">
            <option value="x">-Semua-</option>
            <option value="0">Belum Bayar</option>
            <option value="1">Sudah Bayar</option>
            <option value="2">Ticketed</option>
        </select></div>
        <!--div class=col-lg-4>Tanggal:<input type="date" id="tanggal1" class="form-control" placeholder="masukkan tanggal" style="margin-left:0;"></div>
        <div class=col-lg-4>Tanggal:<input type="date" id="tanggal1" class="form-control" placeholder="masukkan tanggal" style="margin-left:0;"></div-->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-muted bootstrap-admin-box-title">Daftar Transaksi</div>
                </div>
                <div class="bootstrap-admin-panel-content">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Pemesanan</th>
                                <th>Kode Booking</th>
                                <th>Time Limit</th>
                                <th>Tanggal Pesan</th>
                                <th>Status Bayar</th>
                                <th>Nominal</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($list_new_trx==null):?>
                            <tr>
                                <td colspan="4">belum ada data transaksi</td>
                            </tr>
                            <?php else: ?>
                            <?php 
                            $no = 0;
                            foreach($list_new_trx as $trx){ 
                                if($trx['delete_at']!=null){
                                    $classTr = 'danger';
                                }else{
                                    $classTr = 'success';
                                }
                                $no++;?>
                            <tr class="<?= $classTr;?>">
                                <td><?= $no;?></td>
                                <td><?= $trx['id']?></td>
                                <td><?= $trx['kode_booking']?></td>
                                <td><?= $trx['time_limit']?></td>
                                <td><?= date('d-m-Y H:i:s',strtotime($trx['tanggal_pesan']))?></td>
                                <td><?php if ($trx['status_bayar'] == 0)
                                    {echo "belum";} elseif($trx['status_bayar'] == 1)
                                    {echo "sudah";}else{echo "menunggu Konfirmasi";}?></td>
                                <td><?= number_format($trx['total_harga'],0,'',',')?></td>
                                <td class="actions">
                                    <?php if(empty($trx['kode_booking'])&&$trx['status_bayar']=='1'){?>
                                    <button class="btn btn-sm btn-primary" onclick="showPrompt(<?=$trx['id']?>)">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                            Kode Booking
                                        </button>
                                    <?php } ?>
                                    <a href="http://murahtiketnya.com/API/get_order_hotel.php?kode_order=<?=$trx['id']?>&web=1" target=_blank>
                                        <button class="btn btn-sm btn-primary">
                                            <i class="glyphicon glyphicon-share"></i>
                                            Detail
                                        </button>
                                    </a>
                                    <?php if($trx['view']=='1'){?><button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-eye-open"></i></button><?php }?>
                                    <?php if($trx['status_bayar']==3):?>
                                    <a href="<?= base_url('adminx/confirmBayarHotel').'/'.$trx['id']?>" class="confirmbayar" >
                                        <button class="btn btn-sm btn-success">
                                            <i class="glyphicon glyphicon-ok-sign"></i>
                                            Konfirmasi Pembayaran
                                        </button>
                                    </a>
                                    <?php endif; ?>
                                    <?php if($trx['status_bayar']==1):?>
                                    <a href="<?= base_url('adminx/confirmTiketPelni').'/'.$trx['id']?>" class="confirmtiket">
                                        <button class="btn btn-sm btn-warning">
                                            <i class="glyphicon glyphicon-bell"></i>
                                            Konfirmasi Tiket
                                        </button>
                                    </a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('adminx/deletePelni').'/'.$trx['id']?>" class="deleteTrx">
                                        <button class="btn btn-sm btn-danger">
                                            <i class="glyphicon glyphicon-trash"></i>
                                            Delete
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                            }
                            endif; ?>
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
//var $ = jQuery.noConflict(); 
    function statusTransaksi() {
        //alert("tes");
        $.ajax({
            type: "POST",
            data:"status="+$('#status').val(),
            url: "<?= base_url() ?>index.php/superadminx/allTrxHotelbyStatus",
            success:
                    function (response) {
                        var hasil = response;
                    $('#tabel').find('tbody').html(hasil);
                    $('#tabel').DataTable();
                    }
        });
    }
    function TransaksiBayar() {
        //alert("tes");
        $.ajax({
            type: "POST",
            data:"status=1",
            url: "<?= base_url() ?>index.php/superadminx/allTrxHotelbyStatus",
            success:
                    function (response) {
                        var hasil = response;
                    $('#tabel').find('tbody').html(hasil);
                    $('#tabel').DataTable();
                    }
        });
    }
    function kodeBooking(id, kode_booking) {
        //alert("tes");
        $.ajax({
            type: "POST",
            data:"id="+id+"&kode_booking="+kode_booking,
            url: "<?= base_url() ?>index.php/superadminx/updateKodeBookingHotel",
            success:
                    function (response) {
                        var hasil = response;
                    if(hasil=='1'){
                        alert("Data Booking berhasil dimasukkan");
                        TransaksiBayar();
                    }else{
                        alert("Data Booking gagal dimasukkan");
                    }
                    }
        });
    }
    function showPrompt(id){
    var kodebooking = prompt("Masukkan Kode Booking");
    //var par = document.createElement('p');
    if(kodebooking!=null){
        kodeBooking(id, kodebooking);
        //var node = document.createTextNode('Hallo'+fullname+'!');
        //par.appendChild(node);
        //document.getElementById('div2').appendChild(par);
    }
}
</script>