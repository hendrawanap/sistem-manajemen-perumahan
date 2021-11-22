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
          <CForm @submit="editKK">
            <CInput
              label="Nomor KK"
              type="text"
              v-model="KK.nomorKK"
              invalid-feedback="Nomor KK harus terdiri dari 16 karakter."
              :is-valid="KK.nomorKK.length == 16"
              required
            />
            <CInput
              label="Alamat"
              type="text"
              v-model="KK.alamat"
              invalid-feedback="Alamat tidak boleh kosong."
              :is-valid="KK.alamat.length > 0"
              required
            />
            <CInput
              label="Kepala Keluarga"
              type="text"
              v-model="KK.kepalaKeluarga"
              invalid-feedback="Nama kepala keluarga tidak boleh kosong."
              :is-valid="KK.kepalaKeluarga.length > 0"
              required
            />
            <CButton type="submit" color="primary"
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
    editKK(e) {
      e.preventDefault();
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