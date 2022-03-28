$(document).ready(function() {
    $('#reg_form').on('submit', function(e) {
        
        let response_p;
        let p_text;
        $.ajax({
            type: 'POST',
            url: 'register.php',
            async: true,
            data: $(this).serialize(),
            dataType: 'html',
            success: function(response) {
                response_p = $(response).find('#fill_out').text();
                p_text = $('#fill_out').text(response_p);
                localStorage.setItem('p_msg', p_text);
            }
        })
    })

    if($('#fill_out').text() != '') {
        $('#tab-2').prop('checked', true);
    }

    if($('#fill_out_login').text() != '') {
        $('#tab-1').prop('checked', true);
    }

    if($('#success_reg').text() != '') {
        $('#tab-2').prop('checked', true);
    }

    
    $('#selected_date').text() == '' ?  $('.class_time').css('display', 'none') :  $('.class_time').css('display', 'block')

    $('#selected_date').change(function() {
        console.log($('#selected_date'))
    })

    $('#teacher_ch').val() == 'Make wise choise!' ?  $('#date_picker_1').css('display', 'none') : ''

    $('#teacher_ch').change(function() {
        if($(this).val() != 'Make wise choise!') {
            $('#date_picker_1').focus();
            localStorage.setItem('teacher', $(this).val())
        } else {
            $('#date_picker_1').css('display', 'none')
        }
    })

    $('.span_times').click(function(e) {
        if(document.getElementById(e.target.id).style.background != 'green') {
            document.getElementById(e.target.id).style.background = 'green';
            let date = new Date(localStorage.getItem('classDate'));
            let formatted = date.toISOString().split('T')[0];
            localStorage.setItem('classDate', formatted);
            let time = e.target.textContent;
            
            localStorage.setItem('time'+e.target.id, time);
            if($('#submit_class').css('display', 'none')) {
                $('#submit_class').css('display', 'block')
            }

            if(localStorage.getItem('price')) {
                let price = parseInt(localStorage.getItem('price'));
                price += parseInt(25);
                localStorage.setItem('price', price);
            } else {
                localStorage.setItem('price', parseInt(25));
            }

            for(i=0; i<localStorage.length; i++) {
                if(localStorage.key(i).includes("time")) {
                    console.log(localStorage.key(i))
                }
            }

        } else {
            document.getElementById(e.target.id).style.background = 'darkgray'
            localStorage.setItem('price', parseInt(localStorage.getItem('price') - 25));
            localStorage.removeItem('time'+e.target.id)
        }
    })


})


paypal.Buttons({
    style : {
        color: 'blue',
        shape: 'pill'
    },
    createOrder: function (data, actions) {
        return actions.order.create({
            purchase_units : [{
                amount: {
                    value: localStorage.getItem('price'),
                    currency: 'USD'
                }
            }]
        });
    },
    onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
            console.log(details)
            //window.location.replace("http://localhost:63342/tutorial/paypal/success.php")
        })
    },
    onCancel: function (data) {
       // window.location.replace("http://localhost:63342/tutorial/paypal/Oncancel.php")
    }
}).render('#paypal-payment-button');