<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models;
class SocialAuthController extends Controller
{
    private static $CLIENT_ID = '5237078'; // ID приложения
    private static $CLIENT_SECRET = 'F1zLbnzqCAx5zsDgs23I'; // Защищённый ключ
    private static $REDIRECT_URI = 'http://ct24188.tmweb.ru/public/vk'; // Адрес сайта
    private static $VK_AUTHORIZE = 'https://oauth.vk.com/authorize'; // Авторизация
    private static $VK_TOKEN_URL =  'https://oauth.vk.com/access_token';
    private static $SCOPE = 'wall,offline,photos';
    const VK_DISPLAY_METHOD = 'popup';
    const VK_FIELDS = 'uid,first_name,last_name,screen_name,sex,bdate,photo_100';
    public static $USER_INFO = null;


//--------------------------------------//
//              PUBLIC API
//--------------------------------------//
// Метод осуществляет авторизацию через вк
    public function vkAuth(Request $request){
        if(!UserController::getAuthStatus()) {
            if (isset($_GET['code'])) {
                $token = self::getVkToken($_GET['code']);
                if (isset($token['access_token'])) {
                    $userInfo = self::getVkUserInfo($token);
                    $role = UserController::useridentification(@$request, @$userInfo);
                    self::createVkSession(@$request, @$userInfo, @$role, $token['access_token']);
                    //var_dump($userInfo,$token);
                   return redirect('/');
                    $params = array(

                        'owner_id' =>   '-60165420',
                        'message' => "test",

                    );
                    $a = file_get_contents('https://api.vk.com/method/wall.post' . '?' . urldecode(http_build_query($params)).'&'.'access_token='.Session::get('user.token'));
                    var_dump($a);
                }

            } else {
                $url = self::getVkCode();
                if ($url) {

                    return redirect($url);
                } else {
                    return redirect('/');
                }

            }
        }
        else{
            return redirect('/');
        }
    }
    public function repost($table,$id){
        $record = DB::table($table)->where('id',$id)->get();
        $params = array(

            'owner_id' =>   '-60165420',
            'message' => "test",

         );
        $a = file_get_contents('https://api.vk.com/method/wall.post' . '?' . urldecode(http_build_query($params)).'&'.'access_token='.Session::get('user.token'));
        var_dump($a);
    }

    public function uploadVk(){
        if (isset($_POST["url"])) {

            $upload_url = $_POST["url"];
           $image =  'image/martanto-2.jpg';
            var_dump($image);
            $post_params['photo'] ='@'.$image; // kartinka.jpg к примеру лежит в той же папке, что и наш upload.php

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $upload_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_params);
            $result = curl_exec($ch);
            curl_close($ch);

            echo $result;

        }

    }

//--------------------------------------//
//             PROTECTED API
//--------------------------------------//
    protected function createVkSession($request,$user,$role,$token){
        $request->session()->flush();
        $request->session()->put('user.id', $user['uid']);
        $request->session()->put('user.name', $user['first_name'].' '.$user['last_name']);
        $request->session()->put('user.photo', $user['photo_100']);
        $request->session()->put('user.role', $role);
        $request->session()->put('user.token', $token);

    }


//--------------------------------------//
//              PRIVAT API
//--------------------------------------//
////Метод осуществляет редирект на страницу self::$REDIRECT_URI с GET['code'], при успешной авторизации через вконтакте

    private function getVkCode(){
        $params = array(
            'client_id'     => self::$CLIENT_ID,
            'display'       => self::VK_DISPLAY_METHOD,
            'redirect_uri'  => self::$REDIRECT_URI,
            'response_type' => 'code',
            'scope'         => self::$SCOPE,
        );
        $url = self::$VK_AUTHORIZE. '?' . urldecode(http_build_query($params));
        //return redirect(self::$VK_AUTHORIZE. '?' . urldecode(http_build_query($params)));
       // echo "<a href='$url'>vk</a>";
        return $url;
    }

// Метод возвращает ВК токен
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
// Метод возвращает информацию об авторизованном пользователе
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





}
