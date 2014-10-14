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

namespace OCA\Share_qr\AppInfo;


use \OCP\AppFramework\App;
use \OCP\IContainer;

use \OCA\Share_qr\Controller\PageController;
use \OCA\Share_qr\Hooks\FilesystemHooks;


class Application extends App {


	public function __construct (array $urlParams=array()) {
		parent::__construct('share_qr', $urlParams);

		$container = $this->getContainer();

		/**
		 * Controllers
		 */
		$container->registerService('PageController', function(IContainer $c) {
			return new PageController(
				$c->query('AppName'), 
				$c->query('Request'),
				$c->query('UserId')
			);
		});

		/**
		 * Core
		 */
		$container->registerService('UserId', function(IContainer $c) {
			return \OCP\User::getUser();
		});

		/**
		 * Hooks
		 */
		$container->registerService('FilesystemHooks', function(IContainer $c) {
			return new FilesystemHooks(
				$c->query('ServerContainer')->getRootFolder(),
				$c->query('ServerContainer')->getUserFolder()
			);
		});

	}


}