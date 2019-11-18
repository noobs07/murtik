

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
                                <th>Nama Pemesan</th>
                                <th>Kode Order</th>
                                <th>Maskapai</th>
                                <th>Waktu Transaksi</th>
                                <th>Email</th>
                                <th>Telp</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($list_new_trx==null):?>
                            <tr>
                                <td colspan="8">belum ada data transaksi</td>
                            </tr>
                            <?php else:
                            $no = 0;
                            foreach($list_new_trx as $supertrx){ 
                                    $classTr = 'success';
                                $no++;?>
                            <tr class="<?= $classTr;?>">
                                <td><?= $no;?></td>
                                <td><?= $supertrx['firstname_cust'].'/'.$supertrx['surname_cust']?></td>
                                <td><?= $supertrx['kode_order']?></td>
                                <td><?= $supertrx['maskapai']?></td>
                                <td><?= $supertrx['time_order']?></td>
                                <td><?= $supertrx['email_cust']?></td>
                                <td><?= $supertrx['phone_cust']?></td>
                                <td class="actions">
                                    <a href="<?= base_url('superadminx/deleteBatal').'/'.$supertrx['kode_order']?>" class="deleteTrx">
                                        <button class="btn btn-sm btn-danger">
                                            <i class="glyphicon glyphicon-trash"></i>
                                            Sudah Dibatalkan
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