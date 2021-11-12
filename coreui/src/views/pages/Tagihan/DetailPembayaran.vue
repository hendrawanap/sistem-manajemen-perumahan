<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Detail Pembayaran</h2>
          </div>
        </CCardHeader>
        <CCardBody>
          <CForm v-on:submit.prevent>
            <CInput disabled label="Nomor KK" type="text" v-model="nomorKK"/>
            <CInput disabled label="Tanggal" type="date" v-model="tanggalBayar"/>
            <CInput disabled label="Nama Pembayar" type="text" v-model="namaPembayar"/>
            <CCard>
              <CCardHeader>Rincian Pembayaran</CCardHeader>
              <CCardBody>
                <CRow
                  v-for="(detail, index) in detailPembayaran"
                  :key="'detail-'+index"
                >
                  <CCol>
                    <CInput disabled label="Tipe" type="text" :value="detail.tipe" />
                  </CCol>
                  <CCol>
                    <CInput
                      disabled
                      label="Nominal"
                      type="number"
                      :value="detail.nominal"
                    />
                  </CCol>
                </CRow>
              </CCardBody>
              <CCardFooter><CInput disabled label="Total Tagihan: " :value="getTotalPembayaran()"/></CCardFooter>
            </CCard>
            <div class="d-flex justify-content-end"><CButton color="primary" @click="cetakPembayaran()">Cetak Pembayaran</CButton></div>
          </CForm>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import axios from "axios";

export default {
  name: "DetailPembayaran",
  title: 'Detail Pembayaran',
  data() {
    return {
      nomorKK: null,
      tanggalBayar: null,
      namaPembayar: null,
      detailPembayaran: null,
    };
  },
  methods: {
    fetchPembayaran() {
      axios.get(this.$apiAdress + '/api/pembayaran/' + this.$route.params.id + '?token=' + localStorage.getItem('api_token')).then(r => {
        this.nomorKK = r.data.nomorKK;
        this.tanggalBayar = r.data.tanggalBayar;
        this.namaPembayar = r.data.namaPembayar;
        this.detailPembayaran = JSON.parse(r.data.rincian);
      })
    },
    getTotalPembayaran() {
      return this.detailPembayaran.map(p => p.nominal).reduce((total, nominal) => total + nominal);
    },
    cetakPembayaran() {
      window.print();
    }
  },
  mounted() {
    this.fetchPembayaran();
  }
};
</script>
