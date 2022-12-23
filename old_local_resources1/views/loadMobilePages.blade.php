<?php  foreach($mobileData as $data){ 
    if($data['type'] == 'network'){
        $network = $data['data'];
    ?>
    <div class="single-network-cat-full network_{{$network->id}}">
        <img src="{{asset('uploads/network/thumb_'.$network->image_path)}}" alt="img">
        <p><a href="{{url('network/'.$network->url)}}">{{$network->title}}</a></p>
        <?php if(Auth::user()){?>
            <a onclick="subscibeToNetwork('{{$network->id}}')" href="javascript:;" class="tp-right-link" id="network_{{$network->id}}_sub">
                <div class="text-user-not-subscribed">Bliv medlem</div>
                <!--  User is subscribed, but has mouseover and is ready to subscribe. -->
                <div class="text-user-subscribing" style="display:none;"><span>+</span>Bliv medlem</div>

            </a>

            <a href="javascript:;" style="display:none" class="tp-right-link" onclick="makeUnscribe('{{$network->id}}');" id="network_{{$network->id}}_unsub">
                <div class="text-user-subscribed">Medlem</div>
                <!--  User is subscribed, but has mouseover and is ready to subscribe. -->
                <div class="text-user-un-subscribing" style="display:none;"><span>-</span>Forlad</div>
            </a>
        <?php } ?>
    </div>
    <div class="single-network-cat-des-full network_{{$network->id}}">
        <p>
            <?php echo shortString($network->details,200) ?> 
        </p>
    </div>
<?php }else if($data['type'] == 'ad'){
    $postData = $data['PostExtraData'];
    $post = $data['data']; ?>
    @include('adview',['post'=>$post,'postData'=>$postData])
<?php }else{ 
    $postData = $data['PostExtraData'];
    $post = $data['data']; ?>
    @include('postview',['post'=>$post,'postData'=>$postData])
<?php }
} ?>
<?php if(!empty($mobileData)){ ?> 
<a class="nextPage" href="<?php echo $url;?>"><?php echo cmskey('load_more',true) ?></a>
<?php } ?>