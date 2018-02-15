<?php

defined('BASEPATH') or exit('No direct script access allowed');

/** Base Config of Zend Helper * */
$path_to_zend = str_replace('/', '\\', APPPATH) . 'zend\\'; //windows
// $path_to_zend = APPPATH . '/zend/'; //linux
ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . $path_to_zend);
require_once ($path_to_zend . 'Zend/Loader/Autoloader.php');
/** End of Base Config * */
define('authenticationURL', 'https://www.google.com/accounts/ClientLogin');
define('user', 'cahayabaginegeri@gmail.com');
define('password', 'cbnindo@)!@');
define('devKey', 'AI39si6rUAY8Fy7c8YqDYgNUQE0mNkvG1m1kGn4Z62Ajo72CMfYpoGx4_bXmp7Qxl00A4FtJQimT36EHBxWGDq75bj1UnnohHA');
define('appId', 'Video uploader v1');
define('clientId', 'My video upload client - v1');

if (!function_exists('get_top_video')) {

    /**
     * get_top_video
     * @author Lisman Tua Sihotang <lisman.sihotang@gmail.com>
     * @date 7 June 2014
     * 
     * @return type
     */
    function get_top_video() {
        Zend_Loader_Autoloader::getInstance();
        $yt = new Zend_Gdata_YouTube();
//        $url = 'http://gdata.youtube.com/feeds/api/users/cbnindonesia';
//        $video_list = $yt->getVideoFeed($url);
        $video_list = $yt->getUserUploads('cbnindonesia');
        $i = 0;
        foreach ($video_list as $key => $value) {
            $top_rated_video[$i]['video_id'] = $value->getVideoId();
            $top_rated_video[$i]['title'] = (string) $value->mediaGroup->title;
            $top_rated_video[$i]['desc'] = (string) $value->mediaGroup->description;
            $top_rated_video[$i]['thumbnail'] = $value->mediaGroup->thumbnail[0]->url;
            $top_rated_video[$i]['stats_view'] = $value->getVideoViewCount();
            $top_rated_video[$i]['tags'] = $value->getVideoTags();
            foreach ($value->mediaGroup->content as $x) {
                if ($x->type == 'application/x-shockwave-flash') {
                    $top_rated_video[$i]['video_url'] = $x->url;
                    break;
                }
            }
            $i++;
        }

        return $top_rated_video;
    }

}

if (!function_exists('get_video_comment')) {

    /**
     * get_video_comment
     * @author Lisman Tua Sihotang <lisman.sihotang@gmail.com>
     * @date 24 June 2014
     * 
     * @param type $video_id
     */
    function get_video_comment($video_id) {
        Zend_Loader_Autoloader::getInstance();
        $yt = new Zend_Gdata_YouTube();
        $url = 'http://gdata.youtube.com/feeds/api/videos/' . $video_id . '/comments';
//        $arr_comment = $yt->getVideoCommentFeed($video_id);
        $arr_comment = $yt->getVideoCommentFeed(null, $url);
        $i = 0;
        foreach ($arr_comment as $comment) {
            if (!empty($comment->title->text)) {
                $result[$i]['title'] = $comment->title->text;
                $result[$i]['comment'] = $comment->content->text;
                $result[$i]['author'] = $comment->author[0]->name->text;
                $i++;
            }
        }

        return $result;
    }

}

if (!function_exists('get_video_count')) {

    /**
     * get_video_count
     * @author Lisman Tua Sihotang <lisman.sihotang@gmail.com>
     * @date 24 June 2014
     * 
     * @param type $video_id
     * @return type
     */
    function get_video_count($video_id) {
        Zend_Loader_Autoloader::getInstance();
        $yt = new Zend_Gdata_YouTube();
        $video_entry = $yt->getVideoEntry($video_id);

        return $video_entry->getVideoViewCount();
    }

}

