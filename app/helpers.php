
<?php 

function fixbrokenHtml($sValue){
    $doc = new DOMDocument();
    $doc->substituteEntities = false;
    $content = mb_convert_encoding($sValue, 'html-entities', 'utf-8');
    @$doc->loadHTML($content);
    $sValue = $doc->saveHTML();
    return $sValue;
}
function getPlanTitle($plan){
    $package = new \App\Package;
    $pack = $package->where('plan',$plan)->first();
    if(!empty($pack)){
        return $pack->title;
    }
    return '';
}
function getPlanID($plan){
    $package = new \App\Package;
    $pack = $package->where('plan',$plan)->first();
    if(!empty($pack)){
        return $pack->reepay_plan_id;
    }
    return '';
}

function getPlanPrice($plan){
    $package = new \App\Package;
    $pack = $package->where('plan',$plan)->first();
    if(!empty($pack)){
        return $pack->price_inc_vat;
    }
    return '';
}

function isAdminPost($userID){
    if($userID == '1'){
        return true;
    }
    return false;
}
function getUserCompany(){
    $company = array();
    if(!empty(\Auth::user()->id)){
        $company = \Auth::user()->companies()->where('active',1)->first();
    }
    return $company;
}
function canComment(){
    if(!empty(\Auth::user()->id)){
        return true;
    }
    return false;
}
function postCommnet(Post $post,$comment){
    $postsObj = new \App\Repositories\Posts;
    $flag = $postsObj->canAddEditComment($comment);
    $commentData;
    if($flag){
        $commentData = $postsObj->getComment($comment);
    }
    return array('post'=>$post,'commentData'=>$commentData,'comment'=>$comment,'flag'=>$flag);
}
function canEdit($user,$created){
    if(Auth::user()->user_type == 'admin'){
        return true;
    }
    if(Auth::user()->id == $user){
        $timeLimit = "-1 day";
        $limitTimestamp = strtotime($timeLimit);
        $createdTimestamp = strtotime($created);
        if($createdTimestamp > $limitTimestamp){
            return true;
        }
    }
    return false;
}
function postTime($dataTime){
    if(empty($dataTime)){
        return;
    }
    $timeStamp = strtotime($dataTime);
    $nowTimeStamp = strtotime("now");
    $seconds_diff = $nowTimeStamp - $timeStamp;
    if($seconds_diff <= 300){
        return 'Lige Nu';
    }else if($seconds_diff < 3600){
        return ceil($seconds_diff/60).' minutter siden';
    }else if($seconds_diff < 86400){
        return ceil($seconds_diff/3600).' timer siden';
    }else if($seconds_diff < 172800){
        return 'I går';
    }else if($seconds_diff < 864000){
        return 'For '.ceil($seconds_diff/86400).' dage siden';
    }
    return YMD2MDY($dataTime,'.');

}
function shortString($string,$length){    
    return fixbrokenHtml(substr(strip_tags(html_entity_decode($string),'<br><b>'),0,$length).'...');
}
function shortStringComment($string,$length){    
    return substr(strip_tags(html_entity_decode($string),'<br><b>'),0,$length);
}
function stringLength($string){
    return strlen(strip_tags(html_entity_decode($string)));
}
function getManu(){
    return App\Content::getManu(); 
}
function cmskey($key,$striptags = false){
    if(!empty(Auth::user()) && \Auth::user()->user_type == 'admin'){
        return $key;
    }else{
        $val = \App\Text::getValBykey($key);
        if(!empty($val)){ 
            if($striptags ==  true){
                $val = strip_tags($val);
            }
        }else{
            $val = $key;       
        }
    }
    return $val;
}

