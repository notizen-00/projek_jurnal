<script type="text/javascript">

    $(document).ready(function() {

        $("#table-pajak").DataTable();
        $("#table_komisi").DataTable();

        var form_komisi = $("#form_komisi");
        $(".buat_komisi").click(function(e){
            e.preventDefault()
            
            $("#create_komisi").modal('show')

            $(".reset_form").click(function(e){
            e.preventDefault();
        
            $(this).closest('form').find("input,textarea").val("");
            $(this).closest('form').find("select").val("1");


        })
          
        })

      

    })


</script>