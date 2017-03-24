<?php init_head(); ?>
<div id="wrapper" class="customer_profile">
  <div class="content">
    <div class="row">
      <?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
      <div class="col-md-12">
        <?php if(isset($client) && $client->leadid != NULL){ ?>
          <div class="alert alert-info">
            <a href="#" onclick="init_lead(<?php echo $client->leadid; ?>); return false;"><?php echo _l('customer_from_lead',_l('lead')); ?></a>
          </div>
          <?php } ?>
          <?php if(isset($client) && (!has_permission('customers','','view') && is_customer_admin($client->userid))){?>
            <div class="alert alert-info">
              <?php echo _l('customer_admin_login_as_client_message',get_staff_full_name(get_staff_user_id())); ?>
            </div>
            <?php } ?>
            <div class="panel_s no-margin">
              <div class="panel-body">
                <?php if(isset($client) && has_permission('invoices','','create') && $group == 'invoices'){ ?>
                  <div id="invoices_total"></div>
                  <?php } ?>
                  <?php if(isset($client) && has_permission('expenses','','create') && $group == 'expenses'){ ?>
                    <div id="expenses_total"></div>
                    <?php } ?>
                    <?php if(isset($client) && has_permission('expenses','','create') && $group == 'estimates'){ ?>
                      <div id="estimates_total"></div>
                      <?php } ?>
                      <?php if(isset($client) && $group == 'projects'){ ?>
                        <div class="row">
                          <?php foreach($project_statuses as $status){ ?>
                            <div class="col-md-3 total-column">
                              <div class="panel_s">
                                <div class="panel-body">
                                  <h3 class="text-muted _total">
                                  <?php echo total_rows('tblprojects',array('status'=>$status,'clientid'=>$client->userid)); ?>
                                  </h3>
                                  <span class="text-<?php echo get_project_label($status); ?>"><?php echo _l('project_status_'.$status); ?></span>
                                </div>
                              </div>
                            </div>
                            <?php } ?>
                          </div>
                          <?php } ?>
                          <?php $this->load->view('admin/clients/tabs'); ?>
                          <div class="clearfix"></div>
                        </div>
                      </div>
                      <div class="panel_s">

                          <div class="panel-heading">
                              <div class="row">
                                  <div class="col-md-12 col-sm-12">
                            <div class="col-md-6 col-sm-6">
                                <?php if(isset($client)) {
                                    echo '<a href="' . admin_url('clients/client/' . $client->userid) . '">' . client_profile_image($client->userid, array('client-profile-image-small')) . '</a>';
                                } ?>
                            </div>
                              <div align="right" class="col-md-6 col-sm-6 client-profile-company1" style="margin-left:0 !important">
                              <?php echo $title;

                              ?>
                          </div>
                                  </div>
                              </div>
                              <div class="clearfix"></div>
                          </div>
                        <div class="panel-body">
                          <?php if(isset($client)){ ?>
                            <?php echo form_hidden( 'isedit'); ?>
                            <?php echo form_hidden( 'userid',$client->userid); ?>
                            <div class="clearfix"></div>
                            <?php } ?>
                            <div>
                              <div class="tab-content">
                                <?php $this->load->view('admin/clients/groups/'.$group); ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php init_tail(); ?>
                <?php if(isset($client)){ ?>
                  <script>
                    init_rel_tasks_table(<?php echo $client->userid; ?>,'customer');
                  </script>
                  <?php } ?>
                  <?php if(!empty($google_api_key) && !empty($client->latitude) && !empty($client->longitude)){ ?>
                    <script>
                      var latitude = '<?php echo $client->latitude; ?>';
                      var longitude = '<?php echo $client->longitude; ?>';
                      var marker = '<?php echo $client->company; ?>';
                    </script>
                    <script src="<?php echo site_url('assets/js/map.js'); ?>"></script>
                    <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_api_key; ?>&callback=initMap"></script>
                    <?php } ?>
                    <script>
                      var customer_id = $('input[name="userid"]').val();
                      Dropzone.options.clientAttachmentsUpload = {
                       paramName: "file",
                       addRemoveLinks: false,
                       accept: function(file, done) {
                         done();
                       },
                       acceptedFiles:allowed_files,
                       error:function(file,response){
                         alert_float('danger',response);
                       },
                       success: function(file, response) {
                          alert('success');
                         //window.location.reload();
                       }
                     };

                     $(document).ready(function() {
                       var contact_id = get_url_param('contactid');
                       if(contact_id){
                         contact(customer_id,contact_id);
                         $('a[href="#contacts"]').click();
                       }
     // If user clicked save and add new contact
     var new_contact = get_url_param('new_contact');
     if(new_contact){
      contact(customer_id);
      $('a[href="#contacts"]').click();
    }
    $('.customer-form-submiter').on('click',function(){
      var form = $('.client-form');
      if(form.valid()){
        if($(this).hasClass('save-and-add-contact')){
          form.find('.additional').html(hidden_input('save_and_add_contact','true'));
        } else {
          form.find('.additional').html('');
        }
        form.submit();
      }
    });

     // Tables
    var ticket_created = 8;
    if (use_services == 0) {
        ticket_created = 7;
    }
    var tickets_not_sortable = $('.table-projects').find('th').length - 1;
    initDataTable('.table-tickets-single', admin_url + 'tickets/index/""/'+customer_id, [tickets_not_sortable], [tickets_not_sortable], 'undefined', [ticket_created, 'DESC']);

    var headers_contracts = $('.table-contracts-single-client').find('th');
    var headers_contracts = (headers_contracts.length - 1);

    initDataTable('.table-contracts-single-client', admin_url + 'contracts/index/' + customer_id, [headers_contracts], [headers_contracts],'undefined',[3,'DESC']);

    var headers_contacts = $('.table-contacts').find('th');
    var not_sortable_contacts = (headers_contacts.length - 1);

    initDataTable('.table-contacts', admin_url + 'clients/contacts/' + customer_id, [not_sortable_contacts], [not_sortable_contacts]);
    _table_api = initDataTable('.table-invoices-single-client', admin_url + 'invoices/list_invoices/false/' + customer_id, 'undefined', 'undefined','undefined',[[3, 'DESC'],[0, 'DESC']]);
    if(_table_api){
      _table_api.column(3).visible(false, false).columns.adjust().draw(false);
    }

    _table_api = initDataTable('.table-estimates-single-client', admin_url + 'estimates/list_estimates/false/' + customer_id, 'undefined', 'undefined','undefined',[[3,'DESC'],[0,'DESC']]);
    if(_table_api){
      _table_api.column(3).visible(false, false).columns.adjust().draw(false);
    }


    initDataTable('.table-payments-single-client', admin_url + 'payments/list_payments/' + customer_id, [7], [7], 'undefined',[6,'DESC']);
    initDataTable('.table-reminders', admin_url + 'misc/get_reminders/' + customer_id + '/' + 'customer', [4], [4]);
    _table_api = initDataTable('.table-expenses-single-client', admin_url + 'expenses/list_expenses/false/' + customer_id, 'undefined', 'undefined','undefined',[4,'DESC']);
    if(_table_api){
      _table_api.column(0).visible(false, false).columns.adjust().draw(false);
    }

    _table_api = initDataTable('.table-proposals-client-profile', admin_url + 'proposals/proposal_relations/' + customer_id + '/customer', 'undefined', 'undefined','undefined',[4,'DESC']);
     if(_table_api){
      _table_api.column(0).visible(false, false).columns.adjust().draw(false);
    }

    initDataTable('.table-projects-single-client', admin_url + 'projects/index/' + customer_id, [7], [7], 'undefined', [2, 'DESC']);
    _validate_form($('.client-form'), {
     company: 'required',
   });

    $('a[href="#contacts"],a[href="#customer_admins"]').on('click',function(){
     $('.customer-form-submiter').addClass('hide');
   });

    $('.profile-tabs a').not('a[href="#contacts"],a[href="#customer_admins"]').on('click',function(){
     $('.customer-form-submiter').removeClass('hide');
   });

     // Save button not hidden if passed from url ?tab= we need to re-click again
     if (tab_active) {
      $('body').find('.nav-tabs [href="#' + tab_active + '"]').click();
    }

    $('.billing-same-as-customer').on('click', function(e) {
     e.preventDefault();
     $('input[name="billing_street"]').val($('input[name="address"]').val());
     $('input[name="billing_city"]').val($('input[name="city"]').val());
     $('input[name="billing_state"]').val($('input[name="state"]').val());
     $('input[name="billing_zip"]').val($('input[name="zip"]').val());
     $('select[name="billing_country"]').selectpicker('val', $('select[name="country"]').selectpicker('val'));
   });
    $('.customer-copy-billing-address').on('click', function(e) {
     e.preventDefault();
     $('input[name="shipping_street"]').val($('input[name="billing_street"]').val());
     $('input[name="shipping_city"]').val($('input[name="billing_city"]').val());
     $('input[name="shipping_state"]').val($('input[name="billing_state"]').val());
     $('input[name="shipping_zip"]').val($('input[name="billing_zip"]').val());
     $('select[name="shipping_country"]').selectpicker('val', $('select[name="billing_country"]').selectpicker('val'));
   });

    $('body').on('hidden.bs.modal','#contact', function() {
     $('#contact_data').empty();
   });

    $('.client-form').on('submit',function(){
      $('select[name="default_currency"]').removeAttr('disabled');
    });

  });

