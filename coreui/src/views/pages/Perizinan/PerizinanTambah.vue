<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Tambah Perizinan</h2>
          </div>
        </CCardHeader>
        <CCardBody>
          <CForm v-on:submit.prevent>
            <CInput
              label="Nama Pegawai"
              type="text"
              id="inputNama"
              v-model="perizinan.nama"
            />
            <CInput
              label="Tanggal"
              type="date"
              id="inputTanggal"
              v-model="perizinan.tanggal"
            />
            <CInput
              label="Alasan"
              type="text"
              id="inputAlasan"
              v-model="perizinan.alasan"
            />
            <CSelect
              label="Tipe"
              :options="tipeOptions"
              :value.sync="perizinan.tipe"
              placeholder="Pilih Tipe"
            />
            <router-link :to="'/perizinan'">
              <CButton type="submit" color="primary" @click="submit()">
                Submit
              </CButton>
            </router-link>
          </CForm>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>
<script>
export default {
  name: "PegawaiEdit",
  data() {
    return {
      perizinan: {
        nama: "",
        tanggal: null,
        alasan: "",
        tipe: "",
      },
      tipeOptions: ["sakit", "mati", "izin"],
    };
  },
  methods: {
    submit() {
      console.log(this.perizinan);
    },
  },
};
</script>
