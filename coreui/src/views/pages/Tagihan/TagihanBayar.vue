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
          <CForm @submit.prevent="catatPembayaran">
            <CInput disabled label="Nomor KK" type="text" v-model="nomorKK" />
            <CInput
              label="Tanggal"
              type="date"
              v-model="tanggalBayar"
              invalid-feedback="Tanggal Bayar tidak boleh kosong."
              :is-valid="tanggalBayar != null"
              required
            />
            <CInput
              label="Nama Pembayar"
              type="text"
              v-model="namaPembayar"
              invalid-feedback="Nama Pembayar tidak boleh kosong."
              :is-valid="namaPembayar.length > 0"
              required
            />
            <CCard>
              <CCardHeader>Rincian Pembayaran</CCardHeader>
              <CCardBody>
                <CRow
                  v-for="(detail, index) in detailPembayaran"
                  :key="'detail-' + index"
                >
                  <CCol>
                    <CInput
                      disabled
                      label="Tipe"
                      type="text"
                      :value="detail.tipe"
                    />
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
              <CCardFooter
                ><CInput
                  disabled
                  label="Total Tagihan: "
                  :value="getTotalPembayaran()"
              /></CCardFooter>
            </CCard>
            <div class="d-flex justify-content-end">
                <CButton type="submit" color="primary">Catat Pembayaran</CButton>
            </div>
          </CForm>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import axios from "axios";

export default {
  name: "BayarTagihan",
  title: "Bayar Tagihan",
  data() {
    return {
      nomorKK: null,
      tanggalBayar: null,
      namaPembayar: "",
      detailPembayaran: [],
    };
  },
  methods: {
    fetchTagihan() {
      axios
        .get(
          this.$apiAdress +
            "/api/tagihan/" +
            this.$route.query.tagihan +
            "?token=" +
            localStorage.getItem("api_token")
        )
        .then((r) => {
          this.detailPembayaran = JSON.parse(r.data.rincian);
        });
    },
    getTotalPembayaran() {
      return this.detailPembayaran
        .map((p) => p.nominal)
        .reduce((total, nominal) => total + nominal);
    },
    fetchKK() {
      axios
        .get(
          this.$apiAdress +
            "/api/kk/" +
            this.$route.query.kk +
            "?token=" +
            localStorage.getItem("api_token")
        )
        .then((r) => {
          this.nomorKK = r.data.nomorKK;
        });
    },
    catatPembayaran() {
        const formData = new FormData();
        formData.append('namaPembayar', this.namaPembayar);
        formData.append('tanggalBayar', this.tanggalBayar);
        formData.append('idKK', this.$route.query.kk);
        formData.append('idTagihan', this.$route.query.tagihan);

        axios.post(this.$apiAdress + '/api/pembayaran?token=' + localStorage.getItem('api_token'), formData).then(r => {
            console.log(r.data.message);
            this.$router.push('/tagihan/' + this.$route.query.tagihan);
        })
    }
  },
  mounted() {
    this.fetchTagihan();
    this.fetchKK();
  },
};
</script>