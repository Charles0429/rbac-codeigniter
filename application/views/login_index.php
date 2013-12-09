<div style="width: 320px; margin: 0 auto;">
   <h3>Login</h3>
   
   <form class="well" method="POST" action="<?php echo base_url('account/validate')?>">
      <label>Username</label>
      <input type="text" name="username" style="width: 260px;">
      <label>Password</label>
      <input type="password" name="password" style="width: 260px;">
      <button type="submit" class="btn btn-primary">Login</button>
   </form>
</div>
