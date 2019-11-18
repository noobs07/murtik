

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
                    <div class="text-muted bootstrap-admin-box-title">Buat Diskon
                    	
                    </div>
                </div>
                <div class="bootstrap-admin-panel-content">
                    <?php 
                    $attributes = array('id_diskon' => 'formAddDiskon');
                    echo form_open_multipart('promo/adddiskon');?>
                        <fieldset>
                            <legend>Form New Diskon</legend>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Nama Maskapai</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control col-md-6" id="nama_maskapai" autocomplete="off" name="nama_maskapai">
                                    <p class="help-block">Please insert Nama Maskapai</p>
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
                                    <input class="form-control uniform_on" id="imageItem" name="imageItem" type="file">
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="reset" class="btn btn-default">Cancel</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
</div>

