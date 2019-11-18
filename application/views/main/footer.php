</div>
</div>
<!-- footer -->
<div class="navbar navbar-footer hidden">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <footer role="contentinfo">
                    <p class="left">Bootstrap 3.x Admin Theme</p>
                    <p class="right">&copy; 2013 <a href="http://www.meritoo.pl" target="_blank">Meritoo.pl</a></p>
                </footer>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?= base_url('assets') ?>/js/bootstrap.min.js"></script>

<script type="text/javascript" src="<?= base_url('assets') ?>/js/twitter-bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets') ?>/js/bootstrap-admin-theme-change-size.js"></script>
<script type="text/javascript" src="<?= base_url('assets') ?>/vendors/easypiechart/jquery.easy-pie-chart.js"></script>
<script type="text/javascript" src="<?= base_url('assets') ?>/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?= base_url('assets') ?>/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?= base_url('assets') ?>/js/jquery.popdown.js?v=1" /></script>


<script type="text/javascript">
var $ = jQuery.noConflict(); 
var audio = new Audio("<?= base_url('assets')?>/sound/y.mp3");
// Get the modal
var modal = document.getElementById('myModal');

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
function showModal(text) {
  modal.style.display = "block";
  document.getElementById('text').innerHTML=text;
}


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
function batal(){
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>index.php/adminx/batalBooking",
            success:
                    function (response) {
                        var hasil = response;
                        //alert(response);
                        if(hasil==1){
                            audio.play();
                            var r = confirm("ada kode booking yang harus di batalkan! Menuju halaman batal transaksi?");
                            if (r == true) {
                                window.location = "http://backendadmin.murahtiketnya.com/cancelled-trx";
                            } else {
                                return false
                            }
                            //alert("ada kode booking yang harus di batalkan!");
                            
                        }
                    }
        });
    }
		setInterval( function(){ 
    batal();
  }, 30000 );
        
		$(document).ready(function(){
		    Pusher.logToConsole = true;

        var pusher = new Pusher('177ba279f899d3a74dae', {
            cluster: 'ap1',
            forceTLS: true
        });
        var channel = pusher.subscribe('affanutama-production');
        channel.bind('notif', function(data) {
            ambilKomentar();
            //$('#chatAudio')[0].play();
            //alert("Data Transaksi Baru Masuk");
        });
        channel.bind('booking', function(data) {
            $('#chatAudio')[0].play();
            ambilKomentar();
            if(data){
                var tipe = "Tiket "+data['tipe'];
            }else{
                var tipe = 'Tiket Pesawat';
            }
            showModal("<h2>Data Transaksi "+data['tipe']+" Baru Masuk</h2>");
            //alert("Data Transaksi Baru Masuk");
        });
        channel.bind('konfirmasi', function(data) {
            //ambilKomentar();
            $('#chatAudio')[0].play();
            showModal("<h2>Data Konfirmasi Pembayaran"+data['tipe']+" Baru Masuk dengan ID Pemesanan :"+data['id_cust_order']+"</h2>");
            //alert("Data Konfirmasi Pembayaran Baru Masuk");
        });
			$('.popdown').popdown();
		});
	</script>

<script type="text/javascript">
    $(function () {
        // Easy pie charts
        $('.easyPieChart').easyPieChart({animate: 1000});
    });
</script>

<script>
    $(function () {
        //$('#chatAudio')[0].play();
        //showModal("<h2>Data Transaksi Baru Masuk</h2>");
        $("#start_show").datepicker({
            dateFormat: 'yy-mm-dd'
        });

        $("#end_show").datepicker({
            dateFormat: 'yy-mm-dd'
        });

        $(document).on('click', '.del_promo', function () {
            var r = confirm("Delete this promo?");
            if (r == true) {
                return true
            } else {
                return false
            }
        })

        $(document).on('click', '.confirmbayar', function () {
            var r = confirm("Konfirmasi pembayaran transaksi ini?");
            if (r == true) {
                return true
            } else {
                return false
            }
        })

        $(document).on('click', '.confirmtiket', function () {
            var r = confirm("Konfirmasi tiket transaksi ini?");
            if (r == true) {
                return true
            } else {
                return false
            }
        })

        $(document).on('click', '.deleteTrx', function () {
            var r = confirm("Konfirmasi transaksi ini dihapus?");
            if (r == true) {
                return true
            } else {
                return false
            }
        })

    });

    function ambilKomentar() {
        var audio = new Audio("<?= base_url('assets')?>/sound/y.mp3");
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>index.php/adminx/notif",
            dataType: 'json',
            success:
                    function (response){
                        if (response == 1) {
                            $("#jumlah").text("NEW");
                            $jumlahTrx = response;
                            $('#chatAudio')[0].play();
                            timer = setTimeout("ambilKomentar()", 5000);
                        } else {
                            //$('#chatAudio')[0].play();
                            var jumlahTrx = response;
                            $("#jumlah").text(jumlahTrx.pesawat);
                            $("#jumlah_kai").text(jumlahTrx.kereta);
                            $("#jumlah_pelni").text(jumlahTrx.pelni);
                            $("#jumlah_hotel").text(jumlahTrx.hotel);
                            $("#jumlah_konfirmasi").text(jumlahTrx.konfirmasi);
                            //
                            //timer = setTimeout("ambilKomentar()", 5000);
                        }
                    }
        });
    }
    

    $(document).ready(function () {
        ambilKomentar();
    });

    $(function () {
        $("#tabel").dataTable();
    });
	
</script>
<script>
    $(document).ready(function () {
        $("#flip").click(function () {
            $("#panel").slideDown("slow");

        });
    });
    $(document).ready(function () {
        $("#flipUp").click(function () {
            $("#panel").slideUp("slow");
        });
    });
</script>
</body>
</html>