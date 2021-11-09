<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Laporan Fasilitas</h2>
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
          </CDataTable>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import axios from "axios";
export default {
  name: "LaporanFasilitas",
  data() {
    return {
      items: [],
      fields: ["No.", "Nama Fasilitas", "Kondisi", "Informasi"],
    };
  },
  methods: {
    getAllFasilitas() {
      axios
        .get(
          this.$apiAdress +
            "/api/fasilitas" +
            "?token=" +
            localStorage.getItem("api_token")
        )
        .then((r) => {
          this.items = r.data.map((data, index) => {
            return {
              "No.": index + 1,
              "Nama Fasilitas": data.namaFasilitas,
              Kondisi: data.kondisi,
              Informasi: data.informasi,
              id: data.id,
            };
          });
        });
    },
  },
  mounted() {
    this.getAllFasilitas();
  },
};
</script>