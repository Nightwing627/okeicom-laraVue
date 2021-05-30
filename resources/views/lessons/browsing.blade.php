@extends('layouts.user-single')
​
<!-- タイトル・メタディスクリプション -->
@section('title', 'レッスン閲覧画面')
@section('description', 'レッスン閲覧画面')
​
<!-- CSS -->
@push('css')
<!-- 吉田豊が修正しました -->
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
@endpush
​
<!-- 本文 -->
@section('content')
<!-- 吉田豊が修正しました -->
	@if($lesson->type == 2)
	<div class="all-body" >
		<div class="l-wrap--title d_title">
	@else
	<div class="l-wrap--single">
		<div class="l-wrap--title">
	@endif

			<h1 class="c-headline--screen">レッスン受講画面</h1>
		</div>
		@if($lesson->type !== 2)
		<div class="l-wrap--body">
			<div class="l-wrap--main l-wrap--detail">
				<div class="l-content--detail">
					<div class="l-content--detail__inner">
                        <div class="browsing-url">
                            <a class="u-text--link" target="_blank" rel="noopener noreferrer" href="https://www.youtube.com/watch?v=rOho8r3Y2_k">https://www.youtube.com/watch?v=rOho8r3Y2_k</a>
                        </div>
					</div>
				</div>
			</div>
		</div>
		@else
		<div id="my_pdf_viewer" class="viewer_pdf">
			<div id="canvas_container" class="canvas-content">
				<canvas id="pdf_renderer"></canvas>
			</div>

			<div id="navigation_controls" class="control-body">
				<button class="prev-button" id="go_previous" type="button">前へ</button>
				<input id="current_page" value="1" type="number" class="page"/>
				<button class="next-button" id="go_next" type="button">次へ</button>
​
			</div>

			<!-- <div id="zoom_controls" class="zoom-body">
				<button id="zoom_in" class="zoom-in">+</button>
				<button id="zoom_out" class="zoom-out">-</button>
			</div> -->
		</div>
		<!-- 吉田豊が修正しました -->
		@endif
	</div>
@endsection
​
@section('script')
<!-- 吉田豊が修正しました -->
<script
    src="http://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js">
</script>
<script>
        var myState = {
            pdf: null,
            currentPage: 1,
            zoom: 1.4
        }

        pdfjsLib.getDocument("{{ asset('storage/lesson/'. $lesson->view.'/'.$lesson->slide.'.pdf')}}").then((pdf) => {

            myState.pdf = pdf;
            render();

        });

        function render() {
            myState.pdf.getPage(myState.currentPage).then((page) => {

                var canvas = document.getElementById("pdf_renderer");
                var ctx = canvas.getContext('2d');

                var viewport = page.getViewport(myState.zoom);

                canvas.width = viewport.width;
                canvas.height = viewport.height;

                page.render({
                    canvasContext: ctx,
                    viewport: viewport
                });
            });
        }

        document.getElementById('go_previous').addEventListener('click', (e) => {
            prev_event();
        });

		function prev_event(){
            if(myState.pdf == null || myState.currentPage == 1)
            return;
            myState.currentPage -= 1;
            document.getElementById("current_page").value = myState.currentPage;
            render();
		}

        document.getElementById('go_next').addEventListener('click', (e) => {
            next_event();
        });
​
		function next_event(){

			if(myState.pdf == null || myState.currentPage == myState.pdf._pdfInfo.numPages) {

			}else{
				myState.currentPage += 1;
				document.getElementById("current_page").value = myState.currentPage;
				render();
			}
		}

		document.addEventListener('keydown', (e) =>{

			var code = (e.keyCode ? e.keyCode : e.which);
			console.log(code)
			if(code == 37){
				prev_event();
			}
			if(code == 39){
				next_event();
			}
			if(code == 38){
				zoom_in();
			}
			if(code == 40){
				zoom_out();
			}
		});

        document.getElementById('current_page').addEventListener('keypress', (e) => {
            if(myState.pdf == null) return;

            // Get key code
            var code = (e.keyCode ? e.keyCode : e.which);
			console.log(code)
            // If key code matches that of the Enter key
            if(code == 13) {
                var desiredPage =
                document.getElementById('current_page').valueAsNumber;

                if(desiredPage >= 1 && desiredPage <= myState.pdf._pdfInfo.numPages) {
                    myState.currentPage = desiredPage;
                    document.getElementById("current_page").value = desiredPage;
                    render();
                }
            }

        });

        document.getElementById('zoom_in').addEventListener('click', (e) => {
            zoom_in();
        });
​
		function zoom_in(){
			if(myState.pdf == null) return;
            myState.zoom += 0.5;
            render();
		}

        document.getElementById('zoom_out').addEventListener('click', (e) => {
            zoom_out();
        });
​
		function zoom_out(){
			if(myState.pdf == null) return;
            myState.zoom -= 0.5;
            render();
		}
    </script>
@endsection
