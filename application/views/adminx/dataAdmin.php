<?php if (isset($_GET['stat'])){
    echo '<script type="text/javascript"> alert ("password salah");</script>';
}?>
<!-- content -->
<div class="col-md-10">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>Manage Admin</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-muted bootstrap-admin-box-title">Daftar Admin</div>
                </div>
                <div class="bootstrap-admin-panel-content">
                <table class="table">
                <tbody>
                   <fieldset>
                   <?php foreach ($member as $member) {
                    ?>
                    <ul class="adminInfo">
                        <li class="adminListItem clearfix _5b2_ adminListItemLabeled"> 
                        
                            <label class="pls adminListItemLabel col-md-5" id="u_0_4">First Name</label>                                                       
                            <span class="adminListItemContent fcg col-md-5"> <strong><?= $member['first_name']?></strong>                           
                            </span>
                            <button data-toggle="modal" data-target="#firstnameModal"  
                            class="btn btn-sm btn-success">
                            <i class="glyphicon glyphicon-pencil"></i>
                            Update
                            </button>
                        </li><br>

                        <li class="adminListItem clearfix _5b2_ adminListItemLabeled"> 
                        
                            <label class="pls adminListItemLabel col-md-5"  id="u_0_4">Last Name</label>                                                       
                            <span class="adminListItemContent fcg col-md-5"> <strong><?= $member['last_name']?></strong>                           
                            </span>

                            <button data-toggle="modal" data-target="#lastnameModal"  
                            class="btn btn-sm btn-success">
                            <i class="glyphicon glyphicon-pencil"></i>
                            Update
                            </button>
                        
                        </li><br>
                        <li class="adminListItem clearfix _5b2_ adminListItemLabeled"> 
                        
                            <label class="pls adminListItemLabel col-md-5" id="u_0_4">Surname</label>                                                       
                            <span class="adminListItemContent fcg col-md-5"> <strong><?= $member['surname']?></strong>                           
                            </span>
                            <button data-toggle="modal" data-target="#surnameModal"  
                            class="btn btn-sm btn-success">
                            <i class="glyphicon glyphicon-pencil"></i>
                            Update
                            </button>
                      
                        </li><br>

                        <li class="adminListItem clearfix _5b2_ adminListItemLabeled">
                        
                            <label class="pls adminListItemLabel col-md-10" id="u_jsonp_4_7">Password</label>
                            <button data-toggle="modal" data-target="#pswModal"  
                            class="btn btn-sm btn-success">
                            <i class="glyphicon glyphicon-pencil"></i>
                            Update
                            </button>
                          
                            <div class="content">
                            </div>
                        </li><br>

                        <li class="adminListItem clearfix _5b2_ adminListItemLabeled"> 
                        
                            <label class="pls adminListItemLabel col-md-5" id="u_0_4">Email</label>                                                       
                            <span class="adminListItemContent fcg col-md-5"> <strong><?= $member['email']?></strong>                           
                            </span>
                            <button data-toggle="modal" data-target="#emailModal"  
                            class="btn btn-sm btn-success">
                            <i class="glyphicon glyphicon-pencil"></i>
                            Update
                            </button>
                      
                        </li><br>

                        <li class="adminListItem clearfix _5b2_ adminListItemLabeled"> 
                        
                            <label class="pls adminListItemLabel col-md-5" id="u_0_4">Phone</label>                                                       
                            <span class="adminListItemContent fcg col-md-5"> <strong><?= $member['phone']?></strong>                           
                            </span>
                            <button data-toggle="modal" data-target="#phoneModal"  
                            class="btn btn-sm btn-success">
                            <i class="glyphicon glyphicon-pencil"></i>
                            Update
                            </button>
                      
                        </li><br>

                    </ul>
                    <?php
                    }
                    ?>
                    <!-- line modal -->
                        <div class="modal fade"  id="firstnameModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">    
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">
                                        Close</span>
                                        </button>
                                        <h3 class="modal-title" id="lineModalLabel">Update First Name</h3>
                                    </div>
                                    <div class="modal-body">
         
                                    <!-- content goes here -->                                        
                                        <div class="bootstrap-admin-panel-content">
                                            <?php 
                                            echo form_open_multipart('adminx/updateFirstName');?>
                                            <fieldset>
                                            <div class="form-group">
                                                <label for="first_name">First Name</label>
                                                <input type="hidden" name="user_id"  class="form-control" value="<?php echo $member['user_id']; ?>" />
                                                <input type="text" name="first_name"  class="form-control" placeholder="First Name"  value="<?php echo $member['first_name']; ?>" />                                                   
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="close btn-close" data-dismiss="modal" >Cancel</button>
                                            </fieldset>
                                            </form>   
                                        </div>        
                                    </div>
                                </div>            
                            </div>
                        </div>

                        <!-- line modal -->
                        <div class="modal fade"  id="lastnameModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">    
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">
                                        Close</span>
                                        </button>
                                        <h3 class="modal-title" id="lineModalLabel">Update Last Name</h3>
                                    </div>
                                    <div class="modal-body">
         
                                    <!-- content goes here -->                                        
                                        <div class="bootstrap-admin-panel-content">
                                            <?php 
                                            echo form_open_multipart('adminx/updateLastName');?>
                                            <fieldset>
                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input type="hidden" name="user_id"  class="form-control" value="<?php echo $member['user_id']; ?>" />
                                                <input type="text" name="last_name"  class="form-control" placeholder="Last Name"  value="<?php echo $member['last_name']; ?>" />                                                   
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="close btn-close" data-dismiss="modal" >Cancel</button>
                                            </fieldset>
                                            </form>   
                                        </div>        
                                    </div>
                                </div>            
                            </div>
                        </div>

                         <!-- line modal -->
                        <div class="modal fade"  id="surnameModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">    
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">
                                        Close</span>
                                        </button>
                                        <h3 class="modal-title" id="lineModalLabel">Update Surname</h3>
                                    </div>
                                    <div class="modal-body">
         
                                    <!-- content goes here -->                                        
                                        <div class="bootstrap-admin-panel-content">
                                            <?php 
                                            echo form_open_multipart('adminx/updatesurname');?>
                                            <fieldset>
                                            <div class="form-group">
                                                <label for="surname">Surname</label>
                                                <input type="hidden" name="user_id"  class="form-control" value="<?php echo $member['user_id']; ?>" />
                                                <input type="text" name="surname"  class="form-control" placeholder="Surname"  value="<?php echo $member['surname']; ?>" />                                                   
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="close btn-close" data-dismiss="modal" >Cancel</button>
                                            </fieldset>
                                            </form>   
                                        </div>        
                                    </div>
                                </div>            
                            </div>
                        </div>

                        <!-- line modal -->
                        <div class="modal fade"  id="pswModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">    
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">
                                        Close</span>
                                        </button>
                                        <h3 class="modal-title" id="lineModalLabel">Update Password</h3>
                                    </div>
                                    <div class="modal-body">
         
                                    <!-- content goes here -->                                        
                                        <div class="bootstrap-admin-panel-content">
                                            <?php 
                                            echo form_open_multipart('adminx/updatepassword');?>
                                            <fieldset>
                                            <div class="form-group">
                                            <input type="hidden" name="user_id"  class="form-control" value="<?php echo $member['user_id']; ?>" />
                                                <label for="passwordLama">Password</label>
                                                <input type="password" name="passwordlama"  class="form-control" placeholder="Masukkan Password Lama" required />
                                                <label for="passwordBaru">Password</label>
                                                <input type="password" name="passwordBaru"  class="form-control" placeholder="Masukkan Password Baru" required/>
                                                <label for="password">Ulangi Password Baru</label>
                                                <input type="password" name="password"  class="form-control" placeholder="Masukkan Password" required/>                                                  
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="close btn-default" data-dismiss="modal" >Cancel</button>
                                            </fieldset>
                                            </form>   
                                        </div>        
                                    </div>
                                </div>            
                            </div>
                        </div>

                        <!-- line modal -->
                        <div class="modal fade"  id="emailModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">    
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">
                                        Close</span>
                                        </button>
                                        <h3 class="modal-title" id="lineModalLabel">Update Email</h3>
                                    </div>
                                    <div class="modal-body">
         
                                    <!-- content goes here -->                                        
                                        <div class="bootstrap-admin-panel-content">
                                            <?php 
                                            echo form_open_multipart('adminx/updateEmail');?>
                                            <fieldset>
                                            <div class="form-group">
                                                <label for="last_name">Email</label>
                                                <input type="hidden" name="user_id"  class="form-control" value="<?php echo $member['user_id']; ?>" />
                                                <input type="text" name="email"  class="form-control" placeholder="email"  value="<?php echo $member['email']; ?>" />                                                   
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="close btn-close" data-dismiss="modal" >Cancel</button>
                                            </fieldset>
                                            </form>   
                                        </div>        
                                    </div>
                                </div>            
                            </div>
                        </div>

                        <!-- line modal -->
                        <div class="modal fade"  id="phoneModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">    
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">
                                        Close</span>
                                        </button>
                                        <h3 class="modal-title" id="lineModalLabel">Update Phone Number</h3>
                                    </div>
                                    <div class="modal-body">
         
                                    <!-- content goes here -->                                        
                                        <div class="bootstrap-admin-panel-content">
                                            <?php 
                                            echo form_open_multipart('adminx/updatePhone');?>
                                            <fieldset>
                                            <div class="form-group">
                                                <label for="surname">Phone</label>
                                                <input type="hidden" name="user_id"  class="form-control" value="<?php echo $member['user_id']; ?>" />
                                                <input type="text" name="phone"  class="form-control" placeholder="0988754xxx"  value="<?php echo $member['phone']; ?>" />                                                   
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="close btn-close" data-dismiss="modal" >Cancel</button>
                                            </fieldset>
                                            </form>   
                                        </div>        
                                    </div>
                                </div>            
                            </div>
                        </div>

                        </fieldset>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
</div>