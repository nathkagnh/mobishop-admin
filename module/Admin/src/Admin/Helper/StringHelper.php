<?php
namespace Admin\Helper;

class StringHelper
{
	public function setSeoLink($str, $separate='-')
    {
        $arrReg = array(
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#siu',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#siu',
            '#(ì|í|ị|ỉ|ĩ)#siu',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#siu',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#siu',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#siu',
            '#(đ)#siu',
            '#([^a-zA-Z0-9]+)#i'
        );
        $arrFind = array(
            'a',
            'e',
            'i',
            'o',
            'u',
            'y',
            'd',
            $separate
        );
        return strtolower(trim(preg_replace($arrReg, $arrFind, $str), $separate));
    }
	/**
     * cut UTF8 string return full string
     * @param <string> $string
     * @param <int> $start
     * @param <int> $len
     * @param <string> $charlim
     * @return <string>
     */
    public function subFullString($string, $start=0, $len=20, $charlim = '...')
    {
        //Strip tags html
        $string = strip_tags($string);
        if (mb_strlen($string, 'UTF-8') <= $len)
            return $string;
        $string = mb_substr($string, 0, $len, 'UTF-8');
        preg_match('/\s[^\s]+$/u', $string, $matches, PREG_OFFSET_CAPTURE);
        if (!empty($matches))
        {
            $string = mb_substr($string, 0, $matches[0][1]) . ' ';
        }
        return $string . $charlim;
    }

    function randomString($length = 10)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}