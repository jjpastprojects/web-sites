
<?php 
  $headlines = array(
    "Family's that Pray Together\nStay Together",
    "Family is the wind\nbeneath my wings",
    "Blood makes you related,\nLove makes you family",
    "Home is where the heart is",
    "Family is where life begins\nand love never ends"
  );
?>


<?php foreach($this->config->item('print_fonts') as $k => $font): if(!$font['web_font']) continue; ?>
  <span style="font-family: '<?php echo $font['family'];?>'; opacity: 0;"></span>
<?php endforeach;?>

<div class="print-designer-panel left-sliding-panel">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Panel title</h3>
      <span class="glyphicon glyphicon-remove close-panel" aria-hidden="true"></span>
    </div>

    <div class="panel-body">
      <div class="joystick">
        <div class="up text-center">
          <a href="#">
            <span class="glyphicon glyphicon-arrow-up" data-move="up" aria-hidden="true"></span>
          </a>
        </div>

        <div class="row center-controls">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
            <div class="left">
              <a href="#">
                <span class="glyphicon glyphicon-arrow-left" data-move="left" aria-hidden="true"></span>
              </a>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
            <div class="slider">
              <input type="range" min="-8" max="8" step="1" class="obj-scale" />
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div class="right">
              <a href="#">
                <span class="glyphicon glyphicon-arrow-right" data-move="right" aria-hidden="true"></span>
              </a>
            </div>
          </div>
        </div>

        <div class="down text-center">
          <a href="#">
            <span class="glyphicon glyphicon-arrow-down" data-move="down" aria-hidden="true"></span>
          </a>
        </div>
      </div>
      <div class="image-params hidden">
        
      </div>

      <div class="text-params hidden">
        <div class="form-group">
          <label>
            Text
          </label>
          
          <select class="form-control family-slogan">
            <?php foreach($headlines as $h):?>
              <option><?php echo $h;?></option>
            <?php endforeach;?>

            <option value="custom">custom text</option>
          </select>
          
          <textarea class="form-control family-slogan hidden"></textarea>


          <span class="help-block">
            Double click the text box for custom text
          </span>
        </div>

        <div class="form-group">
          <label>
            Font
          </label>

          <select class="form-control font-family" name="font_family">
            <?php foreach($this->config->item('print_fonts') as $k => $font):?>
              <option value="<?php echo $k;?>" data-font-family="<?php echo $font['family'];?>">
                <?php echo $font['name'];?>
              </option>
            <?php endforeach;?>
          </select>
        </div>          
      </div>

      <div class="form-group">
        <label>
          Color
        </label>

        <?php if($product->type == 'EMBROIDERY'):?>
          <div class="embroidery-obj-color-holder">
            <?php $k = 0; foreach($product->options['thread_colors']->values as $color => $v):?>
              <div data-color-code="<?php echo $color;?>" class="color<?php if($color == '#000000') echo ' active';?>" style="background: <?php echo $color;?>"></div>
            <?php $k++; endforeach;?>
          </div>
        <?php else:?>
          <div class="image-params">
            <?php $this->load->view('print_designer/hue_holder.inc.php');?>
          </div>

          <div class="text-params">
            <input type='text' class="spectrum-color" />
          </div>
        <?php endif;?>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-lg-12 text-params">
            <label>
              Text Align
            </label>

            <div>
              <a href="#" class="btn btn-lg btn-primary">
                <span class="glyphicon glyphicon-align-left" data-align="left" aria-hidden="true"></span>
              </a>
              <a href="#" class="btn btn-lg btn-primary">
                <span class="glyphicon glyphicon-align-center" data-align="center" aria-hidden="true"></span>
              </a>
              <a href="#" class="btn btn-lg btn-primary">
                <span class="glyphicon glyphicon-align-right" data-align="right" aria-hidden="true"></span>
              </a>
            </div>
          </div>
          <div class="col-lg-12">
            <label>
              Align
            </label>
            <div class="align-icons">
              <a href="#" class="btn btn-lg btn-primary" data-align="hcenter" >
                <span title="Align Horizontal Center" class="glyphicon glyphicon-object-align-vertical" aria-hidden="true"></span>
              </a>
              <a href="#" class="btn btn-lg btn-primary" data-align="vcenter">
                <span title="Align Vertical Center" class="glyphicon glyphicon-object-align-horizontal" aria-hidden="true"></span>
              </a>
            </div>
          </div>
          <div class="col-lg-12">
            <label>
              Flip
            </label>
            <div>
              <a href="#" class="btn btn-lg btn-primary" data-flip="x">X</a>
              <a href="#" class="btn btn-lg btn-primary" data-flip="y">Y</a>
            </div>
          </div>
        </div>
      </div>
      
      <div class="text-params hidden">
        <button type="button" class="btn btn-danger btn-sm">Delete</button>
      </div>
    </div>
  </div>
</div>