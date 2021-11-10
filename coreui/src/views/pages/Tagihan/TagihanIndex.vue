<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Tagihan</h2>
            <router-link :to="'/tagihan/tambah'">
              <CButton color="primary"> Tambah </CButton>
            </router-link>
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
                <router-link :to="'/tagihan/' + item.id">
                  <CButton color="primary">Lihat Pembayaran</CButton>
                </router-link>
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
  name: "TagihanIndex",
  title:'Daftar Tagihan',
  data() {
    return {
      items: [],
      fields: ["No.", "Nama Tagihan", "Tanggal", "Aksi"],
    };
  },
  methods: {
    fetchTagihan() {
      axios
        .get(
          this.$apiAdress +
            "/api/tagihan?token=" +
            localStorage.getItem("api_token")
        )
        .then((r) => {
          this.items = r.data.map((item, index) => {
            return {
              "No.": index + 1,
              "Nama Tagihan": item.namaTagihan,
              Tanggal: item.tanggalTagihan,
            };
          });
        });
    },
  },
  mounted() {
    this.fetchTagihan();
  },
};
</script>
