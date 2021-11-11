<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Rincian Tagihan</h2>
          </div>
        </CCardHeader>
        <CCardBody>
          <CForm v-on:submit.prevent>
            <CInput label="Nama Tagihan" disabled type="text" v-model="namaTagihan" />
            <CInput label="Tanggal" disabled type="date" v-model="tanggal"/>
            Rincian
              <CCard>
                <CRow class = "ml-2 mr-2" v-for = "t in tagihan" :key = " t.tipe ">
                  <CCol>
                    <CInput label="Tipe" disabled type="text" v-model="t.tipe"/>
                  </CCol>
                  <CCol>
                    <CInput label="Nominal" disabled type="number" v-model="t.nominal"/>
                  </CCol>
                </CRow>
              </CCard>
            <CInput label="Total Tagihan" disabled v-model="total" />
          </CForm>
        </CCardBody>
      </CCard>

      <CCard>
      <CCardHeader>
        <CIcon name="cil-justify-center"/><strong>Statistik Tagihan</strong>
      </CCardHeader>
      <CCardBody>
        <CCard>
            <CRow class="ml-2 mr-2 d-flex justify-content-between">
                <CCol class = "mt-4" >
                    <CInput  label="Jumlah KK" disabled type="number" v-model="jumlahKK"/>
                </CCol>
                <CCol>
                    <CInput label="Total Lunas" disabled type="number" v-model="sudahLunas"/>
                    <CInput label="Belum Lunas" disabled type="number" v-model="belumLunas"/>
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
  name: "LaporanTagihan",
  title: 'Laporan Tagihan',
  computed : {
      total() {
          return this.tagihan.map(t => t.nominal).reduce((total,nominal) => total + nominal)
      },
      belumLunas() {
          return this.jumlahKK-this.sudahLunas
      },
  },
  data() {
    return {
        tagihan: [
            {
                tipe: "Iuran Keamanan",
                nominal: 400000,
            },
            {
                tipe: "Iuran Kebersihan",
                nominal: 200000,
            },
            {
                tipe: "Iuran Kontrol",
                nominal: 100000,
            }
        ],
        namaTagihan: "Tagihan Bulan Oktober",
        tanggal: "2021-10-20",
        jumlahKK: 0,
        sudahLunas: 20,
        items : [],
        fields: ['no','id'],
        
        

    };
  },
  methods :{
      getTotalKK() {
      axios.get(this.$apiAdress + '/api/KK').then( r => {
        this.jumlahKK = r.data.length
      });
    },
  },
  mounted() {
      this.getTotalKK();
  }
};
</script>