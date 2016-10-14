<?php init_head(); ?>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
      <div class="col-md-12">
        <div class="panel_s">
          <div class="panel-body">
            <div id="elfinder"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<?php init_tail(); ?>
<script type="text/javascript" charset="utf-8">
  $().ready(function() {
    // Temporary while locales select are added
    var _locale = locale;
    if(_locale == 'pt'){
      _locale = 'pt_BR';
    }
    var elf = $('#elfinder').elfinder({
      url : admin_url+'utilities/elfinder_init',
      lang: _locale,
      height:700,
      uiOptions : {
    // toolbar configuration
    toolbar : [
    ['back', 'forward'],
        ['mkdir', 'mkfile', 'upload'],
        ['open', 'download', 'getfile'],
        ['info'],
        ['quicklook'],
        ['copy', 'cut', 'paste'],
        ['rm'],
        ['duplicate', 'rename', 'edit', 'resize'],
        ['extract', 'archive'],
        ['search'],
        ['view'],
        ]
      }
    }).elfinder('instance');
  });
</script>
</body>
</html>
