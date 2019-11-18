

<!-- content -->
<div class="col-md-10">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>Diskon</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-muted bootstrap-admin-box-title">Daftar Diskon
                        <!--div class="btn btn-sm btn-primary" id="flip" >
                            <i class="glyphicon glyphicon-pencil"></i>
                            Create New Diskon
                        </div-->
                        <!-- insert data -->
                        <div class="bootstrap-admin-panel-content" id="panel" style="display: none;">
                            <?php echo form_open_multipart('promo/adddiskon'); ?>
                            <fieldset>
                                <b><legend>Form New Diskon</legend></b>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="typeahead">Nama Maskapai </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control col-md-6" id="nama_maskapai"name="nama_maskapai">
                                        <p class="help-block">Please insert nama maskapai!</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="typeahead">Diskon </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control col-md-6" id="diskon" name="diskon">
                                        <p class="help-block hidden">Please insert diskon!</p>
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="fileInput">Image</label>
                                    <div class="col-lg-10">
                                        <input class="form-control uniform_on" id="imagename" name="imagename" type="file">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <button type="reset" class="btn btn-default" id="flipUp">Cancel</button>
                            </fieldset>
                            </form>
                        </div>
                        <!-- insert data -->
                        <!-- edit data -->
                        <div class="bootstrap-admin-panel-content" id="popup" style="display: none;">
                            <?php echo form_open_multipart('promo/adddiskon'); ?>
                            <fieldset>
                                <b><legend>Form New Diskon</legend></b>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="typeahead">Nama Maskapai </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control col-md-6" id="nama_maskapai" name="nama_maskapai">
                                        <p class="help-block">Please insert nama maskapai!</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="typeahead">Diskon </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control col-md-6" id="diskon" name="diskon">
                                        <p class="help-block hidden">Please insert diskon!</p>
                                    </div>
                                </div>
                                <hr/>
                                
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="fileInput">Image</label>
                                    <div class="col-lg-10">
                                        <input class="form-control uniform_on" id="imagename" name="imagename" type="file">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <button type="reset" class="btn btn-default" id="flipUp">Cancel</button>
                            </fieldset>
                            </form>
                        </div>
                        <!-- edit data -->
                    </div>
                </div>
                
                <div class="bootstrap-admin-panel-content">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Pesawat</a></li>
    <li><a data-toggle="tab" href="#menu1">Hotel</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>Pesawat</h3>
      <div class="bootstrap-admin-panel-content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Maskapai</th>
                                <th>Diskon</th>
                                <th>Diskon Promo</th>
                                <th>Bagasi</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($list_promo as $promo) {
                                ?>
                                <tr class="success">
                                    <td><?= $i; ?></td>
                                    <td><?= $promo['maskapai'] ?></td>
                                    <td><?= $promo['diskon'] ?></td>
                                    <td><?= $promo['diskon_promo'] ?></td>
                                    <td><?= $promo['bagasi'] ?></td>
                                    <td class="actions">
										<a class="popdown" href="<?= base_url('promo/editdiskon') . '/' . $promo['maskapai'] ?>">
                                            <button class="btn btn-sm btn-primary" >
                                                <i class="glyphicon glyphicon-pencil"></i>
                                                Edit
                                            </button>
										</a>
                                        
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
    </div>
    <div id="menu1" class="tab-pane fade">
      <fieldset>
                                <b><legend>Diskon Hotel</legend></b>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="typeahead">Tambahan</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control col-md-6" id="tambahan" name="tambahan" value="<?=$tambahan?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="typeahead">Tambahan Persen</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control col-md-6" id="tambahan_persen" name="tambahan_persen" value="<?=$tambahan_persen?>">
                                        <p class="help-block hidden">Please insert diskon!</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="typeahead">Diskon</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control col-md-6" id="potongan" name="potongan" value="<?=$potongan?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="typeahead">Diskon Persen</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control col-md-6" id="potongan_persen" name="potongan_persen" value="<?=$potongan_persen?>">
                                    </div>
                                </div>

                                <button class="btn btn-primary" onClick="saveDiskonHotel()">Save changes</button>
                            </fieldset>
    </div>
  </div>
</div>
                
                
            </div>
        </div>
    </div>
<script type="text/javascript">
    function saveDiskonHotel() {
        //alert("tes");
        $.ajax({
            type: "POST",
            data:"tambahan="+$('#tambahan').val()+"&tambahan_persen="+$('#tambahan_persen').val()+"&potongan="+$('#potongan').val()+"&potongan_persen="+$('#potongan_persen').val(),
            url: "http://backendadmin.affanutama.co.id/index.php/promo/updateDiskonHotel",
            success:
                    function (response) {
                        var hasil = response;
                        if(hasil)
                        alert("Berhasil Update Diskon");
                        else
                        alert("Gagal Update Diskon");
                    }
        });
    }
</script>


