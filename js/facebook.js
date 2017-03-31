
FB.getLoginStatus(function(response) { //näha, et kas on sisse loginud juba
    statusChangeCallback(response);
});

{
    status: 'connected',
    authResponse: {
        accessToken: '...',
        expiresIn:'...',
        signedRequest:'...',
        userID:'...'
    }
}

/*
Step 2: Include the JavaScript SDK on your page once, 
ideally right after the opening <body> tag. 

Built in code to get a simple icon for facebook login,
seda saab sisestada login nupu sisse mugavalt kuhugi
*/

/*
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>*/
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}
(document, 'script', 'facebook-jssdk')); //ilmselt see läheb html sisse

/*
Step 3: Place this code wherever you want the plugin to appear on your page.
*/
//<div class="fb-login-button" data-size="icon" data-show-faces="false" data-auto-logout-link="true"></div>



