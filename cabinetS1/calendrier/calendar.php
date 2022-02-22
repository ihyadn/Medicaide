<div id="calendar"></div>
<div class="form_wrapper">
    <h5>Ajouter un rendez-vous</h5>
    <div class="d-flex align-items-center choose_date">
        <input type="date" value="" class="inser_input date_pick " id="date_picker">
        <img alt="" src="images/search.png" id="search" title="aller à une date spécifique"></img>
    </div>
    <div class="insert_form">
        <input class="inser_input d-none" type="text" id="id">
        <input class="inser_input" type="text" placeholder="CIN" id="cin">
        <img alt="" src="images/search.png" id="search" class="check_user" title="chercher patient par CIN"></img>
        <input class="inser_input" type="text" id="name" placeholder="Nom">
        <input class="inser_input" type="text" placeholder="Prenom" id="prenom" value="">
        <input class="inser_input" type="text" placeholder="Mobile" id="telephone" value="">
        <input class="inser_input" type="email" placeholder="Email" id="email" value="">
        <input class="inser_input" type="date" placeholder="date" id="date_rendez-vous">
        <input class="inser_input" type="time" placeholder="time" id="time_start">
        <input class="inser_input" type="time" placeholder="time" id="time_end">
        <button type="submit" class="btn btn-warning confirmer">Cofirmer</button>
    </div>
