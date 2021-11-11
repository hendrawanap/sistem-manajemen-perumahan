<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <CCarousel arrows indicators animate height="550px">
            <CCarouselItem class="gede">
              <div class="atas" id="app">
                <div class="ml-4">
                  <h1 class="text-light mt-5">Hai, Manajer</h1>
                  <h1 class="text-light">Perumahan Estate</h1>
                  <p class="text-light w-50">
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
            <CCarouselItem
              captionHeader="First Slide"
              image="https://picsum.photos/1024/480/?image=52"
              captionText="Nulla vitae elit libero, a pharetra augue mollis interdum."
            />
          </CCarousel>
        </CCardHeader>
        <CCardBody>
          <CRow class="d-flex justify-content-around">
            <CCol sm="6" md="2">
              <router-link :to="'/Pegawai'">
                <CWidgetProgressIcon
                  class="tombol"
                  header="60"
                  text="Pegawai"
                  color="warning"
                  inverse
                >
                  <CIcon name="cil-people" height="36" />
                </CWidgetProgressIcon>
              </router-link>
            </CCol>
            <CCol sm="6" md="2">
              <router-link :to="'/Fasilitas'">
                <CWidgetProgressIcon
                  class="tombol"
                  header="50"
                  text="Fasilitas"
                  color="warning"
                  inverse
                >
                  <CIcon name="cil-building" height="36" />
                </CWidgetProgressIcon>
              </router-link>
            </CCol>
            <CCol sm="6" md="2">
              <router-link :to="'/KK'">
                <CWidgetProgressIcon
                  class="tombol"
                  header="30"
                  text="Kartu Keluarga"
                  color="warning"
                  inverse
                >
                  <CIcon name="cil-notes" height="36" />
                </CWidgetProgressIcon>
              </router-link>
            </CCol> </CRow
        ></CCardBody>
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
    url("../assets/rumah2.jpg");
  background-size: cover;
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