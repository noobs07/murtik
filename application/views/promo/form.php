
<div class="popdown-content">
<section class="body">
    <div class="bootstrap-admin-panel-content">
        <?php
        echo form_open_multipart('promo/editprocesspromo');
        ?>
        <fieldset>
            <?php foreach ($list_promo as $promo) {
                ?>
                <legend>Edit Promo</legend>
                <div class="form-group">
                    <label class="col-lg-2 control-label" for="typeahead">Promo Title </label>
                    <div class="col-lg-10">
                        <input type="hidden" class="form-control col-md-6" name="id" value="<?= $promo['id'] ?>">
                                    <input type="text"  class="form-control col-md-6" name="promo_title"  value="<?= $promo['promo_title'] ?>">
						<p class="help-block">Please insert promo name!</p>		
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-lg-2 control-label" for="typeahead">Start Promo </label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" value="<?= $promo['start_show']?>" style="width:100px;" id="start_show" autocomplete="off" name="start_show">
                     
                    </div>
                </div>
                            
                <div class="form-group">
                    <label class="col-lg-2 control-label" for="typeahead">End Promo </label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" value="<?= $promo['end_show']?>" style="width:100px;" id="end_show" autocomplete="off" name="end_show">
                       <p class="help-block">Please insert promo time!</p>
                    </div>
                 </div>
				 
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-default close-popdown"> Close </button>
            <?php } ?>
        </fieldset>
        </form>
    </div>
</section>
</div>