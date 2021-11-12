<template>
  <div class="wrapper">
    <CAlert :show.sync="showAlert" color="success" closeButton>
      {{ message }}
      <CButton
        class="position-absolute"
        color="secondary"
        style="right: 10px; top: 50%; transform: translateY(-50%)"
        @click="showAlert = false"
      >
        Close
      </CButton>
    </CAlert>
    <div>
      <CRow>
        <CCol>
          <CCard>
            <CCardHeader>
              <div class="d-flex justify-content-between">
                <h2>Daftar Fasilitas</h2>
                <router-link :to="'/fasilitas/tambah'">
                  <CButton color="primary">Tambah</CButton>
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
                <template #action="{ item }">
                  <td>
                    <router-link :to="'/fasilitas/edit/' + item.id">
                      <CButton color="primary" class="mr-2">Edit</CButton>
                    </router-link>
                    <CButton color="danger" @click="openModal(item.id)"
                      >Hapus</CButton
                    >
                  </td>
                </template>
              </CDataTable>
            </CCardBody>
          </CCard>
        </CCol>
      </CRow>
    </div>
    <div>
      <CModal title="Hapus Pegawai" :show.sync="hapusModal">
        Apakah Anda yakin menghapus data Fasilitas ini?
        <template #footer>
          <CButton @click="hapusModal = false" color="secondary"
            >Batalkan</CButton
          >
          <CButton @click="deleteFasilitas()" color="danger">Hapus</CButton>
        </template>
      </CModal>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "FasilitasIndex",
  title: "Daftar Fasilitas",
  data() {
    return {
      items: [],
      fields: ["No.", "Nama Fasilitas", "Kondisi", "Informasi", "action"],
      hapusModal: false,
      selectedFasilitas: null,
      showAlert: false,
      message: "",
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
    deleteFasilitas() {
      axios
        .delete(
          this.$apiAdress +
            "/api/fasilitas/" +
            this.selectedFasilitas +
            "?token=" +
            localStorage.getItem("api_token")
        )
        .then((r) => {
          this.getAllFasilitas();
          this.hapusModal = false;
          this.showAlert = true;
          this.message = r.data.message;
        });
    },
    openModal(id) {
      this.selectedFasilitas = id;
      this.hapusModal = true;
    },
  },
  mounted() {
    this.message = this.$route.query.message;
    if (this.message) {
      this.showAlert = true;
      this.$router.push("/fasilitas");
    }
    this.getAllFasilitas();
  },
};
</script>