if (!function_exists('get_activity')) {

    /**
     * get_activity
     * @author Lisman Tua Sihotang <lisman.sihotang@gmail.com>
     * @date 24 June 2014
     * 
     * @param type $limit
     * @return type
     */
    function get_activity($limit) {
        Zend_Loader_Autoloader::getInstance();
        $httpClient = Zend_Gdata_ClientLogin::getHttpClient(
                        $username = user, $password = password, $service = 'youtube', $client = null, $source = 'JCChannel', $loginToken = null, $loginCaptcha = null, authenticationURL);

        $yt = new Zend_Gdata_YouTube($httpClient, appId, clientId, devKey);
        $yt->setMajorProtocolVersion(2);

        $arr_activity = $yt->getActivityForUser('cbnindonesia');
        $i = 0;
        foreach ($arr_activity as $row) {
            if ($i < $limit) {
                $activity[$i] = get_video_detail($row->getVideoId()->text);
            }
            $i++;
        }

        return $activity;
    }

}

if (!function_exists('get_video_detail')) {

    /**
     * get_video_detail
     * @author Lisman Tua Sihotang <lisman.sihotang@gmail.com>
     * @date 24 June 2014
     * 
     * @param type $video_id
     * @return type
     */
    function get_video_detail($video_id) {
        Zend_Loader_Autoloader::getInstance();
        $video = array();

        try {
            $httpClient = Zend_Gdata_ClientLogin::getHttpClient(
                            $username = user, $password = password, $service = 'youtube', $client = null, $source = 'JCChannel', $loginToken = null, $loginCaptcha = null, authenticationURL);

            $yt = new Zend_Gdata_YouTube($httpClient, appId, clientId, devKey);
            $yt->setMajorProtocolVersion(2);

            $videoEntry = $yt->getVideoEntry($video_id);
            $videoThumbnails = $videoEntry->getVideoThumbnails();
            $video = array(
                'category' => $videoEntry->getCategory()[1]->label,
                'thumbnail' => $videoThumbnails[0]['url'],
                'title' => $videoEntry->getVideoTitle(),
                'description' => $videoEntry->getVideoDescription(),
                'tags' => implode(', ', $videoEntry->getVideoTags()),
                'url' => $videoEntry->getVideoWatchPageUrl(),
                'flash' => $videoEntry->getFlashPlayerUrl(),
                'duration' => $videoEntry->getVideoDuration(),
                'id' => $videoEntry->getVideoId()
            );
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }

        return $video;
    }

}

if (!function_exists('get_new_video')) {

    /**
     * get_new_video
     * @author Lisman Tua Sihotang <lisman.sihotang@gmail.com>
     * @date 27 June 2014
     * 
     * @param type $limit
     * @return type
     */
    function get_new_video($limit) {
        Zend_Loader_Autoloader::getInstance();
        $httpClient = Zend_Gdata_ClientLogin::getHttpClient(
                        $username = user, $password = password, $service = 'youtube', $client = null, $source = 'JCChannel', $loginToken = null, $loginCaptcha = null, authenticationURL);

        $yt = new Zend_Gdata_YouTube($httpClient, appId, clientId, devKey);
        $yt->setMajorProtocolVersion(2);

        $arr_new = $yt->getActivityForUser('cbnindonesia');
        $i = 0;
        foreach ($arr_new as $row) {
            if ($i < $limit) {
                $new_video[$i] = get_video_detail($row->getVideoId()->text);
            }
            $i++;
        }

        return $new_video;
    }

}

if (!function_exists('get_header_playlist')) {

    function get_header_playlist() {
        Zend_Loader_Autoloader::getInstance();
        $httpClient = Zend_Gdata_ClientLogin::getHttpClient(
                        $username = user, $password = password, $service = 'youtube', $client = null, $source = 'JCChannel', $loginToken = null, $loginCaptcha = null, authenticationURL);

        $yt = new Zend_Gdata_YouTube($httpClient, appId, clientId, devKey);
        $yt->setMajorProtocolVersion(2);
//        $arr_list = $yt->getPlaylistListFeed('default');
        $arr_list = $yt->getPlaylistListFeed(null, "http://gdata.youtube.com/feeds/api/users/cbnindonesia/playlists");
        $i = 0;
        foreach ($arr_list as $list) {
            $feed_list[$i]['title'] = $list->title->text;
            $feed_list[$i]['url'] = $list->getPlaylistVideoFeedUrl();
            $i++;
        }
        debug($arr_list);
        return $feed_list;
    }

}

