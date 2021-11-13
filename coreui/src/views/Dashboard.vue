<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <CCarousel arrows indicators animate>
            <CCarouselItem v-for="carousel in 3" class="gede" :key="carousel">
              <div class="atas" id="app">
                <CRow align="center" class="baris">
                  <CCol class="kolom">
                    <router-link :to="'/Pegawai'">
                      <CButton
                        class="tombol mt-4"
                        variant="outline"
                        shape="pill"
                        color="secondary"
                        >{{ jumlahPegawai }} Pegawai</CButton
                      ></router-link
                    ><router-link :to="'/Fasilitas'"
                      ><CButton
                        class="tombol ml-2 mr-2 mt-4"
                        variant="outline"
                        shape="pill"
                        color="secondary"
                        >{{ jumlahFasilitas }} Fasilitas</CButton
                      ></router-link
                    ><router-link :to="'/KK'"
                      ><CButton
                        class="tombol mt-4"
                        variant="outline"
                        shape="pill"
                        color="secondary"
                        >{{ jumlahKK }} Kartu Keluarga</CButton
                      ></router-link
                    >
                  </CCol>
                </CRow>
                <div class="ml-4">
                  <h1 class="text-light mt-5">Hai, {{ user }}</h1>
                  <h1 class="text-light">Perumahan Estate</h1>
                  <p class="caption carousel-caption d-none d-md-block w-50">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Curabitur pharetra ante in nibh malesuada lacinia.
                    Pellentesque massa odio, condimentum sed nisi a, elementum
                    ornare odio. Sed vel pellentesque tellus. Vivamus risus
                    sapien, vehicula et turpis non, dictum bibendum ligula.
                    Maecenas lacinia, eros eu scelerisque blandit, arcu lacus
                    mattis nisl, sed tincidunt libero est id nulla. Morbi
                    pretium metus elit, non malesuada nunc pellentesque ut.
                    Phasellus interdum ut neque suscipit ultricies.
                  </p>
                </div>
              </div>
              </CCarouselItem>
          </CCarousel>
        </CCardHeader>
        <CCardBody> </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>
    
<script>
import axios from 'axios'

export default {
  name: 'Dashboard',
  title: 'Dashboard',
  data() {
    return {
      jumlahPegawai: 0,
      jumlahKK: 0,
      jumlahFasilitas: 0,
      user: 'User',
    }
  },
  mounted() {
    axios.get(this.$apiAdress + '/api/pegawai?token=' + localStorage.getItem('api_token')).then(r => this.jumlahPegawai = r.data.length);
    axios.get(this.$apiAdress + '/api/kk?token=' + localStorage.getItem('api_token')).then(r => this.jumlahKK = r.data.length);
    axios.get(this.$apiAdress + '/api/fasilitas?token=' + localStorage.getItem('api_token')).then(r => this.jumlahFasilitas = r.data.length);
    const user = localStorage.getItem('roles').split(',');
    if (user[1] == 'manager') {
      this.user = "Manager"
    } else if (user[1] == 'admin') {
      this.user = "Admin"
    }
  }
  
};
</script>
<style scope>
.gede {
  background-image: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.7)),
    url("../assets/rumah.jpg");
  background-size: cover;
  height: 545px;
}
.kolom {
  top: 0;
}

.caption {
  text-align: left;
  left: 30px;
}
.tombol {
  transition: transform 0.2s;
}
.tombol:hover {
  -ms-transform: scale(1.1);
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>