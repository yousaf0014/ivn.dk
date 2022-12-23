<?php
$meta_title_content = $keywords_for_layout =  $description_for_layout = $title_for_layout = $title = '503';
?>
@extends('layouts.default.app')
@section('content')
<div id="cover"  class="bg-white">
        <img class="img-responsive" src="{{asset('images/404.jpg')}}">
    </section>
    <section id="content-area"  class="bg-white" >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div style="margin:auto">
                        <h2 class="text-center">ØV!</h2>
                        <p class="text-center">Du surfer hurtigere end vi kan nå at programmere.</p>
                        <p class="text-center">Skynd dig tilbage til <a href="{{url('/')}}">forsiden</a>.</p>
                        <p class="text-center">Eller skriv til os på fejl@ivn.dk.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="footer"></section>
</div> <!-- main cover end -->
@endsection