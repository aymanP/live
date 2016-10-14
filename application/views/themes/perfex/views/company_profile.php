<div class="row">
    <div class="col-md-12">
        <?php echo form_open_multipart('clients/company'); ?>
        <div class="panel_s">
            <div class="panel-heading">
                <?php echo _l('clients_profile_heading'); ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company" class="control-label"><?php echo _l('clients_company'); ?></label>
                            <input type="text" class="form-control" name="company" value="<?php echo set_value('company',$client->company); ?>">
                            <?php echo form_error('company'); ?>
                        </div>
                        <div class="form-group">
                            <label for="vat" class="control-label"><?php echo _l('clients_vat'); ?></label>
                            <input type="text" class="form-control" name="vat" value="<?php if(isset($client)){echo $client->vat;} ?>">
                        </div>
                        <div class="form-group">
                            <label for="phonenumber"><?php echo _l('clients_phone'); ?></label>
                            <input type="text" class="form-control" name="phonenumber" id="phonenumber" value="<?php echo $client->phonenumber; ?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname"><?php echo _l('clients_country'); ?></label>
                            <select name="country" class="form-control" id="country">
                                <option value=""></option>
                                <?php foreach(get_all_countries() as $country){ ?>
                                <?php
                                    $selected = '';
                                    if($client->country == $country['country_id']){echo $selected = true;}
                                    ?>
                                <option value="<?php echo $country['country_id']; ?>" <?php echo set_select('country', $country['country_id'],$selected); ?>><?php echo $country['short_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="city"><?php echo _l('clients_city'); ?></label>
                            <input type="text" class="form-control" name="city" id="city" value="<?php echo $client->city; ?>">
                        </div>
                        <div class="form-group">
                            <label for="address"><?php echo _l('clients_address'); ?></label>
                            <input type="text" class="form-control" name="address" id="address" value="<?php echo $client->address; ?>">
                        </div>
                        <div class="form-group">
                            <label for="zip"><?php echo _l('clients_zip'); ?></label>
                            <input type="text" class="form-control" name="zip" id="zip" value="<?php echo $client->zip; ?>">
                        </div>
                        <div class="form-group">
                            <label for="state"><?php echo _l('clients_state'); ?></label>
                            <input type="text" class="form-control" name="state" id="state" value="<?php echo $client->state; ?>">
                        </div>
                        <div class="form-group">
                            <label for="default_language" class="control-label"><?php echo _l('localization_default_language'); ?>
                            </label>
                            <select name="default_language" id="default_language" class="form-control selectpicker">
                                <option value="" <?php if($client->default_language == ''){echo 'selected';} ?>><?php echo _l('system_default_string'); ?></option>
                                <?php foreach(list_folders(APPPATH .'language') as $language){
                                    $selected = '';
                                    if($client->default_language == $language){
                                      $selected = 'selected';
                                  }
                                  ?>
                                  <option value="<?php echo $language; ?>" <?php echo $selected; ?>><?php echo ucfirst($language); ?></option>
                                  <?php } ?>
                              </select>
                          </div>
                        <?php echo render_custom_fields( 'customers',$client->userid,array('show_on_client_portal'=>1)); ?>
                    </div>
                    <?php if($contact->is_primary == 1){ ?>
                    <div class="row p15">
                        <div class="col-md-12 text-right mtop20">
                            <div class="form-group">
                                <button type="submit" class="btn btn-info"><?php echo _l('clients_edit_profile_update_btn'); ?></button>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
