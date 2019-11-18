
<!-- content -->
<div class="col-md-10">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>Detail Pembayaran</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-muted bootstrap-admin-box-title">Daftar Detail Pembayaran</div>
                </div>
                <div class="bootstrap-admin-panel-content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pengirim</th>
                                <th>Kode Order</th>
                                <th>Bank Pengirim</th>
                                <th>Bank Penerima</th>
                                <th>Tipe</th>
                                <th>Nominal</th>
                                <th>Waktu Konfirmasi</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($list_new_trx==null):?>
                            <tr>
                                <td colspan="4">belum ada data konfirmasi pembayaran</td>
                            </tr>
                            <?php else: ?>
                            <?php 
                            $no = 0;
                            foreach($list_new_trx as $supertrx){ 
                                if($supertrx['confirmed_at']!=null){
                                    $classTr = 'danger';
                                }else{
                                    $classTr = 'success';
                                }
                                $no++;?>
                                <tr class="<?= $classTr;?>">
                                <td><?= $no;?></td>
                                <td><?= $supertrx['nama_pengirim']?></td>
                                <td><?= $supertrx['pnr']?></td>
                                <td><?= $supertrx['bank_pengirim']?></td>
                                <td><?= $supertrx['bank_penerima']?></td>
                                <td><?= $supertrx['tipe']?></td>
                                <td><?= 'Rp. '.number_format($supertrx['nominal_transfer'],'0','.',',')?></td>
                                <td><?= $supertrx['created_at']?></td>
                                <td class="actions">

                                    <!-- mematikan fungsi awal-->
                                    <?php if($supertrx['confirmed_at']==NULL){
                                    if($supertrx['tipe']=='pesawat'){
                                        $link='confirmBayar';
                                    }elseif($supertrx['tipe']=='kai'){
                                        $link='confirmBayarKAI';
                                    }elseif($supertrx['tipe']=='pelni'){
                                        $link='confirmBayarPelni';
                                    }elseif($supertrx['tipe']=='hotel'){
                                        $link='confirmBayarHotel';
                                    }else{
                                        $link='confirmBayar';
                                    }
                                    ?>
                                    <a href="<?= base_url('superadminx/'.$link.'').'/'.$supertrx['id_cust_order']?>" class="confirmbayar" >
                                        <button class="btn btn-sm btn-success">
                                            <i class="glyphicon glyphicon-ok-sign"></i>
                                            Konfirmasi
                                        </button>
                                    </a>
                                    <?php if($role_id=='3'){?>
                                        <a href="<?= base_url('superadminx/deleteKonfirmasiBayar').'/'.$supertrx['id_konfirmasi_bayar']?>" class="deleteTrx">
                                    <?php }else{ ?>
                                        <a href="<?= base_url('adminx/deleteKonfirmasiBayar').'/'.$supertrx['id_konfirmasi_bayar']?>" class="deleteTrx">
                                    <?php } ?>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="glyphicon glyphicon-trash"></i>
                                            Hapus
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                            }
                        }
                            endif; ?>
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
</div>