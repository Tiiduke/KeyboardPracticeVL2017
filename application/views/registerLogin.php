<?php
echo '<br><br>';
echo '<div id="login-content">';
echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">';
echo '<fieldset id="inputs">';
echo '<label for="username">' . lang("UE") . '</label><br>';
echo '<input id="username" type="email" name="Email" placeholder=' . lang("UEIn") . ' required><br><br>';  
echo '<label for="password">' . lang("Par") . '</label><br>';
echo '<input id="password" type="password" name="Password" placeholder=' . lang("ParIn") . ' required>';
echo '</fieldset>';
echo '<fieldset id="actions">';
echo '<input type="submit" id="submit" value="Log in">';
echo '</fieldset>';
echo '</form>';
echo '</div>';                     
echo '<br><br>';
echo '<a href="'. base_url() . 'index.php/welcome/signUp">'. lang("SignUpNow") . '</a>';

?>