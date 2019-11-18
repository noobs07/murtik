

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
                    <div class="text-muted bootstrap-admin-box-title">Daftar Promo

                        <div class="btn btn-sm btn-primary" id="flip" >
                            <i class="glyphicon glyphicon-pencil"></i>
                            Create New Promo
                        </div>
                        <!-- insert data -->
                        <div class="bootstrap-admin-panel-content" id="panel" style="display: none;">
                            <?php echo form_open_multipart('promo/addpromo'); ?>
                            <fieldset>
                                <b><legend>Form New Promo</legend></b>
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
                                        <input  type="file" class="form-control uniform_on" id="imageItem" name="imageItem">
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
                            <?php echo form_open_multipart('promo/addpromo'); ?>
                            <fieldset>
                                <b><legend>Form New Promo</legend></b>
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
                                        <input type="file" class="form-control uniform_on" id="imageItem" name="imageItem" >
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
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Promo Title</th>
                                <th>Url Image</th>
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
                                    <td><img src="<?= $promo["url_image"] ?>" width="120px" height="100px"/></td>
                                    <td><?= $promo['promo_title'] ?></td>
                                    <td><?= $promo['url_image'] ?></td>
                                    <td class="actions">
										<a class="popdown" href="<?= base_url('promo/edit') . '/' . $promo['id'] ?>">
                                            <button class="btn btn-sm btn-primary" >
                                                <i class="glyphicon glyphicon-pencil"></i>
                                                Edit
                                            </button>
										</a>
                                        <a class="del_promo" href="<?= base_url('promo/del') . '/' . $promo['id'] ?>">
                                            <button class="btn btn-sm btn-danger">
                                                <i class="glyphicon glyphicon-trash"></i>
                                                Delete
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
        </div>
    </div>



