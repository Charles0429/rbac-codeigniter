<?php $menus = ($this->user->getUserMenus());?>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <?php echo anchor('',"Rbac", array('class'=>'brand'));?>
          <div class="nav-collapse collapse"> 
          	<ul class="nav">
          	<?php if (isset($menus)):?>
          	<?php foreach($menus as $menu):?>
          		<li class="dropdown">
              	<a class="dropdown-toggle" data-toggle="dropdown" href="#">
              	  <?php echo $menu['parent_title'];?>
              	  <span class="caret"></span>
             	</a>
              	<ul class="dropdown-menu">
              	  <?php foreach($menu as $sub_menu):?>
              	  <?php if(is_array($sub_menu)):?>
              	  <li><?php echo anchor($sub_menu['url'], $sub_menu['title']);?>
              	  <?php endif;?>
              	  <?php endforeach;?>
              	</ul>
          	</li>
          	<?php endforeach;?>
          	<?php endif;?>
          </ul>
        </div>
        <div class="pull-right">
          <ul class="nav">
          	<li><?php echo anchor('manage/index', $this->user->getUsername());?></li>
          	<li><?php echo anchor('account/logout', "注销")?></li>         
          </ul>
      	</div>
    </div>
   </div>
  </div>