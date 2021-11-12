<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div v class="d-flex justify-content-between">
            <h2>Edit KK</h2>
          </div>
        </CCardHeader>
        <CCardBody>
          <CForm v-on:submit.prevent>
            <CInput
              label="Nomor KK"
              type="text"
              id="noKKInput"
              v-model="KK.nomorKK"
            />
            <CInput
              label="Alamat"
              type="text"
              id="alamatInput"
              v-model="KK.alamat"
            />
            <CInput
              label="Kepala Keluarga"
              type="text"
              id="kepalaKeluargaInput"
              v-model="KK.kepalaKeluarga"
            />
            <CButton type="submit" color="primary" @click="editKK()"
              >Submit</CButton
            >
          </CForm>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import axios from "axios";
export default {
  name: "KKEdit",
  title: "Edit KK",
  data() {
    return {
      KK: {
        nomorKK: "",
        alamat: "",
        kepalaKeluarga: "",
      },
    };
  },
  methods: {
    editKK() {
      axios
        .put(
          this.$apiAdress + "/api/kk/" + this.$route.params.id + '?token=' + localStorage.getItem('api_token'),
          this.KK,
        )
        .then((r) => {
          this.$router.push("/KK?message=" + r.data.message);
        });
    },
    getKK() {
      axios
        .get(this.$apiAdress + "/api/kk/" + this.$route.params.id + '?token=' + localStorage.getItem('api_token'))
        .then((r) => {
          const data = r.data;
          this.KK = {
            nomorKK: data.nomorKK,
            alamat: data.alamat,
            kepalaKeluarga: data.kepalaKeluarga,
          };
        });
    },
  },
  mounted() {
    this.getKK();
  },
};
</script>