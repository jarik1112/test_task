<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date 2/17/15
 * @time 7:29 PM
 */
?>

<form class="login" action="/login" method="post">
    <label>Login Form</label>
    <label>
        <input type="text" placeholder="Email" name="user[email]">
    </label>
    <label>
        <input type="password" name="user[password]" placeholder="Password">
    </label>
    <label>
        <input type="submit" name="submit" value="Login">
    </label>
    <div>
        <a href="/register">Register</a>
    </div>
</form>