</div>
<script>
function reloadcal() {
    var calendar = $("#calendar").fullCalendar({
        eidtable: true,
        height: $(".calendar").height(),
        header: {
            left: "prev,next,today",
            center: "title",
            right: "month,agendaWeek,agendaDay",
        },

        weekends: false, // Hide weekends
        defaultView: "agendaWeek", // Only show week view
        //header: false, // Hide buttons/titles
        minTime: "07:30:00", // Start time for the calendar
        maxTime: "22:00:00", // End time for the calendar
        displayEventTime: true, // Display event time

        events: "CRUD/load.php",
        selectable: true,
        selectHelper: true,
        select: function(start, end, allDay) {
            // var title = prompt("Enter Event Title");
            console.log("hi");
            if (true) {
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                console.log(start);
                $.ajax({
                    url: "",
                    type: "POST",
                    data: {
                        start: start,
                        end: end,
                    },
                    success: function() {
                        // calendar.fullCalendar("refetchEvents");
                    },
                });
                // window.location.href = "rendez-vous.php";
            }
        },
        editable: true,
        eventResize: function(event) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            var title = event.title;
            var id = event.id;
            $.ajax({
                url: "CRUD/update.php",
                type: "POST",
                data: {
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                },
                success: function() {
                    calendar.fullCalendar("refetchEvents");
                    alert("Event Update");
                },
            });
        },
        eventDrop: function(event) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            var title = event.title;
            var id = event.id;
            $.ajax({
                url: "CRUD/update.php",
                type: "POST",
                data: {
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                },
                success: function() {
                    calendar.fullCalendar("refetchEvents");
                },
            });
        },
        eventClick: function(event) {
            console.log("click")
            if (confirm("Are you sure you want to remove it?")) {
                var id = event.id;
                $.ajax({
                    url: "CRUD/delete.php",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function() {
                        calendar.fullCalendar("refetchEvents");
                    },
                });
            }
        },
    });
    calendar.fullCalendar("refetchEvents");
}
$(document).ready(function() {
    reloadcal();
})
$(".confirmer").click(function(calendar) {
    var cin = document.getElementById("cin").value
    $.ajax({
        url: "CRUD/chercherPatient.php",
        type: "POST",
        data: {
            cin: cin,
        },
        success: function(data) {
            if (!jQuery.isEmptyObject(JSON.parse(data))) {
                var start = document.getElementById("date_rendez-vous").value + " " + document
                    .getElementById("time_start")
                    .value
                var end = document.getElementById("date_rendez-vous").value + " " + document
                    .getElementById("time_end")
                    .value
                var id = document.getElementById("id").value
                $.ajax({
                    url: "CRUD/insert.php",
                    type: "POST",
                    data: {
                        start: start,
                        end: end,
                        patientID: id
                    },
                    success: function(data) {
                        reloadcal();
                        if (!jQuery.isEmptyObject(JSON.parse(data))) {
                            alert("plage indisponbile");
                        }

                    }
                })
            } else {
                var cin = document.getElementById("cin").value
                var name = document.getElementById("name").value
                var tele = document.getElementById("telephone").value
                var prenom = document.getElementById("prenom").value
                var email = document.getElementById("email").value
                var date = new Date().toJSON().slice(0, 10).replace(/-/g, '/');
                $.ajax({
                    url: "CRUD/addPatient.php",
                    type: "POST",
                    data: {
                        cin: cin,
                        name: name,
                        telephone: tele,
                        prenom: prenom,
                        email: email,
                        date: date
                    },
                    success: function() {
                        $.ajax({
                            url: "CRUD/chercherPatient.php",
                            type: "POST",
                            data: {
                                cin: cin,
                            },
                            success: function(data) {
                                data = JSON.parse(data)
                                document.getElementById("id").value = data[
                                    "id"]
                                var start = document.getElementById(
                                        "date_rendez-vous").value +
                                    " " + document.getElementById(
                                        "time_start")
                                    .value
                                var end = document.getElementById(
                                        "date_rendez-vous").value +
                                    " " + document.getElementById(
                                        "time_end")
                                    .value
                                var id = document.getElementById("id").value
                                console.log(start, end, id)
                                $.ajax({
                                    url: "CRUD/insert.php",
                                    type: "POST",
                                    data: {
                                        start: start,
                                        end: end,
                                        patientID: id
                                    },
                                    success: function() {
                                        reloadcal();
                                        if (!jQuery
                                            .isEmptyObject(JSON
                                                .parse(data))) {
                                            alert(
                                                "plage indisponbile"
                                            );
                                        }
                                        reloadcal();
                                    }
                                })
                            }
                        })


                    }
                })
            }

        }
    })
    // var cin = document.getElementById("cin").value
    // var name = document.getElementById("name").value
    // var tele = document.getElementById("telephone").value
    // var prenom = document.getElementById("prenom").value
    // var email = document.getElementById("email").value
    // var date = new Date().toJSON().slice(0, 10).replace(/-/g, '/');
    // $.ajax({
    //     url: "CRUD/addPatient.php",
    //     type: "POST",
    //     data: {
    //         cin: cin,
    //         name: name,
    //         telephone: tele,
    //         prenom: prenom,
    //         email: email,
    //         date: date
    //     },
    //     success: function() {
    //     }
    // })
});
$(".check_user").click(function() {
    var cin = document.getElementById("cin").value
    $.ajax({
        url: "CRUD/chercherPatient.php",
        type: "POST",
        data: {
            cin: cin,
        },
        success: function(data) {
            if (!jQuery.isEmptyObject(JSON.parse(data))) {
                data = JSON.parse(data)
                document.getElementById("name").value = data["Nom"]
                document.getElementById("telephone").value = data['telephone']
                document.getElementById("prenom").value = data['Prenom']
                document.getElementById("email").value = data['email']
                document.getElementById("id").value = data['id']
            } else {
                alert("patient n'existe pas")
            }
        }
    })
});
const found = () => {
    var cin = document.getElementById("cin").value
    $.ajax({
        url: "CRUD/chercherPatient.php",
        type: "POST",
        data: {
            cin: cin,
        },
        success: function(data) {
            return true;
        }
    })
}
$("#search").click(function() {
    date = document.getElementById("date_picker").value;
    if (date) {
        console.log(date)
        date = moment(date, "YYYY-MM-DD");
        $("#calendar").fullCalendar('gotoDate', date);
    }
})
</script>