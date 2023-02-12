
<div class="content-wrapper">

    <section class="content-header">
        
				<h1>Whatsapp API</h1>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body table-responsive">	
						<div id="app">
						<img src="" alt="QR Code" id="qrcode">
						<h3>Logs:</h3>
						<ul class="logs"></ul>
						</div>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function() {
			// var socket = io();
			var socket = io.connect('http://sipedas.sanggau.go.id', {path: "/lib/socket.io"});

			socket.on('message', function(msg) {
				$('.logs').append($('<li>').text(msg));
			});

			socket.on('qr', function(src) {
				$('#qrcode').attr('src', src);
				$('#qrcode').show();
			});

			socket.on('ready', function(data) {
				$('#qrcode').hide();
			});

			socket.on('authenticated', function(data) {
				$('#qrcode').hide();
			});
        
        	$('#reset').on('click', function(){
            	
            })
		});
	</script>