
                                       <div class="popdown-content">
                                        <section class="body">
                                            <div class="bootstrap-admin-panel-content">
        
                                        <!-- content goes here -->                                        
                                                <div class="bootstrap-admin-panel-content">
                                                <?php 
                                                echo form_open_multipart('superadminx/updateAdminProcess');?> 
                                                <fieldset>
                                               <?php foreach ($list_member as $supertrx) {
                                                ?>
                                                <legend>Update Admin</legend>
                                                <div class="form-group">
                                                    <label for="exampleInputMaskapai">First Name</label>
                                                    <input type="hidden" name="user_id"  class="form-control" value="<?php echo $supertrx['user_id']; ?>" />
                                                    <input type="text" name="first_name" class="form-control" value="<?php echo $supertrx['first_name']; ?>" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputDiskon">Last Name</label>
                                                    <input type="text" name="last_name" class="form-control"  value="<?php echo $supertrx['last_name']; ?>" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputDiskon">Surname</label>
                                                    <input type="text" name="surname" class="form-control"  value="<?php echo $supertrx['surname']; ?>" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputDiskon">Email</label>
                                                    <input type="text" name="email" class="form-control"  value="<?php echo $supertrx['email']; ?>" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputDiskon">Phone</label>
                                                    <input type="text" name="phone" class="form-control"  value="<?php echo $supertrx['phone']; ?>" />
                                                </div>                
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-default close-popdown"> Close </button>
                                                <?php } 
                                                ?>
                                                </fieldset>
                                                </form>   
                                            </div>
                                            </section>        
                                        </div>                   
                                    