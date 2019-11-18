

<!-- content -->
<div class="col-md-10">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>Promo</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-muted bootstrap-admin-box-title">Buat Promo
                    	
                    </div>
                </div>
                <div class="bootstrap-admin-panel-content">
                    <?php 
                    $attributes = array('id' => 'formAddPromo');
                    echo form_open_multipart('promo/addpromo');?>
                        <fieldset>
                            <legend>Form New Promo</legend>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Promo Title </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control col-md-6" id="promo_title" autocomplete="off" name="promo_title">
                                    <p class="help-block">Please insert promo title!</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Start Promo </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control col-md-6" style="width:100px;" id="start_show" autocomplete="off" name="start_show">
                                    <p class="help-block hidden">Please insert promo title!</p>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">End Promo </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control col-md-6" style="width:100px;" id="end_show" autocomplete="off" name="end_show">
                                    <p class="help-block hidden">Please insert promo title!</p>
                                </div>
                            </div><hr/>
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

