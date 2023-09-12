<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-shipping" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach($breadcrumbs as $breadcrumb){?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php }?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if($error_user_id){?>
    <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> <?php echo $error_user_id; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php }?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-shipping" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-hinnasto" data-toggle="tab"><?php echo $tab_hinnasto; ?></a></li>
            <li><a href="#tab-hinnasto-2" data-toggle="tab"><?php echo $tab_hinnasto_2; ?></a></li>
            <li><a href="#tab-hinnasto-3" data-toggle="tab"><?php echo $tab_hinnasto_3; ?></a></li>
            <li><a href="#tab-hinnasto-4" data-toggle="tab"><?php echo $tab_hinnasto_4; ?></a></li>
          </ul>
        <div class="tab-content">
        <div class="tab-pane active" id="tab-general">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-cost"><?php echo $entry_user_id; ?></label>
            <div class="col-sm-10">
              <input type="text" name="matkahuolto_user_id" value="<?php echo $matkahuolto_user_id; ?>" placeholder="<?php echo $entry_user_id; ?>" id="input-cost" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-tax-class"><?php echo $entry_tax_class; ?></label>
            <div class="col-sm-10">
              <select name="matkahuolto_tax_class_id" id="input-tax-class" class="form-control">
                <option value="0"><?php echo $text_none; ?></option>
                <?php foreach($tax_classes as $tax_class){?>
                <?php if($tax_class['tax_class_id'] == $matkahuolto_tax_class_id){?>
                <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                <?php } else {?>
                <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                <?php }?>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-weight-class"><?php echo $entry_weight_class; ?></label>
            <div class="col-sm-10">
              <select name="matkahuolto_weight_class_id" id="input-weight-class" class="form-control">
                <option value="0"><?php echo $text_none; ?></option>
                <?php foreach($weight_classes as $weight_class){ ?>
                <?php if($weight_class['weight_class_id'] == $matkahuolto_weight_class_id){?>
                <option value="<?php echo $weight_class['weight_class_id']; ?>" selected="selected"><?php echo $weight_class['title']; ?></option>
                <?php } else {?>
                <option value="<?php echo $weight_class['weight_class_id']; ?>"><?php echo $weight_class['title']; ?></option>
                <?php }?>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-weight-class"><?php echo $entry_length_class; ?></label>
            <div class="col-sm-10">
              <select name="matkahuolto_length_class_id" id="input-weight-class" class="form-control">
                <option value="0"><?php echo $text_none; ?></option>
                <?php foreach($length_classes as $length_class){?>
                <?php if($length_class['length_class_id'] == $matkahuolto_length_class_id){?>
                <option value="<?php echo $length_class['length_class_id']; ?>" selected="selected"><?php echo $length_class['title']; ?></option>
                <?php } else {?>
                <option value="<?php echo $length_class['length_class_id']; ?>"><?php echo $length_class['title']; ?></option>
                <?php }?>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
            <div class="col-sm-10">
              <select name="matkahuolto_geo_zone_id" id="input-geo-zone" class="form-control">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach($geo_zones as $geo_zone){?>
                <?php if($geo_zone['geo_zone_id'] == $matkahuolto_geo_zone_id){?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else {?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php }?>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="matkahuolto_status" id="input-status" class="form-control">
                <?php if($matkahuolto_status){?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else {?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_test_mode; ?></label>
            <div class="col-sm-10">
              <select name="matkahuolto_test_mode" id="input-status" class="form-control">
                <?php if($matkahuolto_test_mode){?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else {?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-free-cargo"><?php echo $entry_free_cargo; ?></label>
            <div class="col-sm-10">
              <select name="matkahuolto_free_cargo" id="input-free-cargo" class="form-control">
                <?php if($matkahuolto_free_cargo){?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else {?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-discount-cargo"><?php echo $entry_discount_cargo; ?></label>
            <div class="col-sm-10">
              <select name="matkahuolto_discount_cargo" id="input-discount-cargo" class="form-control">
                <?php if($matkahuolto_discount_cargo){?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else {?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-cargo-sum"><?php echo $entry_cargo_sum; ?></label>
            <div class="col-sm-10">
              <input type="text" name="matkahuolto_cargo_sum" value="<?php echo $matkahuolto_cargo_sum; ?>" placeholder="<?php echo $entry_cargo_sum; ?>" id="input-cargo-sum" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-discount-cargo-percent"><?php echo $entry_discount_cargo_percent; ?></label>
            <div class="col-sm-10">
              <input type="text" name="matkahuolto_discount_cargo_percent" value="<?php echo $matkahuolto_discount_cargo_percent; ?>" placeholder="<?php echo $entry_discount_cargo_percent; ?>" id="input-discount-cargo-percent" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-search"><?php echo $entry_search; ?></label>
            <div class="col-sm-10">
              <input type="text" name="matkahuolto_search_result" value="<?php echo $matkahuolto_search_result; ?>" placeholder="<?php echo $entry_search; ?>" id="input-search" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-kotijakelu"><?php echo $entry_kotijakelu; ?></label>
            <div class="col-sm-10">
              <select name="matkahuolto_kotijakelu" id="input-kotijakelu" class="form-control">
                <?php if($matkahuolto_kotijakelu){?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else {?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-koti-price"><span data-toggle="tooltip" title="<?php echo $help_kotijakelu_price;?>"><?php echo $entry_kotijakelu_price;?></span></label>
            <div class="col-sm-10">
              <input type="text" name="matkahuolto_kotijakelu_price" value="<?php echo $matkahuolto_kotijakelu_price;?>" placeholder="<?php echo $entry_kotijakelu_price;?>" id="input-koti-price" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-iso-palvelu"><span data-toggle="tooltip" title="<?php echo $help_iso_palvelu;?>"><?php echo $entry_iso_palvelu;?></span></label>
            <div class="col-sm-10">
              <select name="matkahuolto_iso_palvelu" id="input-iso-palvelu" class="form-control">
                <?php if ($matkahuolto_iso_palvelu){?>
                <option value="1" selected="selected"><?php echo $text_enabled;?></option>
                <option value="0">><?php echo $text_disabled;?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled;?></option>
                <option value="0" selected="selected"><?php echo $text_disabled;?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-iso-price"><span data-toggle="tooltip" title="<?php echo $help_iso_price;?>"><?php echo $entry_iso_add_price;?></span></label>
            <div class="col-sm-10">
              <input type="text" name="matkahuolto_iso_price" value="<?php echo $matkahuolto_iso_price;?>" placeholder="<?php echo $entry_iso_add_price;?>" id="input-iso-price" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
            <div class="col-sm-10">
              <input type="text" name="matkahuolto_sort_order" value="<?php echo $matkahuolto_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
            </div>
          </div>
        </div>

        <div class="tab-pane" id="tab-hinnasto">
           <b><?php echo $text_hinnasto_description; ?></b>
              <div class="table-responsive">
                <table id="ihinnasto" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left col-sm-2"><?php echo $column_kg; ?></td>
                      <td class="text-left col-sm-8"><?php echo $column_price; ?></td>
                      <td class="text-left col-sm-2"></td>
                    </tr>
                  </thead>
                  <tbody>
          <?php $row = 0;?>
          <?php if($matkahuolto_hinnasto){?>
            <?php foreach($matkahuolto_hinnasto as $hinta){?>
             <tr id="row<?php echo $row; ?>">
                    <td class="text-left"> <input type="text" name="matkahuolto_hinnasto[<?php echo $row; ?>][kg]" value="<?php echo $hinta['kg']; ?>" class="form-control" /></td>
                    <td><input type="text" name="matkahuolto_hinnasto[<?php echo $row; ?>][price]" value="<?php echo $hinta['price']; ?>" class="form-control" /></td>
                    <td class="text-left"><button type="button" onclick="$('#row<?php echo $row; ?>').remove()" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td></tr>      
            <?php $row++;?>
            <?php }?>
          <?php }?>
            </tbody>
                  <tfoot>
                    <tr>
                      <td></td>
                      <td></td>
                      <td class="text-left"><button type="button" id="button-add" data-toggle="tooltip" title="<?php echo $button_weight_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                    </tfoot>
                  </table>
            </div>

  <script type="text/javascript"><!--
   var row = <?php echo $row; ?>;
  $('#button-add').click(function(){
  html  = '<tr id="row' + row + '">';
  html += '  <td class="text-right"><input type="text" name="matkahuolto_hinnasto[' + row + '][kg]" value="" placeholder="<?php echo $column_kg; ?>" class="form-control" /></td>';
  html += '  <td class="text-right"><input type="text" name="matkahuolto_hinnasto[' + row + '][price]" value="" placeholder="<?php echo $column_price; ?>" class="form-control" /></td>';
  html += '  <td class="text-left"><button type="button" onclick="$(\'#row' + row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';

  $('#tab-hinnasto tbody').append(html);

  row++;
  });
//--></script>
        </div>

        <div class="tab-pane" id="tab-hinnasto-2">
          <b><?php echo $text_hinnasto_2_description; ?></b>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-hinnasto"><?php echo $entry_hinnasto_2; ?></label>
            <div class="col-sm-10">
              <select name="matkahuolto_hinnasto_2_status" id="input-hinnasto" class="form-control">
                <?php if($matkahuolto_hinnasto_2_status){?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else {?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php }?>
              </select>
            </div>
          </div>
              <div class="table-responsive">
                <table id="ihinnasto" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left col-sm-2"><?php echo $column_kg; ?></td>
                      <td class="text-left col-sm-8"><?php echo $column_price; ?></td>
                      <td class="text-left col-sm-2"></td>
                    </tr>
                  </thead>
                  <tbody>
          <?php $row2 = 0;?>
          <?php if($matkahuolto_hinnasto_2){?>
            <?php foreach($matkahuolto_hinnasto_2 as $hinta2){?>
             <tr id="row2-<?php echo $row2; ?>">
                    <td class="text-left"> <input type="text" name="matkahuolto_hinnasto_2[<?php echo $row2; ?>][kg]" value="<?php echo $hinta2['kg']; ?>" class="form-control" /></td>
                    <td><input type="text" name="matkahuolto_hinnasto_2[<?php echo $row2; ?>][price]" value="<?php echo $hinta2['price']; ?>" class="form-control" /></td>
                    <td class="text-left"><button type="button" onclick="$('#row2-<?php echo $row2; ?>').remove()" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td></tr>      
            <?php $row2++; ?>
            <?php }?>
          <?php }?>
            </tbody>
                  <tfoot>
                    <tr>
                      <td></td>
                      <td></td>
                      <td class="text-left"><button type="button" id="button-add-2" data-toggle="tooltip" title="<?php echo $button_weight_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                    </tfoot>
                  </table>
            </div>

  <script type="text/javascript"><!--
   var row2 = <?php echo $row2; ?>;
  $('#button-add-2').click(function(){
  html2  = '<tr id="row2-' + row2 + '">';
  html2 += '  <td class="text-right"><input type="text" name="matkahuolto_hinnasto_2[' + row2 + '][kg]" value="" placeholder="<?php echo $column_kg; ?>" class="form-control" /></td>';
  html2 += '  <td class="text-right"><input type="text" name="matkahuolto_hinnasto_2[' + row2 + '][price]" value="" placeholder="<?php echo $column_price; ?>" class="form-control" /></td>';
  html2 += '  <td class="text-left"><button type="button" onclick="$(\'#row2-' + row2 + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html2 += '</tr>';

  $('#tab-hinnasto-2 tbody').append(html2);

  row2++;
  });
//--></script>
        </div>

        <div class="tab-pane" id="tab-hinnasto-3">
        <b><?php echo $text_hinnasto_3_description; ?></b>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-hinnasto-3"><?php echo $entry_hinnasto_3; ?></label>
            <div class="col-sm-10">
              <select name="matkahuolto_hinnasto_3_status" id="input-hinnasto-3" class="form-control">
                <?php if($matkahuolto_hinnasto_3_status){?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else {?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php }?>
              </select>
            </div>
          </div>
              <div class="table-responsive">
                <table id="ihinnasto" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left col-sm-2"><?php echo $column_kg; ?></td>
                      <td class="text-left col-sm-8"><?php echo $column_price; ?></td>
                      <td class="text-left col-sm-2"></td>
                    </tr>
                  </thead>
                  <tbody>
          <?php $row3 = 0;?>
          <?php if($matkahuolto_hinnasto_3){?>
            <?php foreach($matkahuolto_hinnasto_3 as $hinta3){?>
             <tr id="row3-<?php echo $row3; ?>">
                    <td class="text-left"> <input type="text" name="matkahuolto_hinnasto_3[<?php echo $row3;?>][kg]" value="<?php echo $hinta3['kg']; ?>" class="form-control" /></td>
                    <td><input type="text" name="matkahuolto_hinnasto_3[<?php echo $row3; ?>][price]" value="<?php echo $hinta3['price']; ?>" class="form-control" /></td>
                    <td class="text-left"><button type="button" onclick="$('#row3-<?php echo $row3; ?>').remove()" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td></tr>      
            <?php $row3++;?>
            <?php }?>
          <?php }?>
            </tbody>
                  <tfoot>
                    <tr>
                      <td></td>
                      <td></td>
                      <td class="text-left"><button type="button" id="button-add-3" data-toggle="tooltip" title="<?php echo $button_weight_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                    </tfoot>
                  </table>
            </div>

  <script type="text/javascript"><!--
   var row3 = <?php echo $row3; ?>;
  $('#button-add-3').click(function(){
  html3  = '<tr id="row3-' + row3 + '">';
  html3 += '  <td class="text-right"><input type="text" name="matkahuolto_hinnasto_3[' + row3 + '][kg]" value="" placeholder="<?php echo $column_kg; ?>" class="form-control" /></td>';
  html3 += '  <td class="text-right"><input type="text" name="matkahuolto_hinnasto_3[' + row3 + '][price]" value="" placeholder="<?php echo $column_price; ?>" class="form-control" /></td>';
  html3 += '  <td class="text-left"><button type="button" onclick="$(\'#row3-' + row3 + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html3 += '</tr>';

  $('#tab-hinnasto-3 tbody').append(html3);

  row3++;
  });
//--></script>
        </div>

        <div class="tab-pane" id="tab-hinnasto-4">
        <b><?php echo $text_hinnasto_4_description; ?></b>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-hinnasto-4"><?php echo $entry_hinnasto_4; ?></label>
            <div class="col-sm-10">
              <select name="matkahuolto_hinnasto_4_status" id="input-hinnasto-4" class="form-control">
                <?php if($matkahuolto_hinnasto_4_status){?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else {?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php }?>
              </select>
            </div>
          </div>
              <div class="table-responsive">
                <table id="hinnasto" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left col-sm-2"><?php echo $column_kg; ?></td>
                      <td class="text-left col-sm-8"><?php echo $column_price; ?></td>
                      <td class="text-left col-sm-2"></td>
                    </tr>
                  </thead>
                  <tbody>
          <?php $row4 = 0;?>
          <?php if($matkahuolto_hinnasto_4){?>
            <?php foreach($matkahuolto_hinnasto_4 as $hinta4){?>
             <tr id="row4-<?php echo $row4; ?>">
                    <td class="text-left"><input type="text" name="matkahuolto_hinnasto_4[<?php echo $row4;?>][kg]" value="<?php echo $hinta4['kg']; ?>" class="form-control" /></td>
                    <td><input type="text" name="matkahuolto_hinnasto_4[<?php echo $row4; ?>][price]" value="<?php echo $hinta4['price']; ?>" class="form-control" /></td>
                    <td class="text-left"><button type="button" onclick="$('#row4-<?php echo $row4; ?>').remove()" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td></tr>      
            <?php $row4++;?>
            <?php }?>
          <?php }?>
            </tbody>
                  <tfoot>
                    <tr>
                      <td></td>
                      <td></td>
                      <td class="text-left"><button type="button" id="button-add-4" data-toggle="tooltip" title="<?php echo $button_weight_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                    </tfoot>
                  </table>
            </div>

  <script type="text/javascript"><!--
   var row4 = <?php echo $row4; ?>;
  $('#button-add-4').click(function(){
  html4  = '<tr id="row4-' + row4 + '">';
  html4 += '  <td class="text-right"><input type="text" name="matkahuolto_hinnasto_4[' + row4 + '][kg]" value="" placeholder="<?php echo $column_kg; ?>" class="form-control" /></td>';
  html4 += '  <td class="text-right"><input type="text" name="matkahuolto_hinnasto_4[' + row4 + '][price]" value="" placeholder="<?php echo $column_price; ?>" class="form-control" /></td>';
  html4 += '  <td class="text-left"><button type="button" onclick="$(\'#row4-' + row4 + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html4 += '</tr>';

  $('#tab-hinnasto-4 tbody').append(html4);

  row4++;
  });
//--></script>
        </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?> 
