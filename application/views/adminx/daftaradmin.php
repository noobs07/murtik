

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
                        <button data-toggle="modal" data-target="#addAdminModal"  
                        class="btn btn-sm btn-primary">
                        <i class="glyphicon glyphicon-pencil"></i>
                        New Admin
                        </button>
                    </div>
                <!-- line modal -->
                    <div class="modal fade"  id="addAdminModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">    
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">
                                    Close</span>
                                    </button>
                                    <h3 class="modal-title" id="lineModalLabel">New Admin</h3>
                                </div>
                                <div class="modal-body">
         
                                <!-- content goes here -->                                        
                                    <div class="bootstrap-admin-panel-content">
                                        <?php 
                                        $attributes = array('user_id' => 'formAddUser');
                                        echo form_open_multipart('superadminx/addAdmin');?>
                                        <fieldset>
                                        <div class="form-group">
                                            <label for="exampleInputMaskapai">First Name</label>
                                            <input type="text" name="first_name"  class="form-control" placeholder="First Name" required />                                                    
                                        </div>
                                            <div class="form-group">
                                                <label for="exampleInputDiskon">Last Name</label>
                                                <input type="text" name="last_name" class="form-control"  placeholder="Last Name" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputDiskon">Surname</label>
                                                <input type="text" name="surname" class="form-control"  placeholder="Surname" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputDiskon">Password</label>
                                                <input type="password" name="password" class="form-control"  placeholder="******" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputDiskon">Email</label>
                                                <input type="text" name="email" class="form-control"  placeholder="Email" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputDiskon">Phone</label>
                                                <input type="text" name="phone" class="form-control"  placeholder="Phone Number" required />
                                            </div>                
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="btn btn-close" data-dismiss="modal">Cancel</button>
                                        </fieldset>
                                        </form>   
                                    </div>        
                                </div>
                            </div>            
                        </div>
                    </div>
                </div>
                <div class="bootstrap-admin-panel-content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Surname</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($list_member==null):?>
                            <tr>
                                <td colspan="4">belum ada admin terdaftar</td>
                            </tr>
                            <?php else: ?>
                            <?php 
                            $no = 0; 
                            foreach($list_member as $supertrx){ 
                                if($supertrx['role_id']!=null){
                                    $classTr = 'danger';
                                }else{
                                    $classTr = 'success';
                                }
                                $no++;?>
                            <tr class="<?= $classTr;?>">
                                <td><?= $no;?></td>
                                <td><?= $supertrx['first_name']?></td>
                                <td><?= $supertrx['last_name']?></td>
                                <td><?= $supertrx['surname']?></td>
                                <td><?= $supertrx['email']?></td>
                                <td><?= $supertrx['phone']?></td>
                                <td><?php if ($supertrx['role_id'] == 1)
                                    {echo "member";} else if ($supertrx['role_id'] == 2)
                                    {echo "admin";} else 
                                    {echo "superadmin";}
                                    ?></td>
                                <td class="actions">
                                    <a class="popdown" href="<?= base_url('superadminx/updateAdmin') . '/' . $supertrx['user_id'] ?>">                                   
                                    <button data-toggle="modal"  class="btn btn-success" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-pencil"></i> Update </button>
                                    </a>
                                    
                                   
                                    <a href="<?= base_url('superadminx/deleteMember').'/'.$supertrx['user_id']?>" class="deleteTrx">
                                        <button class="btn btn-sm btn-danger">
                                            <i class="glyphicon glyphicon-trash"></i>
                                            Delete
                                        </button>
                                    </a>                                   
                                </td>
                            </tr
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