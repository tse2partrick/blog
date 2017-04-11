<?php 
class captcha
{
	public $width;
	public $height;
	public $arr = [];
	public function __construct($width, $height)
	{
		$this->width = $width;
		$this->height = $height;
		$this->createPic();
	}

	public function createPic()
	{
		$pic = imagecreatetruecolor($this->width, $this->height);
		$white = imagecolorallocate($pic, 255, 255, 255);
		$black = imagecolorallocate($pic, 0, 0, 0);
		

		for($i=1; $i<=4; $i++){
			$string = rand(0, 9);
			array_push($this->arr, $string);
			//$text_color = imagecolorallocate($pic, rand(0,255), rand(0,255), rand(0,255));
			$x = $i*($this->width/4)-15;	//让验证码居中于图片
			imagestring($pic, 5, $x, $this->height/3, $string, $white);

		}

		imagepng($pic);
		imagedestroy($pic);
	}

	public function getPic()
	{
		return implode('', $this->arr);
	}
}
header('Content-type:image/png');
session_start();
$pic = new captcha(100, 30);
$_SESSION['captcha_backend'] = $pic->getPic();
 ?>