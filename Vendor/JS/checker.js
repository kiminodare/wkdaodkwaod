$(document).ready(function () {
    $(".startbtn").click(function () {
        var gate = $(".active").data("cheker")
        if (gate == "gate3") {
            var textarea = $("#CreditCard_Gate3")
            var livetextarea = $("#Results_live_Gate3")
            var dietextarea = $("#Results_dead_Gate3")

        } else if(gate == "gate2") {
            var textarea = $("#CreditCard_Gate2")
            var livetextarea = $("#Results_live_Gate2")
            var dietextarea = $("#Results_dead_Gate2")
        }
       if(textarea.val() == ""){
        Swal.fire(
            'Error',
            'Please Input Your Credit Card',
            'error'
        )
       }else{
        $.ajax({

            type: "POST",

            url: "api.php",

            dataType: "json",

            data: {
                cc: textarea.val(),
                gate_checker: gate
            },
            beforeSend: function() {
                
            },
            success: function (data) {
                var die = data.die
                var live = data.live
                var arrdie = []
                var aliv = []
                var i;
                if (data.error) {
                    Swal.fire(
                        'Error',
                        'Credit Tidak Mencukupi',
                        'error'
                    )
                }
                if (live) {
                    for (i = 0; i < live.length; i++) {
                        aliv[i] = live[i].data +"|BIN => "+live[i].BIN
                    }
                    livetextarea.val(aliv.join("\r\n"));
                
                if (die) {
                    for (i = 0; i < die.length; i++) {
                        arrdie[i] = die[i].data + " => " + die[i].status +"|BIN => "+die[i].BIN;
                    }
                    dietextarea.val(arrdie.join("\r\n"));
                 }
            }
            }

        });
       }
       
    });
});