

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
                            foreach($list_new_trx as $supertrx){ 
                                if($supertrx['deleted_at']!=null){
                                    $classTr = 'danger';
                                }else{
                                    $classTr = 'success';
                                }
                                $no++;?>
                            <tr class="<?= $classTr;?>">
                                <td><?= $no;?></td>
                                <td><?= $supertrx['id_cust_order']?></td>
                                <td><?= $supertrx['kode_order']?></td>
                                <td><?= $supertrx['firstname_cust']?></td>
                                <td><?= $supertrx['kode_maskapai']?></td>
                                <td><?= $supertrx['time_order']?></td>
                                <td><?php if ($supertrx['status_bayar'] == 0)
                                    {echo "belum";} else
                                    {echo "sudah";}?></td>
                                <td><?= $supertrx['bank_pengirim']?></td>
                                <td><?= number_format($supertrx['total_bayar'],0,'',',')?></td>
                                <td class="actions">
                                    <a class="hidden" href="<?= base_url('superadminx/detailTrx').'/'.$supertrx['id_cust_order']?>">
                                        <button class="btn btn-sm btn-primary">
                                            <i class="glyphicon glyphicon-share"></i>
                                            Detail
                                        </button>
                                    </a>
                                    <a href="http://murahtiketnya.com/API/get_order.php?web=1&kode_order=<?=$supertrx['id_cust_order']?>" target=_blank>
                                        <button class="btn btn-sm btn-primary">
                                            <i class="glyphicon glyphicon-share"></i>
                                            Detail
                                        </button>
                                    </a>
                                    <?php if($supertrx['status_bayar']==0):?>
                                    <a href="<?= base_url('superadminx/confirmBayar').'/'.$supertrx['id_cust_order']?>" class="confirmbayar" >
                                        <button class="btn btn-sm btn-success">
                                            <i class="glyphicon glyphicon-ok-sign"></i>
                                            Konfirmasi Pembayaran
                                        </button>
                                    </a>
                                    <?php endif; ?>
                                    <?php if($supertrx['status_bayar']==1):?>
                                    <a href="<?= base_url('superadminx/confirmTiket').'/'.$supertrx['id_cust_order']?>" class="confirmtiket">
                                        <button class="btn btn-sm btn-warning">
                                            <i class="glyphicon glyphicon-bell"></i>
                                            Konfirmasi Tiket
                                        </button>
                                    </a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('superadminx/deleteTrx').'/'.$supertrx['id_cust_order']?>" class="deleteTrx">
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