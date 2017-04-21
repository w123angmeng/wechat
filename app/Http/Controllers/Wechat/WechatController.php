<?php

namespace App\Http\Controllers\Wechat;

//use Aimeos\Shop\Base\View;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \DB;
//include __DIR__ . '/../../../vendor/autoload.php'; // 引入 composer 入口文件
include __DIR__ ."/../../../../vendor/autoload.php";
//include  __DIR__ . '/vendor/autoload.php';
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Text;
use Log;


class WechatController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

//    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('guest', ['except' => 'logout']);
//    }

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve(){
        Log::info('request arrived123.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $options = [
            'debug'  => true,
            'app_id' => 'wx9d2be0f76f19dcc8',
            'secret' => 'd11ba24cde7164df573624b4cfde9a33',
            'token'  => 'easywechat',
            // 'aes_key' => null, // 可选
            'log' => [
                'level' => 'debug',
                'file'  => '/tmp/food-info.ngrok.sinomoses.com', // XXX: 绝对路径！！！！
            ],
            'oauth' => [
                'scopes'   => ['snsapi_userinfo'],
                'callback' => 'food-info.ngrok.sinomoses.com/',
            ],
        ];
        $app = new Application($options);
        $menu = $app->menu;
        $menus = $menu->all();
        $buttons = [
            [
                "name"       => "圣林源",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "医院简介",
                        "url"  => "http://food-info.ngrok.sinomoses.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "医院历史",
                        "url"  => "http://food-info.ngrok.sinomoses.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "医院文化",
                        "url"  => "http://food-info.ngrok.sinomoses.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "地理位置",
                        "url"  => "http://food-info.ngrok.sinomoses.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "科室导航",
                        "url"  => "http://food-info.ngrok.sinomoses.com/"
                    ],
                ],
            ],
            [
                "name"       => "患者服务",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "预约挂号",
                        "url"  => "http://food-info.ngrok.sinomoses.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "检验单查询",
                        "url"  => "http://food-info.ngrok.sinomoses.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "门诊记录",
                        "url"  => "http://food-info.ngrok.sinomoses.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "住院记录",
                        "url"  => "http://food-info.ngrok.sinomoses.com/"
                    ],
                ],
            ],
            [
                "name"       => "我的",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "个人中心",
                        "url"  => "http://food-info.ngrok.sinomoses.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "常见问题",
                        "url"  => "http://food-info.ngrok.sinomoses.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "意见反馈",
                        "url"  => "http://food-info.ngrok.sinomoses.com/"
                    ],
                ],
            ],
        ];
        $menu->add($buttons);
        Log::info('menu is .'.$menus);
        $server = $app->server;
        $server->setMessageHandler(function ($message) {
            switch ($message->MsgType) {
                case 'event':
                    switch ($message->Event) {
                        case 'subscribe':
                            return '你好';
                            break;
                        default:
                            return 'hello';
                            break;
                    }
                    break;
                case 'text':
                    $text = new Text(['content' => '您好！overtrue。']);
                    return $text;
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
            }
            // ...
        });
        $response = $server -> serve();
        Log::info('return response.'.$response);

        return $response;

//        $response->send(); // Laravel 里请使用：return $response;

//        return view("Wechat/serve");
    }
//    public function showNav(){
//        $result = DB::select('select * from food_info_adv');
//        return view("web/nav",["op" => "show", "result" => $result]);
//
//    }
//    public function editNav($id){
//        $results = DB::select('select * from food_info_adv where id =?',[$id]);
//        $result = "";
//        if(!empty($results)){
//            $result = $results[0];
//        }
//        if(Request::ajax()){
//            $advname = trim($_POST["advname"]);
//            if(empty($advname)){
//                return array(
//                    "status" => 0,
//                    "info" => "标题不能为空！"
//                );
//            }
//            $data = [$advname, $_POST["link"], $_POST["thumb"], $_POST["displayorder"], $_POST["enabled"]];
//            if(empty($id)){
//                $result = DB::insert('insert into food_info_adv (advname, link, thumb, displayorder, enabled) values (?, ?, ?, ?, ?)', $data);
//            }else{
//                $data = [$advname, $_POST["link"], $_POST["thumb"], $_POST["displayorder"], $_POST["enabled"], $id];
//                $result = DB::update('update food_info_adv set advname = ?, link = ?, thumb = ?, displayorder = ?, enabled = ? where id = ?', $data);
//            }
//            if($result){
//                return array(
//                    "status" => 1,
//                    "info" => "更新数据成功！"
//                );
//            }
//            return array(
//                "status" => 0,
//                "info" => "更新数据失败！"
//            );
//
//        }
//
//        return view("web/nav",["op" => "edit", "result" => $result]);
//
//    }
//    public function delNav($id){
//        $results = DB::select('select * from food_info_adv where id =?',[$id]);
//        if(empty($results)){
//            return array(
//                "status" => 0,
//                "info" => "该幻灯片不存在！"
//            );
//        }
//        $result = DB::delete('delete from food_info_adv where id =?',[$id]);
//        if($result){
//            return array(
//                "status" => 1,
//                "info" => "更新数据成功！"
//            );
//        }
//        return array(
//            "status" => 0,
//            "info" => "更新数据失败！"
//        );
//    }

}
