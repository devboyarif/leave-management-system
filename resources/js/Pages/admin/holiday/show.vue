<template>

    <Head title="Company Holidays" />

    <div class="row justify-content-center">
        <!-- <div class="col-6">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>Calendar</span>
                    </div>
                </div>
                <div class="card-body">
                    <FullCalendar :options="calendarOptions" />
                </div>
            </div>
        </div> -->
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>Holiday List</span>
                        <button @click="showModal = true" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i>
                        Add Holiday
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap col-12">
                        <div v-for="holiday in holidays" :key="holiday.id"
                            class="col-12 col-md-6 holidayCont officalHCont d-flex justify-content-between align-items-center main-user-fields">
                            <div class="mt-4">
                                <h6><strong>{{ holiday.title }}</strong>
                                    <span class="text-danger ml-1">
                                        {{ holiday.days }} Day
                                    </span>
                                </h6>
                                <h6 class="d-flex align-items-center">
                                    <span class="m-widget4__sub">
                                        <span class="m-widget4__sm-text mr-1">
                                           <i class="fa-regular fa-calendar-days"></i>
                                             {{ holiday.format_start_date }}
                                        </span>

                                        <span class="m-widget4__sm-text ml-1">
                                           <i class="fa-regular fa-calendar-days"></i>
                                             {{ holiday.format_end_date }}
                                        </span>
                                    </span>
                                </h6>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-sm ">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button class="btn btn-danger btn-sm mx-1">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div id="exampleModalCenter" class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-modal="true" style="display: block; padding-right: 21px;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->
<div id="app">
  <div v-if="showModal">
    <transition name="modal">
      <div class="modal-mask">
        <div class="modal-wrapper">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" @click="showModal = false">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Modal body text goes here.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" @click="showModal = false">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
</div>
</template>

<script>
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";

export default {
    props: {
        user: Object,
        company: Object,
        holidays: Array,
    },
    components: {
        FullCalendar, // make the <FullCalendar> tag available
    },
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: "dayGridMonth",
                events: this.holidays,
            },

            showModal: false,
        };
    },
};
</script>

<style scoped>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}
</style>
