<div class="user-panel-tab">
  <hr>
  <?php $link = $this->uri->segment(2);?>
  <ul class="list-unstyled">
    <li><a <?php echo ($link == 'dashboard')?'class="user-active"':''?> href="<?php echo base_url('user/dashboard')?>">Account Settings Panel</a></li>
    <li><a <?php echo ($link == 'edit-profile')?'class="user-active"':''?> class="" href="<?php echo base_url('user/edit-profile');?>">Personal information</a></li>
    <li><a <?php echo ($link == 'address-book')?'class="user-active"':''?> href="<?php echo base_url('user/address-book')?>">Address book</a></li>
    <li><a <?php echo ($link == 'my-orders')?'class="user-active"':''?> href="<?php echo base_url('user/my-orders');?>">My orders</a></li>
    <!-- <li><a class="" href="user-reviews.php">My Reviews &amp; Ratings</a></li> -->
    <li><a <?php echo ($link == 'my-wishlist')?'class="user-active"':''?> href="<?php echo base_url('admin/my-wishlist');?>">Wishlist</a></li>
    <li><a <?php echo ($link == 'my-quotation')?'class="user-active"':''?> href="<?php echo base_url('user/my-quotation');?>">My Quotations</a></li>
    <li><a class="" href="<?php  echo base_url();?>user/log-out">Logout</a></li>
  </ul>
</div>