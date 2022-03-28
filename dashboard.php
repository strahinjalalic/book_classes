<?php
 include('includes/header.php'); 
 include('includes/functions.php');
?>

<style>
    span {display:none;}
</style>

<div class="container" style="height:100%;">
    <div class="picker">
        <h3 style="text-align:center;font-size:45px;">Book your classes!</h3>
        <form method="POST">
            <label id="label_teacher_ch" for="teacher_ch">Choose teacher:</label>
            <select name="teacher_ch" id="teacher_ch" class="form-control">
                <option>Make wise choise!</option>
                <?php get_teachers(); ?>
            </select>
            <p id="selected_date"></p>
            <input id="date_picker_1" type="text" value="0" style="display:none;" />
            <div class="span_times"><span class="class_time_span" id="1700">17:00</span><span class="class_time_span" id="1730">17:30</span><span class="class_time_span" id="1800">18:00</span><span class="class_time_span" id="1830">18:30</span><span class="class_time_span" id="1900">19:00</span><span class="class_time_span" id="1930">19:30</span><span class="class_time_span" id="2000">20:00</span><span class="class_time_span" id="2030">20:30</span><span class="class_time_span" id="2100">21:00</span></div>
            <input type="hidden" name="time" />
            <a href="paypal_checkout.php" name="submit" id="submit_class" class="btn btn-primary" style="display:none;">Book</a>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type='application/javascript' src='js/main.js'></script>
<?php include('includes/footer.php'); ?>

<script>
$(document).ready(function() {
    localStorage.clear();


    const myDatePicker = MCDatepicker.create({ 
      el: '#date_picker_1' 
    })

myDatePicker.onSelect((date, formatedDate) =>  {
    document.getElementById('selected_date').innerHTML = 'You selected: <br />' + formatedDate 
    localStorage.setItem('classDate', date)     
    let times = document.getElementsByClassName('class_time_span')  
    for(time in times) {
        if(time != 'length' && time != 'item' && time != 'namedItem') {
            document.getElementsByClassName('class_time_span')[time].style.display = 'inline';
        }
    }

    let new_date = new Date(date);
    let formatted = new_date.toISOString().split('T')[0];
    let dataString = 'date='+formatted+'&teacher='+localStorage.getItem('teacher');

    $.ajax({
        type: 'POST',
        url: 'includes/get_booked.php',
        data: dataString,
        success: function(data) {
            data.split(',').forEach(function(item) {
                if(item != '') {
                    document.getElementById(item).style.background = 'red';
                    $("#"+item).css("pointer-events", "none");
                }
            });
        }
    });
});

});
</script>