<p>
  <strong>Surface Type</strong>
</p>

<form action="" method="get" class="filter-surfaces hidden">
  <div class="radio">
    <label>
      <input type="radio" name="surface_id" value="0" checked />
      All Surfaces
    </label>
  </div>
  <?php foreach($this->surfaces->get_all() as $v):?>
    <div class="radio">
      <label>
        <input type="radio" name="surface_id" value="<?php echo $v->id;?>" />
        <?php echo $v->name;?>
      </label>
    </div>
  <?php endforeach;?>
</form>