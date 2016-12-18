        
        <!--footer section start-->
        <footer class="sticky-footer">
            2015 &copy; Hubin by DeaEmalia
        </footer>
        <!--footer section end-->


    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="../js/jquery-1.10.2.min.js"></script>
<script src="../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/modernizr.min.js"></script>
<script src="../js/jquery.nicescroll.js"></script>

<!--dynamic table-->
<script type="text/javascript" language="javascript" src="../js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="../js/data-tables/DT_bootstrap.js"></script>

<!--dynamic table initialization -->
<script src="../js/dynamic_table_init.js"></script>

<!--common scripts for all pages-->
<script src="../js/scripts.js"></script>

<!--icheck -->
<script src="../js/iCheck/jquery.icheck.js"></script>
<script src="../js/icheck-init.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-timepicker.js"></script>

<!--pickers initialization-->
<script src="../js/pickers-init.js"></script>


<script type="text/javascript" src="../js/bootstrap-fileupload.min.js"></script>
<script type="text/javascript" src="../js/ckeditor/ckeditor.js"></script>


 <script type="text/javascript">
$(document).ready(function() {

    $(".prop2").change(function(){
        var id = $(this).val();
        $.get('select_daerah.php',{prop : id},function(data){
            $(".kota2").empty();
            $(".kota2").html(data);
        });
    });
    $(".kota2").change(function(){
        var id = $(this).val();
        $.get('select_daerah.php',{kab : id},function(data){
            $(".kec2").empty();
            $(".kec2").html(data);
        });
    });
    $(".kec2").change(function(){
        var id = $(this).val();
        $.get('select_daerah.php',{kec : id},function(data){
            $(".kel2").empty();
            $(".kel2").html(data);
        });
    });
    

    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append("<div class='form-inline' style='width:800px;;float:left'><br><div><?php echo "<select required class='form-control m-bot15 sk' name='jurusan[]' id='jur[]' style='float:left'> <option value=''> * Pilih Jurusan * </option>";  $jurusan = mysql_query("SELECT * FROM jurusan"); while($j = mysql_fetch_array($jurusan)){ echo " <option value='$j[id_jurusan]'> $j[nama_jurusan] </option>"; } echo " </select>"; ?> <input type='number' class='form-control' style='width:114px;float:left' name='jumlah[]' id='jl[]' placeholder='Jumlah' required> <div class='col-md-12' style='padding:0'><div class='col-md-8' style='padding:0 10px 0 0; width:67.666667%'><input type='text' name='skill[]' placeholder='Spesifikasi Keterampilan/Skill' class='form-control' style='width:100%' required>  </div><div class='col-md-12' style='padding:0'><small style='color: #D9534F'> Contoh : Web, Microcontroller, Video Editing, C++, Jaringan </small> </div></div><a href='#' class='remove_field'><button style=' margin-left:10px;margin-top: 1px;'class='btn btn-xs btn-danger add_field_button'><i class='fa fa-times-circle'></i></button></a></div></div>"); //add input box
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
  </script>

<script>

    $('#verifikasi_kerja').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget); // Button that triggered the modal

        var recipient = button.data('iddu'); // Extract info from data-* attributes

      

        var modal = $(this);

        modal.find("#iddu").val(recipient);


    });

    </script>
    <script>

    $('#tolak_kerja').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget); // Button that triggered the modal

        var recipient = button.data('iddu'); // Extract info from data-* attributes

      

        var modal = $(this);

        modal.find("#iddu").val(recipient);


    });

    </script>

    <script>

    $('#pilihmon').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget); // Button that triggered the modal

        var recipient = button.data('id'); // Extract info from data-* attributes

      

        var modal = $(this);

        modal.find("#id").val(recipient);

        var cityOptions = new Array();

          $.get("namaguru.php?id=" + 1, function(data) {

                eval(data);
                if(cityOptions.length > 0) {
                   $("#petugas").removeAttr("disabled");
                   $("#petugas").html('');
                   //repopulate child list with array from helper page
                   var city = document.getElementById('petugas');
                   for(var i = 0; i < cityOptions.length; i++) {
                      city.options[i] = new Option(cityOptions[i].text, cityOptions[i].value);
                   }
                }
             }
          );

    });

    </script>

    <script>

    $('#jurusan').change(function () {
    $("#petugas").attr("disabled", true);
       //clear child select list's options
       $("#petugas").html('');
     
       //querystring value is selected value of parent drop down list
       var qs = $("#jurusan").val();
       //if user selected a separator, show error
       if(qs == '') {
          alert('You cannot select this option. Please make a different selection.');
       }
       else {
          //show message indicating we're getting new values
          $("#petugas").append(new Option('Getting city list ...'));
          //declare options array and populate
          var cityOptions = new Array();

          $.get("namaguru.php?id=" + qs, function(data) {

                eval(data);
                if(cityOptions.length > 0) {
                   $("#petugas").removeAttr("disabled");
                   $("#petugas").html('');
                   //repopulate child list with array from helper page
                   var city = document.getElementById('petugas');
                   for(var i = 0; i < cityOptions.length; i++) {
                      city.options[i] = new Option(cityOptions[i].text, cityOptions[i].value);
                   }
                }
             }
          );
       }

});
    </script>
                  <script>

    $('#nilai').on('show.bs.modal', function (event) {

      var button = $(event.relatedTarget); // Button that triggered the modal
      var recipient = button.data('iddu'); // Extract info from data-* attributes
      var modal = $(this);
        $.ajax({
            type: 'POST',
            url: 'nilai.php',
            data: 'id='+recipient,
            dataType: 'json',
            success: function(result) {
                modal.find("#iddu").val(recipient);
                modal.find("#nilai").val(result['nilai']);
                modal.find("#kegiatan").val(result['kegiatan_siswa']);
                modal.find("#yg_menerima").val(result['yang_menerima']);
                modal.find("#masalah").val(result['masalah_yg_ditemukan']);
                modal.find("#saran").val(result['saran']);
            }
        })
     

    });
</script>
<script type="text/javascript" src="../js/ajax_daerah.js"></script>
  <link href="../css/admin.css" rel="stylesheet">
</body>
</html>
