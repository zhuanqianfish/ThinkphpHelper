<?php
//	ThinkphpHelper v0.3
//
//	weiyunstudio.com
//	sjj zhuanqianfish@gmail.com
//	2014年9月18日
namespace TPH\Controller;
use Think\Controller;

class IndexController extends Controller {

    public function index(){
		$this->display("Public/help");
    }

	public function ui(){
		$this->display("Public/ui");
    }

	public function help(){
		$this->display("Public/help");
    }

	public function test(){
		$dbDict = C('DB_FIELD_DICT');
		dump($dbDict);
		dump($dbDict['article']['title']['asName']);
		$this->display(); 
	}

	public function checkVersion(){	//检查代码版本
		header("Content-type: text/html; charset=utf-8");
		$version = C('VERSION');
		$url = 'http://zhuanqianfish.github.io/ThinkphpHelper/version.txt';
		$newVersion =  (float)file_get_contents($url);
		if($newVersion > $version){
			echo '<font color="red">有新版本，建议更新!</font>';
		}
	}
}
