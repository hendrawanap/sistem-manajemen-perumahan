<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <CCarousel arrows indicators animate>
            <CCarouselItem class="satu gede" :key="carousel">
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
                  <h1 class="text-light mt-5">Hai, Manajer</h1>
                  <h1 class="text-light">Perumahan Estate</h1>
                  <p class="capt1 carousel-caption d-none d-md-block w-50">
                    Estate merupakan sebuah perumahan yang menawarkan kenyamanan
                    dan keamanan kepada para penghuninya dibantu dengan Sistem
                    Manajemen Perumahan yang baik. Dengan sistem ini kondisi
                    perumahan dapat dipantau setiap saat sehingga bisnis
                    perumahan ini dapat berjalan dengan baik dan semakin baik
                    setiap harinya.
                  </p>
                </div>
              </div> </CCarouselItem
            ><CCarouselItem
              class="dua gede"
              captionHeader="SEKILAS"
              captionText="Perumahan ini menyediakan berbagai macam fasilitas yang
                    dapat digunakan oleh para penghuni perumahan ini. Sampai
                    saat ini pihak estate telah menyediakan fasilitas sejumlah
                    50 buah. Fasilitas tersebut berupa taman, kolam, lapangan,
                    area bermain, dan fasilitas lainnya. Sampai saat ini
                    tercatat sudah ada 30 Kartu Keluarga yang terdaftar sebagai
                    pemilik hunian di perumahan ini."
            /><CCarouselItem
              class="tiga gede"
              captionHeader="KEUNGGULAN"
              captionText="Hal yang dapat kami tonjolkan kepada para penghuni 
              adalah kepastian akan keamanan dan kenyamanan. Kami menyediakan 
              petugas keamanan yang siap siaga 24 jam dalam sehari yang melaksanakan 
              pengawasan dan penjagaan secara bergantian sehingga terhindar dari 
              kelelahan yang menyebabkan kelalaian dalam bekerja. Demi menunjang kenyamanan 
              kami juga memiliki pasukan kebersihan yang selalu menjaga kebersihan lingkungan perumahan"
            />
          </CCarousel>
        </CCardHeader>
      </CCard>
    </CCol>
  </CRow>
</template>
    
<script>
import axios from "axios";

export default {
  name: "Dashboard",
  title: "Dashboard",
  data() {
    return {
      jumlahPegawai: 0,
      jumlahKK: 0,
      jumlahFasilitas: 0,
      user: "User",
    };
  },
  mounted() {
    axios
      .get(
        this.$apiAdress +
          "/api/pegawai?token=" +
          localStorage.getItem("api_token")
      )
      .then((r) => (this.jumlahPegawai = r.data.length));
    axios
      .get(
        this.$apiAdress + "/api/kk?token=" + localStorage.getItem("api_token")
      )
      .then((r) => (this.jumlahKK = r.data.length));
    axios
      .get(
        this.$apiAdress +
          "/api/fasilitas?token=" +
          localStorage.getItem("api_token")
      )
      .then((r) => (this.jumlahFasilitas = r.data.length));
    const user = localStorage.getItem("roles").split(",");
    if (user[1] == "manager") {
      this.user = "Manager";
    } else if (user[1] == "admin") {
      this.user = "Admin";
    }
  },
};
</script>
<style scope>
.gede {
  height: 545px;
}
.satu {
  background-image: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.7)),
    url("../assets/rumah.jpg");
  background-size: cover;
}
.dua {
  background-image: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.7)),
    url("../assets/fas.jpg");
  background-size: cover;
}
.tiga {
  background-image: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.7)),
    url("../assets/keuntungan.jpg");
  background-size: cover;
}
.kolom {
  top: 0;
}

.capt1 {
  text-align: left;
  left: 30px;
}
.capt2 {
  text-align: mid;
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