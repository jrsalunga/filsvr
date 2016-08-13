
$(document).ready(function () {
 alert("test")
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
        
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".btn-primary").click(function (e) {

        var $active = $('.wizard .nav-wizard li.active');
        $active.next().removeClass('disabled');
        nextTab($active);
    });

});

    $('input[type=radio][name=payment-option]').change(function() {
        
        if (this.value == 'full') {
          
        }
        else if (this.value == 'partial') {
       
        }
    });


    $('.range').datepicker({
        inputs: $('.range-start, .range-end')
    });

    $('#checkin-datepicker').datepicker();
    $('#checkin-datepicker').on("changeDate", function() {
        $('#my_hidden_input').val(
            $('#datepicker').datepicker('getFormattedDate')
            );
    });


    $('#checkout-datepicker').datepicker();
    $('#checkout-datepicker').on("changeDate", function() {
        $('#my_hidden_input').val(
            $('#datepicker').datepicker('getFormattedDate')
            );
    });
    
    function nextTab(elem) {
        $(elem).next().find('a[data-toggle="tab"]').click();
    }