function getNetworks(){
    $networks = App\Network::with('category')->get();
    $networksArr = array();
    foreach($networks as $network){
        $networksArr[$network->category->id]['title'] = $network->category->title;
        $networksArr[$network->category->id]['network'][$network->id] = $network->title;
    }
    return $networksArr;
}
function flash($message,$level = 'info'){
	session()->flash('flash_message',$message);
	session()->flash('flash_message_level',$level);
}
function stringToSlug($str){
	$str = strtolower(trim($str));
    // replace all non valid characters and spaces with an underscore
    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
    $str = preg_replace('/-+/', "_", $str);
    return $str;
}
function cropCentered($srPath, $desPath, $img, $w, $h) {
    $data = getimagesize($srPath . $img);
    $hr = $data[1] / $h;
    $wr = $data[0] / $w;
    $imgH = $imgW = 0;
    if ($wr < $hr) {
        $imgH = $h * $wr;
        $imgW = $w * $wr;
    } else {
        $imgH = $h * $hr;
        $imgW = $w * $hr;
    }
    $cx = $data[0] / 2;
    $cy = $data[1] / 2;
    $x = $cx - $imgW / 2;
    $y = $cy - $imgH / 2;
    if ($x < 0)
        $x = 0;
    if ($y < 0)
        $y = 0;
    return cropImage($srPath, $desPath, $img, $x, $y, $imgW, $imgH);
}

function cropImage($srPath, $path,  $image, $X, $Y, $targ_w, $targ_h) {
    ini_set("memory_limit", "256M");
    $caption = $image;
    echo $srPath.'=====';
    echo $image.'---';
    $data = getimagesize($srPath . $image);

    $org_w = $data[0];
    $org_h = $data[1];

    $jpeg_quality = 99;
    if ($org_w > $targ_w) {
        $org_w = $targ_w;
    }
    if ($org_h > $targ_h) {
        $org_h = $targ_h;
    }

    $imageName = $image;
    $ext = @strtolower(array_pop(explode(".", $imageName)));
    $src = $srPath . $imageName;

    $img_r = null;
    if ($ext == 'gif') {
        $img_r = imagecreatefromgif($src);
    } else if ($ext == 'png') {
        $img_r = imagecreatefrompng($src);
    } else {
        $img_r = imagecreatefromjpeg($src);
    }

    $dst_r = ImageCreateTrueColor($targ_w, $targ_h);
    imagecopyresampled($dst_r, $img_r, 0, 0, $X, $Y, $targ_w, $targ_h, $org_w, $org_h);

    $image_location = $path . $imageName;
    if (file_exists($image_location)) {
        unlink($image_location);
    }
    if ($ext == 'gif') {
        imagegif($dst_r, $image_location);
    } else if ($ext == 'png') {
        imagepng($dst_r, $image_location);
    } else {
        imagejpeg($dst_r, $image_location, $jpeg_quality);
    }
    return;
}
function make_thumb($src, $dest, $desired_width, $ext) {
    $jpeg_quality = 80;
    $source_image = null;
    if ($ext == 'gif') {
        $source_image = imagecreatefromgif($src);
    } else if ($ext == 'png') {
        $source_image = imagecreatefrompng($src);
    } else {
        $source_image = imagecreatefromjpeg($src);        
    }

    /* read the source image */
    $width = imagesx($source_image);
    $height = imagesy($source_image);
    /* find the "desired height" of this thumbnail, relative to the desired width  */
    $desired_height = floor($height * ($desired_width / $width));

    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

    /* create the physical thumbnail image to its destination */
    if ($ext == 'gif') {
        imagegif($virtual_image, $dest);
    } else if ($ext == 'png') {
        imagepng($virtual_image, $dest);
    } else {
        imagejpeg($virtual_image, $dest, $jpeg_quality);
    }
}

function YMD2MDY($date, $join = '-') {
    $dateArr = preg_split("/[- ]/", $date);
    return $dateArr[2] . $join. $dateArr[1] . $join . $dateArr[0];
}

function rtime($date, $join = '-') {
    $dateArr = preg_split("/[-: ]/", $date);
    return date("H:i:s", mktime($dateArr[3], $dateArr[4], $dateArr[5], $dateArr[1], $dateArr[2], $dateArr[0]));
}

