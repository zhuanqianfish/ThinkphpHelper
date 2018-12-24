<?php
//	ThinkphpHelper v0.3
//
//	weiyunstudio.com
//	sjj zhuanqianfish@gmail.com
//	2014年9月18日
namespace app\tph2\Controller;
use think\Controller;

class Index extends Base{

	public function index()
	{
		return $this->fetch(DS."help");
    }

	public function ui()
	{
		return $this->fetch(DS."ui");
    }

	public function help(){
		return $this->fetch(DS."help");
    }

	public function test(){
		 return tph2test();
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
