<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Daftar KK</h2>
          </div>
        </CCardHeader>
        <CCardBody>
          <CDataTable
            hover
            striped
            :items="items"
            :fields="fields"
            :items-per-page="5"
            pagination>
          </CDataTable>
        </CCardBody>
      </CCard>

      <CCard>
      <CCardHeader>
        <CIcon name="cil-justify-center"/><strong>Statistik Jumlah KK</strong>
      </CCardHeader>
      <CCardBody>
        <CCard>
            <CRow class="ml-2 mr-2 d-flex justify-content-center">
                <CCol class = "mt-4" >
                    <CInput  label="Jumlah KK" disabled type="number" v-model="jumlahKK"/>
                </CCol>
            </CRow>
        </CCard>
    </CCardBody>
    </CCard>
    </CCol>
  </CRow>
</template>

<script>
import axios from 'axios';
export default {
  name: "LaporanKK",
  title: 'Laporan KK',
  data() {
    return {
      items: [],
      jumlahKK : 0,
      fields: ['no.', 'nomor KK', 'alamat', 'kepala Keluarga'],
    }
  },
  methods: {
    getAllKK() {
      axios.get(this.$apiAdress + '/api/KK').then( r => {
        this.jumlahKK = r.data.length;
        this.items = r.data.map((data, index) => {
          return {
          'no.': index+1,
          'nomor KK': data.nomorKK,
          'alamat': data.alamat,
          'kepala Keluarga': data.kepalaKeluarga,
          'id' : data.id,
        }});
      });
    },
  },
  mounted() {
    this.getAllKK();

  }
}
</script>