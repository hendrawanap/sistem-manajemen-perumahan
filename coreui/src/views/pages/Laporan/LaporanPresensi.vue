<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Laporan Presensi</h2>
            <div class="d-flex align-items-end">
            </div>
          </div>
        </CCardHeader>
        <CCardBody>
          <CDataTable
            hover
            striped
            :items="items"
            :fields="fields"
            :items-per-page="7"
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
    name : "LaporanPresensi",
    title: 'Lapooran Presensi',
    data(){
        return {
            items : [],
            fields : ['No.', 'Tanggal Presensi', 'Jumlah Kehadiran']
        }
    },
    methods: {
      fetchLaporan() {
        const bulan = this.$route.query.bulan;
        const tahun = this.$route.query.tahun;
        axios.get(this.$apiAdress + '/api/laporanPresensi?bulan=' + bulan + '&tahun=' + tahun + '&token=' + localStorage.getItem('api_token'))
        .then(r => {
          this.items = r.data.map((presensi, index) => {
            return {
              'No.': index + 1,
              'Tanggal Presensi': presensi.tanggal,
              'Jumlah Kehadiran' : presensi.presensi,
            }
          })
        });
      }
    },
    mounted() {
      this.fetchLaporan();
    }
}
</script>