function arrangeAdColData($ad, $network){
        $colArr = array();
        $index = 0;
        if(!empty($ad['Post'][0])){
            $colArr[$index]['type'] = 'ad';
            $colArr[$index]['data'] = $ad['Post'][0];
            $colArr[$index]['PostExtraData'] = !empty($ad[$ad['Post'][0]->id]) ? $ad[$ad['Post'][0]->id]:array();
            $index++;
        }
        if(!empty($network[0])){
            $colArr[$index]['type'] = 'network';
            $colArr[$index]['data'] = $network[0];
            $index++;
        }
        if(!empty($ad['Post'][1])){
            $colArr[$index]['type'] = 'ad';
            $colArr[$index]['data'] = $ad['Post'][1];
            $colArr[$index]['PostExtraData'] = !empty($ad[$ad['Post'][1]->id]) ? $ad[$ad['Post'][1]->id]:array();
            $index++;
        }
        if(!empty($network[1])){
            $colArr[$index]['type'] = 'network';
            $colArr[$index]['data'] = $network[1];
            $index++;
        }
        if(!empty($ad['Post'][2])){
            $colArr[$index]['type'] = 'ad';
            $colArr[$index]['data'] = $ad['Post'][2];
            $colArr[$index]['PostExtraData'] = !empty($ad[$ad['Post'][2]->id]) ? $ad[$ad['Post'][2]->id]:array();
            $index++;
        }
        if(!empty($network[2])){
            $colArr[$index]['type'] = 'network';
            $colArr[$index]['data'] = $network[2];
            $index++;
        }
        if(!empty($ad['Post'][3])){
            $colArr[$index]['type'] = 'ad';
            $colArr[$index]['data'] = $ad['Post'][3];
            $colArr[$index]['PostExtraData'] = !empty($ad[$ad['Post'][3]->id]) ? $ad[$ad['Post'][3]->id]:array();
            $index++;
        }
        if(!empty($network[3])){
            $colArr[$index]['type'] = 'network';
            $colArr[$index]['data'] = $network[3];
            $index++;
        }
        if(!empty($ad['Post'][4])){
            $colArr[$index]['type'] = 'ad';
            $colArr[$index]['data'] = $ad['Post'][4];
            $colArr[$index]['PostExtraData'] = !empty($ad[$ad['Post'][4]->id]) ? $ad[$ad['Post'][4]->id]:array();
            $index++;
        }
        if(!empty($network[4])){
            $colArr[$index]['type'] = 'network';
            $colArr[$index]['data'] = $network[4];
            $index++;
        }
        if(!empty($ad['Post'][5])){
            $colArr[$index]['type'] = 'ad';
            $colArr[$index]['data'] = $ad['Post'][5];
            $colArr[$index]['PostExtraData'] = !empty($ad[$ad['Post'][5]->id]) ? $ad[$ad['Post'][5]->id]:array();
            $index++;
        }
        if(!empty($network[5])){
            $colArr[$index]['type'] = 'network';
            $colArr[$index]['data'] = $network[5];
            $index++;
        }
        if(!empty($ad['Post'][6])){
            $colArr[$index]['type'] = 'ad';
            $colArr[$index]['data'] = $ad['Post'][6];
            $colArr[$index]['PostExtraData'] = !empty($ad[$ad['Post'][6]->id]) ? $ad[$ad['Post'][6]->id]:array();
            $index++;
        }
        if(!empty($network[6])){
            $colArr[$index]['type'] = 'network';
            $colArr[$index]['data'] = $network[6];
            $index++;
        }
        return $colArr;
    }

    function arrangeHomeDataForMobile($feed1, $feed2,$feed3){
        $colArr = array();
        $index = 0;
        if(!empty($feed1['Post'][0])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed1['Post'][0];
            $colArr[$index]['PostExtraData'] = !empty($feed1[$feed1['Post'][0]->id]) ? $feed1[$feed1['Post'][0]->id]:array();
            $index++;
        }
        if(!empty($feed2['Post'][0])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed2['Post'][0];
            $colArr[$index]['PostExtraData'] = !empty($feed2[$feed2['Post'][0]->id]) ? $feed2[$feed2['Post'][0]->id]:array();
            $index++;
        }
        if(!empty($feed3[0])){
            $colArr[$index] = $feed3[0];
            $index++;
        }
        if(!empty($feed1['Post'][1])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed1['Post'][1];
            $colArr[$index]['PostExtraData'] = !empty($feed1[$feed1['Post'][1]->id]) ? $feed1[$feed1['Post'][1]->id]:array();
            $index++;
        }
        if(!empty($feed2['Post'][1])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed2['Post'][1];
            $colArr[$index]['PostExtraData'] = !empty($feed2[$feed2['Post'][1]->id]) ? $feed2[$feed2['Post'][1]->id]:array();
            $index++;
        }
        if(!empty($feed3[1])){
            $colArr[$index] = $feed3[1];
            $index++;
        }
        if(!empty($feed1['Post'][2])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed1['Post'][2];
            $colArr[$index]['PostExtraData'] = !empty($feed1[$feed1['Post'][2]->id]) ? $feed1[$feed1['Post'][2]->id]:array();
            $index++;
        }
        if(!empty($feed2['Post'][2])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed2['Post'][2];
            $colArr[$index]['PostExtraData'] = !empty($feed2[$feed2['Post'][2]->id]) ? $feed2[$feed2['Post'][2]->id]:array();
            $index++;
        }
        if(!empty($feed3[2])){
            $colArr[$index] = $feed3[2];
            $index++;
        }
        if(!empty($feed1['Post'][3])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed1['Post'][3];
            $colArr[$index]['PostExtraData'] = !empty($feed1[$feed1['Post'][3]->id]) ? $feed1[$feed1['Post'][3]->id]:array();
            $index++;
        }
        if(!empty($feed2['Post'][3])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed2['Post'][3];
            $colArr[$index]['PostExtraData'] = !empty($feed2[$feed2['Post'][3]->id]) ? $feed2[$feed2['Post'][3]->id]:array();
            $index++;
        }
        if(!empty($feed3[3])){
            $colArr[$index] = $feed3[3];
            $index++;
        }
        if(!empty($feed1['Post'][4])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed1['Post'][4];
            $colArr[$index]['PostExtraData'] = !empty($feed1[$feed1['Post'][4]->id]) ? $feed1[$feed1['Post'][4]->id]:array();
            $index++;
        }
        if(!empty($feed2['Post'][4])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed2['Post'][4];
            $colArr[$index]['PostExtraData'] = !empty($feed2[$feed2['Post'][4]->id]) ? $feed2[$feed2['Post'][4]->id]:array();
            $index++;
        }
        if(!empty($feed3[4])){
            $colArr[$index] = $feed3[4];
            $index++;
        }

        if(!empty($feed1['Post'][5])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed1['Post'][5];
            $colArr[$index]['PostExtraData'] = !empty($feed1[$feed1['Post'][5]->id]) ? $feed1[$feed1['Post'][5]->id]:array();
            $index++;
        }
        if(!empty($feed2['Post'][5])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed2['Post'][5];
            $colArr[$index]['PostExtraData'] = !empty($feed2[$feed2['Post'][5]->id]) ? $feed2[$feed2['Post'][5]->id]:array();
            $index++;
        }
        if(!empty($feed3[5])){
            $colArr[$index] = $feed3[5];
            $index++;
        }

        if(!empty($feed1['Post'][6])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed1['Post'][6];
            $colArr[$index]['PostExtraData'] = !empty($feed1[$feed1['Post'][6]->id]) ? $feed1[$feed1['Post'][6]->id]:array();
            $index++;
        }
        if(!empty($feed2['Post'][6])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed2['Post'][6];
            $colArr[$index]['PostExtraData'] = !empty($feed2[$feed2['Post'][6]->id]) ? $feed2[$feed2['Post'][6]->id]:array();
            $index++;
        }
        if(!empty($feed3[6])){
            $colArr[$index] = $feed3[6];
            $index++;
        }
        return $colArr;
    }