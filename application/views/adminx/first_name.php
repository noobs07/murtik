   
            <div>
    			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">
   				 Close</span>
    			</button>
			</div>
			<div class="popdown-content">
   				<section class="body">
        			<div class="bootstrap-admin-panel-content">
        			<!-- content goes here -->                                        
            			<div class="bootstrap-admin-panel-content">
            			<?php 
            			echo form_open_multipart('adminx/updateFirstName');?> 
            				<fieldset>
            				<?php foreach ($list_member as $member) {
             				?>
            				<legend>Update Admin</legend>
                				<div class="form-group">
                    				<label for="first_name">First Name</label>
                    				<input type="hidden" name="user_id"  class="form-control" value="<?php echo $member['user_id']; ?>" />
                    				<input type="text" name="first_name" class="form-control" value="<?php echo $member['first_name']; ?>" />
                				</div>
                			<?php } ?>
                			<button type="submit" class="btn btn-primary">Save</button>
            				</fieldset>
            				</form>
            			</div>
         			</div>
    			</section>
			</div>
		