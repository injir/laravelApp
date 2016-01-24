<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Session;

class UserController extends Controller
{
 private static $IS_ADMIN = 1;

//--------------------------------------//
//              PUBLIC API
//--------------------------------------//
    public static function useridentification($request,$user){
        $checkUser = self::checkUser(@$user['uid']);
        $role = 0;
        if($checkUser){
            $role = self::getUserRole(@$checkUser);
            self::updateUserInfo(@$checkUser,@$user);
        }
        else{
            self::saveUserInDB($user);
        }
       return $role;

    }
    public static function getUserFromSession(){
       $user = Session::get('user');
        if($user){
            return $user;
        }
        else{
            return false;
        }
    }
    public static function  getAuthStatus(){
        $session = self::getUserFromSession();
        if($session){
            return true;
        }
        else{
            return false;
        }

    }

    public static function  getUserStatus(){
        $role = Session::get('user.role');
        if($role == self::$IS_ADMIN){
            return true;
        }
        else{
            return false;
        }
    }
    public static function getUserStatusTitle(){
        if(self::getUserStatus()){
            return "ADMINISTRATOR";
        }
        else{
            return "USER";
        }

    }
//--------------------------------------//
//              PRIVAT API
//--------------------------------------//

// Ïğîâåğÿåò åñòü ëè şçåğ ñ äàííûì id  â áàçå äàííûõ, åñëè åñòü âîçâğàùàåò åãî;
    private static function checkUser($id){
        $result = Users::find($id);
        if(!$result){
            return false;
        }
        else {
            return $result;
        }
    }


// Âîçâğàùàåò ğîëü ïîëüçîâàòåëÿ èç áä
    private static function getUserRole($user){
        return $user->role;
    }

// Èçìåíÿåò èíôîğìàöèş î ïîëüçîâàòåëå â áä
    private static function updateUserInfo($oldUser, $newUser){
        $oldUser->name = $newUser['first_name'].' '.$newUser['last_name'];
        $oldUser->save();
    }

// Ñîõğàíÿåò Íîâîãî ïîëüçîâàòåëÿ â áä
    private static function saveUserInDB($user){
        $result = Users::find($user['uid']);
        if(!$result){
            $newUser = new Users();
            $newUser->id = $user['uid'];
            $newUser->name = $user['first_name'].' '.$user['last_name'];
            $newUser->save();
        }
    }
}
