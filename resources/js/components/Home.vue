<template>
  <div class="row">
      <div class="col-xl-3 col-md-6">
          <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                  <div class="row">
                      <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0"> TOTAL SUBSCRIBER </h5>
                          <span class="h2 font-weight-bold mb-0">{{ allData.subscriber }}</span>
                      </div>
                      <div class="col-auto">
                          <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                              <i class="ni ni-active-40"></i>
                          </div>
                      </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                      <router-link to="/subscriber">
                          <span class="text-nowrap">Lihat Semua Subscriber</span>
                      </router-link>
                  </p>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6">
          <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                  <div class="row">
                      <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0"> TOTAL PERTANYAAN</h5>
                          <span class="h2 font-weight-bold mb-0">{{ allData.question }}</span>
                      </div>
                      <div class="col-auto">
                          <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                              <i class="ni ni-chart-pie-35"></i>
                          </div>
                      </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                      <router-link to="/questions">
                          <span class="text-nowrap">Lihat Semua Pertanyaan</span>
                      </router-link>
                  </p>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6">
          <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                  <div class="row">
                      <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0"> TOTAL INDIKATOR</h5>
                          <span class="h2 font-weight-bold mb-0">{{ allData.indicator }}</span>
                      </div>
                      <div class="col-auto">
                          <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                              <i class="ni ni-money-coins"></i>
                          </div>
                      </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                      <router-link to="/question-indicators">
                          <span class="text-nowrap">Lihat Semua Indicator</span>
                      </router-link>
                  </p>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6">
          <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                  <div class="row">
                      <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0"> TOTAL OPTION</h5>
                          <span class="h2 font-weight-bold mb-0">{{ allData.option }}</span>
                      </div>
                      <div class="col-auto">
                          <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                              <i class="ni ni-chart-bar-32"></i>
                          </div>
                      </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                      <router-link to="/options">
                          <span class="text-nowrap">Lihat Semua Opsi</span>
                      </router-link>
                  </p>
              </div>
          </div>
      </div>
  </div>
</template>

<script>


    export default {
        data() {
            return {
                allData : {}
            }
        },

        methods: {

            loadData(){
                axios.get("api/dashboard-data").then(({ data }) => (this.allData = data));
            },

        },

        created() {
           this.loadData();
        }

    }

</script>
