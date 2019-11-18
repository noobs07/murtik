

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
                                <th>Nama Pemesan</th>
                                <th>Kode Maskapai</th>
                                <th>Waktu Transaksi</th>
                                <th>Status Pembayaran</th>
                                <th>Bank Pengirim</th>
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
                                <td><?= $trx['kode_order']?></td>
                                <td><?= $trx['firstname_cust']?></td>
                                <td><?= $trx['kode_maskapai']?></td>
                                <td><?= date('d-m-Y H:i:s',strtotime($trx['time_order']))?></td>
                                <td><?php if ($trx['status_bayar'] == 0)
                                    {echo "belum";} else
                                    {echo "sudah";}?></td>
                                <td><?= $trx['bank_pengirim']?></td>
                                <td><?= number_format($trx['total_bayar'],0,'',',')?></td>
                                <td class="actions">
                                    <a href="http://murahtiketnya.com/API/get_order.php?kode_order=<?=$trx['id_cust_order']?>&web=1" target=_blank>
                                        <button class="btn btn-sm btn-primary">
                                            <i class="glyphicon glyphicon-share"></i>
                                            Detail
                                        </button>
                                    </a>
                                    <?php if($trx['view']=='1'){?><button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-eye-open"></i></button><?php }?>
                                    <?php if($trx['status_bayar']==3 || $trx['status_bayar']==0):?>
                                    <a href="<?= base_url('adminx/confirmBayar').'/'.$trx['id_cust_order']?>" class="confirmbayar" >
                                        <button class="btn btn-sm btn-success">
                                            <i class="glyphicon glyphicon-ok-sign"></i>
                                            Konfirmasi Pembayaran
                                        </button>
                                    </a>
                                    <?php endif; ?>
                                    <?php if($trx['status_bayar']==1):?>
                                        <button class="btn btn-sm btn-warning" onclick="showPrompt(<?=$trx['id_cust_order']?>)">
                                            <i class="glyphicon glyphicon-bell"></i>
                                            Konfirmasi Tiket
                                        </button>
                                    <?php endif; ?>
                                    <a href="<?= base_url('adminx/deleteTrx').'/'.$trx['id_cust_order']?>" class="deleteTrx">
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
            url: "<?= base_url() ?>index.php/superadminx/allTrxPesawatbyStatus",
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
            url: "<?= base_url('adminx/confirmTiket')?>",
            success:
                    function (response) {
                        var hasil = response;
                    if(hasil=='1'){
                        alert("Data Booking berhasil dimasukkan");
                        location.reload();
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