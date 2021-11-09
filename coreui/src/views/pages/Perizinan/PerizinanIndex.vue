<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Perizinan</h2>
            <router-link :to="'/perizinan/tambah'">
              <CButton color="primary"> Tambah </CButton>
            </router-link>
          </div>
        </CCardHeader>
        <CCardBody>
          <CDataTable
            hover
            striped
            :items="daftarPerizinan"
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
import axios from 'axios';
export default {
  name: "PerizinanIndex",
  data() {
    return {
      daftarPerizinan: [],
      fields: ["No.", "Nama Pegawai", "Tanggal", "Alasan"],
    };
  },
  methods: {
    fetchDaftarPerizinan() {
      axios.get(this.$apiAdress + '/api/perizinan?token=' + localStorage.getItem('api_token')).then(r => {
        this.daftarPerizinan = r.data.map((perizinan,index) => {
          return {
            "No.": index+1,
            "Nama Pegawai": perizinan.nama,
            "Tanggal": perizinan.waktuPresensi.slice(0,10),
            "Alasan": perizinan.perizinan
          }
        })
      })
    }
  },
  mounted() {
    this.fetchDaftarPerizinan();
  }
};
</script>
