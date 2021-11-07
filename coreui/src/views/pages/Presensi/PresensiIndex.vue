<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Daftar Presensi</h2>
            <div class="d-flex align-items-end">
              <div class="mr-2">
                Tanggal:
                <CDropdown :toggler-text="selectedTanggal" color="primary">
                  <CDropdownItem
                    v-for="tanggal in dates"
                    :key="tanggal"
                    @click="selectedTanggal = tanggal"
                    >{{ tanggal }}</CDropdownItem
                  >
                </CDropdown>
              </div>
            </div>
          </div>
        </CCardHeader>
        <CCardBody>
          <CDataTable
            hover
            striped
            :items="selectedDaftar"
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
import daftarPresensi from "./dummyPresensi";
export default {
  name: "PresensiIndex",
  data() {
    return {
      daftarPresensi,
      fields: ["No.", "Nama Pegawai", "Waktu Presensi", "Status"],
      selectedTanggal: "2021-11-01",
      dates: ["2021-11-01", "2021-11-02", "2021-11-03"],
    };
  },
  computed: {
    selectedDaftar() {
      return daftarPresensi[this.selectedTanggal].map((presence, index) => {
        return {
          "No.": index + 1,
          ...presence,
        };
      });
    },
  },
  methods: {
    // getAllPresensi() {
    //   axios.get(this.$apiAdress + '/api/presensi/'+ new Date(key)).then( r => {
    //     this.items = r.data.map((data, index) => {
    //       return {
    //         'no.': index+1,
    //         'Nama Pegawai': data.namaPresensi,
    //         'Waktu Presensi': data.waktuPresensi,
    //         'Status': data.status,
    //     }});
    //   });
    // },
    // deletePresensi(id) {
    //     axios.get(this.$apiAdress + '/api/Presensi/delete/' + id).then(R => {
    //         this.getAllPresensi()
    //     })
    // }
  },
  mounted() {
    // this.getAllPresensi();
  },
};
</script>