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

    $('#tolak').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget); // Button that triggered the modal

        var recipient = button.data('id'); // Extract info from data-* attributes

      

        var modal = $(this);

        modal.find("#id").val(recipient);
        var recipient2 = button.data('nama');
        modal.find("#namasiswa").text(recipient2);
    });

    $( "#sel" ).change(function() {
    if(this.value=="Ya"){
        $("#selek").css("display","block");
    }else{
        $("#selek").css("display","none");
    }
});

$('select.sk').live('change', function() {
    var index = $('select').index(this);
    if(this.value==1){
        
    }else if(this.value==2){
        
    }
});

$("#plus1").click(function(){
    $("#p2").append("<div class='form-inline' style='width:800px;;float:left'><br><div><?php echo "<select required class='form-control m-bot15' name='jurusan[]' style='float:left'> <option value=''> * Pilih Jurusan * </option>";  $jurusan = mysql_query("SELECT * FROM jurusan"); while($j = mysql_fetch_array($jurusan)){ echo " <option value='$j[id_jurusan]'> $j[nama_jurusan] </option>"; } echo " </select>"; ?> <input type='number' class='form-control' style='width:80px;float:left' name='jumlah[]' placeholder='Jml' required></div></div>");
});
    </script>


<script>

    $('#pilihpem').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget); // Button that triggered the modal

        var recipient = button.data('nis'); // Extract info from data-* attributes

      

        var modal = $(this);

        modal.find("#nis").val(recipient);


    });
$('#verifikasibimbingan').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget); // Button that triggered the modal

        var recipient = button.data('id'); // Extract info from data-* attributes


        var modal = $(this);

        modal.find("#id").val(recipient);

    });
    </script>
<script type="text/javascript" src="../js/ajax_daerah.js"></script>
  <link href="../css/admin.css" rel="stylesheet">
</body>
</html>
