<?php
echo '<br><br>';
echo '<div id="login-content2">';
echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">';
echo '<fieldset id="inputs2">';
echo '<label for="username2">' . lang("UE") . '</label><br>';
echo '<input id="username2" type="email" name="Email" placeholder=' . lang("UEIn") . ' required><br><br>';  
echo '<label for="password2">' . lang("Par") . '</label><br>';
echo '<input id="password2" type="password" name="Password" placeholder=' . lang("ParIn") . ' required>';
echo '</fieldset>';
echo '<fieldset id="actions2">';
echo '<input type="submit" id="submit2" value="Log in">';
echo '</fieldset>';
echo '</form>';
echo '</div>';                     
echo '<br><br>';
echo '<a href="'. base_url() . 'index.php/welcome/signUp">'. lang("SignUpNow") . '</a>';

?>