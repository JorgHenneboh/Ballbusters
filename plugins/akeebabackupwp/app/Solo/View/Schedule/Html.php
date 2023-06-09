<?php
/**
 * @package   solo
 * @copyright Copyright (c)2014-2023 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Solo\View\Schedule;

use Akeeba\Engine\Platform;
use Awf\Mvc\View;
use Solo\Model\Schedule;

class Html extends View
{
	public $profileid;
	public $profileName;
	public $croninfo;
	public $checkinfo;

	public function onBeforeMain()
	{
		// Get profile ID
		$this->profileid = Platform::getInstance()->get_active_profile();

		// Get profile name
		$this->profileName = $this->escape(Platform::getInstance()->get_profile_name($this->profileid));

		// Get the CRON paths
		/** @var Schedule $model */
		$model           = $this->getModel();
		$this->croninfo  = $model->getPaths();
		$this->checkinfo = $model->getCheckPaths();

		return true;
	}
}
