<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: member_switchstatus.php 22481 2011-05-10 02:45:34Z liulanbo $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

define('NOROBOT', TRUE);

if($_G['uid']) {

	if(!$_G['group']['allowinvisible']) {
		showmessage('group_nopermission', NULL, array('grouptitle' => $_G['group']['grouptitle']), array('login' => 1));
	}

	$_G['session']['invisible'] = $_G['session']['invisible'] ? 0 : 1;
	DB::query("UPDATE ".DB::table('common_session')." SET invisible = '{$_G['session']['invisible']}' WHERE uid='$_G[uid]'", 'UNBUFFERED');
	DB::query("UPDATE ".DB::table('common_member_status')." SET invisible = '{$_G['session']['invisible']}' WHERE uid='$_G[uid]'", 'UNBUFFERED');
	$language = lang('forum/misc');
	$msg = $_G['session']['invisible'] ? $language['login_invisible_mode'] : $language['login_normal_mode'];
	showmessage('<a href="member.php?mod=switchstatus" title="'.$language['login_switch_invisible_mode'].'" onclick="ajaxget(this.href, \'loginstatus\');return false;" class="xi2">'.$msg.'</a>', dreferer(), array(), array('msgtype' => 3, 'showmsg' => 1));

}

?>