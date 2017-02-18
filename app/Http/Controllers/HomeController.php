<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use zgldh\QiniuStorage\QiniuStorage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function menu()
    {
        $menu = [];
        $menus = Menu::all()->toArray();

        function recursion(&$menuList, &$menu, $id)
        {
            foreach ($menuList as &$item)
            {
                if (isset($item['used']) || $item['father'] != $id)  continue;
                else
                {
                    $count = count($menu);
                    $item['used'] = true;
                    $menu[] = ['menuName'=>$item['title'], 'url'=>$item['url'], 'children'=>[]];
                    recursion($menuList, $menu[$count]['children'], $item['id']);
                }
            }
        }
        recursion($menus, $menu, 0);

        return $menu;
    }

    public function info()
    {
        $info = Auth::user();

        $info['avatar'] = env('USER_AVATAR');

        return $info;
    }

    public function token()
    {
        $disk = QiniuStorage::disk('qiniu');
        $key = time();
        $token = $disk->uploadToken($key);
        return ['key'=>$key, 'token'=>$token];
    }
}
