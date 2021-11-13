<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div v class="d-flex justify-content-between">
            <h2>Tambah KK</h2>
          </div>
        </CCardHeader>
        <CCardBody>
          <CForm @submit="addKK">
            <CInput
              label="Nomor KK"
              type="text"
              v-model="KK.noKK"
              invalid-feedback="Nomor KK harus terdiri dari 16 karakter."
              :is-valid="KK.noKK.length == 16"
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
  name: "KKTambah",
  title: "Tambah KK",
  data() {
    return {
      KK: {
        noKK: "",
        alamat: "",
        kepalaKeluarga: "",
      },
    };
  },
  methods: {
    addKK(e) {
      e.preventDefault();
      const formData = new FormData();
      const KK = this.KK;
      formData.append("nomorKK", KK.noKK);
      formData.append("alamat", KK.alamat);
      formData.append("kepalaKeluarga", KK.kepalaKeluarga);

      axios.post(this.$apiAdress + '/api/kk?token=' + localStorage.getItem('api_token'), formData).then((r) => {
        this.$router.push("/KK?message=" + r.data.message);
      });
    },
  },
};
</script>