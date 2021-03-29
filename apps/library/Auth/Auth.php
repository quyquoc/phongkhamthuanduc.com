<?php
namespace Modules\Library\Auth;
use Phalcon\Mvc\User\Component;

/**
 * Manages Authentication/Identity Management
 */
class Auth extends Component {

	/**
	 * Checks the user credentials
	 *
	 * @param array $credentials
	 * @return boolan
	 */
	public function check($credentials) {
		
		// Check if the user exist
		$conditions = "(email = :email: OR username = :username:) AND status = '1'";

		$member = \Modules\App\Models\MemberModel::findFirst(array("conditions" => $conditions,"bind" => array("email" => $credentials['username'],"username" => $credentials['username'])));

		if (!$member) { // không đúng tài khoản hoặc email thì return
			return false;
		}
		
		// Kiểm tra  password đúng hay không
		$hash = new \Modules\Library\Oh\Hash();
		if($member->password !== $hash::create($credentials['password'],$member->salt)){ 
			return false;
		} 

		$this->session->set('auth-oh', array(
			'id' 					=> $member->id,
			'username' 		=> $member->username,
			'group_id'    => $member->group_id,
			'permission' 	=> $member->permission_group->permission
			// 'resource'    => $member->permission_group->resource_id  
		));
		
		//Cấp quyen Update FILE bằng CKFINDER
		$this->setPermissionCKFinder();

		return true;
	}

	/**
	 * Returns the current identity
	 *
	 * @return array
	 */
	public function getIdentity() {

		return $this->session->get('auth-oh');
	}

	/**
	 * Returns the current identity Username
	 *
	 * @return string
	 */
	public function getUserName() {

		$identity = $this->session->get('auth-oh');
		return $identity['username'];
	}

	/**
	 * Returns the current identity
	 *
	 * @return string
	 */
	public function getPermission() {

		$identity = $this->session->get('auth-oh');
		return $identity['permission'];
	}
	
	/**
	 * Get the entity related to user in the active identity
	 *
	 * @return \Models\App\Models\Member
	 */
	public function getMember() {

		$identity = $this->session->get('auth-oh');
		if (isset($identity['id'])) {

			$member = \Modules\App\Models\MemberModel::findFirstById($identity['id']);
			if ($member) {
			   return $member;
			}
		}
		return false;
	}
	
	/**
	 * Removes the user identity information from session
	 */
	public function remove() {
		$this->session->remove('auth-oh');
		$this->session->remove('ckfinder');
	}

