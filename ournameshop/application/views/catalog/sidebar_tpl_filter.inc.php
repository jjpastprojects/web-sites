<div class="side-bar-filter">
  <?php
    $parent_id = $this->categories->get($category->id)->parent_id;
    if($parent_id){
      $parent = $this->categories->get($parent_id);
      $sub_cats = $this->categories->order_by('name','asc')->get_many_by(array('parent_id' => $parent_id));
    }
    else{
      $parent = $category;
      $sub_cats = $this->categories->order_by('name','asc')->get_many_by(array('parent_id' => $category->id));
    }

    if($this->input->get('surface')){
      if($parent_id)
        $all_url = sprintf('/%s/category/%s?surface=%s', $lastname, $parent->slug,$this->input->get('surface'));
      else
        $all_url = sprintf('/%s/category/%s?surface=%s', $lastname, $category->slug,$this->input->get('surface'));
    }
    else{
      if($parent_id)
        $all_url = sprintf('/%s/category/%s', $lastname, $parent->slug);
      else
        $all_url = sprintf('/%s/category/%s', $lastname, $category->slug);
    }
  ?>
  <form action="" method="get" class="filter-family">
    <div class="form-group">
      <label>Category:</label>
      <select class="form-control input-lg" onchange="location = this.value;">
        <option value="/<?php echo $lname->lastname.($this->input->get('surface')?'?surface='.$this->input->get('surface'):'');?>">
          All
        </option>
        <?php 
          $cats=$this->categories->root()->order_by('name', 'asc')->get_all();
          foreach($cats as &$v):
            if($this->input->get('surface'))
              $v->url = sprintf('/%s/category/%s?surface=%s', $lastname, $v->slug,$this->input->get('surface'));
            else
              $v->url = sprintf('/%s/category/%s', $lastname, $v->slug);
          if(!$v->parent_id):?>
          <option <?php if(($category && $v->id == $category->id) || ($parent && $parent->id == $v->id)) echo 'selected';?> value="<?php echo $v->url;?>">
            <?php echo $v->name;?>
          </option>
          <?php endif;?>
        <?php endforeach;?>
      </select>
    </div>
    <div class="form-group">
      <label>Sub Category:</label>
      <select class="form-control input-lg" onchange="location = this.value;">
        <option value="<?php echo $all_url;?>">
          All
        </option>
        <?php foreach($sub_cats as $sub_cat):
          if($this->input->get('surface'))
              $sub_cat->url = sprintf('/%s/category/%s?surface=%s', $lastname, $sub_cat->slug,$this->input->get('surface'));
            else
              $sub_cat->url = sprintf('/%s/category/%s', $lastname, $sub_cat->slug);
        ?>
        <option <?php if($category && $sub_cat->id == $category->id) echo 'selected';?> value="<?php echo $sub_cat->url;?>">
          <?php echo $sub_cat->name;?>
        </option>
        <?php endforeach;?>
      </select>
    </div>
  </form>
</div>