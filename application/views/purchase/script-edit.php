<script>
    //==============================for edit page=========================

    //3rd part calculation
    var countproduct=$("#count_product").val();
    var count=1;
    var countqtyrate=0;
    var countvat=0;
    for(count;count<=countproduct;count++){
    //3rd part
    var qty2=parseInt($("#qty"+count).val());
    var rate2=parseInt($("#rate"+count).val());
    var vat2 = parseInt($("#vat"+count).val());
    var discountsingle2 = parseInt($("#discountsingle"+count).val());

    var qtyrate=qty2 * rate2;
    var vatamount=(qtyrate-qtyrate*(discountsingle2/100)) * (vat2/100); //Vat amount
    var amount= qtyrate-(qtyrate*(discountsingle2/100))  //Amount
    countqtyrate=countqtyrate + amount;  //Total quantity* qty
    countvat=countvat + vatamount;  //Total vat
    }
    var discount=$("#discount").val();
    var totalamount= countqtyrate;  //total amount
    var grandtotal= totalamount + countvat;  //grand total
    var netamount= grandtotal - discount;  //net amount


    document.getElementById("total_amout").innerHTML=totalamount;
    $(".total_amout").val(totalamount);

    document.getElementById("total_vat").innerHTML=countvat;
    $(".total_vat").val(countvat);

    document.getElementById("grandtotal").innerHTML=grandtotal;
    $(".grandtotal").val(grandtotal);

    document.getElementById("net_amout").innerHTML=netamount;
    $(".net_amout").val(netamount);




    //3rd part for discount

    $("#discount").change(function(){
        var grandtotal=$(".grandtotal").val();
        var discount=$("#discount").val();
        var net_amout=grandtotal-discount;

        document.getElementById("net_amout").innerHTML=net_amout;
        $(".net_amout").val(net_amout);
    });


    //click on reset for products
    $("#product-reset").click(function(){
        $("#product_name").val("");
        $("#qtyi").val("");
        $("#unit").val("");
        $("#unitshow").val("");
        $("#ratei").val("");
        $("#sale_ratei").val("");
        $("#discountsinglei").val("");
        $("#vati").val("");
    });

    //when click on rows
    $(".single_row").click(function(){
        var no=$(this).attr("id");
        var product_id=$("#product_id"+no).val();
        var qty=$("#qty"+no).val();
        var unit_id=$("#unit_id"+no).val();
        var unit_name=$(".unit_id"+no).text();
        var rate=$("#rate"+no).val();
        var salerate=$("#salerate"+no).val();
        var discountsingle=$("#discountsingle"+no).val();
        var vat=$("#vat"+no).val();
        //paste values
        $("#product_name").val(product_id);
        $("#qtyi").val(qty);
        $("#unit").val(unit_id);
        $("#unitshow").val(unit_name);
        $("#ratei").val(rate);
        $("#sale_ratei").val(salerate);
        $("#discountsinglei").val(discountsingle);
        $("#vati").val(vat);
        $("#count").val(no);

        //when click on edit
        $("#addpurchase").click(function(){
            var product_name=$("#product_name").val();
            var qtyi=$("#qtyi").val();
            var unit=$("#unit").val();
            var ratei=$("#ratei").val();
            var sale_ratei=$("#sale_ratei").val();
            var discountsinglei=$("#discountsinglei").val();
            var vati=$("#vati").val();
            var count=$("#count").val();

            if(vati==""){
                vati=0.00;
            }
            if(sale_ratei==""){
                sale_ratei=0.00;
            }
            if(discountsinglei==""){
                discountsinglei=0.00;
            }
            if(product_name==""){
                $("#product_name").css('border-color', 'red');
                return false;
            }else{
                $("#product_name").css('border-color', '#898990');
            }
            if(qtyi==""){
                $("#qtyi").css('border-color', 'red');
                return false;
            }else{
                $("#qtyi").css('border-color', '#898990');
            }
            if(ratei==""){
                $("#ratei").css('border-color', 'red');
                return false;
            }else{
                $("#ratei").css('border-color', '#898990');
            }

            $("#product_id"+count).val(product_name);
            //$(".product_id"+count).text(product_name);
            $("#qty"+count).val(qtyi);
            $(".qty"+count).text(qtyi);
            $("#unit_id"+count).val(unit);

            $("#rate"+count).val(ratei);
            $(".rate"+count).text(ratei);
            $("#salerate"+count).val(sale_ratei);
            $(".salerate"+count).text(sale_ratei);
            $("#discountsingle"+count).val(discountsinglei);
            $(".discountsingle"+count).text(discountsinglei);
            $("#vat"+count).val(vati);
            $(".vat"+count).text(vati);

            var dataString = "product_id=" + product_name + "&unitid=" + unit
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('purchase/purchase/dataqueryedit'); ?>",
                data: dataString,
                success: function (data) {
                   var res= data.split(",");
                    $('.product_id'+count).text(res[0]);
                    $(".unit_id"+count).text(res[1]);
                }
            });


            //3rd part calculation after click on edit
            var countproduct=$("#count_product").val();
            var count=1;
            var countqtyrate=0;
            var countvat=0;
            for(count;count<=countproduct;count++){
                //3rd part
                var qty2=parseInt($("#qty"+count).val());
                var rate2=parseInt($("#rate"+count).val());
                var vat2 = parseInt($("#vat"+count).val());
                var discountsingle2 = parseInt($("#discountsingle"+count).val());

                var qtyrate=qty2 * rate2;
                var vatamount=(qtyrate-qtyrate*(discountsingle2/100)) * (vat2/100); //Vat amount
                var amount= qtyrate-(qtyrate*(discountsingle2/100))  //Amount
                countqtyrate=countqtyrate + amount;  //Total quantity* qty
                countvat=countvat + vatamount;  //Total vat
            }

            var discount=$("#discount").val();
            var totalamount= countqtyrate;  //total amount
            var grandtotal= totalamount + countvat;  //grand total
            var netamount= grandtotal - discount;  //net amount


            document.getElementById("total_amout").innerHTML=totalamount;
            $(".total_amout").val(totalamount);

            document.getElementById("total_vat").innerHTML=countvat;
            $(".total_vat").val(countvat);

            document.getElementById("grandtotal").innerHTML=grandtotal;
            $(".grandtotal").val(grandtotal);

            document.getElementById("net_amout").innerHTML=netamount;
            $(".net_amout").val(netamount);


            $("#product_name").val("");
            $("#qtyi").val("");
            $("#unit").val("");
            $("#unitshow").val("");
            $("#ratei").val("");
            $("#sale_ratei").val("");
            $("#discountsinglei").val("");
            $("#vati").val("");

        });
    });


    //show unit id
    $("#product_name").change(function(){
        var product_id=$(this).val();
        //alert(product_id);
        var dataString = "product_id=" + product_id;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('purchase/purchase/unit_name'); ?>",
            data: dataString,
            success: function (data) {
                var res = data.split(",");
                $("#unitshow").val(res[1]);
                $("#unit").val(res[0]);
            }
        });
    });

    //Date time picker
    <?php $this->sessiondata = $this->session->userdata('logindata'); ?>
    var start_date = "<?php echo $this->sessiondata['mindate']; ?>";
    var end_date = "<?php echo $this->sessiondata['maxdate']; ?>";
    $('#datetimepicker').datetimepicker({
        dayOfWeekStart : 1,
        lang:'en',
        disabledDates:['1986-01-08','1986-01-09','1986-01-10'],
        startDate:'2014-12-01',
        minDate:start_date,
        maxDate:end_date,
        timepicker:false
    });
</script>