	// Set quyền truy cập vào CKinder và đường dẫn chứa tài nguyên + được truy xuất vào folder
	private function setPermissionCKFinder(){

		$identity       = $this->session->get('auth-oh'); 
		// $resource_id    = $identity['resource'];

		$conditions     = "id = :id: AND status = 1";            
		// $resource       = \Modules\App\Models\PermissionResourceModel::findFirst(array("conditions" => $conditions, "bind" => array("id" => $resource_id)));

		$this->session->set('ckfinder', array(
			// 'BaseUrl'       =>  $this->url->get('public/files/'),
			'BaseUrl'       =>  UPLOAD_URL,
			'BaseDir'       =>  ROOT_PATH.UPLOAD_URL,
			'IsAuthorized'  =>  true
			// 'Permission'    =>  $resource->permission
		));
		$_SESSION['ckfinder']['Thumbnails'] = Array(
			'url'           => UPLOAD_URL . '/_thumbs',
			'directory'     => UPLOAD_PATH . '/_thumbs',
			'enabled'       => true,
			'directAccess'  => false,
			'maxWidth'      => 100,
			'maxHeight'     => 100,
			'bmpSupported'  => false,
			'quality'       => 80
		);
		$_SESSION['ckfinder']['Images'] = Array(
			'maxWidth'  => 2000,
			'maxHeight' => 2000,
			'quality'   => 80
		);
		$_SESSION['ckfinder']['AccessControl'][] = Array(
			'role' 					=> '*',
			'resourceType' 	=> '*',
			'folder' 				=> '/',
			'folderView' 		=> true,
			'folderCreate' 	=> true,
			'folderRename'	=> true,
			'folderDelete' 	=> true,
			'fileView' 			=> true,
			'fileUpload' 		=> true,
			'fileRename' 		=> true,
			'fileDelete' 		=> true
		);
		$_SESSION['ckfinder']['DefaultResourceTypes'] = '';
		$_SESSION['ckfinder']['ResourceType'][] = Array(
			'name' 							=> 'static',
			'url' 							=> UPLOAD_URL.'/static',
			'directory' 				=> UPLOAD_PATH.'/static',
			'maxSize' 					=> UPLOAD_SIZE,
			'allowedExtensions' => UPLOAD_EXT,
			'deniedExtensions' 	=> ''
		);
		// $_SESSION['ckfinder']['ResourceType'][] = Array(
		// 	'name' 							=> $identity['username'],
		// 	'url' 							=> UPLOAD_URL.'/members/'.$identity['username'],
		// 	'directory' 				=> UPLOAD_PATH.'/members/'.$identity['username'],
		// 	'maxSize' 					=> UPLOAD_SIZE,
		// 	'allowedExtensions' => UPLOAD_EXT,
		// 	'deniedExtensions' 	=> ''
		// );		
		
		/* chưa sử dụng */
			// if($resource){ // Tồn tại nhóm quyền resource
			//     if($resource->permission == "full"){
			//         $_SESSION['ckfinder']['AccessControl'][] = Array(
			//             'role' => '*',
			//             'resourceType' => '*',
			//             'folder' => '/',

			//             'folderView'    => true,
			//             'folderCreate'  => true,
			//             'folderRename'  => true,
			//             'folderDelete'  => true,

			//             'fileView'      => true,
			//             'fileUpload'    => true,
			//             'fileRename'    => true,
			//             'fileDelete'    => true
			//         );
			//     } else {
			//         $_SESSION['ckfinder']['AccessControl'][] = Array(
			//             'role' => '*',
			//             'resourceType' => '*',
			//             'folder' => '/',

			//             'folderView'    => true,
			//             'folderCreate'  => true,
			//             'folderRename'  => true,
			//             'folderDelete'  => true,

			//             'fileView'      => false,
			//             'fileUpload'    => true,
			//             'fileRename'    => true,
			//             'fileDelete'    => true
			//         );
					
			//         $conditions = "resource_id = :resource_id: AND status = 1";
			//         $resource_config = \Modules\Backend\Models\Permission_resource_config::find(array("conditions" => $conditions,"bind" => array("resource_id" => $resource_id)));

			//         foreach ($resource_config as $key => $value) {

			//             $_SESSION['ckfinder']['AccessControl'][] = Array(
			//                 'role' 			=> '*',
			//                 'resourceType' 	=> $value->config->type,
			//                 'folder' 		=> '/'.$value->config->folder,

			//                 'folderView'    => $value->config->folder_view   == 1 ? true : false,
			//                 'folderCreate'  => $value->config->folder_create == 1 ? true : false,
			//                 'folderRename'  => $value->config->folder_rename == 1 ? true : false,
			//                 'folderDelete'  => $value->config->folder_delete == 1 ? true : false,

			//                 'fileView'      => $value->config->file_view   == 1 ? true : false,
			//                 'fileUpload'    => $value->config->file_upload == 1 ? true : false,
			//                 'fileRename'    => $value->config->file_rename == 1 ? true : false,
			//                 'fileDelete'    => $value->config->file_delete == 1 ? true : false,
			//             );
			//         }
			//     }
			// } else { // Tắt kích hoạt resource -> Không truy cập vào folder được

			//     $_SESSION['ckfinder']['AccessControl'][] = Array(
			//         'role'          => '*',
			//         'resourceType'  => '*',
			//         'folder'        => '/',

			//         'folderView'    => false,
			//         'folderCreate'  => false,
			//         'folderRename'  => false,
			//         'folderDelete'  => false,

			//         'fileView'      => false,
			//         'fileUpload'    => false,
			//         'fileRename'    => false,
			//         'fileDelete'    => false
			//     );
			// }
	}
}

/* End of file Auth.php */
/* Location: ./apps/library/Auth/Auth.php */
