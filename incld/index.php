<?php
?>
<!DOCTYPE html>
<html>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>Full Calendar Class room</title>
<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.css' rel='stylesheet' />
<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css' rel='stylesheet' />
<link  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel='stylesheet'/>
<link  href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css" rel='stylesheet'/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.js'></script>
<script src='https://fullcalendar.io/releases/fullcalendar-scheduler/1.9.3/scheduler.min.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
   
  $(document).ready(function() {
        var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

        var calendar = $('#calendar').fullCalendar({    
            editable:true,
            header:{
            left:'prev,next today',
            center:'title',
            right:'month,agendaWeek,listWeek,agendaDay'

            },
            buttonText: {
/*                listMonth: 'List Month',
                listYear: 'List Year',*/
                listWeek: 'List Week',
                agendaDay: 'Day'
            },
            displayEventTime: true,
            defaultView: 'listWeek',
            
            events: 'incld/load.php',
            selectable:true,
            selectHelper:true,
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;

                } else {
                    event.allDay = false;
                }
            },
           /* dayRender: function(date, cell) {
                var today = $.fullCalendar.moment();
                var end = $.fullCalendar.moment().add(7, 'days');
                if (date.get('date') == today.get('date')) {
                    $(".fc-"+date.format('ddd').toLowerCase()).css("background", "#f8f9fa");
                    $("th.fc-"+date.format('ddd').toLowerCase()).text("Holiday");
                    $("th.fc-"+date.format('ddd').toLowerCase()).css("background", "red");
                    $("th.fc-"+date.format('ddd').toLowerCase()).css("color", "#fff");
                 }
             },
            */
            //show popup            
            eventClick: function(info) {
                
                $("#startTime").html(moment(info.start).format('YYYY-MM-DD HH:mm:ss A'));
                $("#endTime").html(moment(info.end).format('YYYY-MM-DD HH:mm:ss A'));
                $("#eventInfo").html(info.title);
                $("#idIntructor").html(info.InstructorName);
                $("#idAssistant").html(info.AssistantName);
                $("#idSupporter").html(info.SupporterName);
                $("#eventLink").attr('href', info.url);        
                $("#ModalWarning").modal("show");              
                
            },
            //Show events tooltip
            eventMouseover: function(calEvent, jsEvent) {
                var tooltip = '<div class="tooltipevent" style="width:300px;height:50px;background-color:#fa8612;color: white; position:absolute;z-index:10001;">' + calEvent.title +' Startdate:'+  calEvent.start.toISOString() +'</div>';
                var $tooltip = $(tooltip).appendTo('body');

                $(this).mouseover(function(e) {
                    $(this).css('z-index', 10000);
                    $tooltip.fadeIn('500');
                    $tooltip.fadeTo('10', 1.9);
                }).mousemove(function(e) {
                    $tooltip.css('top', e.pageY + 10);
                    $tooltip.css('left', e.pageX + 20);
                });
            },

            eventMouseout: function(calEvent, jsEvent) {
                $(this).css('z-index', 8);
                $('.tooltipevent').remove();
            },
        });
        $("#ModalWarning").on('hidden.bs.modal', function(){
                    // alert("Hello World!");
                });
  });
   
  </script>
  <style>
.fc-license-message{display: none;}
body {
        /*margin-top: 40px;*/
        text-align: center;
        font-size: 12px;
        font-family: tahoma,Verdana,sans-serif;
        /*background-color: #DDDDDD;*/
    }
        
    #wrap {
        width: 1100px;
        margin: 0 auto;
        }
        
     #external-events {
        float: left;
        width: 150px;
        padding: 0 10px;
        text-align: left;
        }
        
    #external-events h4 {
        font-size: 16px;
        margin-top: 0;
        padding-top: 1em;
        } 
        
     .external-event { 
        margin: 10px 0;
        padding: 2px 4px;
        background: #3366CC;
        color: #fff;
        font-size: .85em;
        cursor: pointer;
        }
        
    #external-events p {
        margin: 1.5em 0;
        font-size: 11px;
        color: #666;
        }
        
    #external-events p input {
        margin: 0;
        vertical-align: middle;
        } 

    #calendar {
/*      float: right; */
        margin: 0 auto;
        width: 850px;
        background-color: #FFFFFF;
          border-radius: 6px;
        box-shadow: 0 1px 2px #C3C3C3;
        
        }


</style>
 </head>
 <body>
<div id='wrap'>

<div id='calendar'></div>

<div style='clear:both'></div>
</div>
<div class="modal fade left" id="ModalWarning" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-warning modal-side modal-bottom-left" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <p class="heading">Course infomation</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">

        <div class="row">
          <div class="col-3 text-center">
            <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(1).jpg" alt="IMG of Avatars"
              class="img-fluid z-depth-1-half rounded-circle">
            <div style="height: 10px"></div>
            <p id="idIntructor" style="font-weight:bold;font-size: 16px" class="title mb-0"></p>
            <p class="text-muted " style="font-size: 13px">Instructor</p>
          </div>

          <div class="col-9">
                <p style="font-weight:bold" id="eventInfo"></p>
                Start: <span id="startTime"></span><br>
                End: <span id="endTime"></span><br><br>
                <!-- Instructor: <span id="idIntructor"></span><br> -->
                Assistant: <span style="font-weight:bold" id="idAssistant"></span><br>
                Supporter: <span style="font-weight:bold"  id="idSupporter"></span>
                
                <!-- <p><strong><a id="eventLink" href="" target="_blank">Read More</a></strong></p> -->
          </div>
        </div>


      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
        <a type="button" class="btn btn-warning">Read More<i class="far fa-gem ml-1 white-text"></i></a>
        <a type="button" class="btn btn-outline-warning waves-effect" data-dismiss="modal">Close</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- Central Modal Warning Demo-->

<!-- //Bootstrap Modal POPUP -->
<div  class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div style="color:currentColor;" class="modal-content">
            <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                Course Name: <p id="eventInfo"></p>
                Start: <span id="startTime"></span><br>
                End: <span id="endTime"></span><br><br>
                Instructor: <span id="idIntructor"></span><br>
                Assistant: <span id="idAssistant"></span><br>
                Supporter: <span  id="idSupporter"></span>
                
                <p><strong><a id="eventLink" href="" target="_blank">Read More</a></strong></p>
                
                <p></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>