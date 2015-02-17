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
        <input type="text" placeholder="Email" name="email">
    </label>
    <label>
        <input type="text" name="password" placeholder="Password">
    </label>
    <label>
        <input type="submit" name="submit" value="Login">
    </label>
    <div>
        <a href="/register">Register</a>
    </div>
</form>