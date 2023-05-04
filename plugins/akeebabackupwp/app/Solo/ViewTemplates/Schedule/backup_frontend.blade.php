<?php
/**
 * @package   solo
 * @copyright Copyright (c)2014-2023 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

/** @var \Solo\View\Schedule\Html $this */

// Protect from unauthorized access
defined('_AKEEBA') or die();

?>
<div class="akeeba-panel--information">
    <header class="akeeba-block-header">
        <h3>
			@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTENDBACKUP')
        </h3>
    </header>

    <div class="akeeba-block--info">
        <p>
			@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTENDBACKUP_INFO')
        </p>
        <p>
            <a class="akeeba-btn--info" href="https://www.akeeba.com/documentation/akeeba-solo/automating-your-backup.html#frontend-backup" target="_blank">
				@lang('COM_AKEEBA_SCHEDULE_LBL_GENERICREADDOC')
            </a>
        </p>
    </div>
	@if(!$this->croninfo->info->legacyapi)
    <div class="akeeba-block--failure">
        <p>
			@lang('COM_AKEEBA_SCHEDULE_LBL_LEGACYAPI_DISABLED')
        </p>
    </div>
	@elseif(!trim($this->croninfo->info->secret))
    <div class="akeeba-block--failure">
        <p>
			@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_SECRET')
        </p>
    </div>
	@else
    <p>
		@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTENDBACKUP_MANYMETHODS')
    </p>

    <h4>
		@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTENDBACKUP_TAB_WEBCRON')
    </h4>


    <p>
		@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON')
    </p>

    <table class="akeeba-table--striped" width="100%">
        <tr>
            <td></td>
            <td>
				@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_INFO')
            </td>
        </tr>
        <tr>
            <td>
				@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_NAME')
            </td>
            <td>
				@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_NAME_INFO')
            </td>
        </tr>
        <tr>
            <td>
				@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_TIMEOUT')
            </td>
            <td>
				@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_TIMEOUT_INFO')
            </td>
        </tr>
        <tr>
            <td>
				@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_URL')
            </td>
            <td>
                {{ defined('WPINC') ? '' : $this->croninfo->info->root_url.'/' }}{{ $this->croninfo->frontend->path }}
            </td>
        </tr>
        <tr>
            <td>
				@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_LOGIN')
            </td>
            <td>
				@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_LOGINPASSWORD_INFO')
            </td>
        </tr>
        <tr>
            <td>
				@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_PASSWORD')
            </td>
            <td>
				@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_LOGINPASSWORD_INFO')
            </td>
        </tr>
        <tr>
            <td>
				@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_EXECUTIONTIME')
            </td>
            <td>
				@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_EXECUTIONTIME_INFO')
            </td>
        </tr>
        <tr>
            <td>
				@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_ALERTS')
            </td>
            <td>
				@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_ALERTS_INFO')
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
				@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_THENCLICKSUBMIT')
            </td>
        </tr>
    </table>

    <h4>
		@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTENDBACKUP_TAB_WGET')
    </h4>

    <p>
		@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WGET')
        <code>
            wget --max-redirect=10000 "{{ defined('WPINC') ? '' : $this->croninfo->info->root_url.'/' }}{{ $this->croninfo->frontend->path }}" -O - 1>/dev/null 2>/dev/null
        </code>
    </p>

    <h4>
		@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTENDBACKUP_TAB_CURL')
    </h4>

    <p>
		@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_CURL')
        <code>
            curl -L --max-redirs 1000 -v "{{ defined('WPINC') ? '' : $this->croninfo->info->root_url.'/' }}{{ $this->croninfo->frontend->path }}" 1>/dev/null 2>/dev/null
        </code>
    </p>

    <h4>
		@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTENDBACKUP_TAB_SCRIPT')
    </h4>

    <p>
		@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_CUSTOMSCRIPT')
    </p>

    <pre>
{{ '&lt;?php' }}

$curl_handle=curl_init();
curl_setopt($curl_handle, CURLOPT_URL, '{{ defined('WPINC') ? '' : $this->croninfo->info->root_url.'/' }}{{ $this->croninfo->frontend->path }}');
curl_setopt($curl_handle,CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($curl_handle,CURLOPT_MAXREDIRS, 10000);
curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER, 1);
$buffer = curl_exec($curl_handle);
curl_close($curl_handle);
if (empty($buffer))
    echo "Sorry, the backup didn't work.";
else
    echo $buffer;
{{ '?&gt;' }}
        </pre>

    <h4>
		@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTENDBACKUP_TAB_URL')
    </h4>

    <p>
		@lang('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_RAWURL')
        <code>
            {{ defined('WPINC') ? '' : $this->croninfo->info->root_url.'/' }}{{ $this->croninfo->frontend->path }}
        </code>
    </p>
	@endif
</div>
