
window.fbAsyncInit = function() {
    FB.init({
        appId      : '964001690382555',
        xfbml      : true,
        version    : 'v2.5'
    });
    //FB.ui({
    //    method: 'feed',
    //    link: 'https://developers.facebook.com/docs/',
    //    caption: 'An example caption',
    //}, function(response){});

    FB.login(function(response){
        FB.api('/me', function(response) {
            console.log(JSON.stringify(response));
        });
    })
    FB.getLoginStatus(function(response) {

        console.log(response);
        //statusChangeCallback(response);
    });
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


//window.onload = function(){
//
//
//};
