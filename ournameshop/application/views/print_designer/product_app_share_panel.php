<div class="left-sliding-panel share" data-panel="share">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Share It!</h3>
      <span class="glyphicon glyphicon-remove close-product-panel" aria-hidden="true"></span>
    </div>

    <div class="panel-body">
      <div class="listSoc1 margin-top">
        <h5 class="text-uppercase">Share this design:</h5>
        <ul>
          <li>
            <a class="s1" href="#" data-sharer-network="facebook"> </a>
          </li>
          <li>
            <a class="s2" href="#" data-sharer-network="twitter"> </a>
          </li>
          <li>
            <a class="s3" href="#" data-sharer-network="pinterest"> </a>
          </li>
          <li>
            <a class="s4" href="#" data-sharer-network="google"> </a>
          </li>
          <li>
            <a class="s5" href="#" data-sharer-network="linkedin"> </a>
          </li>
          <?php if($this->user_id):?>
            <li>
              <a title="add to collection" class="f7 add-to-col" href="#"></a>
            </li>
          <?php endif;?>
        </ul>
      </div>
    </div>
  </div>
</div>