if (!function_exists('get_detail_playlist')) {

    function get_detail_playlist($feed_url, $limit = null) {
        Zend_Loader_Autoloader::getInstance();
        $httpClient = Zend_Gdata_ClientLogin::getHttpClient(
                        $username = user, $password = password, $service = 'youtube', $client = null, $source = 'JCChannel', $loginToken = null, $loginCaptcha = null, authenticationURL);

        $yt = new Zend_Gdata_YouTube($httpClient, appId, clientId, devKey);
        $yt->setMajorProtocolVersion(2);

        $list = $yt->getPlaylistVideoFeed($feed_url);
        $i = 0;
        foreach ($list as $detail) {
            $detail_list[$i]['list_video'] = get_video_detail($detail->getVideoId());
            $i++;
        }

        return $detail_list;
    }

}

//if (!function_exists('set_video_comment')) {
//
//    function set_video_comment() {
//        Zend_Loader_Autoloader::getInstance();
////        
//        $httpClient = Zend_Gdata_ClientLogin::getHttpClient(
//                        $username = user, $password = password, $service = 'youtube', $client = null, $source = 'JCChannel', $loginToken = null, $loginCaptcha = null, authenticationURL);
////        $client = new Zend_Gdata_HttpClient();
////        $httpClient = $client->setClientLoginToken($token);
//        $yt = new Zend_Gdata_YouTube_CommentEntry($httpClient);
//        $yt->setMajorProtocolVersion(2);
//
//        $newComment = $yt->newCommentEntry('3reB3nsZyqs');
//        $newComment->content = $yt->newContent()->setText('new comment');
//
//// post the comment to the comments feed URL for the video
//        $commentFeedPostUrl = $videoEntry->getVideoCommentFeedUrl();
//        $updatedVideoEntry = $yt->insertEntry($newComment, $commentFeedPostUrl, 'Zend_Gdata_YouTube_CommentEntry');
//    }
//
//}
//
//if (!function_exists('get_user_auth')) {
//
//    function get_user_auth($gmail_acc, $gmail_pass) {
//        $httpClient = null;
//        Zend_Loader_Autoloader::getInstance();
////        $authenticationURL = 'https://www.google.com/accounts/ClientLogin';
////        $httpClient = Zend_Gdata_ClientLogin::getHttpClient(
////                        $username = $gmail_acc, $password = $gmail_pass, $service = 'youtube', $client = null, $source = 'JCChannel',
////                        $loginToken = null, $loginCaptcha = null, $authenticationURL);
////        return $httpClient;
//        try {
////            $authenticationURL = 'https://www.google.com/accounts/ClientLogin';
//            $httpClient = Zend_Gdata_ClientLogin::getHttpClient($gmail_acc, $gmail_pass, 'youtube');
//            $AuthToken = $httpClient->getClientLoginToken();
//
////            $client = new Zend_Gdata_HttpClient();
////            $httpClient = $client->setClientLoginToken($AuthToken);
//        } catch (Zend_Gdata_App_CaptchaRequiredException $cre) {
//            echo 'URL of CAPTCHA image: ' . $cre->getCaptchaUrl() . "\n";
//            echo 'Token ID: ' . $cre->getCaptchaToken() . "\n";
//        } catch (Zend_Gdata_App_AuthException $ae) {
//            echo 'Problem authenticating: ' . $ae->exception() . "\n";
//        }
//
//
////        echo $AuthToken;
////        $yt = new Zend_Gdata_YouTube($httpClient);
//
//        return $AuthToken;
//    }
//
//}
//
//function get_user($gmail_acc, $gmail_pass) {
//    Zend_Loader_Autoloader::getInstance();
//    $service = Zend_Gdata_YouTube::AUTH_SERVICE_NAME;
//    $users = null;
//    try {
//        $client = Zend_Gdata_ClientLogin::getHttpClient($gmail_acc, $gmail_pass, $service);
//        $gdata = new Zend_Gdata_YouTube($client);
//        $users = $gdata->isAuthenticated();
//    } catch (Zend_Gdata_App_Exception $ex) {
//        debug($ex->getMessage());
//    }
//    return $users;
//}
