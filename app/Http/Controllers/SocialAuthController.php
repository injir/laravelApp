<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class SocialAuthController extends Controller
{
    private static $CLIENT_ID = '5237078'; // ID приложения
    private static $CLIENT_SECRET = 'F1zLbnzqCAx5zsDgs23I'; // Защищённый ключ
    private static $REDIRECT_URI = 'http://ct24188.tmweb.ru/public/vk'; // Адрес сайта
    private static $VK_AUTHORIZE = 'https://oauth.vk.com/authorize'; // Авторизация
    private static $VK_TOKEN_URL =  'https://oauth.vk.com/access_token';
    const VK_DISPLAY_METHOD = 'popup';
    const VK_FIELDS = 'uid,first_name,last_name,screen_name,sex,bdate,photo_big';
    public static $USER_INFO = null;
    //Метод осуществляет редирект на страницу self::$REDIRECT_URI с GET['code'], при успешной авторизации через вконтакте
    private function getVkCode(){
        $params = array(
            'client_id'     => self::$CLIENT_ID,
            'display'=> self::VK_DISPLAY_METHOD,
            'redirect_uri'  => self::$REDIRECT_URI,
            'response_type' => 'code'
        );
        $url = self::$VK_AUTHORIZE. '?' . urldecode(http_build_query($params));
        //return redirect(self::$VK_AUTHORIZE. '?' . urldecode(http_build_query($params)));
       // echo "<a href='$url'>vk</a>";
        return $url;
    }
    private function getVkToken($code){
        $params = array(
            'client_id'     => self::$CLIENT_ID,
            'client_secret' => self::$CLIENT_SECRET,
            'display'       => self::VK_DISPLAY_METHOD,
            'redirect_uri'  => self::$REDIRECT_URI,
            'code' => $code
        );
        $token = json_decode(file_get_contents(self::$VK_TOKEN_URL. '?' . urldecode(http_build_query($params))), true);
        return $token; // Массив
    }
    private function getVkUserInfo($token){
        if (isset($token['access_token'])) {
            $params = array(
                'uids' => $token['user_id'],
                'fields' => self::VK_FIELDS,
                'access_token' => $token['access_token']
            );
            $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
            if (isset($userInfo['response'][0]['uid'])) {
                $userInfo = $userInfo['response'][0];
                return $userInfo;
            }

        }
        else{
            echo "Что то пошло не так, попробуйте позже";
        }
    }


    public function vkAuth(Request $request){
        if(isset($_GET['code'])) {
            $token = self::getVkToken($_GET['code']);
            if (isset($token['access_token'])) {
                $userInfo = self::getVkUserInfo($token);
                $this->userIdentity(@$request,@$userInfo);
                return redirect('/');
            }

        }
        else{
           $url =  self::getVkCode();
            if($url){

                return redirect($url);
            }
            else{
                return redirect('/');
            }

        }
    }
    public static function createVkSession($request,$user,$role){
        $request->session()->flush();
        $request->session()->put('user.id', $user['uid']);
        $request->session()->put('user.name', $user['first_name'].' '.$user['last_name']);
        $request->session()->put('user.photo', $user['photo_big']);
        $request->session()->put('user.role', $role);

    }
    protected function userIdentity($request,$user){
        $checkUser = $this->checkUser(@$user);
        $role = 0;
        if($checkUser){
            $role = $this->checkUserRole(@$checkUser);
            $this->updateUserInfo(@$checkUser,@$user);
        }
        else{
            $this->saveUserInDB($user);
        }
        $this->createVkSession($request,$user,$role);

    }

    protected function checkUser($user){
        $result = Users::find($user['uid']);
        if(!$result){
           return false;
        }
        else {
            return $result;
         }
    }
    protected function checkUserRole($user){
        return $user->role;
    }
    protected function updateUserInfo($oldUser, $newUser){
        $oldUser->name = $newUser['first_name'].' '.$newUser['last_name'];
        $oldUser->save();
    }


    protected function saveUserInDB($user){
        $result = Users::find($user['uid']);
        if(!$result){
            $newUser = new Users();
            $newUser->id = $user['uid'];
            $newUser->name = $user['first_name'].' '.$user['last_name'];
            $newUser->save();
        }
    }
}
