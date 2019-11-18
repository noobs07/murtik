

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
                    <div class="text-muted bootstrap-admin-box-title">Edit Diskon
                    	
                    </div>
                </div>
                <div class="bootstrap-admin-panel-content">
                    <?php 
                    $attributes = array('id_diskon' => 'formEditDiskon');
                    echo form_open_multipart('promo/editprocessdiskon');?>
                        <input type="hidden" name="id_diskon" value="<?= $detail_diskon['id_diskon']?>"/>
                        <fieldset>
                            <legend>Form New Diskon</legend>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Nama Maskapai </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control col-md-6" value="<?= $detail_diskon['nama_maskapai']?>" id="nama_maskapai" autocomplete="off" name="nama_maskapai">
                                    <p class="help-block">Please insert diskon title!</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Diskon</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control col-md-6" id="diskon" autocomplete="off" name="diskon">
                                    <p class="help-block">Please insert Diskon</p>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="fileInput">Image</label>
                                <div class="col-lg-10">
                                    <img width="150" height="100" src="<?= $detail_diskon['image']?>" alt="">
                                    <input class="form-control uniform_on" id="imageItem" name="imageItem" type="file">
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
</div>

