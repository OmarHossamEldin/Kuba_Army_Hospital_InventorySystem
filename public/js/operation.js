$(document).ready(function() {
    /*-------------------------Start DashboardManu Page-----------------------------*/
    $(".dashbordManu").css("minHeight",$(window).height()-60); 
    $(".salesDashboard").click(function(){
        $(".stockSubDash,.importSubDash,.expenseSubDash,.supplierSubDash,.customerSubDash,.employerSubDash,.userDashboardSubDash").slideUp();
        $(".salesSubDash").slideToggle();
    });
    $(".stockDashboard").click(function(){
        $(".salesSubDash,.importSubDash,.expenseSubDash,.supplierSubDash,.customerSubDash,.employerSubDash,.userDashboardSubDash").slideUp();
        $(".stockSubDash").slideToggle();
    });
    $(".importDashboard").click(function(){
        $(".salesSubDash,.stockSubDash,.expenseSubDash,.supplierSubDash,.customerSubDash,.employerSubDash,.userDashboardSubDash").slideUp();
        $(".importSubDash").slideToggle();
    });
    $(".expenseDashboard").click(function(){
        $(".salesSubDash,.stockSubDash,.importSubDash,.supplierSubDash,.customerSubDash,.employerSubDash,.userDashboardSubDash").slideUp();
        $(".expenseSubDash").slideToggle();
    });
    $(".purchasesDashboard").click(function(){
        $(".salesSubDash,.stockSubDash,.importSubDash,.expenseSubDash,.supplierSubDash,.customerSubDash,.employerSubDash,.userDashboardSubDash").slideUp();
        $(".purchasesSubDash").slideToggle();
    });
    $(".supplierDashboard").click(function(){
        $(".salesSubDash,.stockSubDash,.importSubDash,.expenseSubDash,.customerSubDash,.employerSubDash,.userDashboardSubDash").slideUp();
        $(".supplierSubDash").slideToggle();
    });
    $(".customerDashboard").click(function(){
        $(".salesSubDash,.stockSubDash,.importSubDash,.expenseSubDash,.supplierSubDash,.employerSubDash,.userDashboardSubDash").slideUp();
        $(".customerSubDash").slideToggle();
    });
    $(".employerDashboard").click(function(){
        $(".salesSubDash,.stockSubDash,.importSubDash,.expenseSubDash,.supplierSubDash,.customerSubDash,.userDashboardSubDash").slideUp();
        $(".employerSubDash").slideToggle();
    });
    $(".userDashboard").click(function(){
        $(".salesSubDash,.stockSubDash,.importSubDash,.expenseSubDash,.employerSubDash,.supplierSubDash,.customerSubDash").slideUp();
        $(".userDashboardSubDash").slideToggle();
    });
    /*--------------------------End DashboardManu Page------------------------------*/
    
    /*------------------------------Start Date Page---------------------------------*/
    $('.dateText1').daterangepicker({autoClose:true,
                                    singleDatePicker: true,
                                    locale: {format: 'YYYY-MM-DD'},
                                    startDate:new Date(),
                                    singleDate: true
                                    }); 
    $('.dateText2').daterangepicker({autoClose:true,
                                    locale: {format: 'YYYY-MM-DD'},
                                    singleDatePicker: true,
                                    startDate:new Date(),
                                    singleDate: true
                                    });
    /*-------------------------------End Date Page----------------------------------*/
    
    /*----------------------------Start Select Function-----------------------------*/
    $(".payingWay select").on("change",function(){
        if($(this).val() == "قسط"){
            $(".payingWay input").slideDown();
        }else{
            $(".payingWay input").slideUp();
        }
    });
    /*-----------------------------End select Function------------------------------*/

    /*---------------------------Start Expences Function----------------------------*/
    //$(".statusInput, .descriptionInput").hide();
    $(".searchBy").on("change",function(){
        if($(this).val() == "النوع"){
            $(".statusInput").slideDown();
            $(".descriptionInput").slideUp();
        }else if($(this).val() == "الوصف"){
            $("select").removeClass('d-none');
            $(".descriptionInput").slideDown();

            $(".statusInput").slideDown();
        }else{
            $(".statusInput, .descriptionInput").slideUp();
        }
    });
    /*----------------------------End Expences Function-----------------------------*/

    /*-------------------Start AddSupplier & AddCustomer Page-----------------------*/
    var plusnum=0;
    $(".supplierMobPlus,.customerMobPlus").click(function(){
        plusnum++;
        $(this).before('<input type="tel" name="mobile'+plusnum+'" maxlength="11" placeholder="رقم التليفون أخر">');
        if(plusnum == 2){$(this).hide();}
    });

    /*---------------------End AddSupplier & AddCustomer Page-----------------------*/
    
    /*--------------------------Start AddEmployer Page------------------------------*/
    var plusnum=0;
    $(".empmobPlus").click(function(){
        $(this).before('<input type="tel" name="mobile2"  maxlength="11" placeholder="رقم التليفون أخر">');
        plusnum++;
        if(plusnum == 1){$(this).hide();}
    });
    /*---------------------------End AddEmployer Page-------------------------------*/
});