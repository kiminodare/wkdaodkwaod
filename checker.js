$(document).ready(function () {
    
    $(".startbtn").click(function () {
        Swal.fire({
            title: '<strong>HTML <u>example</u></strong>',
            type: 'info',
            html:
              'You can use <b>bold text</b>, ' +
              '<a href="//github.com">links</a> ' +
              'and other HTML tags',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText:
              '<i class="fa fa-thumbs-up"></i> Great!',
            confirmButtonAriaLabel: 'Thumbs up, great!',
            cancelButtonText:
              '<i class="fa fa-thumbs-down"></i>',
            cancelButtonAriaLabel: 'Thumbs down',
          })
          
        var gate = $(".active").data("cheker")
        if (gate == "gate3") {
            var textarea = $("#CreditCard_Gate3").val()
            var livetextarea = $("#Results_live_Gate3")
            var dietextarea = $("#Results_dead_Gate3")

        } else if(gate == "gate2") {
            var textarea = $("#CreditCard_Gate2").val()
            var livetextarea = $("#Results_live_Gate2")
            var dietextarea = $("#Results_dead_Gate2")
        }
        $.ajax({

            type: "POST",

            url: "api.php",

            dataType: "json",

            data: {
                cc: textarea,
                gate_checker: gate
            },

            success: function (data) {
                var die = data.die
                var live = data.live
                var arrdie = []
                var aliv = []
                var i;
                if (data.error) {
                    alert(data.msg)
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
    });
});