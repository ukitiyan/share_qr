/**
 * ownCloud - share_qr
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Begood Technology Corp. <y-takahashi@begood-tech.com>
 * @copyright Begood Technology Corp. 2014
 */

(function ($, OC) {

	$(document).ready(function () {
		$('#savepath').click(function () {
			var url = OC.generateUrl('/apps/share_qr/savepath');
			var data = {
				path: $('#path-content').val()
			};

			$.post(url, data).success(function (response) {

			});
			
		});
	});

})(jQuery, OC);