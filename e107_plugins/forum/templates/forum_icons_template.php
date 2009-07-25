<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     �Steve Dunstan 2001-2002
|     http://e107.org
|     jalist@e107.org
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: /cvs_backup/e107_0.8/e107_plugins/forum/templates/forum_icons_template.php,v $
|     $Revision: 1.8 $
|     $Date: 2009-07-25 07:49:57 $
|     $Author: marj_nl_fr $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

include_lan(e_PLUGIN.'forum/languages/'.e_LANGUAGE.'/lan_forum_viewforum.php');

define('IMAGE_e', '<img src="'.img_path('e.png').'" alt="" title="" />');
define('IMAGE_new', '<img src="'.img_path('new.png').'" alt="'.LAN_199.'" title="'.LAN_199.'" />');
define('IMAGE_nonew', '<img src="'.img_path('nonew.png').'" alt="" title="" />');
define('IMAGE_new_small', '<img src="'.img_path('new_small.png').'" alt="'.FORLAN_11.'" title="'.FORLAN_11.'" />');
define('IMAGE_nonew_small', '<img src="'.img_path('nonew_small.png').'" alt="'.FORLAN_12.'" title="'.FORLAN_12.'" />');
define('IMAGE_new_popular', '<img src="'.img_path('new_popular.png').'" alt="'.FORLAN_13.'" title="'.FORLAN_13.'" />');
define('IMAGE_nonew_popular', '<img src="'.img_path('nonew_popular.png').'" alt="'.FORLAN_14.'" title="'.FORLAN_14.'" />');
define('IMAGE_new_popular_small', '<img src="'.img_path('new_popular_small.png').'" alt="'.FORLAN_13.'" title="'.FORLAN_13.'" />');
define('IMAGE_nonew_popular_small', '<img src="'.img_path('nonew_popular_small.png').'" alt="'.FORLAN_14.'" title="'.FORLAN_14.'" />');
define('IMAGE_sticky', '<img src="'.img_path('sticky.png').'" alt="'.FORLAN_15.'" title="'.FORLAN_15.'" />');
define('IMAGE_stickyclosed', '<img src="'.img_path('sticky_closed.png').'" alt="'.FORLAN_16.'" title="'.FORLAN_16.'" />');
define('IMAGE_sticky_small', '<img src="'.img_path('sticky_small.png').'" alt="'.FORLAN_15.'" title="'.FORLAN_15.'" />');
define('IMAGE_stickyclosed_small', '<img src="'.img_path('sticky_closed_small.png').'" alt="'.FORLAN_16.'" title="'.FORLAN_16.'" />');
define('IMAGE_announce', '<img src="'.img_path('announce.png').'" alt="'.FORLAN_17.'" title="'.FORLAN_17.'" />');
define('IMAGE_announce_small', '<img src="'.img_path('announce_small.png').'" alt="'.FORLAN_17.'" title="'.FORLAN_17.'" />');
define('IMAGE_closed_small', '<img src="'.img_path('closed_small.png').'" alt="'.FORLAN_18.'" title="'.FORLAN_18.'" />');
define('IMAGE_closed', '<img src="'.img_path('closed.png').'" alt="'.FORLAN_18.'" title="'.FORLAN_18.'" />');
define('IMAGE_profile', '<img src="'.img_path('profile.png').'" alt="'.LAN_398.'" title="'.LAN_398.'" />');
define('IMAGE_email', '<img src="'.img_path('email.png').'" alt="'.LAN_397.'" title="'.LAN_397.'" />');
define('IMAGE_pm', '<img src="'.img_path('pm.png').'" alt="'.LAN_399.'" title="'.LAN_399.'" />');
define('IMAGE_website', '<img src="'.img_path('website.png').'" alt="'.LAN_396.'" title="'.LAN_396.'" />');
define('IMAGE_edit', '<img src="'.img_path('edit.png').'" alt="'.LAN_400.'" title="'.LAN_400.'" />');
define('IMAGE_quote', '<img src="'.img_path('quote.png').'" alt="'.LAN_401.'" title="'.LAN_401.'" />');
define('IMAGE_admin_edit', '<img src="'.img_path('admin_edit.png').'" alt="'.LAN_406.'" title="'.LAN_406.'" style="vertical-align: top;" />');
define('IMAGE_admin_move', '<img src="'.img_path('admin_move.png').'" alt="'.LAN_402.'" title="'.LAN_402.'" style="vertical-align: top;" />');
define('IMAGE_admin_split', '<img src="'.img_path('admin_split.png').'" alt="'.FORLAN_105.'" title="'.FORLAN_105.'" style="vertical-align: top;" />');
define('IMAGE_admin_move2', '<img src="'.img_path('admin_move.png').'" alt="'.LAN_408.'" title="'.LAN_408.'" style="vertical-align: top;" />');
define('IMAGE_post', '<img src="'.img_path('post.png').'" alt="" title="" />');
define('IMAGE_post2', '<img src="'.img_path('post2.png').'" alt="" title="" style="vertical-align:bottom" />');
define('IMAGE_report', '<img src="'.img_path('report.png').'" alt="'.LAN_413.'" title="'.LAN_413.'" />');
define('IMAGE_attachment', '<img src="'.img_path('attach.png').'" alt="" title="" />');

define('IMAGE_track', '<img src="'.img_path('track.png').'" alt="'.LAN_392.'" title="'.LAN_392.'" />');
define('IMAGE_untrack', '<img src="'.img_path('untrack.png').'" alt="'.LAN_391.'" title="'.LAN_391.'" />');

// Admin <input> Icons

define('IMAGE_admin_delete', 'src="'.img_path('admin_delete.png').'" alt="'.LAN_435.'" title="'.LAN_435.'" ');
define('IMAGE_admin_unstick', 'src="'.img_path('admin_unstick.png').'" alt="'.LAN_398.'" title="'.LAN_398.'" ');
define('IMAGE_admin_stick', 'src="'.img_path('admin_stick.png').'" alt="'.LAN_401.'" title="'.LAN_401.'" ');
define('IMAGE_admin_lock', 'src="'.img_path('admin_lock.png').'" alt="'.LAN_399.'" title="'.LAN_399.'" ');
define('IMAGE_admin_unlock', 'src="'.img_path('admin_unlock.png').'" alt="'.LAN_400.'" title="'.LAN_400.'" ');

// Multi Language Images

define('IMAGE_newthread', '<img src="'.img_path('newthread.png').'" alt="'.FORLAN_10.'" title="'.FORLAN_10.'" />');
define('IMAGE_reply', '<img src="'.img_path('reply.png').'" alt="" title="" />');
define('IMAGE_rank_moderator_image', '<img src="'.img_path('moderator.png', '', 'rank_moderator_image').'" alt="" />');
define('IMAGE_rank_main_admin_image', '<img src="'.img_path('main_admin.png', '', 'rank_main_admin_image').'" alt="" />');
define('IMAGE_rank_admin_image', '<img src="'.img_path('admin.png', '', 'rank_admin_image').'" alt="" />');

?>