<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div v class="d-flex justify-content-between">
            <h2>Tambah Fasilitas</h2>
          </div>
        </CCardHeader>
        <CCardBody>
          <CForm @submit="addFasilitas">
            <CInput
              label="Nama Fasilitas"
              type="text"
              v-model="fasilitas.namaFasilitas"
              invalid-feedback="Nama fasilitas tidak boleh kosong."
              :is-valid="fasilitas.namaFasilitas.length > 0"
              required
            />
            <CSelect
              label="Kondisi"
              :options="kondisiOptions"
              :value.sync="fasilitas.kondisi"
              placeholder="Pilih Kondisi"
              invalid-feedback="Kondisi fasilitas tidak boleh kosong."
              :is-valid="fasilitas.kondisi.length > 0"
              required
            />
            <CInput
              label="Informasi"
              type="text"
              v-model="fasilitas.informasi"
              invalid-feedback="Informasi fasilitas tidak boleh kosong."
              :is-valid="fasilitas.informasi.length > 0"
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
  name: "FasilitasTambah",
  title: "Tambah Fasilitas",
  data() {
    return {
      fasilitas: {
        namaFasilitas: "",
        kondisi: "",
        informasi: "",
      },
      kondisiOptions: ["Baik", "Dalam Perbaikan", "Rusak"],
    };
  },
  methods: {
    addFasilitas(e) {
      e.preventDefault();
      const formData = new FormData();
      const fasilitas = this.fasilitas;
      formData.append("namaFasilitas", fasilitas.namaFasilitas);
      formData.append("kondisi", fasilitas.kondisi);
      formData.append("informasi", fasilitas.informasi);
      
      axios
        .post(
          this.$apiAdress +
            "/api/fasilitas" +
            "?token=" +
            localStorage.getItem("api_token"),
          formData
        )
        .then((r) => {
          this.$router.push("/fasilitas?message=" + r.data.message);
        });
    },
  },
};
</script>