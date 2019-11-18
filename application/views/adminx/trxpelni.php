

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
                                <th>Nama Kapal</th>
                                <th>Waktu Transaksi</th>
                                <th>Status Pembayaran</th>
                                <th>Time Limit</th>
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
                                if($trx['deleted_at']!=null){
                                    $classTr = 'danger';
                                }else{
                                    $classTr = 'success';
                                }
                                $no++;?>
                            <tr class="<?= $classTr;?>">
                                <td><?= $no;?></td>
                                <td><?= $trx['id_cust_order']?></td>
                                <td><?= $trx['kode_booking']?></td>
                                <td><?= $trx['nama_kapal']?></td>
                                <td><?= date('d-m-Y H:i:s',strtotime($trx['created_at']))?></td>
                                <td><?php if ($trx['status_bayar'] == 0)
                                    {echo "belum";} else
                                    {echo "sudah";}?></td>
                                <td><?= date('d-m-Y H:i:s',strtotime($trx['timelimit']))?></td>
                                <td><?= number_format($trx['booking_balance'],0,'',',')?></td>
                                <td class="actions">
                                    <?php if(empty($trx['kode_booking'])&&$trx['status_bayar']=='1'){?>
                                    <button class="btn btn-sm btn-primary" onclick="showPrompt(<?=$trx['id_cust_order']?>)">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                            Kode Booking
                                        </button>
                                        
                                        
                                    <?php } ?>
                                    <a href="http://murahtiketnya.com/API/get_order_pelni.php?kode_order=<?=$trx['id_cust_order']?>&web=1" target=_blank>
                                        <button class="btn btn-sm btn-primary">
                                            <i class="glyphicon glyphicon-share"></i>
                                            Detail
                                        </button>
                                    </a>
                                        <button class="btn btn-sm btn-primary" onclick="showPenumpang(<?=$trx['id_cust_order']?>)">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                            Seat
                                        </button>
                                    
                                    <?php if($trx['view']=='1'){?><button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-eye-open"></i></button><?php }?>
                                    <?php if($trx['status_bayar']==0):?>
                                    <a href="<?= base_url('adminx/confirmBayarPelni').'/'.$trx['id_cust_order']?>" class="confirmbayar" >
                                        <button class="btn btn-sm btn-success">
                                            <i class="glyphicon glyphicon-ok-sign"></i>
                                            Konfirmasi Pembayaran
                                        </button>
                                    </a>
                                    <?php endif;?>
                                    <?php if($trx['status_bayar']==1):?>
                                    <a href="<?= base_url('adminx/confirmTiketPelni').'/'.$trx['id_cust_order']?>" class="confirmtiket">
                                        <button class="btn btn-sm btn-warning">
                                            <i class="glyphicon glyphicon-bell"></i>
                                            Konfirmasi Tiket
                                        </button>
                                    </a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('adminx/deletePelni').'/'.$trx['id_cust_order']?>" class="deleteTrx">
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
            url: "<?= base_url() ?>index.php/superadminx/allTrxPelnibyStatus",
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
            url: "<?= base_url() ?>index.php/superadminx/allTrxPelnibyStatus",
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
            url: "<?= base_url() ?>index.php/superadminx/updateKodeBookingPelni",
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
    function showPenumpang(id) {
        $.ajax({
            type: "POST",
            data:"id="+id,
            url: "<?= base_url() ?>index.php/superadminx/penumpangPelni",
            success:
                    function (response) {
                        var hasil = response;
                        modal.style.display = "block";
                        document.getElementById('text').innerHTML=response;
                    }
        });
    }
</script>