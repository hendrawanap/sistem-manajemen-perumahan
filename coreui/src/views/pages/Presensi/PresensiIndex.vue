<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Daftar Presensi</h2>
            <div class="d-flex align-items-end">
              <div class="mr-2">
                <CInput
                  label="Tanggal"
                  type="date"
                  id="inputTanggal"
                  @change="getAllPresensi"
                  v-model="selectedTanggal"
                />
              </div>
            </div>
          </div>
        </CCardHeader>
        <CCardBody>
          <CDataTable
            hover
            striped
            :items="daftarPresensi"
            :fields="fields"
            :items-per-page="5"
            pagination
          >
          </CDataTable>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>
<script>
import axios from "axios";
export default {
  name: "PresensiIndex",
  data() {
    return {
      daftarPresensi: [],
      fields: ["No.", "Nama Pegawai", "Waktu Presensi", "Status"],
      selectedTanggal: new Date().toISOString().slice(0, 10),
    };
  },
  methods: {
    getAllPresensi() {
      axios
        .get(this.$apiAdress + "/api/presensi/" + this.selectedTanggal)
        .then((r) => {
          this.daftarPresensi = r.data.map((data, index) => {
            return {
              "No.": index + 1,
              "Nama Pegawai": data.nama,
              "Waktu Presensi": data.waktuPresensi,
              Status: data.status,
            };
          });
        });
    },
  },
  mounted() {
    this.getAllPresensi();
  },
};
</script>