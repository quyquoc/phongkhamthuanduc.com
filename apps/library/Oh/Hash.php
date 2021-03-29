<?php
	namespace Modules\Library\Oh;
	
	class Hash {

	public function __construct(){}

	/** 
		 * Tạo chuỗi ký tự đã mã hóa theo kiểu mã hóa sha256
		 * từ chuỗi nhập vào và từ khóa SALT
		 * @param string data chuỗi nhập vào
		 * @param string $salt chuỗi từ khóa, không nên thay đổi
		 * @return string chuỗi đã mã hóa 
		*/
	public static function create($data, $salt){
		$context = hash_init('md5', HASH_HMAC, $salt);
		hash_update($context, $data);
		return hash_final($context);
	}

	/** 
	 * Trả về một chuỗi ký tự ngẫu nhiên theo kiểu base64_encode
	 * @param no
	 * @return string chuỗi mã hóa ngẫu nhiên
	 *  
	*/
	public static function random(){
		// $result = base64_encode(mcrypt_create_iv('32', MCRYPT_RAND));
		$result = base64_encode(random_bytes(32));
		return $result;
	}
}