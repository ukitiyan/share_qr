<?php
/**
 * ownCloud - share_qr
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Begood Technology Corp. <y-takahashi@begood-tech.com>
 * @copyright Begood Technology Corp. 2014
 */
namespace OCA\Share_qr\Hooks;


require_once __DIR__ . '/../3rdparty/phpqrcode/qrlib.php';

class FilesystemHooks {

	private $root;
	private $userFolder;

	public function __construct($root, $userFolder) {
		$this->root = $root;
		$this->userFolder = $userFolder;
	}

//	public function register() {
//		$callback = function($params) {
//			\OC_Log::write('share_qr', 'callback', \OC_Log::DEBUG);
//		};
//		$this->root->listen('\OCP\Files\Node', 'create', $callback);
//	}

	public function create($node) {
		$user = \OCP\User::getUser();
		$view = new \OC\Files\View('/'.$user.'/files');
		$fileInfo = $view->getFileInfo($node['path']);
		if (!$fileInfo) {
			return false;
		}



		// create share
		$key = \OCP\Share::shareItem('file', $fileInfo['fileid'], \OCP\Share::SHARE_TYPE_LINK, null, \OCP\PERMISSION_ALL);
		$url = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"]. '/public.php?service=files&t='. $key;

		// create qr image
		$filename = 'qr.png';
		$dir = \OC_User::getHome($user). '/qr';
		if (!file_exists($dir) ) {
			mkdir($dir, 0755);
		}
		\QRcode::png($url, $dir. '/'. $filename);

		\OC_Log::write('share_qr', $url, \OC_Log::DEBUG);
	}
}
