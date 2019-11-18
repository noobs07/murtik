
<div class="popdown-content">
<section class="body">
    <div class="bootstrap-admin-panel-content">
        <?php
        echo form_open_multipart('promo/editprocessdiskon');
        ?>
        <fieldset>
            <?php foreach ($list_promo as $promo) {
                ?>
                <legend>Form New Promo</legend>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Maskapai </label>
                                <div class="col-lg-10">
									<input type="hidden" class="form-control col-md-6" name="id_diskon" value="<?= $promo['maskapai'] ?>">
                                    <input type="text"  class="form-control col-md-6" name="maskapai" readonly  value="<?= $promo['maskapai'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Diskon </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control col-md-6" name="diskon"  value="<?= $promo['diskon'] ?>">
                                    <p class="help-block">Please insert new diskon!</p>
                                </div>
                                <label class="col-lg-2 control-label" for="typeahead">Diskon Promo </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control col-md-6" name="diskon_promo"  value="<?= $promo['diskon_promo'] ?>">
                                    <p class="help-block">Please insert new diskon!</p>
                                </div>
                                <label class="col-lg-2 control-label" for="typeahead">Bagasi </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control col-md-6" name="bagasi"  value="<?= $promo['bagasi'] ?>">
                                    <p class="help-block">Please insert new bagasi!</p>
                                </div>
                            </div>
                            <hr/>
                            
                            
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-default close-popdown"> Close </button>
            <?php } ?>
        </fieldset>
        </form>
    </div>
</section>
</div>