<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Daftar Pembayaran</h2>
          </div>
          <div>
            <CInput
              label="Search KK"
              placeholder="Cari nama kepala keluarga, atau no kk"
              type="text"
              id="searchKK"
            />
          </div>
        </CCardHeader>
        <CCardBody>
          <CDataTable
            hover
            striped
            :items="items"
            :fields="fields"
            :items-per-page="5"
            pagination
          >
            <template #Aksi="{ item }">
              <td>
                <div v-if="item['Tanggal Bayar'] == 'Belum Bayar'">
                  <router-link :to="'/pembayaran/bayar?tagihan=' + $route.params.id + '&kk=' + item.id">
                    <CButton color="warning">Bayar</CButton>
                  </router-link>
                </div>
                <div v-else>
                  <router-link :to="'/pembayaran/' + item.id">
                    <CButton color="primary">Detail</CButton>
                  </router-link>
                </div>
              </td>
            </template>
          </CDataTable>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>
<script>
import axios from "axios";
export default {
  name: "DaftarPembayaran",
  title:'Daftar Pembayaran',
  data() {
    return {
      items: [],
      fields: ["No.", "Nomor KK", "Tanggal Bayar", "Aksi"],
    };
  },
  methods: {
    fetchAllPembayaran() {
      axios.get(this.$apiAdress + '/api/pembayaran?tagihan=' + this.$route.params.id + '&token=' + localStorage.getItem('api_token')).then(r => {
        // console.log(r.data.length);
        if (r.data.length) {
          this.items = r.data.map((data, index) => {
            return {
              "No.": index+1,
              "Nomor KK": data.nomorKK,
              "Tanggal Bayar": data.tanggalBayar,
              id: data.id,
              kepalaKeluarga: data.kepalaKeluarga,
            }
          });
        }
        // console.log(this.items);
        this.fetchBelumDibayar(r.data.length);
      })
    },
    fetchBelumDibayar(nomorTerakhir) {
      axios.get(this.$apiAdress + '/api/pembayaran/?tagihan' + this.$route.params.id + '&belum=true' + '&token=' + localStorage.getItem('api_token')).then(r => {
        r.data.forEach((data, index) => {
          this.items.push({
            "No.": nomorTerakhir + index+1,
            "Nomor KK": data.nomorKK,
            "Tanggal Bayar": "Belum Bayar",
            id: data.id,
            kepalaKeluarga: data.kepalaKeluarga,
          })
        });
      })
    }
  },
  mounted() {
    this.fetchAllPembayaran();
  }
};
</script>
