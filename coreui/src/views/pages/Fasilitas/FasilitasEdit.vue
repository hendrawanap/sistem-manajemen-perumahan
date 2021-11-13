<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div v class="d-flex justify-content-between">
            <h2>Edit Fasilitas</h2>
          </div>
        </CCardHeader>
        <CCardBody>
          <CForm @submit="editFasilitas">
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
  name: "FasilitasEdit",
  title: "Edit Fasilitas",
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
    editFasilitas(e) {
      e.preventDefault();
      axios.put(this.$apiAdress + '/api/fasilitas/' + this.$route.params.id  + '?token=' + localStorage.getItem('api_token'), this.fasilitas)
        .then((r) => {
          this.$router.push("/fasilitas?message=" + r.data.message);
        });
    },

    getFasilitas() {
      axios.get(this.$apiAdress + '/api/fasilitas/' + this.$route.params.id + '?token=' + localStorage.getItem('api_token'))
        .then((r) => {
          const data = r.data;
          this.fasilitas = {
            namaFasilitas: data.namaFasilitas,
            kondisi: data.kondisi,
            informasi: data.informasi,
          };
        });
    },
  },
  mounted() {
    this.getFasilitas();
  },
};
</script>