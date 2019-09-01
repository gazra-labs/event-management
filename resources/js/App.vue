<template>
    <div class="container">
        <div class="" style="margin:50px">
            <FullCalendar class='demo-app-calendar'
        ref="fullCalendar"
        defaultView="dayGridMonth"
        :header="{
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        }"
        :plugins="calendarPlugins"
        :events="calendarEvents"
        :selectable="true"
        @eventClick="editEvent"
        @select="selectedDates"
        :eventRender="addCloseIcon"
        />

        </div>
    </div>
</template>

<script>
    import FullCalendar from '@fullcalendar/vue'
    import dayGridPlugin from '@fullcalendar/daygrid'
    import timeGridPlugin from '@fullcalendar/timegrid'
    import interactionPlugin from '@fullcalendar/interaction'
    import timelinePlugin from '@fullcalendar/timeline'
    import listPlugin from '@fullcalendar/list'
    // import resourceTimelinePlugin from '@fullcalendar/resource-timeline'
    import axios from 'axios';
    import jQuery from "jquery";
    const $ = jQuery;
    window.$ = $;


    export default{
        components: {
            FullCalendar // make the <FullCalendar> tag available
        },
        data(){
            return {
                msg:'Hello world',
                calendarPlugins: [ dayGridPlugin, timeGridPlugin, listPlugin, timelinePlugin, interactionPlugin ],
                calendarWeekends: [],
                calendarEvents:[],
                userId:0,
            }
        },
        mounted(){
            let instance = this
            // let calendarApi = this.$refs.fullCalendar.getApi()
            // console.log(calendarApi)
            // calendarApi.next()
            this.fetchEvents();
            this.getLoggedInUser();

        },
        methods: {
            getLoggedInUser(){
                let instance = this
                instance.userId = $('#navbarDropdown').data('id')
            },
            fetchEvents(){
                let instance = this;
                axios.get('api/events')
                .then(function (response) {
                    instance.calendarEvents = response.data
                })
                .catch(function (error) {
                    // console.log(error);
                });
            },
            addCloseIcon(event, element){
                event.el.innerHTML = '<span class="text-light">' +  event.event.title + '</span>' + '<span class="deleteEvent fa fa-times pull-right text-light"></span>';
            },
            editEvent(info){

                let instance = this
                let $ele = $(info.jsEvent.target)

                if($ele.hasClass('deleteEvent')){
                    if(confirm('Are you sure, you want to delete this event?')){
                        axios.delete('api/events/'+info.event.id)
                        .then(function (response) {
                            instance.fetchEvents()
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                        .then(function () {
                            // always executed
                        });
                    }
                }else{
                    let name = prompt('Edit Event?',info.event.title);
                    if(name==null){
                        return false;
                    }
                    let params = {
                        name: name,
                    };
    
                    axios.put('api/events/'+info.event.id, params)
                    .then(function (response) {
                        instance.fetchEvents()
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    }); 
                }

            },
            selectedDates(info){
                let instance = this;
                let name = prompt("Please enter the event name");
                let params = {
                    name: name,
                    start_time:info.startStr,
                    end_time:info.endStr,
                    user_id:instance.userId
                };

                axios.post('api/events', params)
                .then(function (response) {
                    instance.fetchEvents()
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                    // always executed
                }); 
            }
        }
    }
</script>