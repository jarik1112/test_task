<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date   2/17/15
 * @time   7:57 PM
 */
?>
<form class="login" action="/register" method="post">
    <label>User data</label>
    <?php
    if(!empty($errors)){
        foreach ($errors as $error) {
            echo '<div class="error">'.$error.'</div>';
        }
    }
    ?>
    <label>
        <input type="text" placeholder="Email" name="user[email]">
    </label>
    <label>
        <input type="text" placeholder="First Name" name="user[first_name]">
    </label>
    <label>
        <input type="text" placeholder="Last Name" name="user[last_name]">
    </label>
    <label>
        <input type="password" placeholder="Password" name="user[password]">
    </label>
    <label>
        <input type="submit" name="submit" value="Save">
    </label>
</form>