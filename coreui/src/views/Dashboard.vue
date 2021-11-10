<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader class="gede">
          <div class="atas" id="app">
            <div class="ml-4">
              <h1 class="text-light mt-5">Hai, Manajer</h1>
              <h1 class="text-light mb-5">Perumahan Estate</h1>
              <p class="text-light w-50">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Curabitur pharetra ante in nibh malesuada lacinia. Pellentesque
                massa odio, condimentum sed nisi a, elementum ornare odio. Sed
                vel pellentesque tellus. Vivamus risus sapien, vehicula et
                turpis non, dictum bibendum ligula. Maecenas lacinia, eros eu
                scelerisque blandit, arcu lacus mattis nisl, sed tincidunt
                libero est id nulla. Morbi pretium metus elit, non malesuada
                nunc pellentesque ut. Phasellus interdum ut neque suscipit
                ultricies.
              </p>
            </div>
          </div>
          <CRow class="baris d-flex justify-content-around mt-5 mb-3">
            <router-link :to="'/pegawai/'">
              <CButton class="tombol" shape="pill" size="lg" color="secondary"
                >60 Pegawai</CButton
              > </router-link
            ><router-link :to="'/fasilitas/'">
              <CButton class="tombol" shape="pill" size="lg" color="secondary"
                >50 Fasilitas</CButton
              > </router-link
            ><router-link :to="'/KK/'">
              <CButton class="tombol" shape="pill" size="lg" color="secondary"
                >80 Kartu Keluarga</CButton
              >
            </router-link>
          </CRow>
        </CCardHeader>
      </CCard>
    </CCol>
  </CRow>
</template>
    
<script>
import ColorTheme from "./theme/ColorTheme";
export default {};
</script>
<style>
.gede {
  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7)),
    url("../assets/rumah.jpg");
  background-size: cover;
  min-height: 500px;
  border-radius: 50px;
}
.atas {
  min-height: 350px;
}
.tombol {
  transition: transform 0.2s;
}
.tombol:hover {
  -ms-transform: scale(1.2);
  -webkit-transform: scale(1.2);
  transform: scale(1.2);
}
</style>