function validate_contact_form(){
 _validate_form('#contact-form',{
   firstname:'required',
   lastname:'required',
   password: {
     required: {
       depends: function(element) {
         var sent_set_password = $('input[name="send_set_password_email"]');
         if ($('#contact input[name="contactid"]').val() == '' && sent_set_password.prop('checked') == false) {
           return true;
         }
       }
     }
   },
   email: {
     required: true,
     email: true,
     remote: {
       url: admin_url + "misc/contact_email_exists",
       type: 'post',
       data: {
         email: function() {
           return $('#contact input[name="email"]').val();
         },
         userid: function() {
           return $('body').find('input[name="contactid"]').val();
         }
       }
     }
   }
 },contactFormHandler);
}

function contactFormHandler(form) {
 $('#contact input[name="is_primary"]').prop('disabled',false);
 form = $(form);
 var data = form.serialize();
 var serializeArray = $(form).serializeArray();

 $.post(form.attr('action'), data).success(function(response) {
   response = $.parseJSON(response);
   if(response.success){
     alert_float('success', response.message);
   }
   if ($.fn.DataTable.isDataTable('.table-contacts')) {
     $('.table-contacts').DataTable().ajax.reload();
   }
   $('#contact').modal('hide');
 }).fail(function(error){
   response = $.parseJSON(error.responseText);
   alert_float('danger', response.message);
 });
 return false;
}

function contact(client_id,contact_id){
 if(typeof(contact_id) == 'undefined'){
   contact_id = '';
 }
 $.post(admin_url+'clients/contact/'+client_id+'/'+contact_id).success(function(response){
   $('#contact_data').html(response);
   $('#contact').modal('show');
   $('body').on('shown.bs.modal', '#contact', function() {
    var contactid = $(this).find('input[name="contactid"]').val();
    if(contact_id == ''){
              // Is new contact focus the field
              $('#contact').find('input[name="firstname"]').focus();
            }
          });
   bs_switch();
   init_selectpicker();
   init_datepicker();
   validate_contact_form();
 });
}

</script>
</body>
</html>
