
    function repostVk(id){
        VK.init({
            apiId: 5237078
        });
        //var data = );
        VK.Auth.getLoginStatus(function(response){
            if(response){
                VK.Auth.login(function(){
                    generateData(id);
                });

                //VK.Api.call('wall.post', {message: "123",attachments:'posted_photo'}, function(r) {
                //
                //    if(r.response) {
                //        alert(r.response);
                //    }
                //});
            }
            else{
                authInfo(response);
            }
        });
       // VK.Auth.login(authInfo)
    }
    function authInfo(response) {


        if (response.session) {
            console.log(response.session);
            VK.Api.call('wall.post', {message: 6492}, function(r) {
                if(r.response) {
                    alert(r.response);
                }
            });
        } else {
            alert('not auth');
        }
    }
 function generateData(id){
     console.log(111);
  //var elem = document.getElementById(id);
  //   if(elem){
  //       var img = elem.getElementsByTagName('img');
  //       var article = elem.getElementsByTagName('article');
  //   }
   //var data = {
   //    message: 'Record',
   //    attachments: {}
   //
   //};



     VK.Api.call('photos.getWallUploadServer', {group_id: 87650458}, function(r) {
         console.log(r);
         if (r.response) {
             console.log(r.response);
             $.post('uploadvk', {
                 url: r.response.upload_url
             }, function (data) {
                console.log(data);
                 //var p = JSON.parse(data);
                // console.log(p);
                 //VK.Api.call('photos.saveWallPhoto', {
                 //    user_id: userId,
                 //    group_id: userId,
                 //    photo: p.photo,
                 //    server: p.server,
                 //    hash: p.hash
                 //}, function (s) {
                 //    VK.Api.call('wall.post', {message: content, attachments: s.response[0].id}, function(r) { });
                 //}); // / photos.saveWallPhoto()

             });

         }

     });



 }