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

namespace OCA\Share_qr\Controller;


use \OCP\IRequest;
use \OCP\AppFramework\Http\TemplateResponse;
use \OCP\AppFramework\Controller;

class PageController extends Controller {

    private $userId;

    public function __construct($appName, IRequest $request, $userId){
        parent::__construct($appName, $request);
        $this->userId = $userId;
    }


    /**
     * CAUTION: the @Stuff turn off security checks, for this page no admin is
     *          required and no CSRF check. If you don't know what CSRF is, read
     *          it up in the docs or you might create a security hole. This is
     *          basically the only required method to add this exemption, don't
     *          add it to any other method if you don't exactly know what it does
     *
     * @NoAdminRequired
     * @NoCSRFRequired
     */
    public function index() {
		$path = \OC_Preferences::getValue(\OC_User::getUser(), 'share_qr', 'path', '');
		$imgSrc = null;
		$imgDate = null;

		$imgPath = \OC_User::getHome($this->userId). '/qr/qr.png';
		if (file_exists($imgPath)) {
			$base64 = base64_encode(file_get_contents($imgPath));
			$mime = 'image/png';
			$imgSrc = 'data:'.$mime.';base64,'.$base64;
			date_default_timezone_set( 'Asia/Tokyo' );
			$imgDate = date ("Y/m/d H:i:s", filemtime($imgPath));
		}

        $params = array(
			'user' => $this->userId,
			'path' => $path,
			'imgSrc' => $imgSrc,
			'imgDate' => $imgDate
		);
        return new TemplateResponse('share_qr', 'main', $params);  // templates/main.php
    }


    /**
     * Save path method
     * @NoAdminRequired
     */
    public function savepath($path) {
		$normalizePath = \OC\Files\Filesystem::normalizePath($path);
		\OC_Preferences::setValue(\OC_User::getUser(), 'share_qr', 'path', $normalizePath);
        return array('path' => $normalizePath);
    }


}